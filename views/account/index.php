<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '特殊帳號';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radcheck-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新增帳號', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => '帳號',
                'attribute' => 'username',
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::a($model->username, Url::toroute(['update', 'id' => $model->id]));
                }
            ],
             'attribute:text:屬性',
             'value:text:值',
            [
                'label' => '',
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::a('刪除', Url::toroute(['delete', 'id' => $model->id]), [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '您確定要刪除帳號嗎?',
                            'method' => 'post',
                        ],
                    ]);
                }
            ],
        ],
    ]); ?>
</div>
