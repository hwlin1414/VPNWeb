<?php

namespace app\controllers;

use Yii;
use app\models\Radcheck;
use app\models\Radpostauth;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountController implements the CRUD actions for Radcheck model.
 */
class AccountController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function($rule, $action){
                            if(Yii::$app->user->isGuest) return false;
                            return Yii::$app->user->identity->isVip();
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Radcheck models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Radcheck::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Radcheck model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Radcheck();

        if ($model->load(Yii::$app->request->post())) {
            $model->op = ':=';
            switch($model->attribute){
                case 'Cleartext-Password':
                    $model->value = $model->value;
                    break;
                case 'Crypt-Password':
                    $model->value = crypt($model->value, '$1$'.uniqid());
                    break;
                case 'Auth-Type':
                    $model->value = 'Reject';
                    break;
            }
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Radcheck model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $o_attr = $model->attribute;
        $o_val = $model->value;

        if ($model->load(Yii::$app->request->post())){
            $model->op = ':=';
            if($model->attribute == $o_attr && $model->value == ''){
                $model->value = $o_val;
            }else{
                switch($model->attribute){
                    case 'Cleartext-Password':
                        $model->value = $model->value;
                        break;
                    case 'Crypt-Password':
                        $model->value = crypt($model->value, '$1$'.uniqid());
                        break;
                    case 'Auth-Type':
                        $model->value = 'Reject';
                        break;
                }
            }

            $model->save();
            return $this->redirect(['index']);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => Radpostauth::find()->where(['username' => $model->username]),
                'pagination' => ['pageSize' => 5],
            ]);
            return $this->render('update', [
                'model' => $model,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing Radcheck model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Radcheck model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Radcheck the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Radcheck::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
