<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Radcheck */

$this->title = '新增帳號';
$this->params['breadcrumbs'][] = ['label' => '特殊帳號', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radcheck-create">

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
            <?= Html::submitButton('新增', ['class' => 'btn btn-success']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    
    </div>

</div>
