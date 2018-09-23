<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_permission".
 *
 * @property int $id
 * @property string $title
 * @property string $route
 * @property int $level
 * @property string $icon
 * @property int $pid
 * @property int $orders
 * @property int $is_menu
 */
class AdminPermission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_permission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level', 'pid', 'orders', 'is_menu'], 'integer'],
            [['title'], 'string', 'max' => 20],
            [['route', 'icon'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'route' => 'Route',
            'level' => 'Level',
            'icon' => 'Icon',
            'pid' => 'Pid',
            'orders' => 'Orders',
            'is_menu' => 'Is Menu',
        ];
    }
}
