<?php
/**
 * Created by PhpStorm.
 * User: sattvadigital
 * Date: 28/08/2017
 * Time: 00:39
 */

namespace app\helpers;

use app\models\Product;
use app\models\ProductToCategory;

class SameCategoryProducts
{
    private $ProductId;

    public function __construct($productId=0) {
        $this->ProductId = $productId;
    }

    public function GetProductsSameCategories() {

        $sameCategoryProducts = array();

        if ( $this->ProductId != 0) {
            // Выберем все категории этого продукта
            $categoriesOfCurrentProduct = ProductToCategory::find()->where(['product_id' => $this->ProductId])->all();

            // Переберём категории
            foreach ($categoriesOfCurrentProduct as $categoryOfCurrentProduct) {
                // Для текущей категории выберем все продукты
                $productsOfCurrentCategory = ProductToCategory::find()->where(['category_id' => $categoryOfCurrentProduct->category_id])->all();

                foreach ( $productsOfCurrentCategory as $productOfCurrentCategory )
                    // Выберем все продукты, кроме текущего, для которого мы отбираем похожие
                    if ($productOfCurrentCategory->product_id !=  $this->ProductId) {
                        $product = Product::findOne($productOfCurrentCategory->product_id);
                        $sameCategoryProducts[$productOfCurrentCategory->product_id] = $product->code;
                    }
            }
        }
        else {
            $allProducts = Product::find()->all();
            foreach ( $allProducts as $product )
                // Выберем все продукты
                $sameCategoryProducts[$product->id] = $product->code;
        }

        // Уберём повторяющиеся значения
        $sameCategoryProducts = array_unique($sameCategoryProducts);

        return $sameCategoryProducts;
    }
}
