<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%group_discount}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $percentage
 * @property string $description_title
 * @property string $description
 * @property string $promo_title
 * @property string $promo_description
 * @property string $promo_keywords
 * @property string $promo_robots
 *
 * @property Product[] $products
 */
class GroupDiscount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group_discount}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'description_title', 'description'], 'required'],
            [['percentage'], 'integer'],
            [['description'], 'string'],
            [['code', 'name', 'description_title', 'promo_title', 'promo_description', 'promo_keywords'], 'string', 'max' => 255],
            [['promo_robots'], 'string', 'max' => 20],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID скидки'),
            'code' => Yii::t('app', 'Код скидки'),
            'name' => Yii::t('app', 'Название скидки'),
            'percentage' => Yii::t('app', 'Размер скидки'),
            'description_title' => Yii::t('app', 'Заголовок описания'),
            'description' => Yii::t('app', 'Описание'),
            'promo_title' => Yii::t('app', 'Заголовок страницы (title)'),
            'promo_description' => Yii::t('app', 'Описание страницы (description)'),
            'promo_keywords' => Yii::t('app', 'Ключевые слова (keywords)'),
            'promo_robots' => Yii::t('app', 'robots'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['discount_id' => 'id']);
    }
}
