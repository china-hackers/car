<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_qrcode".
 *
 * @property int $id
 * @property int $uid
 * @property string $openid
 * @property int $created
 */
class UserQrcode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_qrcode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'created'], 'integer'],
            [['openid'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'openid' => 'Openid',
            'created' => 'Created',
        ];
    }
}
