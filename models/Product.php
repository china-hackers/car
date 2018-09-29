<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $car_id
 * @property string $title
 * @property string $note
 * @property string $price 总价
 * @property string $guid_price 官方指导价
 * @property string $down_payment 首付
 * @property int $month_payment 月供
 * @property string $itype
 * @property int $business_id
 * @property int $user_id
 * @property string $voice
 * @property string $city 归属地
 * @property string $km 公里数
 * @property string $emission_std 排放标准
 * @property string $gear_box 变速箱
 * @property string $color 颜色
 * @property string $overdue 年检到期时间
 * @property string $summary 车辆描述
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_id', 'month_payment', 'business_id', 'user_id'], 'integer'],
            [['price', 'down_payment'], 'number'],
            [['business_id', 'user_id'], 'required'],
            [['summary'], 'string'],
            [['title'], 'string', 'max' => 250],
            [['note', 'voice'], 'string', 'max' => 200],
            [['guid_price'], 'string', 'max' => 100],
            [['itype', 'city', 'km', 'emission_std', 'gear_box', 'color', 'overdue'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => 'Car ID',
            'title' => 'Title',
            'note' => 'Note',
            'price' => 'Price',
            'guid_price' => 'Guid Price',
            'down_payment' => 'Down Payment',
            'month_payment' => 'Month Payment',
            'itype' => 'Itype',
            'business_id' => 'Business ID',
            'user_id' => 'User ID',
            'voice' => 'Voice',
            'city' => 'City',
            'km' => 'Km',
            'emission_std' => 'Emission Std',
            'gear_box' => 'Gear Box',
            'color' => 'Color',
            'overdue' => 'Overdue',
            'summary' => 'Summary',
        ];
    }
}
