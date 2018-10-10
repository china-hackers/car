<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_loan_log".
 *
 * @property int $id
 * @property int $lid
 * @property string $note
 * @property int $created
 */
class ILoanLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i_loan_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lid'], 'required'],
            [['lid', 'created'], 'integer'],
            [['note'], 'string'],
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
            'note' => 'Note',
            'created' => 'Created',
        ];
    }
}
