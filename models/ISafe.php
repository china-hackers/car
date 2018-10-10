<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_safe".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $card_no
 * @property string $drive_no
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
            [['name', 'phone', 'card_no', 'drive_no'], 'required'],
            [['is_deal', 'uid'], 'integer'],
            [['name', 'phone', 'card_no', 'drive_no', 'option', 'created'], 'string', 'max' => 20],
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
            'card_no' => 'Card No',
            'drive_no' => 'Drive No',
            'option' => 'Option',
            'created' => 'Created',
            'is_deal' => 'Is Deal',
            'uid' => 'Uid',
        ];
    }
}
