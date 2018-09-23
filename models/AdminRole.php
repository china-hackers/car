<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_role".
 *
 * @property int $id
 * @property string $role
 * @property string $note
 */
class AdminRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'string', 'max' => 20],
            [['note'], 'string', 'max' => 200],
            [['role'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'note' => 'Note',
        ];
    }
}
