<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $cookie_id
 * @property string $role
 * @property integer $discount
 *
 * @property Role $role0
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'role'], 'required'],
            [['discount'], 'integer'],
            [['username', 'password', 'name', 'email', 'phone', 'address', 'cookie_id', 'role'], 'string', 'max' => 255],
            [['auth_key', 'access_token'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID пользователя'),
            'username' => Yii::t('app', 'Имя пользователя'),
            'password' => Yii::t('app', 'Пароль'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'access_token' => Yii::t('app', 'Access Token'),
            'name' => Yii::t('app', 'Имя'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Номер телефона'),
            'address' => Yii::t('app', 'Адресс'),
            'cookie_id' => Yii::t('app', 'Cookie ID'),
            'role' => Yii::t('app', 'Роль'),
            'discount' => Yii::t('app', 'Скидка клиента'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole0()
    {
        return $this->hasOne(Role::className(), ['name' => 'role']);
    }
}
