<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%brand}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $header
 * @property string $description
 * @property string $country
 * @property integer $country_id
 * @property string $promo_title
 * @property string $promo_description
 * @property string $promo_keywords
 * @property string $promo_robots
 *
 * @property GroupCollection[] $groupCollections
 * @property Product[] $products
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['description'], 'string'],
            [['country_id'], 'integer'],
            [['code', 'name', 'header', 'country', 'promo_title', 'promo_description', 'promo_keywords', 'promo_robots'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID производитея'),
            'code' => Yii::t('app', 'Код производителя'),
            'name' => Yii::t('app', 'Название'),
            'header' => Yii::t('app', 'Заголовок'),
            'description' => Yii::t('app', 'Описание бренда'),
            'country' => Yii::t('app', 'Страна изготовитель'),
            'country_id' => Yii::t('app', 'Country брэнда'),
            'promo_title' => Yii::t('app', 'Заголовок страницы (title)'),
            'promo_description' => Yii::t('app', 'Описание страницы (description)'),
            'promo_keywords' => Yii::t('app', 'Ключевые слова (keywords)'),
            'promo_robots' => Yii::t('app', 'robots'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupCollections()
    {
        return $this->hasMany(GroupCollection::className(), ['brand_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['brand_id' => 'id']);
    }
}
