<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%group_collection}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $brand_id
 * @property string $description_title
 * @property string $description
 * @property string $promo_title
 * @property string $promo_description
 * @property string $promo_keywords
 * @property string $promo_robots
 *
 * @property Brand $brand
 * @property Product[] $products
 */
class GroupCollection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group_collection}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'brand_id', 'description_title', 'description'], 'required'],
            [['brand_id'], 'integer'],
            [['description'], 'string'],
            [['code', 'name', 'description_title', 'promo_title', 'promo_description', 'promo_keywords'], 'string', 'max' => 255],
            [['promo_robots'], 'string', 'max' => 20],
            [['code'], 'unique'],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID коллекции'),
            'code' => Yii::t('app', 'Код коллекции'),
            'name' => Yii::t('app', 'Название'),
            'brand_id' => Yii::t('app', 'ID производителя'),
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
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['collection_id' => 'id']);
    }
}
