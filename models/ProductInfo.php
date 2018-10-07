<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_info".
 *
 * @property int $id
 * @property int $pid
 * @property string $examiner
 * @property string $business
 * @property string $owner
 */
class ProductInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid'], 'integer'],
            [['examiner', 'business', 'owner'], 'string'],
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
            'examiner' => 'Examiner',
            'business' => 'Business',
            'owner' => 'Owner',
        ];
    }
}
