<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_buy".
 *
 * @property int $id
 * @property int $pid
 * @property int $uid
 * @property int $bid
 * @property string $name
 * @property string $phone
 * @property int $is_deal
 * @property int $created
 * @property int $saler_id
 * @property string $price
 * @property int $pid2
 *
 * @property Product $p
 * @property IBuyLog[] $iBuyLogs
 */
class IBuy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i_buy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid'], 'required'],
            [['pid', 'uid', 'bid', 'is_deal', 'created', 'saler_id', 'pid2'], 'integer'],
            [['name', 'phone', 'price'], 'string', 'max' => 20],
            [['pid'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['pid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'uid' => 'Uid',
            'bid' => 'Bid',
            'name' => 'Name',
            'phone' => 'Phone',
            'is_deal' => 'Is Deal',
            'created' => 'Created',
            'saler_id' => 'Saler ID',
            'price' => 'Price',
        ];
    }
    public function getSaler()
    {
        return $this->hasOne(User::className(), ['id' => 'saler_id']);
    }
    public function getP2()
    {
        return $this->hasOne(Product::className(), ['id' => 'pid2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP()
    {
        return $this->hasOne(Product::className(), ['id' => 'pid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIBuyLogs()
    {
        return $this->hasMany(IBuyLog::className(), ['bid' => 'id']);
    }
}
