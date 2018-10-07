<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_engine".
 *
 * @property int $id
 * @property int $pid
 * @property int $oil_wear 油耗
 * @property string $oil 燃油
 * @property string $oil_no 燃油编号
 * @property int $displacement 排量
 * @property int $oil_capacity 邮箱容积
 * @property int $power 功率
 * @property string $air_in 进气形式
 * @property int $speed 最高时速
 * @property int $nm 最大扭矩
 * @property int $speed_up 加速度
 */
class ProductEngine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_engine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid', 'oil_wear', 'displacement', 'oil_capacity', 'power', 'speed', 'nm', 'speed_up'], 'integer'],
            [['oil', 'oil_no', 'air_in'], 'string', 'max' => 20],
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
            'oil_wear' => 'Oil Wear',
            'oil' => 'Oil',
            'oil_no' => 'Oil No',
            'displacement' => 'Displacement',
            'oil_capacity' => 'Oil Capacity',
            'power' => 'Power',
            'air_in' => 'Air In',
            'speed' => 'Speed',
            'nm' => 'Nm',
            'speed_up' => 'Speed Up',
        ];
    }
}
