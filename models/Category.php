<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property string $code
 * @property integer $parent_id
 * @property string $name
 * @property string $description
 * @property string $promo_title
 * @property string $promo_description
 * @property string $promo_keywords
 * @property string $promo_robots
 * @property integer $sort
 *
 * @property ProductToCategory[] $productToCategories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'description', 'sort'], 'required'],
            [['parent_id', 'sort'], 'integer'],
            [['description'], 'string'],
            [['code', 'name', 'promo_title', 'promo_description', 'promo_keywords'], 'string', 'max' => 255],
            [['promo_robots'], 'string', 'max' => 20],
            [['code'], 'unique'],
        ];
    }

    public static function listAll($keyField = 'id', $valueField = 'name', $asArray = true)
    {
        $query = static::find();
        if ($asArray) {
            $query->select([$keyField, $valueField])->asArray();
        }
        return ArrayHelper::map($query->all(), $keyField, $valueField);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID категории',
            'code' => 'Код категории',
            'parent_id' => 'ID родителя',
            'name' => 'Название категории',
            'description' => 'Описание категории',
            'promo_title' => 'Заголовок страницы (title)',
            'promo_description' => 'Описание страницы (description)',
            'promo_keywords' => 'Ключевые слова (keywords)',
            'promo_robots' => 'robots',
            'sort' => 'Sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductToCategories()
    {
        return $this->hasMany(ProductToCategory::className(), ['category_id' => 'id']);
    }
}
