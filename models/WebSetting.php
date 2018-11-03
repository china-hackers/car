<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "web_setting".
 *
 * @property int $id
 * @property string $k
 * @property string $v
 */
class WebSetting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'web_setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['v'], 'string'],
            [['k'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'k' => 'K',
            'v' => 'V',
        ];
    }
}
