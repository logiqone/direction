<?php
/**
 * Created by PhpStorm.
 * User: sattvadigital
 * Date: 17/08/2017
 * Time: 21:42
 */

namespace app\helpers;

use app\models\Category;

class CategoryTree
{
    private $Items;
    private $RootCategories;
    private $SubCategories;

    public function __construct() {
        $this->Items = array();
        $this->RootCategories = Category::find()->where(['parent_id' => NULL])->all();
    }

    public function GetItems() {
        foreach($this->RootCategories as $category) {
            $this->Items[$category->id] = $category->name;
            $this->SubCategories = Category::find()->Where(['parent_id' => $category->id])->all();
            foreach($this->SubCategories as $subcategory) {
                $this->Items[$subcategory->id] = "- ".$subcategory->name;
            }
        }
        return $this->Items ;
    }
}