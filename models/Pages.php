<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pages}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $meta_robots
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'desc', 'meta_title', 'meta_description', 'meta_keywords', 'meta_robots'], 'required'],
            [['desc', 'meta_description', 'meta_keywords'], 'string'],
            [['title', 'meta_title', 'meta_robots'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'desc' => Yii::t('app', 'Desc'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_robots' => Yii::t('app', 'Meta Robots'),
        ];
    }
}
