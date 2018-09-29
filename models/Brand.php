<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string $letter
 * @property string $brand
 * @property string $model
 * @property string $core 关键ID
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['letter'], 'string', 'max' => 1],
            [['brand', 'model'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'letter' => 'Letter',
            'brand' => 'Brand',
            'model' => 'Model',
        ];
    }
}
