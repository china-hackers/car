<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $nickname 微信昵称
 * @property string $headimgurl 头像地址
 * @property string $name 姓名
 * @property string $sex 性别
 * @property string $phone 电话
 * @property string $openid openid
 * @property string $id_card 身份证号
 * @property int $rid 推荐人ID
 * @property string $city 微信城市
 * @property string $province 微信省份
 * @property string $country 微信国家
 * @property string $itype 爱车类型
 * @property int $jifen 积分
 * @property int $car_id 爱车型号
 * @property int $uid 销售ID
 * @property string $car_no 车牌号
 *
 * @property UserBusiness[] $userBusinesses
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
            [['rid', 'jifen', 'car_id', 'uid'], 'integer'],
            [['nickname'], 'string', 'max' => 50],
            [['headimgurl', 'openid'], 'string', 'max' => 250],
            [['name'], 'string', 'max' => 30],
            [['sex'], 'string', 'max' => 2],
            [['phone'], 'string', 'max' => 16],
            [['id_card', 'city', 'province', 'country', 'itype'], 'string', 'max' => 20],
            [['car_no'], 'string', 'max' => 12],
            [['openid'], 'unique'],
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
            'headimgurl' => '头像地址',
            'name' => '姓名',
            'sex' => '性别',
            'phone' => '电话',
            'openid' => 'openid',
            'id_card' => '身份证号',
            'rid' => '推荐人ID',
            'city' => '微信城市',
            'province' => '微信省份',
            'country' => '微信国家',
            'itype' => '爱车类型',
            'jifen' => '积分',
            'car_id' => '爱车型号',
            'uid' => '销售ID',
            'car_no' => '车牌号',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserBusiness()
    {
        return $this->hasOne(UserBusiness::className(), ['uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
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
    public function getUserStores()
    {
        return $this->hasMany(UserStore::className(), ['uid' => 'id']);
    }
}
