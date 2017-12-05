<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \app\models\Brand;
use kartik\select2\Select2;
use \app\models\GroupCollection;
use \app\models\GroupDiscount;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
isset($_COOKIE['accordionState']) ? $accordionState = $_COOKIE['accordionState'] : $accordionState = "0";
$this->registerJs(
    "$('#product-code').liTranslit();",
    View::POS_READY,
    'product-code-translit'
);
?>
<div class="product-form">
    <?php $form = ActiveForm::begin(['options' => [
            'action' => 'product/update',
            'enctype' => 'multipart/form-data',
            'id' => 'product-update'
    ]]); ?>

    <?= $form->field($product, 'code')->textInput(['maxlength' => true]) ?>

    <!-- start accordion -->
    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
        <div class="panel">
            <a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" data-num="1" href="#collapseOne1" aria-expanded="false" aria-controls="collapseOne" onclick="rememberAccordionState(this)">
                <h4 class="panel-title">Свойства</h4>
            </a>
            <div id="collapseOne1" class="panel-collapse collapse <?php if($accordionState == 1) echo "in" ?>" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">

                    <?= $form->field($product, 'code_kupinoj')->textInput(['maxlength' => true,
                        'disabled' => true]) ?>
                    <?= $form->field($product, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($product,
                        'brand_id')->dropDownList( ArrayHelper::map(Brand::find()->orderBy('name')->all(),
                        'id', 'name'), ['prompt'=>'Выберите бренд...']) ?>

                    <?php
                        $tree = new \app\helpers\CategoryTree();
                        $itemsCategory = $tree->GetItems();
                    ?>

                    <?=
                         $form->field($product, 'categories')->widget(Select2::className(), [
                            'model' => $product,
                            'attribute' => 'categories',
                            'data' => $itemsCategory,
                            'options' => [
                                'multiple' => true,
                            ],
                            'pluginOptions' => [
                                'tags' => false,
                            ],
                        ]);
                    ?>

                    <?= $form->field($product, 'weight')->textInput() ?>
                    <?= $form->field($product, 'price')->textInput() ?>

                    <?= $form->field($product, 'collection_id')->dropDownList(
                        ArrayHelper::map(GroupCollection::find()->orderBy('name')->all(),'id', 'name'),
                        ['prompt'=>'Выберите коллекцию...']) ?>
                    <?= $form->field($product, 'discount_id')->dropDownList(
                        ArrayHelper::map(GroupDiscount::find()->orderBy('name')->all(), 'id', 'name'),
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
            <a class="panel-heading collapsed" role="tab" id="headingSeven1" data-toggle="collapse" data-parent="#accordion1" data-num="7" href="#collapseSeven1" aria-expanded="false" aria-controls="collapseSeven" onclick="rememberAccordionState(this)">
                <h4 class="panel-title">Класс ножа</h4>
            </a>
            <div id="collapseSeven1" class="panel-collapse collapse <?php if($accordionState == 7) echo "in" ?>" role="tabpanel" aria-labelledby="headingSeven">
                <div class="panel-body">

                    <?= $form->field($classKnife, 'color')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classKnife, 'blade_thickness')->textInput() ?>

                    <?= $form->field($classKnife, 'grind')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classKnife, 'handle_material')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classKnife, 'blade_material')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classKnife, 'sheath_material')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classKnife, 'lanyard_hole_diameter')->textInput() ?>

                    <?= $form->field($classKnife, 'blade_length')->textInput() ?>

                    <?= $form->field($classKnife, 'blade_width')->textInput() ?>

                    <?= $form->field($classKnife, 'knife_width')->textInput() ?>

                    <?= $form->field($classKnife, 'knife_length')->textInput() ?>

                    <?= $form->field($classKnife, 'handle_length')->textInput() ?>

                    <?= $form->field($classKnife, 'blade_hardness')->textInput() ?>

                    <?= $form->field($classKnife, 'type_processing_blade')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classKnife, 'blade_shape')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classKnife, 'shape_sharpening')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classKnife, 'sharpening_angle')->textInput() ?>

                    <?= $form->field($classKnife, 'sharpening_stone')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classKnife, 'sharpening_stages')->textInput() ?>

                    <?= $form->field($classKnife, 'lock_type')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classKnife, 'clamp')->checkbox([
                        'labelOptions' => [
                            'class' => 'check'
                        ],
                    ]);  ?>

                    <?= $form->field($classKnife, 'fuse')->checkbox([
                        'labelOptions' => [
                            'class' => 'check'
                        ],
                    ]);  ?>

                    <?= $form->field($classKnife, 'mechanism_type')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classKnife, 'number_of_layers')->textInput() ?>

                    <?= $form->field($classKnife, 'designer')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="panel">
            <a class="panel-heading collapsed" role="tab" id="headingEight1" data-toggle="collapse" data-parent="#accordion1" data-num="8" href="#collapseEight1" aria-expanded="false" aria-controls="collapseEight" onclick="rememberAccordionState(this)">
                <h4 class="panel-title">Типовой класс</h4>
            </a>
            <div id="collapseEight1" class="panel-collapse collapse <?php if($accordionState == 8) echo "in" ?>" role="tabpanel" aria-labelledby="headingEight">
                <div class="panel-body">

                    <?= $form->field($classType, 'volume')->textInput() ?>

                    <?= $form->field($classType, 'length')->textInput() ?>

                    <?= $form->field($classType, 'width')->textInput() ?>

                    <?= $form->field($classType, 'height')->textInput() ?>

                    <?= $form->field($classType, 'thickness')->textInput() ?>

                    <?= $form->field($classType, 'depth')->textInput() ?>

                    <?= $form->field($classType, 'diameter')->textInput() ?>

                    <?= $form->field($classType, 'material')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'packaging')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'sharpening_angle1')->textInput() ?>

                    <?= $form->field($classType, 'sharpening_angle2')->textInput() ?>

                    <?= $form->field($classType, 'sharpening_angle3')->textInput() ?>

                    <?= $form->field($classType, 'sharpening_angle4')->textInput() ?>

                    <?= $form->field($classType, 'color')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'design')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'filter')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'object01')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'object02')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'object03')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'object04')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'object05')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'object06')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'object07')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'object08')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'object09')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'object10')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'removing_cap')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'rod_type')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'ink_color')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'blade_length')->textInput() ?>

                    <?= $form->field($classType, 'handle_material')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'ax_material')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'web_material')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'tooth_pitch')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($classType, 'inner_size')->textInput() ?>

                    <?= $form->field($classType, 'butt_thickness')->textInput() ?>

                </div>
            </div>
        </div>
        <div class="panel">
            <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" data-num="2" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo" onclick="rememberAccordionState(this)">
                <h4 class="panel-title">Основное фото</h4>
            </a>
            <div id="collapseTwo1" class="panel-collapse collapse <?php if($accordionState == 2) echo "in" ?>" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">

                        <?php if(!$product->isNewRecord):
                            $thumbnailPath = "/pix/product/s-".mb_strtolower($product->code)."-d.jpg";
//                            echo $thumbnailPath;
                        if (file_exists(Yii::getAlias('@webroot').$thumbnailPath))
                            echo Html::img("@web".$thumbnailPath."?v=".rand ( 1000000 , 100000000 ), ['class' => 'img-preview']);
                        ?>
                    <?php endif; ?>

                    <?=
                        $form->field($product, 'file')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
                            'aspectRatio' => (16/9), //set the aspect ratio
                            'cropViewMode' => 1, //crop mode, option info: https://github.com/fengyuanchen/cropper/#viewmode
                            'showPreview' => true, //false to hide the preview
                            'showDeletePickedImageConfirm' => false, //on true show warning before detach image
                        ]);
                    ?>
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
            <a class="panel-heading collapsed" role="tab" id="headingFive1" data-toggle="collapse" data-parent="#accordion1" data-num="5" href="#collapseFive1" aria-expanded="false" aria-controls="collapseFive" onclick="rememberAccordionState(this)">
                <h4 class="panel-title">Похожие товары</h4>
            </a>
            <div id="collapseFive1" class="panel-collapse collapse <?php if($accordionState == 5) echo "in" ?>" role="tabpanel" aria-labelledby="headingFive">
                <div class="panel-body">
                    Похожие и сопутсвующие товары
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