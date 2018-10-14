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
 * @property string $id_card 身份证号
 * @property int $rid 推荐人ID
 *
 * @property Business $business
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
            [['city_id', 'is_checked', 'business_id', 'is_manager', 'rid'], 'integer'],
            [['nick'], 'string', 'max' => 50],
            [['avator', 'open_id'], 'string', 'max' => 250],
            [['name'], 'string', 'max' => 30],
            [['sex'], 'string', 'max' => 2],
            [['phone'], 'string', 'max' => 16],
            [['id_card'], 'string', 'max' => 20],
            [['business_id'], 'exist', 'skipOnError' => true, 'targetClass' => Business::className(), 'targetAttribute' => ['business_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nick' => '微信昵称',
            'avator' => 'Avator',
            'name' => 'Name',
            'sex' => 'Sex',
            'phone' => 'Phone',
            'city_id' => 'City ID',
            'open_id' => 'Open ID',
            'is_checked' => 'Is Checked',
            'business_id' => '所属车商',
            'is_manager' => '是否管理员',
            'id_card' => '身份证号',
            'rid' => '推荐人ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusiness()
    {
        return $this->hasOne(Business::className(), ['id' => 'business_id']);
    }
}
