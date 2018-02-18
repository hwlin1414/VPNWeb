<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $items = [
        ['label' => '首頁', 'url' => ['/site/index']],
    ];
    if(Yii::$app->user->isGuest){
        $items[] = ['label' => '登入', 'url' => ['/site/login']];
    }else{
        $items[] = ['label' => 'VPN', 'items' => [
            ['label' => '選擇路由', 'url' => ['/vpn/route'], 'visible' => Yii::$app->user->identity->isVip()],
            ['label' => 'WhatIsMyIP', 'url' => 'https://ifconfig.co/', 'linkOptions' => ['target' => '_blank'],],
            ['label' => '設定檔下載', 'url' => ['/vpn/config']],
        ]];
        if(Yii::$app->user->identity->isAdmin()){
            $items[] = ['label' => '管理', 'items' => [
                ['label' => '特殊帳號', 'url' => ['/account/index']],
                ['label' => '驗證紀錄', 'url' => ['/auth/index']],
                ['label' => '使用紀錄', 'url' => ['/radacct/index']],
            ]];
        }
        $items[] = '<li>' . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '登出 (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm() . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; CSCC <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
