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
 * @property string $driver_card
 * @property string $option
 * @property int $created
 * @property int $is_deal
 * @property int $uid
 * @property int $car_id
 *
 * @property Brand $car
 * @property ISafeLog[] $iSafeLogs
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
            [['created', 'is_deal', 'uid', 'car_id'], 'integer'],
            [['name', 'phone', 'car_no', 'option'], 'string', 'max' => 20],
            [['driver_card'], 'string', 'max' => 200],
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
            'driver_card' => 'Driver Card',
            'option' => 'Option',
            'created' => 'Created',
            'is_deal' => 'Is Deal',
            'uid' => 'Uid',
            'car_id' => 'Car ID',
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
}
