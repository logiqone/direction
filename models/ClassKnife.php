<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%class_knife}}".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $color
 * @property double $blade_thickness
 * @property string $grind
 * @property string $handle_material
 * @property string $blade_material
 * @property string $sheath_material
 * @property double $lanyard_hole_diameter
 * @property double $blade_length
 * @property double $blade_width
 * @property double $knife_width
 * @property double $knife_length
 * @property double $handle_length
 * @property integer $blade_hardness
 * @property string $type_processing_blade
 * @property string $blade_shape
 * @property string $shape_sharpening
 * @property integer $sharpening_angle
 * @property string $sharpening_stone
 * @property integer $sharpening_stages
 * @property string $lock_type
 * @property integer $clamp
 * @property integer $fuse
 * @property string $mechanism_type
 * @property integer $number_of_layers
 * @property string $designer
 *
 * @property Product $product
 */
class ClassKnife extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%class_knife}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'blade_hardness', 'sharpening_angle', 'sharpening_stages', 'clamp', 'fuse', 'number_of_layers'], 'integer'],
            [['blade_thickness', 'lanyard_hole_diameter', 'blade_length', 'blade_width', 'knife_width', 'knife_length', 'handle_length'], 'number'],
            [['color', 'grind', 'handle_material', 'sheath_material', 'type_processing_blade', 'blade_shape', 'shape_sharpening', 'sharpening_stone', 'lock_type'], 'string', 'max' => 100],
            [['blade_material', 'mechanism_type'], 'string', 'max' => 255],
            [['designer'], 'string', 'max' => 512],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Продукт'),
            'color' => Yii::t('app', 'Цвет'),
            'blade_thickness' => Yii::t('app', 'Толщина обуха клинка (мм)'),
            'grind' => Yii::t('app', 'Заточка'),
            'handle_material' => Yii::t('app', 'Материал рукояти'),
            'blade_material' => Yii::t('app', 'Материал лезвия'),
            'sheath_material' => Yii::t('app', 'Материал ножен'),
            'lanyard_hole_diameter' => Yii::t('app', 'Диаметр отверстия под темляк (мм)'),
            'blade_length' => Yii::t('app', 'Длина лезвия (мм)'),
            'blade_width' => Yii::t('app', 'Ширина лезвия (мм)'),
            'knife_width' => Yii::t('app', 'Ширина ножа (мм)'),
            'knife_length' => Yii::t('app', 'Длинна ножа (мм)'),
            'handle_length' => Yii::t('app', 'Длинна рукояти (мм)'),
            'blade_hardness' => Yii::t('app', 'Твердость клинка (HRc)'),
            'type_processing_blade' => Yii::t('app', 'Тип обработки клинка'),
            'blade_shape' => Yii::t('app', 'Форма клинка'),
            'shape_sharpening' => Yii::t('app', 'Форма заточки'),
            'sharpening_angle' => Yii::t('app', 'Угол заточки (град)'),
            'sharpening_stone' => Yii::t('app', 'Камень заточки'),
            'sharpening_stages' => Yii::t('app', 'Количество этапов заточки'),
            'lock_type' => Yii::t('app', 'Тип замка'),
            'clamp' => Yii::t('app', 'Фиксатор'),
            'fuse' => Yii::t('app', 'Предохранитель'),
            'mechanism_type' => Yii::t('app', 'Тип механизма'),
            'number_of_layers' => Yii::t('app', 'Количество слоёв'),
            'designer' => Yii::t('app', 'Дизайнер'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
