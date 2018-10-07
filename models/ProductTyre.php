<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_tyre".
 *
 * @property int $id
 * @property int $pid
 * @property string $head_drive
 * @property string $back_drive
 * @property string $head_std
 * @property string $back_std
 */
class ProductTyre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_tyre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid'], 'integer'],
            [['head_drive', 'back_drive'], 'string', 'max' => 20],
            [['head_std', 'back_std'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'head_drive' => 'Head Drive',
            'back_drive' => 'Back Drive',
            'head_std' => 'Head Std',
            'back_std' => 'Back Std',
        ];
    }
}
