<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property integer $freeze
 * @property integer $deleted
 * @property string $code
 * @property string $code_kupinoj
 * @property string $name
 * @property integer $brand_id
 * @property string $availability
 * @property integer $weight
 * @property double $price
 * @property integer $novelty
 * @property integer $bestseller
 * @property integer $collection_id
 * @property integer $discount_id
 * @property string $short_description
 * @property string $full_description
 * @property string $video_link
 * @property string $promo_title
 * @property string $promo_description
 * @property string $promo_keywords
 * @property string $promo_robots
 * @property integer $sort
 * @property string $date_created
 * @property string $date_modify
 *
 *
 * @property ClassKnife $classKnife
 * @property ClassType $classType
 * @property Brand $brand
 * @property GroupCollection $collection
 * @property GroupDiscount $discount
 * @property ProductToCategory[] $productToCategories
 */
class Product extends ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'string'],
            [['freeze', 'deleted', 'brand_id', 'weight', 'novelty', 'bestseller', 'collection_id', 'discount_id', 'sort'], 'integer'],
            [['name', 'code', 'brand_id', 'price'], 'required'],
            [['price'], 'number'],
            [['full_description'], 'string'],
            [['date_created', 'date_modify'], 'safe'],
            [['code', 'code_kupinoj', 'name', 'video_link', 'promo_title', 'promo_description', 'promo_keywords'], 'string', 'max' => 255],
            [['availability'], 'string', 'max' => 10],
            [['short_description'], 'string', 'max' => 1024],
            [['promo_robots'], 'string', 'max' => 20],
            [['code'], 'unique'],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['collection_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupCollection::className(), 'targetAttribute' => ['collection_id' => 'id']],
            [['discount_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupDiscount::className(), 'targetAttribute' => ['discount_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'freeze' => Yii::t('app', 'Заморозка'),
            'deleted' => Yii::t('app', 'Удалённый'),
            'code' => Yii::t('app', 'Код'),
            'code_kupinoj' => Yii::t('app', 'Код купинож'),
            'name' => Yii::t('app', 'Название'),
            'brand_id' => Yii::t('app', 'Производитель'),
            'availability' => Yii::t('app', 'Наличие'),
            'weight' => Yii::t('app', 'Вес (гр)'),
            'price' => Yii::t('app', 'Цена'),
            'novelty' => Yii::t('app', 'Новинка'),
            'bestseller' => Yii::t('app', 'Хит продаж'),
            'collection_id' => Yii::t('app', 'Коллекция'),
            'discount_id' => Yii::t('app', 'Скидка'),
            'short_description' => Yii::t('app', 'Краткое описание'),
            'full_description' => Yii::t('app', 'Полное описание'),
            'video_link' => Yii::t('app', 'Видео frame'),
            'promo_title' => Yii::t('app', 'Заголовок страницы (title)'),
            'promo_description' => Yii::t('app', 'Описание страницы (description)'),
            'promo_keywords' => Yii::t('app', 'Ключевые слова (keywords)'),
            'promo_robots' => Yii::t('app', 'robots'),
            'sort' => Yii::t('app', 'Вес сортировки'),
            'date_created' => Yii::t('app', 'Дата и время создания'),
            'date_modify' => Yii::t('app', 'Дата и время изменения'),
            'file' =>  Yii::t('app', ''),
            'categories' =>  Yii::t('app', 'Категории'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassKnife()
    {
        return $this->hasOne(ClassKnife::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassType()
    {
        return $this->hasOne(ClassType::className(), ['product_id' => 'id']);
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
    public function getCollection()
    {
        return $this->hasOne(GroupCollection::className(), ['id' => 'collection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(GroupDiscount::className(), ['id' => 'discount_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('{{%product_to_category}}', ['product_id' => 'id']);
    }
}
