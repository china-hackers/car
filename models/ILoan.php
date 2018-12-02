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
 * @property int $d_money_return
 * @property string $d_date
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
            [['created', 'uid', 'money', 'years', 'state', 'd_money', 'd_month', 'd_money_return', 'd_pay'], 'integer'],
            [['money', 'years'], 'required'],
            [['d_date'], 'safe'],
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
            'd_month' => 'D Month',
            'd_pay' => 'D Pay',
            'd_date' => 'D Date',
            'd_money_return'=>'D Return',
        ];
    }

    public function getMonths($date1,$date2){
        $date1_stamp=strtotime($date1);
        $date2_stamp=strtotime($date2);
        list($date_1['y'],$date_1['m'])=explode("-",date('Y-m',$date1_stamp));
        list($date_2['y'],$date_2['m'])=explode("-",date('Y-m',$date2_stamp));
        return abs($date_1['y']-$date_2['y'])*12 +$date_2['m']-$date_1['m'];
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
