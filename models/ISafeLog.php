<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_safe_log".
 *
 * @property int $id
 * @property int $sid
 * @property string $note
 * @property int $created
 */
class ISafeLog extends \yii\db\ActiveRecord
{

    public function addLog($id, $note){
        $this->lid = $id;
        $this->note = $note;
        $this->created = time();
        return $this->save();
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i_safe_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid', 'created'], 'integer'],
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
            'sid' => 'Sid',
            'note' => 'Note',
            'created' => 'Created',
        ];
    }
}
