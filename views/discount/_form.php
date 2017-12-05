<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GroupDiscount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-discount-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'percentage')->textInput() ?>

    <?= $form->field($model, 'description_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'promo_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promo_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promo_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promo_robots')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
