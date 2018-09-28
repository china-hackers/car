<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "business".
 *
 * @property int $id
 * @property string $name
 * @property string $sex
 * @property string $phone
 * @property string $address
 * @property string $open_id
 * @property string $avator
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
            [['is_checked'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['sex'], 'string', 'max' => 2],
            [['phone'], 'string', 'max' => 16],
            [['address'], 'string', 'max' => 200],
            [['open_id', 'avator'], 'string', 'max' => 250],
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
            'sex' => 'Sex',
            'phone' => 'Phone',
            'address' => 'Address',
            'open_id' => 'Open ID',
            'avator' => 'Avator',
            'is_checked' => 'Is Checked',
        ];
    }
}
