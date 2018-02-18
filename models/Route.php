<?php

namespace app\models;

class Route extends \yii\base\Model
{
    public $_ip;
    public $_route;
    public $_tables;

    public function rules(){
        return [['route', 'safe']];
    }

    public function getIp(){
        if ($this->_ip == null){
            $user = \yii::$app->user->identity->username;
            $output = "";
            exec(\yii::getAlias("@app/commands/openvpn.sh ${user}"), $output);
            if(count($output) == 0 || $output[0] == ""){
                throw new \yii\web\ServerErrorHttpException('請先連至 OpenVPN 伺服器');
            };
            $this->_ip = explode(",", $output[0])[0];

        }
        return $this->_ip;
    }

    public function getTables(){
        if ($this->_tables == null){
            $this->_tables = [];
            $output = "";
            exec("/usr/local/bin/sudo /sbin/pfctl -s Tables", $output);
            foreach($output as $value){
                $this->_tables[$value] = $value;
            }
        }
        return $this->_tables;
    }

    public function getRoute(){
        if ($this->route == null){
            $ret = 0;
            $ip = $this->ip;
            foreach($this->tables as $t){
                exec("/usr/local/bin/sudo /sbin/pfctl -t ${t} -T show | grep ${ip}", $output, $ret);
                if($ret == 0){
                    $this->_route = $t;
                    break;
                }
            }
        }
        return $this->_route;
    }

    public function setRoute($table){
        if(!in_array($table, $this->tables)){
            throw new \yii\web\ServerErrorHttpException("目標 Table: ${table} 不存在");
        }

        $ip = $this->ip;
        foreach($this->tables as $t){
            exec("/usr/local/bin/sudo /sbin/pfctl -t ${t} -T delete ${ip}");
        }
        exec("/usr/local/bin/sudo /sbin/pfctl -t ${table} -T add ${ip}");
        exec("/usr/local/bin/sudo /sbin/pfctl -k ${ip}");
        $this->_route = $table;
        \yii::$app->session->setFlash('route', 'You have successfully change your route.');

    }

    public function attributeLabels(){
        return ['route' => '路由'];
    }
}
