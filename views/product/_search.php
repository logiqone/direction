<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'freeze') ?>

    <?= $form->field($model, 'deleted') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'code_kupinoj') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'brand_id') ?>

    <?php // echo $form->field($model, 'availability') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'novelty') ?>

    <?php // echo $form->field($model, 'bestseller') ?>

    <?php // echo $form->field($model, 'collection_id') ?>

    <?php // echo $form->field($model, 'discount_id') ?>

    <?php // echo $form->field($model, 'short_description') ?>

    <?php // echo $form->field($model, 'full_description') ?>

    <?php // echo $form->field($model, 'video_link') ?>

    <?php // echo $form->field($model, 'promo_title') ?>

    <?php // echo $form->field($model, 'promo_description') ?>

    <?php // echo $form->field($model, 'promo_keywords') ?>

    <?php // echo $form->field($model, 'promo_robots') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
