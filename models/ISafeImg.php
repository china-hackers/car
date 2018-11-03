<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_safe_img".
 *
 * @property int $id
 * @property int $sid
 * @property string $img
 *
 * @property ISafe $s
 */
class ISafeImg extends \yii\db\ActiveRecord
{

    public static function addImgs($id, $list){
        ISafeImg::deleteAll('sid='.$id);
        if(empty($list)) return false;
        foreach($list as $li){
            $model = new ISafeImg();
            $model->sid = $id;
            $model->img = $li;
            $model->save();
        }
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i_safe_img';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sid'], 'integer'],
            [['img'], 'string', 'max' => 200],
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
            'img' => 'Img',
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
