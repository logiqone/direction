<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupDiscount */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Group Discount',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group Discounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="group-discount-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
