<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_buy_log".
 *
 * @property int $id
 * @property int $bid
 * @property string $note
 * @property int $created
 *
 * @property IBuy $b
 */
class IBuyLog extends \yii\db\ActiveRecord
{

    public function addLog($id, $note){
        $this->bid = $id;
        $this->note = $note;
        $this->created = time();
        return $this->save();
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i_buy_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bid', 'created'], 'integer'],
            [['note'], 'string'],
            [['bid'], 'exist', 'skipOnError' => true, 'targetClass' => IBuy::className(), 'targetAttribute' => ['bid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bid' => 'Bid',
            'note' => 'Note',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB()
    {
        return $this->hasOne(IBuy::className(), ['id' => 'bid']);
    }
}
