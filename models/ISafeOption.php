<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_safe_option".
 *
 * @property int $id
 * @property int $sid
 * @property string $k
 * @property string $v
 *
 * @property ISafe $s
 */
class ISafeOption extends \yii\db\ActiveRecord
{

    public static function addOptions($id, $list){
        if(empty($list)) return false;
        foreach($list as $key=>$value){
            $model = new ISafeOption();
            $model->sid = $id;
            $model->k = $key;
            $model->v = $value;
            $model->save();
        }
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i_safe_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid'], 'integer'],
            [['v'], 'number'],
            [['k'], 'string', 'max' => 100],
            [['sid'], 'exist', 'skipOnError' => true, 'targetClass' => ISafe::className(), 'targetAttribute' => ['sid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sid' => 'Sid',
            'k' => 'K',
            'v' => 'V',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getS()
    {
        return $this->hasOne(ISafe::className(), ['id' => 'sid']);
    }
}
