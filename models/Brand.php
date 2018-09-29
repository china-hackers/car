<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property int $id
 * @property string $letter
 * @property string $brand
 * @property string $model
 * @property string $star
 * @property string $keywords
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
            [['star'], 'number'],
            [['letter'], 'string', 'max' => 1],
            [['brand', 'model'], 'string', 'max' => 100],
            [['keywords'], 'string', 'max' => 250],
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
            'star' => 'Star',
            'keywords' => 'Keywords',
        ];
    }
}
