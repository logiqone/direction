<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/product.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/libs/js.cookie/js.cookie.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/libs/jquery.liTranslit/jquery.liTranslit.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = Yii::t('app', 'Создание продукта');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= \yiister\gentelella\widgets\FlashAlert::widget(['showHeader' => true]) ?>

    <?= $this->render('_form', [
        'product' => $product,
        'classKnife' => $classKnife,
        'classType' => $classType,
    ]) ?>

</div>
