<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_img".
 *
 * @property int $id
 * @property int $pid 商品ID
 * @property string $img
 */
class ProductImg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_img';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid'], 'integer'],
            [['img'], 'string', 'max' => 200],
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
            'img' => 'Img',
        ];
    }
}
