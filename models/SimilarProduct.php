<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%similar_product}}".
 *
 * @property integer $id_product
 * @property integer $id_product_similar
 */
class SimilarProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%similar_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'id_product_similar'], 'required'],
            [['id_product', 'id_product_similar'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product' => Yii::t('app', 'Id Product'),
            'id_product_similar' => Yii::t('app', 'Id Product Similar'),
        ];
    }
}
