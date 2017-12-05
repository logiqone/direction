<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \app\models\Brand;
use \app\models\Category;
use \app\models\GroupCollection;
use \app\models\GroupDiscount;
use \app\helpers\CategoryTree;
use \app\helpers\SameCategoryProducts;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
isset($_COOKIE['accordionState']) ? $accordionState = $_COOKIE['accordionState'] : $accordionState = "0";

?>
<div class="product-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <!-- start accordion -->
    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
        <div class="panel">
            <a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" data-num="1" href="#collapseOne1" aria-expanded="false" aria-controls="collapseOne" onclick="rememberAccordionState(this)">
                <h4 class="panel-title">Свойства</h4>
            </a>
            <div id="collapseOne1" class="panel-collapse collapse <?php if($accordionState == 1) echo "in" ?>" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <?= $form->field($product, 'code')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($product, 'code_kupinoj')->textInput(['maxlength' => true,
                        'disabled' => true]) ?>
                    <?= $form->field($product, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($product,
                        'brand_id')->dropDownList( ArrayHelper::map(Brand::find()->all(),
                        'id', 'name'), ['prompt'=>'Выберите бренд...']) ?>

                    <?php
                        $tree = new CategoryTree();
                        $itemsCategory = $tree->GetItems();
                        $paramsCategory = [
                            'multiple' => 'true',
                        ];
                        echo $form->field($product, 'category_ids')->dropDownList($itemsCategory,$paramsCategory);
                    ?>

                    <?= $form->field($product, 'weight')->textInput() ?>
                    <?= $form->field($product, 'price')->textInput() ?>

                    <?= $form->field($product, 'collection_id')->dropDownList(
                        ArrayHelper::map(GroupCollection::find()->all(),'id', 'name'),
                        ['prompt'=>'Выберите коллекцию...']) ?>
                    <?= $form->field($product, 'discount_id')->dropDownList(
                        ArrayHelper::map(GroupDiscount::find()->all(), 'id', 'name'),
                        ['prompt'=>'Выберите скидку...']) ?>
                    <?= $form->field($product, 'short_description')->textarea(['rows' => 6]) ?>
                    <?= $form->field($product, 'full_description')->textarea(['rows' => 6]) ?>
                    <?= $form->field($product, 'video_link')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($product, 'availability')->checkbox([
                        'label' => ' Наличие',
                        'labelOptions' => [
                            'class' => 'check'
                        ],
                    ]); ?>

                    <?= $form->field($product, 'freeze')->checkbox([
                        'label' => ' Заморожен',
                        'labelOptions' => [
                            'class' => 'check'
                        ],
                    ]); ?>
                    <?= $form->field($product, 'deleted')->checkbox([
                        'label' => ' Удалён',
                        'labelOptions' => [
                            'class' => 'check'
                        ],
                    ]);  ?>
                    <?= $form->field($product, 'novelty')->checkbox([
                        'label' => ' Новинка',
                        'labelOptions' => [
                            'class' => 'check'
                        ],
                    ]);  ?>
                    <?= $form->field($product, 'bestseller')->checkbox([
                        'label' => ' Хит продаж',
                        'labelOptions' => [
                            'class' => 'check'
                        ],
                    ]);  ?>
                </div>
            </div>
        </div>
        <div class="panel">
            <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" data-num="2" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo" onclick="rememberAccordionState(this)">
                <h4 class="panel-title">Основное фото</h4>
            </a>
            <div id="collapseTwo1" class="panel-collapse collapse <?php if($accordionState == 2) echo "in" ?>" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">

                    <?= $form->field($product, 'file')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
                        'aspectRatio' => (16/9), //set the aspect ratio
                        'cropViewMode' => 1, //crop mode, option info: https://github.com/fengyuanchen/cropper/#viewmode
                        'showPreview' => true, //false to hide the preview
                        'showDeletePickedImageConfirm' => false, //on true show warning before detach image
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="panel">
            <a class="panel-heading collapsed" role="tab" id="headingThree1" data-toggle="collapse" data-parent="#accordion1" data-num="3" href="#collapseThree1" aria-expanded="false" aria-controls="collapseThree" onclick="rememberAccordionState(this)">
                <h4 class="panel-title">Дополнительное фото</h4>
            </a>
            <div id="collapseThree1" class="panel-collapse collapse <?php if($accordionState == 3) echo "in" ?>" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    Дополнительные фото
                </div>
            </div>
        </div>

        <div class="panel">
            <a class="panel-heading collapsed" role="tab" id="headingFour1" data-toggle="collapse" data-parent="#accordion1" data-num="4" href="#collapseFour1" aria-expanded="false" aria-controls="collapseFour" onclick="rememberAccordionState(this)">
                <h4 class="panel-title">Раскрутка</h4>
            </a>
            <div id="collapseFour1" class="panel-collapse collapse <?php if($accordionState == 4) echo "in" ?>" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                    <?= $form->field($product, 'promo_title')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($product, 'promo_description')->textarea(['rows' => 6])  ?>
                    <?= $form->field($product, 'promo_keywords')->textarea(['rows' => 6])  ?>
                    <?= $form->field($product, 'promo_robots')->dropDownList([
                        '' => 'Пусто',
                        'NONE' => 'NONE',
                        'ALL' => 'ALL',
                        'INDEX,NOFOLLOW'=>'INDEX,NOFOLLOW',
                        'NOINDEX,FOLLOW'=>'NOINDEX,FOLLOW',
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end of accordion -->

    <br>
    <div class="form-group">
        <?= Html::submitButton($product->isNewRecord ? Yii::t('app', 'Сохранить') : Yii::t('app', 'Обновить'), ['class' => $product->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>