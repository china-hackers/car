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
 * @property string $created
 * @property int $is_deal
 * @property int $uid
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
            [['is_deal', 'uid', 'created'], 'integer'],
            [['name', 'phone', 'car_no', 'option'], 'string', 'max' => 20],
            [['driver_card'], 'string', 'max' => 200],
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
        ];
    }
}
