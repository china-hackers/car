<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $car_id
 * @property string $title
 * @property string $price 卖价
 * @property string $price_new 新车价
 * @property string $tax 购置税
 * @property int $business_id
 * @property int $user_id
 * @property string $reg_date 上牌时间
 * @property int $city_id 归属地
 * @property string $km 公里数
 * @property string $emission_std 排放标准
 * @property string $itype 类型
 *
 * @property Brand $car
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
            [['car_id', 'business_id', 'user_id', 'city_id', 'km'], 'integer'],
            [['price', 'price_new', 'tax'], 'number'],
            [['business_id', 'user_id'], 'required'],
            [['title'], 'string', 'max' => 250],
            [['reg_date',  'emission_std'], 'string', 'max' => 20],
            [['itype'], 'string', 'max' => 10],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['car_id' => 'id']],
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
            'price' => 'Price',
            'price_new' => 'Price New',
            'tax' => 'Tax',
            'business_id' => 'Business ID',
            'user_id' => 'User ID',
            'reg_date' => 'Reg Date',
            'city_id' => 'City ID',
            'km' => 'Km',
            'emission_std' => 'Emission Std',
            'itype' => 'Itype',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar(){
        return $this->hasOne(Brand::className(), ['id' => 'car_id']);
    }

    public function getBusiness(){
        return $this->hasOne(Business::className(), ['id' => 'business_id']);
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCity(){
        return $this->hasOne(City::className(),['id'=>'city_id']);
    }
}
