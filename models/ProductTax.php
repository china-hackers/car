<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_tax".
 *
 * @property int $id
 * @property int $pid
 * @property string $nian_date
 * @property string $jiao_date
 * @property string $shang_date
 * @property string $zhi_date
 * @property int $shoufu
 * @property int $yuegong
 */
class ProductTax extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_tax';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid', 'shoufu', 'yuegong'], 'integer'],
            [['nian_date', 'jiao_date', 'shang_date', 'zhi_date'], 'string', 'max' => 20],
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
            'nian_date' => 'Nian Date',
            'jiao_date' => 'Jiao Date',
            'shang_date' => 'Shang Date',
            'zhi_date' => 'Zhi Date',
            'shoufu' => 'Shoufu',
            'yuegong' => 'Yuegong',
        ];
    }
}
