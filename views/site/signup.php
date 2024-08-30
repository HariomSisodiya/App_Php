<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use yii\helpers\Url;

/** @var yii\web\View $this */
$model = new app\models\Student();

AppAsset::register($this);

$this->title = 'Signup Form';
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

        .btn-dark{
            background-color: #333;
        }

        .btn-dark:hover{
            background-color: #333 !important;
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

    <!-- <div class="wrapper"> -->
    <div class="inner">
        <div class="image-holder">
            <img src="<?= Url::to('@web/image/student1.webp') ?>" alt="Student Image">
        </div>
        <div class="form-container">
            <h1><?= Html::encode($this->title) ?></h1>

            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'form-horizontal'],
            ]); ?>

            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Student Name']) ?>
            <?= $form->field($model, 'fathername')->textInput(['placeholder' => 'Father Name']) ?>

            <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Subject']) ?>

            <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email Address']) ?>

            <?= $form->field($model, 'gender')->dropDownList([
                '' => 'Gender',
                'male' => 'Male',
                'female' => 'Female',
                'other' => 'Other',
            ]) ?>

            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>
            <div class="row w-100 d-flex align-items-center">
                <div class="col-md-4 ">
                    <?= Html::submitButton('SignUp', ['class' => 'btn btn-dark'] ) ?>
                </div>
                <div class="col-md-8">
                    <span class="already">
                        Already have an account?
                        <?= Html::a('Login here', ['site/login'], ['style' => 'text-decoration : none ; font-weight : bold ; color : #333;']) ?>
                    </span>

                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <!-- </div> -->

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>