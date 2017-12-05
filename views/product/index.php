<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use app\models\Brand;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Товары');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/product.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/libs/js.cookie/js.cookie.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/libs/jquery.liTranslit/jquery.liTranslit.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>

<div class="product-index">

    <h1>Товары</h1>

    <div id="inf-success" class="alert alert-success fade in" style="display: none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

        <h4><i class="fa fa-check"></i>&nbsp;Успешно!</h4>
        <span class="inf-text">Продукт успешно изменён!</span>

    </div>

    <div id="inf-error" class="alert alert-error fade in" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4><i class="fa fa-ban"></i>&nbsp;Ошибка!</h4>
            <span class="inf-text">Ошибка при записи!</span>
        </div>
    </div>

    <p>
        <a class="btn btn-success" href="javascript: $('div#product-form').load('/product/create')">Созадть товар на форме справа</a>
        <a class="btn btn-primary" href="/product/create">Перейти на страницу создания товара</a>
    </p>
    <!-- Товары -->
    <div class="row">
        <div class="col-md-8">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Последние изменения <small>список товаров</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php

                    $gridLastProductColumns = [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                            'attribute' => 'id',
                            'contentOptions' => ['class' => 'id'],
                        ],
                        [
                            'class'=>'kartik\grid\BooleanColumn',
                            'falseIcon' => '<span style="color: #26B99A" class="glyphicon glyphicon-leaf"></span>',
                            'trueIcon' => '<span style="color: #18a3fa" class="glyphicon glyphicon-asterisk"></span>',
                            'attribute'=>'freeze',
                        ],
                        [
                            'attribute' => 'name',
                            'contentOptions' => ['class' => 'name'],
                        ],
                        [
                            'attribute' => 'code',
                            'contentOptions' => ['class' => 'code'],
                        ],
                        [
                            'attribute' => 'brand_id',
                            'value' => function($data) {
                                return $data->brand->name;
                            }
                        ],
//                        [
//                            'attribute' => 'sort',
//                            'contentOptions' => ['class' => 'sort'],
//                        ],
                        [
                            'class' => '\kartik\grid\ActionColumn',
                            'contentOptions' => ['class' => 'actions'],
                            'template' => '{view} {update} {edit} {onclient}',
                            'buttons' => [
                                'view' => function ($url,$model,$key) {
                                    return Html::a('<span style="cursor: pointer" class="glyphicon glyphicon-list-alt"></span>',
                                        $url, [
                                            'data-pjax' => '0',
                                            'target' => '_blank',
                                        ]);
                                },
                                'update' => function ($url,$model,$key) {
                                    return Html::a('<span style="cursor: pointer" class="glyphicon glyphicon-edit"></span>',
                                        $url, [
                                            'data-pjax' => '0',
                                            'target' => '_blank',
                                        ]);
                                },
                                'edit' => function ($url,$model,$key) {
                                    return Html::a('<span style="cursor: pointer" class="glyphicon glyphicon-arrow-right"></span>',
                                        'javascript: editProduct("'.$key.' ");', [
                                            'data-pjax' => '0',
                                            'target' => '_blank',
                                        ]);
                                },
                                'onclient' =>  function ($url,$model,$key) {
                                    return Html::a('<span style="cursor: pointer" class="glyphicon glyphicon-eye-open"></span>',
                                        "http://original-knife.ru/product/".$model->brand->name."/".$model->code.".html", [
                                            'target' => '_blank',
                                        ] );
                                },
                            ],
                        ],
                    ];
                        ?>
                    <?= GridView::widget([
                        'dataProvider' => $lastProductsDataProvider,
                        'layout'=>"{items}",
                        'id'=>'last-products-grid',
                        'pjax'=>true,
                        'columns' => $gridLastProductColumns,
                    ]); ?>

                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2>Товары<small>список товаров</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                    Pjax::begin(['id' => 'products']);

                    $gridProductColumns = [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                            'attribute' => 'id',
                            'contentOptions' => ['class' => 'id'],
                        ],
                        [
                            'class'=>'kartik\grid\BooleanColumn',
                            'falseIcon' => '<span style="color: #26B99A" class="glyphicon glyphicon-leaf"></span>',
                            'trueIcon' => '<span style="color: #18a3fa" class="glyphicon glyphicon-asterisk"></span>',
                            'attribute' => 'freeze',
                            'contentOptions' => ['class' => 'freeze'],
                        ],
                        [
                            'attribute' => 'name',
                            'contentOptions' => ['class' => 'name'],
                        ],
                        [
                            'attribute' => 'code',
                            'contentOptions' => ['class' => 'code'],
                        ],
                        [
                            'attribute' => 'brand_id',
                            'value' => function($data) {
                                return $data->brand->name;
                            },
                            'filter' => ArrayHelper::map(Brand::find()->asArray()->all(), 'id', 'name'),
//
//                          'filter' => Html::activeDropDownList($productsSearchModel,'brand_id',
//                                ArrayHelper::map(Brand::find()->asArray()->all(), 'id', 'name'),
//                                ['class'=>'form-control','prompt' => 'Брэнд... ']),
                        ],
//                        [
//                            'attribute' => 'sort',
//                            'contentOptions' => ['class' => 'sort'],
//                        ],
                        [
                            'class' => '\kartik\grid\ActionColumn',
                            'contentOptions' => ['class' => 'actions'],
                            'template' => '{view} {update} {edit} {onclient}',
                            'buttons' => [
                                'view' => function ($url,$model,$key) {
                                    return Html::a('<span style="cursor: pointer" class="glyphicon glyphicon-list-alt"></span>',
                                        $url, [
                                            'data-pjax' => '0',
                                            'target' => '_blank',
                                        ]);
                                },
                                'update' => function ($url,$model,$key) {
                                    return Html::a('<span style="cursor: pointer" class="glyphicon glyphicon-edit"></span>',
                                        $url, [
                                            'data-pjax' => '0',
                                            'target' => '_blank',
                                        ]);
                                },
                                'edit' => function ($url,$model,$key) {
                                    return Html::a('<span style="cursor: pointer" class="glyphicon glyphicon-arrow-right"></span>',
                                        'javascript: editProduct("'.$key.' ");', [
                                            'data-pjax' => '0',
                                            'target' => '_blank',
                                        ]);
                                },
                                'onclient' =>  function ($url,$model,$key) {
                                    return Html::a('<span style="cursor: pointer" class="glyphicon glyphicon-eye-open"></span>',
                                        "http://original-knife.ru/product/".$model->brand->name."/".$model->code.".html", [
                                            'target' => '_blank',
                                        ] );
                                },
                            ],
                        ],
                    ];
                    ?>
                    <?= GridView::widget([
                        'dataProvider' => $productsDataProvider,
                        'filterModel' => $productsSearchModel,
                        'layout'=>"{pager}{items}{summary}{pager}",
                        'columns' => $gridProductColumns,
                        'id'=>'products-grid',
                        'pjax'=>true,
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Свойства товара <small>характеристики</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="product-form">
                    <?= $this->render('_form', [
                        'product' => $product,
                        'classKnife' => $classKnife,
                        'classType' => $classType,
                    ]) ?>
                </div>
            </div>
        </div>

    </div>
</div>