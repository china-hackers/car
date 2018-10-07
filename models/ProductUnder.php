<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_under".
 *
 * @property int $id
 * @property int $pid
 * @property string $dirve_type
 * @property string $turn_sys
 * @property string $head_sys
 * @property string $back_sys
 */
class ProductUnder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_under';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid'], 'integer'],
            [['dirve_type', 'turn_sys'], 'string', 'max' => 20],
            [['head_sys', 'back_sys'], 'string', 'max' => 11],
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
            'dirve_type' => 'Dirve Type',
            'turn_sys' => 'Turn Sys',
            'head_sys' => 'Head Sys',
            'back_sys' => 'Back Sys',
        ];
    }
}
