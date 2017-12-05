<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ImageManager".
 *
 * @property integer $id
 * @property string $fileName
 * @property string $fileHash
 * @property string $created
 * @property string $modified
 * @property integer $createdBy
 * @property integer $modifiedBy
 */
class ImageManager extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ImageManager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fileName', 'fileHash', 'created'], 'required'],
            [['created', 'modified'], 'safe'],
            [['createdBy', 'modifiedBy'], 'integer'],
            [['fileName'], 'string', 'max' => 128],
            [['fileHash'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fileName' => Yii::t('app', 'File Name'),
            'fileHash' => Yii::t('app', 'File Hash'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'createdBy' => Yii::t('app', 'Created By'),
            'modifiedBy' => Yii::t('app', 'Modified By'),
        ];
    }
}
