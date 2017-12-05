<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'country_name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promo_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promo_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promo_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promo_robots')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
