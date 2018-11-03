<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_loan_img".
 *
 * @property int $id
 * @property int $lid
 * @property string $img
 *
 * @property ILoan $l
 */
class ILoanImg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i_loan_img';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lid'], 'integer'],
            [['img'], 'string', 'max' => 250],
            [['lid'], 'exist', 'skipOnError' => true, 'targetClass' => ILoan::className(), 'targetAttribute' => ['lid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lid' => 'Lid',
            'img' => 'Img',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getL()
    {
        return $this->hasOne(ILoan::className(), ['id' => 'lid']);
    }
}
