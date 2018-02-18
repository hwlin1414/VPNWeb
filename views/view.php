<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Radacct */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '使用紀錄', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radacct-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('刪除', ['delete', 'id' => $model->radacctid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您確定要刪除紀錄嗎?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'radacctid',
            'acctsessionid',
            'acctuniqueid',
            'username',
            ['label' => 'finger', 'value' => $model->gecos],
            'groupname',
            'realm',
            'nasipaddress',
            'nasportid',
            'nasporttype',
            'acctstarttime',
            'acctupdatetime',
            'acctstoptime',
            'acctinterval',
            //'acctsessiontime:datetime',
            [
                'label' => 'acctsessiontime',
                'value' => str_pad((int)($model->acctsessiontime / 3600), 2, '0', STR_PAD_LEFT)
                        . ':'
                        . str_pad((int)(($model->acctsessiontime % 3600) / 60), 2, '0', STR_PAD_LEFT)
                        . ':'
                        . str_pad((int)($model->acctsessiontime % 60), 2, '0', STR_PAD_LEFT),
            ],
            'acctauthentic',
            'connectinfo_start',
            'connectinfo_stop',
            'acctinputoctets',
            'acctoutputoctets',
            'calledstationid',
            'callingstationid',
            'acctterminatecause',
            'servicetype',
            'framedprotocol',
            'framedipaddress',
        ],
    ]) ?>

</div>
