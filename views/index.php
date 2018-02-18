<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '使用紀錄';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radacct-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'radacctid',
            // 'acctsessionid',
            // 'acctuniqueid',
            [
                'attribute' => 'username',
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::a($model->username, ['view', 'id' => $model->radacctid]);
                }
            ],
            // 'groupname',
            // 'realm',
            'nasipaddress',
            // 'nasportid',
            // 'nasporttype',
             'acctstarttime',
            // 'acctupdatetime',
             'acctstoptime',
            // 'acctinterval',
            [
                'attribute' => 'acctsessiontime',
                'format' => 'text',
                'value' => function($model, $key, $index, $widget){
                    return str_pad((int)($model->acctsessiontime / 3600), 2, '0', STR_PAD_LEFT)
                        . ':'
                        . str_pad((int)(($model->acctsessiontime % 3600) / 60), 2, '0', STR_PAD_LEFT)
                        . ':'
                        . str_pad((int)($model->acctsessiontime % 60), 2, '0', STR_PAD_LEFT);
                }
            ],
            // 'acctauthentic',
            // 'connectinfo_start',
            // 'connectinfo_stop',
            //'acctinputoctets',
            //'acctoutputoctets',
            // 'calledstationid',
            // 'callingstationid',
            // 'acctterminatecause',
            // 'servicetype',
            // 'framedprotocol',
            'framedipaddress',

            [
                'label' => '',
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::a('刪除', Url::toroute(['delete', 'id' => $model->radacctid]), [
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
