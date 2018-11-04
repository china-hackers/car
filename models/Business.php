<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "business".
 *
 * @property int $id
 * @property string $name 车商名
 * @property string $phone 联系电话
 * @property string $note 简介
 * @property string $logo
 * @property string $address
 * @property string $lat
 * @property string $lng
 * @property int $is_checked
 */
class Business extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note'], 'string'],
            [['is_checked'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['logo', 'address'], 'string', 'max' => 200],
            [['lat', 'lng'], 'string', 'max' => 30],
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
            'note' => 'Note',
            'logo' => 'Logo',
            'address' => 'Address',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'is_checked' => 'Is Checked',
        ];
    }
}
