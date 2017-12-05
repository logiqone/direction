<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $client_id
 * @property string $client_name
 * @property string $client_phone
 * @property string $client_email
 * @property string $client_address
 * @property string $comment
 * @property string $store_comment
 * @property string $products
 * @property integer $order_discount
 * @property string $created
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'order_discount'], 'integer'],
            [['client_name', 'client_phone', 'client_email', 'client_address', 'products', 'created'], 'required'],
            [['created'], 'safe'],
            [['client_name', 'client_phone', 'client_email', 'client_address', 'comment', 'store_comment', 'products'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID заказа',
            'client_id' => 'ID клиента',
            'client_name' => 'Контактное лицо',
            'client_phone' => 'Телефон',
            'client_email' => 'E-mail',
            'client_address' => 'Адрес',
            'comment' => 'Комментарий к заказу',
            'store_comment' => 'Комментарий магазина',
            'products' => 'Массив продуктов',
            'order_discount' => 'Скидка к заказу',
            'created' => 'Дата и время создания',
        ];
    }
}
