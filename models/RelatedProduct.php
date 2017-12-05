<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_related_product".
 *
 * @property integer $id_product
 * @property integer $id_product_related
 */
class RelatedProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_related_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'id_product_related'], 'required'],
            [['id_product', 'id_product_related'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product' => Yii::t('app', 'Id Product'),
            'id_product_related' => Yii::t('app', 'Id Product Related'),
        ];
    }
}
