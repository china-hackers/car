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
 * @property int $km 公里数
 * @property string $emission_std 排放标准
 * @property string $itype 类型
 * @property string $brand 品牌
 * @property int $shoufu 首付
 * @property int $yuegong 月供
 * @property int $displacement 排量
 * @property string $gear_box 变速箱
 * @property string $air_in 进气形式
 * @property int $state
 *
 * @property IBuy[] $iBuys
 * @property Brand $car
 * @property ProductBase[] $productBases
 * @property ProductEngine[] $productEngines
 * @property ProductImg[] $productImgs
 * @property ProductInfo[] $productInfos
 * @property ProductTax[] $productTaxes
 * @property ProductTyre[] $productTyres
 * @property ProductUnder[] $productUnders
 * @property UserStore[] $userStores
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
            [['car_id', 'business_id', 'user_id', 'city_id', 'km', 'shoufu', 'yuegong', 'displacement', 'state'], 'integer'],
            [['price', 'price_new', 'tax'], 'number'],
            [['business_id', 'user_id'], 'required'],
            [['title'], 'string', 'max' => 250],
            [['reg_date', 'emission_std', 'brand', 'gear_box', 'air_in'], 'string', 'max' => 20],
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
            'price' => '卖价',
            'price_new' => '新车价',
            'tax' => '购置税',
            'business_id' => 'Business ID',
            'user_id' => 'User ID',
            'reg_date' => '上牌时间',
            'city_id' => '归属地',
            'km' => '公里数',
            'emission_std' => '排放标准',
            'itype' => '类型',
            'brand' => '品牌',
            'shoufu' => '首付',
            'yuegong' => '月供',
            'displacement' => '排量',
            'gear_box' => '变速箱',
            'air_in' => '进气形式',
            'state' => 'State',
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

    public function getProductImg()
    {
        return $this->hasOne(ProductImg::className(), ['pid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIBuys()
    {
        return $this->hasMany(IBuy::className(), ['pid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductBases()
    {
        return $this->hasMany(ProductBase::className(), ['pid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductEngines()
    {
        return $this->hasMany(ProductEngine::className(), ['pid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImgs()
    {
        return $this->hasMany(ProductImg::className(), ['pid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductInfos()
    {
        return $this->hasMany(ProductInfo::className(), ['pid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTaxes()
    {
        return $this->hasMany(ProductTax::className(), ['pid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTyres()
    {
        return $this->hasMany(ProductTyre::className(), ['pid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUnders()
    {
        return $this->hasMany(ProductUnder::className(), ['pid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserStores()
    {
        return $this->hasMany(UserStore::className(), ['pid' => 'id']);
    }
}
