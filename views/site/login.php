<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use yii\helpers\Url;

/** @var yii\web\View $this */
$this->title = 'Login';

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .inner {
            display: flex;
            flex-direction: row;
            height: 85vh;
            padding: 6rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.8);
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            /* Ensure background is white */
        }

        .image-holder {
            flex: 1;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-holder img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .form-container {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h1 {
            margin-bottom: 30px;
            font-size: 24px;
            text-align: center;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }


        .btn-dark {
            display: inline-block;
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
            width: 100%;
            /* Full width button */
        }

        .btn-dark:hover{
            background-color: #333;
        }

        .already {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .already a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .already a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .inner {
                flex-direction: column;
            }

            .image-holder,
            .form-container {
                flex: none;
                width: 100%;
                padding: 20px;
            }

            .form-container {
                padding-top: 20px;
            }
        }
    </style>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="inner">
        <div class="image-holder">
            <img src="<?= Url::to('@web/image/student1.webp') ?>" alt="Login Image">
        </div>
        <div class="form-container">
            <h1><?= Html::encode($this->title) ?></h1>

            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'form-horizontal'],
            ]); ?>

            <?= $form->field($model, 'email')->input('email', ['placeholder' => 'Email Address']) ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

            <?= Html::submitButton('Login', ['class' => 'btn btn-dark']) ?>

            <div class="already">
                Don't have an account? <?= Html::a('Signup here', ['site/signup']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>