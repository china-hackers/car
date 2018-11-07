<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_business".
 *
 * @property int $id
 * @property int $uid
 * @property int $is_checked
 * @property int $business_id
 * @property int $is_manager
 * @property int $users 服务客户数
 * @property int $created 申请时间
 *
 * @property User $user
 * @property User $business
 */
class UserBusiness extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_business';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'is_checked', 'business_id', 'is_manager', 'users', 'created'], 'integer'],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'is_checked' => 'Is Checked',
            'business_id' => 'Business ID',
            'is_manager' => 'Is Manager',
            'users' => '服务客户数',
            'created' => '申请时间',
        ];
    }


    public function getBusiness()
    {
        return $this->hasOne(Business::className(), ['id' => 'business_id']);
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['uid' => 'id']);
    }
}
