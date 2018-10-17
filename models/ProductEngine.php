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
 * @property string $displacement 排量
 * @property int $oil_capacity 邮箱容积
 * @property int $power 功率
 * @property string $air_in 进气形式
 * @property int $speed 最高时速
 * @property int $nm 最大扭矩
 * @property int $speed_up 加速度
 *
 * @property Product $p
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
            [['pid'], 'required'],
            [['pid', 'oil_wear', 'oil_capacity', 'power', 'speed', 'nm', 'speed_up'], 'integer'],
            [['displacement'], 'number'],
            [['oil', 'oil_no', 'air_in'], 'string', 'max' => 20],
            [['pid'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['pid' => 'id']],
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
            'oil_wear' => '油耗',
            'oil' => '燃油',
            'oil_no' => '燃油编号',
            'displacement' => '排量',
            'oil_capacity' => '邮箱容积',
            'power' => '功率',
            'air_in' => '进气形式',
            'speed' => '最高时速',
            'nm' => '最大扭矩',
            'speed_up' => '加速度',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP()
    {
        return $this->hasOne(Product::className(), ['id' => 'pid']);
    }
}
