<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_loan".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $itype
 * @property string $created
 * @property int $uid
 * @property int $is_deal
 * @property int $rid
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
            [['name', 'phone', 'itype'], 'required'],
            [['uid', 'is_deal', 'rid'], 'integer'],
            [['name', 'phone', 'itype', 'created'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'itype' => 'Itype',
            'created' => 'Created',
            'uid' => 'Uid',
            'is_deal' => 'Is Deal',
            'rid' => 'Rid',
        ];
    }
}
