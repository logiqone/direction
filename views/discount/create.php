<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupDiscount */

$this->title = Yii::t('app', 'Create Group Discount');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group Discounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-discount-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
