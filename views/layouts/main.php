<?php

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
/** @var yii\web\View $this */

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<style>
    /* Custom Navbar Styles */
    .navbar-custom {
        background-color: #333;
        border-radius: 50px;
        width: 96%;
        margin-top: 7px;
        margin-left: 30px;
        /* Change this to your preferred background color */
    }

    .navbar-custom .navbar-brand {
        color: #ffffff;
        /* Change brand link color */
    }

    .navbar-custom .navbar-nav .nav-link {
        color: #ffffff;
        /* Change navigation link color */
    }

    .navbar-custom .navbar-nav .nav-link:hover {
        color: #f8f9fa;
        /* Change hover color */
    }

    .navbar-custom .navbar-toggler-icon {
        /* background-image: url('path/to/custom-icon.svg'); */
        /* Replace with your custom icon if needed */
    }

    /* Adjustments for active links */
    .navbar-custom .nav-item.active .nav-link {
        color: #ffc107;
        /* Active link color */
    }
</style>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <?php if (!Yii::$app->user->isGuest): ?>
        <!-- Navbar appears only if the user is logged in -->
        <header id="header">
            <?php
            NavBar::begin([
                'brandLabel' => 'Knowledge+',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => ['class' => 'navbar-expand-md navbar-dark navbar-custom fixed-top'] // Apply custom class here
            ]);

            $navItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
            ];

            if (Yii::$app->user->isGuest) {
                $navItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $navItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $navItems[] = [
                    'label' => 'Logout',
                    'url' => ['/site/logout'],
                    'linkOptions' => [
                        'class' => 'nav-link btn btn-link logout',
                        'data-method' => 'post',
                        'data-confirm' => 'Are you sure you want to logout?'
                    ]
                ];
            }

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav d-flex align-items-end'],
                'items' => $navItems,
            ]);

            NavBar::end();
            ?>
        </header>
    <?php endif; ?>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
