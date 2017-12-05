<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%country}}".
 *
 * @property integer $id
 * @property string $country_name_ru
 * @property string $country_name_en
 * @property string $country_code
 * @property string $promo_title
 * @property string $promo_description
 * @property string $promo_keywords
 * @property string $promo_robots
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_name_ru', 'country_name_en', 'promo_title', 'promo_description', 'promo_keywords', 'promo_robots'], 'string', 'max' => 255],
            [['country_code'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'country_name_ru' => Yii::t('app', 'Название страны на русском'),
            'country_name_en' => Yii::t('app', 'Название страны на английском'),
            'country_code' => Yii::t('app', 'Код страны'),
            'promo_title' => Yii::t('app', 'Заголовок страницы (title)'),
            'promo_description' => Yii::t('app', 'Описание страницы (description)'),
            'promo_keywords' => Yii::t('app', 'Ключевые слова (keywords)'),
            'promo_robots' => Yii::t('app', 'robots'),
        ];
    }
}
