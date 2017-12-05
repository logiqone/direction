<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%class_type}}".
 *
 * @property integer $id
 * @property integer $product_id
 * @property double $volume
 * @property double $length
 * @property double $width
 * @property double $height
 * @property double $thickness
 * @property double $depth
 * @property double $diameter
 * @property string $material
 * @property string $packaging
 * @property integer $sharpening_angle1
 * @property integer $sharpening_angle2
 * @property integer $sharpening_angle3
 * @property integer $sharpening_angle4
 * @property string $color
 * @property string $design
 * @property string $filter
 * @property string $object01
 * @property string $object02
 * @property string $object03
 * @property string $object04
 * @property string $object05
 * @property string $object06
 * @property string $object07
 * @property string $object08
 * @property string $object09
 * @property string $object10
 * @property string $removing_cap
 * @property string $rod_type
 * @property string $ink_color
 * @property double $blade_length
 * @property string $handle_material
 * @property string $ax_material
 * @property string $web_material
 * @property string $tooth_pitch
 * @property double $inner_size
 * @property double $butt_thickness
 *
 * @property Product $product
 */
class ClassType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%class_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'sharpening_angle1', 'sharpening_angle2', 'sharpening_angle3', 'sharpening_angle4'], 'integer'],
            [['volume', 'length', 'width', 'height', 'thickness', 'depth', 'diameter', 'blade_length', 'inner_size', 'butt_thickness'], 'number'],
            [['material', 'packaging', 'color', 'design', 'filter', 'object01', 'object02', 'object03', 'object04', 'object05', 'object06', 'object07', 'object08', 'object09', 'object10', 'removing_cap', 'rod_type', 'ink_color', 'handle_material', 'ax_material', 'web_material', 'tooth_pitch'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'product_id' => Yii::t('app', 'id продукта'),
            'volume' => Yii::t('app', 'Объём'),
            'length' => Yii::t('app', 'Длинна'),
            'width' => Yii::t('app', 'Ширина'),
            'height' => Yii::t('app', 'Высота'),
            'thickness' => Yii::t('app', 'Толщина'),
            'depth' => Yii::t('app', 'Глубина'),
            'diameter' => Yii::t('app', 'Диаметр'),
            'material' => Yii::t('app', 'Материал'),
            'packaging' => Yii::t('app', 'Упаковка'),
            'sharpening_angle1' => Yii::t('app', 'Угол заточки 1'),
            'sharpening_angle2' => Yii::t('app', 'Угол заточки 2'),
            'sharpening_angle3' => Yii::t('app', 'Угол заточки 3'),
            'sharpening_angle4' => Yii::t('app', 'Угол заточки 4'),
            'color' => Yii::t('app', 'Цвет'),
            'design' => Yii::t('app', 'Дизайн'),
            'filter' => Yii::t('app', 'Фильтр'),
            'object01' => Yii::t('app', 'Предмет 1'),
            'object02' => Yii::t('app', 'Предмет 2'),
            'object03' => Yii::t('app', 'Предмет 3'),
            'object04' => Yii::t('app', 'Предмет 4'),
            'object05' => Yii::t('app', 'Предмет 5'),
            'object06' => Yii::t('app', 'Предмет 6'),
            'object07' => Yii::t('app', 'Предмет 7'),
            'object08' => Yii::t('app', 'Предмет 8'),
            'object09' => Yii::t('app', 'Предмет 9'),
            'object10' => Yii::t('app', 'Предмет 10'),
            'removing_cap' => Yii::t('app', 'Метод снятия колпачка'),
            'rod_type' => Yii::t('app', 'Тип стержня'),
            'ink_color' => Yii::t('app', 'Цвет чернил'),
            'blade_length' => Yii::t('app', 'Длина лезвия'),
            'handle_material' => Yii::t('app', 'Материал рукояти'),
            'ax_material' => Yii::t('app', 'Материал топорища'),
            'web_material' => Yii::t('app', 'Материал полотна'),
            'tooth_pitch' => Yii::t('app', 'Шаг зубьев'),
            'inner_size' => Yii::t('app', 'Внутренний размер'),
            'butt_thickness' => Yii::t('app', 'Толщина обуха'),
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
