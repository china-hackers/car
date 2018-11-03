<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_safe".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $car_no
 * @property int $created
 * @property int $uid
 * @property int $car_id
 * @property int $state
 * @property string $d_name
 * @property string $d_phone
 * @property string $d_car_no
 * @property string $d_type
 * @property int $d_car_id
 * @property string $d_s_outdate
 * @property string $d_j_outdate
 * @property string $d_price
 *
 * @property Brand $car
 * @property ISafeLog[] $iSafeLogs
 * @property ISafeOption[] $iSafeOptions
 */
class ISafe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i_safe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'uid', 'car_id', 'state', 'd_car_id'], 'integer'],
            [['d_s_outdate', 'd_j_outdate'], 'safe'],
            [['d_price'], 'number'],
            [['name', 'phone', 'car_no', 'd_name', 'd_phone', 'd_type'], 'string', 'max' => 20],
            [['d_car_no'], 'string', 'max' => 8],
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
            'name' => 'Name',
            'phone' => 'Phone',
            'car_no' => 'Car No',
            'created' => 'Created',
            'uid' => 'Uid',
            'car_id' => 'Car ID',
            'state' => 'State',
            'd_name' => 'D Name',
            'd_phone' => 'D Phone',
            'd_car_no' => 'D Car No',
            'd_type' => 'D Type',
            'd_car_id' => 'D Car ID',
            'd_s_outdate' => 'D S Outdate',
            'd_j_outdate' => 'D J Outdate',
            'd_price' => 'D Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Brand::className(), ['id' => 'car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISafeLogs()
    {
        return $this->hasMany(ISafeLog::className(), ['sid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISafeOptions()
    {
        return $this->hasMany(ISafeOption::className(), ['sid' => 'id']);
    }
}
