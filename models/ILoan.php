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
 * @property int $money 贷款金额
 * @property int $years 贷款时间
 * @property int $state
 * @property string $d_name
 * @property string $d_phone
 * @property string $d_type
 * @property int $d_money
 * @property int $d_month
 * @property int $d_pay
 *
 * @property ILoanImg[] $iLoanImgs
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
            [['created', 'uid', 'money', 'years', 'state', 'd_money', 'd_month', 'd_pay'], 'integer'],
            [['money', 'years'], 'required'],
            [['name', 'phone', 'itype', 'd_type'], 'string', 'max' => 20],
            [['d_name'], 'string', 'max' => 6],
            [['d_phone'], 'string', 'max' => 16],
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
            'money' => '贷款金额',
            'years' => '贷款时间',
            'state' => 'State',
            'd_name' => 'D Name',
            'd_phone' => 'D Phone',
            'd_type' => 'D Type',
            'd_money' => 'D Money',
            'd_month' => 'D Months',
            'd_pay' => 'D Pay',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getILoanImgs()
    {
        return $this->hasMany(ILoanImg::className(), ['lid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getILoanLogs()
    {
        return $this->hasMany(ILoanLog::className(), ['lid' => 'id']);
    }
}
