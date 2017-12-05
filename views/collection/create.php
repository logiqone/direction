<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupCollection */

$this->title = Yii::t('app', 'Create Group Collection');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group Collections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-collection-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
