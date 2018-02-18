<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '驗證紀錄';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radpostauth-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            //'nasipaddress',
            'reply',
            'authdate',

            [
                'label' => '',
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::a('刪除', Url::toroute(['delete', 'id' => $model->id]), [
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
