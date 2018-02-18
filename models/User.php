<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $dn;
    public $username;

    private static function ldap_init()
    {
        $ds = ldap_connect(\yii::$app->params['ldap']['host']);
        if (!$ds) { throw new \yii\web\ServerErrorHttpException('LDAP Server Error'); }
        if(\yii::$app->params['ldap']['startTLS']) ldap_start_tls($ds);
        return $ds;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $data = \yii::$app->cache->get('id_' . $id);
        if ($data === false){
            $ds = static::ldap_init();
            $filter = sprintf(\yii::$app->params['ldap']['filterByUid'], $id);
            $sr = ldap_search($ds, \yii::$app->params['ldap']['basedn'], $filter);

            $info = ldap_get_entries($ds, $sr)[0];
            if($info === null) return null;
            ldap_close($ds);

            $data = new static([
                'id' => $info['uidnumber'][0],
                'dn' => $info['dn'],
                'username' => $info['uid'][0],
            ]);
            \yii::$app->cache->set('id_' . $data->id, $data, 3600);
            \yii::$app->cache->set('username_' . $data->username, $data, 3600);
        }
        return $data;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $data = \yii::$app->cache->get('username_' . $username);
        if ($data === false){
            $ds = static::ldap_init();

            $filter = sprintf(\yii::$app->params['ldap']['filterByName'], $username);
            $sr = ldap_search($ds, \yii::$app->params['ldap']['basedn'], $filter);

            $info = ldap_get_entries($ds, $sr)[0];
            if($info === null) return null;
            ldap_close($ds);

            $data = new static([
                'id' => $info['uidnumber'][0],
                'dn' => $info['dn'],
                'username' => $info['uid'][0],
            ]);
            \yii::$app->cache->set('id_' . $data->id, $data, 3600);
            \yii::$app->cache->set('username_' . $data->username, $data, 3600);
        }
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return md5($this->username.$this->id);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return md5($this->username.$this->id) == $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        try{
            $ds = static::ldap_init();
            $r = ldap_bind($ds, $this->dn, $password);
            ldap_close($ds);
            return $r;
        } catch (Exception $e) {}
        return false;
    }
    public function isVip()
    {
        return in_array($this->username, \yii::$app->params['vip']);
    }
    public function isAdmin()
    {
        return in_array($this->username, \yii::$app->params['admin']);
    }
}
