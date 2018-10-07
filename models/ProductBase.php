<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_base".
 *
 * @property int $id
 * @property int $pid
 * @property int $length
 * @property int $width
 * @property int $hight
 * @property int $wheelbase 轴距
 * @property int $capacity 后备箱容量
 * @property int $weight 整备质量
 * @property string $color
 * @property string $gear_box 变速箱
 * @property string $gear_model 变速箱型号
 * @property int $doors 门数
 * @property int $chairs 座位数
 * @property string $wheel 轮毂材质
 */
class ProductBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_base';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid', 'length', 'width', 'hight', 'wheelbase', 'capacity', 'weight', 'doors', 'chairs'], 'integer'],
            [['color'], 'string', 'max' => 10],
            [['gear_box', 'wheel'], 'string', 'max' => 20],
            [['gear_model'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'length' => 'Length',
            'width' => 'Width',
            'hight' => 'Hight',
            'wheelbase' => 'Wheelbase',
            'capacity' => 'Capacity',
            'weight' => 'Weight',
            'color' => 'Color',
            'gear_box' => 'Gear Box',
            'gear_model' => 'Gear Model',
            'doors' => 'Doors',
            'chairs' => 'Chairs',
            'wheel' => 'Wheel',
        ];
    }
}
