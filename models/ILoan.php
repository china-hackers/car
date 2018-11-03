<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_loan".
 *
 * @property int $id
 * @property string $name 姓名
 * @property string $phone 电话
 * @property string $itype 贷款类型
 * @property int $created
 * @property int $uid
 * @property int $is_deal
 * @property int $money 贷款金额
 * @property int $years 贷款时间
 *
 * @property ILoanLog[] $iLoanLogs
 */
class ILoan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i_loan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'uid', 'is_deal', 'money', 'years'], 'integer'],
            [['name', 'phone', 'itype'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'phone' => '电话',
            'itype' => '贷款类型',
            'created' => 'Created',
            'uid' => 'Uid',
            'is_deal' => 'Is Deal',
            'money' => '贷款金额',
            'years' => '贷款时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getILoanLogs()
    {
        return $this->hasMany(ILoanLog::className(), ['lid' => 'id']);
    }
}
