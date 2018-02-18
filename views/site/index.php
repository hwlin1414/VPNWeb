<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'NCTU CSCC VPN';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p>
            <?= Html::a('Get OpenVPN Config!', ['/vpn/config'], ['class' => 'btn btn-lg btn-info']) ?>

            <a class="btn btn-lg btn-success" href="https://openvpn.net/index.php/open-source/downloads.html" target="_blank">Donwload OpenVPN Now!</a>
        </p>
        <p>Your IP is: <?= $_SERVER['REMOTE_ADDR'] ?></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4"></div>
        </div>

    </div>
</div>
