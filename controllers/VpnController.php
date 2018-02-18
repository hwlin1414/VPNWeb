<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Route;

class VpnController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['route'],
                        'allow' => true,
                        'matchCallback' => function($rule, $action){
                            if(Yii::$app->user->isGuest) return false;
                            return Yii::$app->user->identity->isVip();
                        }
                    ],
                    [
                        'actions' => ['config'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionConfig()
    {
        return \Yii::$app->response->sendContentAsFile(
            $this->renderPartial('config', [
                //'ca' => file_get_contents("/usr/local/etc/openvpn/pki/ca.crt"),
                //'cert' => '*** CERT ***',
                //'key' => '*** KEY ***',
                //'tlsauth' => file_get_contents("/usr/local/etc/openvpn/ta.key"),
            ]),
            'nctucscc.ovpn'
        );
    }

    public function actionRoute()
    {
        $model = new Route();
        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['route']);
        }
        return $this->render('route', ['model' => $model]);
    }
}
