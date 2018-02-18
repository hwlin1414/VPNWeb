<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "radacct".
 *
 * @property integer $radacctid
 * @property string $acctsessionid
 * @property string $acctuniqueid
 * @property string $username
 * @property string $groupname
 * @property string $realm
 * @property string $nasipaddress
 * @property string $nasportid
 * @property string $nasporttype
 * @property string $acctstarttime
 * @property string $acctupdatetime
 * @property string $acctstoptime
 * @property integer $acctinterval
 * @property integer $acctsessiontime
 * @property string $acctauthentic
 * @property string $connectinfo_start
 * @property string $connectinfo_stop
 * @property integer $acctinputoctets
 * @property integer $acctoutputoctets
 * @property string $calledstationid
 * @property string $callingstationid
 * @property string $acctterminatecause
 * @property string $servicetype
 * @property string $framedprotocol
 * @property string $framedipaddress
 */
class Radacct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'radacct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acctstarttime', 'acctupdatetime', 'acctstoptime'], 'safe'],
            [['acctinterval', 'acctsessiontime', 'acctinputoctets', 'acctoutputoctets'], 'integer'],
            [['acctsessionid', 'username', 'groupname', 'realm'], 'string', 'max' => 64],
            [['acctuniqueid', 'nasporttype', 'acctauthentic', 'acctterminatecause', 'servicetype', 'framedprotocol'], 'string', 'max' => 32],
            [['nasipaddress', 'nasportid', 'framedipaddress'], 'string', 'max' => 15],
            [['connectinfo_start', 'connectinfo_stop', 'calledstationid', 'callingstationid'], 'string', 'max' => 50],
            [['acctuniqueid'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'radacctid' => 'Radacctid',
            'acctsessionid' => 'Acctsessionid',
            'acctuniqueid' => 'Acctuniqueid',
            'username' => 'Username',
            'groupname' => 'Groupname',
            'realm' => 'Realm',
            'nasipaddress' => 'Nasipaddress',
            'nasportid' => 'Nasportid',
            'nasporttype' => 'Nasporttype',
            'acctstarttime' => 'Acctstarttime',
            'acctupdatetime' => 'Acctupdatetime',
            'acctstoptime' => 'Acctstoptime',
            'acctinterval' => 'Acctinterval',
            'acctsessiontime' => 'Acctsessiontime',
            'acctauthentic' => 'Acctauthentic',
            'connectinfo_start' => 'Connectinfo Start',
            'connectinfo_stop' => 'Connectinfo Stop',
            'acctinputoctets' => 'Acctinputoctets',
            'acctoutputoctets' => 'Acctoutputoctets',
            'calledstationid' => 'Calledstationid',
            'callingstationid' => 'Callingstationid',
            'acctterminatecause' => 'Acctterminatecause',
            'servicetype' => 'Servicetype',
            'framedprotocol' => 'Framedprotocol',
            'framedipaddress' => 'Framedipaddress',
        ];
    }
}
