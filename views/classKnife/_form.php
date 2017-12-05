<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClassKnife */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="class-knife-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'blade_thickness')->textInput() ?>

    <?= $form->field($model, 'grind')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'handle_material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'blade_material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sheath_material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lanyard_hole_diameter')->textInput() ?>

    <?= $form->field($model, 'blade_length')->textInput() ?>

    <?= $form->field($model, 'blade_width')->textInput() ?>

    <?= $form->field($model, 'knife_width')->textInput() ?>

    <?= $form->field($model, 'knife_length')->textInput() ?>

    <?= $form->field($model, 'handle_length')->textInput() ?>

    <?= $form->field($model, 'blade_hardness')->textInput() ?>

    <?= $form->field($model, 'type_processing_blade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'blade_shape')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shape_sharpening')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sharpening_angle')->textInput() ?>

    <?= $form->field($model, 'sharpening_stone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sharpening_stages')->textInput() ?>

    <?= $form->field($model, 'lock_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clamp')->textInput() ?>

    <?= $form->field($model, 'fuse')->textInput() ?>

    <?= $form->field($model, 'mechanism_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number_of_layers')->textInput() ?>

    <?= $form->field($model, 'designer')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
