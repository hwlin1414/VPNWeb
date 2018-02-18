<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\bootstrap\ActiveForm;

$this->title = '選擇路由';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="vpn-route">

    <div>
        <?php
            if(\yii::$app->session->getFlash('route') != null){
                echo Alert::widget([
                    'options' => ['class' => 'alert-info'],
                    'body' => \yii::$app->session->getFlash('route'),
                ]);
            }
        ?>
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'vpn-route',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],

    ]); ?>

    <?= $form->field($model, 'route')->radioList($model->tables, []) ?>

    <p>警告：變更路由可能導致所有連線中斷！</p>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('設定', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
