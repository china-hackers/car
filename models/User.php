<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $nickname 微信昵称
 * @property string $headimgurl
 * @property string $name
 * @property string $sex
 * @property string $phone
 * @property int $city_id
 * @property string $openid
 * @property int $is_checked
 * @property int $business_id 所属车商
 * @property int $is_manager 是否管理员
 * @property string $id_card 身份证号
 * @property int $rid 推荐人ID
 * @property string $city
 * @property string $province
 * @property string $country
 *
 * @property Business $business
 * @property UserStore[] $userStores
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
            [['city_id', 'is_checked', 'business_id', 'is_manager', 'rid'], 'integer'],
            [['nickname'], 'string', 'max' => 50],
            [['headimgurl', 'openid'], 'string', 'max' => 250],
            [['name'], 'string', 'max' => 30],
            [['sex'], 'string', 'max' => 2],
            [['phone'], 'string', 'max' => 16],
            [['id_card', 'city', 'province', 'country'], 'string', 'max' => 20],
            [['openid'], 'unique'],
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
            'nickname' => '微信昵称',
            'headimgurl' => '头像',
            'name' => 'Name',
            'sex' => 'Sex',
            'phone' => 'Phone',
            'city_id' => 'City ID',
            'openid' => 'Openid',
            'is_checked' => 'Is Checked',
            'business_id' => '所属车商',
            'is_manager' => '是否管理员',
            'id_card' => '身份证号',
            'rid' => '推荐人ID',
            'city' => 'City',
            'province' => 'Province',
            'country' => 'Country',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusiness()
    {
        return $this->hasOne(Business::className(), ['id' => 'business_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserStores()
    {
        return $this->hasMany(UserStore::className(), ['uid' => 'id']);
    }
}
