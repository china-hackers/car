<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $nick 微信昵称
 * @property string $avator
 * @property string $name
 * @property string $sex
 * @property string $phone
 * @property int $city_id
 * @property string $open_id
 * @property int $is_checked
 * @property int $business_id 所属车商
 * @property int $is_manager 是否管理员
 * @property int $id_card 身份证号
 * @property int $uid 推荐人ID
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avator'], 'required'],
            [['city_id', 'is_checked', 'business_id', 'is_manager', 'id_card', 'uid'], 'integer'],
            [['nick'], 'string', 'max' => 50],
            [['avator', 'open_id'], 'string', 'max' => 250],
            [['name'], 'string', 'max' => 30],
            [['sex'], 'string', 'max' => 2],
            [['phone'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nick' => 'Nick',
            'avator' => 'Avator',
            'name' => 'Name',
            'sex' => 'Sex',
            'phone' => 'Phone',
            'city_id' => 'City ID',
            'open_id' => 'Open ID',
            'is_checked' => 'Is Checked',
            'business_id' => 'Business ID',
            'is_manager' => 'Is Manager',
            'id_card' => 'Id Card',
            'uid' => 'Uid',
        ];
    }
}
