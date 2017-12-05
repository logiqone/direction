<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                ]); ?>

                    <h1>Алоха!</h1>
                    <div>
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true,
                            'class' => 'form-control'])->label(false) ?>
                    </div>
                    <div>
                        <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
                    </div>
                    <div>
                        <?= Html::submitButton('Login', ['class' => 'btn btn-default submit', 'name' => 'login-button']) ?>
                        <a class="reset_pass" href="#">Забыли пароль?</a>
                    </div>

                    <div class="clearfix"></div>
                    <br />

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"js-switch\"> &nbsp;{input} &nbsp;{label}</div>\n<div class=\"col-lg-12\">{error}</div>",
                    ]) ?>

                    <div class="clearfix"></div>
                    <br />
                        <div>
                            <h1><i class="fa fa-paw"></i> Original</h1>
                            <p>©2017 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </section>
        </div>

    </div>
</div>

