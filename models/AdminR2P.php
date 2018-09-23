<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_r2p".
 *
 * @property int $id
 * @property int $role_id
 * @property int $menu_id
 */
class AdminR2P extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_r2p';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'menu_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'menu_id' => 'Menu ID',
        ];
    }
}
