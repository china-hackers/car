<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_buy".
 *
 * @property int $id
 * @property int $pid
 * @property int $uid
 * @property string $name
 * @property string $phone
 * @property int $is_deal
 * @property int $created
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
            [['pid', 'uid', 'is_deal', 'created'], 'integer'],
            [['name', 'phone'], 'string', 'max' => 20],
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
            'name' => 'Name',
            'phone' => 'Phone',
            'is_deal' => 'Is Deal',
            'created' => 'Created',
        ];
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
