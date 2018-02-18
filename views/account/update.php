<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Radcheck */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '特殊帳號', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->username;
?>
<div class="radcheck-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="radcheck-form">
    
        <?php $form = ActiveForm::begin(); ?>
    
        <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label('帳號') ?>
    
        <?= Html::activeDropDownList($model, 'attribute', [
            'Crypt-Password' => 'Crypt-Password',
            'Cleartext-Password' => 'Cleartext-Password',
            'Auth-Type' => 'Reject (無須填密碼)',
        ]) ?>

        <?= $form->field($model, 'value')->passwordInput(['maxlength' => true, 'value' => ''])->label('密碼') ?>
    
        <div class="form-group">
            <?= Html::submitButton('更新', ['class' => 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    
    </div>

    <h2>驗證紀錄</h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'nasipaddress',
            'reply',
            'authdate',

            [
                'label' => '',
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::a('刪除', Url::toroute(['auth/delete', 'id' => $model->id]), [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '您確定要刪除紀錄嗎?',
                            'method' => 'post',
                        ],
                    ]);
                }
            ],
        ],
    ]); ?>

</div>
