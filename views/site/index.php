<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="site-index">
    <div class="container-fluid ">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div style="background-color: #333; color: white; padding: 150px; border-radius: 10px;">
                    <div class="row">
                        <div class="col-md-7">
                            <h6 style="color: #4db6ac; margin-bottom: 20px;">KNOWLEDGEPULSE</h6>
                            <h1 style="font-size: 3rem; font-weight: bold; margin-bottom: 20px;">Knowledge Meets<br>Innovation</h1>
                            <p style="color: #b2dfdb; margin-bottom: 30px;">This platform's simplicity belies its powerful capabilities, offering<br>a seamless and enjoyable educational experience.</p>
                            
                            <?php $form = ActiveForm::begin(['options' => ['class' => 'form-inline']]); ?>
                                <div class="input-group" style="width: 100%;">
                                    <?= Html::a('Get Courses' , ['/react'] , ['class' => 'btn btn-warning p-2'] ) ?>
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="col-md-5 position-relative">
                            <?= Html::img('@web/image/student3.avif', ['class' => 'img-fluid', 'alt' => 'Student image', 'style' => 'border-radius: 10px; object-fit: cover;']) ?>
                            <div style="position: absolute; top: 0; right: 0; width: 100px; height: 100px; background-color: #ffeb3b; border-radius: 0 10px 0 100%;"></div>
                            <div style="position: absolute; bottom: 0; left: 0; width: 50px; height: 50px; background-color: #4db6ac; border-radius: 0 50px 0 0;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f5f5f5;
    }
    .site-index {
        padding: 20px;
    }
    @media (max-width: 768px) {
        .col-md-5 {
            margin-top: 30px;
        }
    }
</style>