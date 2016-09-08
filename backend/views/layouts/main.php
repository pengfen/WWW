<?php

use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>后台管理</title>
    <style>
        body,ul,li,p,h1,h2,h3,h4 {
            padding: 0; margin: 0;
        }
        body {
            font-size: 12px;
        }
        ul,li {
            list-style: none;
        }
        a {
            text-decoration: none;
        }
        img,input {
            border: none; outline: none;
        }
        .fl {
            float: left;
        }
        .fr {
            float: right;
        }
        .clear {
            clear: both;
        }
        .w {
            margin: 0 auto; width: 1200px;
        }
        .mt10 {
            margin-top: 10px;
        }
        .mt20 {
            margin-top: 20px;
        }
        .header {
            height: 60px; line-height: 60px; background: #14191c;
        }
        .header .logo {
            width: 140px; height: 60px;
        }
        .header .nav-left li {
            width: 80px; float: left;
        }
        .header .nav-left li a {
            color: #787d82; font-size: 14px;
        }
        .header .nav-left li a:hover {
            color: #fff; font-weight: bold;
        }
        .header .nav-right li {
            width: 80px; float: left; text-align: center;
        }
        .header .nav-right li a {
            color: #787d82; font-size: 14px;
        }
        .header .nav-right li a:hover {
            color: #fff; font-weight: bold;
        }
        .wrap {
            width: 1900px; margin: 0px auto;
        }

        /* 分页处理 */
        ul.pagination {
            width: 1000px; height: 39px; margin: 10px auto;
        }
        .pagination li {
            width: 39px; margin-right: 8px; height: 39px; line-height: 39px; background: #f3f3f3; text-align: center; float: left;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="header">
    <div class="w">
        <ul class="fl nav-left">
            <li><a href="">首页</a></li>
        </ul>
        <ul class="fr nav-right">
            <li><a href="">个人中心</a></li>
            <li><a href="">登录</a></li>
            <li><a href="">退出</a></li>
        </ul>
    </div>
</div>
<div class="clear"></div>

<div class="wrap">
    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"></p>

        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>