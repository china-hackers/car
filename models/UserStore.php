<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_store".
 *
 * @property int $id
 * @property int $uid
 * @property int $pid
 * @property int $created
 *
 * @property Product $p
 * @property User $u
 */
class UserStore extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_store';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'pid', 'created'], 'integer'],
            [['pid'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['pid' => 'id']],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['uid' => 'id']],
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
            'pid' => 'Pid',
            'created' => 'Created',
        ];
    }

    public static function store($store, $uid , $pid){
        $store = intval($store);
        if($store==2){//读取
            $model = UserStore::find()->where('uid='.$uid.' AND pid='.$pid)->one();
            if($model)
                return 1;
            else
                return 0;
        }elseif($store ==1){//收藏
            $model = UserStore::find()->where('uid='.$uid.' AND pid='.$pid)->one();
            if(!$model){
                $model = new UserStore();
                $model->uid = $uid;
                $model->pid = $pid;
                $model->save();
            }
            return 1;
        }else{
            $model = UserStore::find()->where('uid='.$uid.' AND pid='.$pid)->one();
            if($model){
                $model->delete();
            }
            return 0;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP()
    {
        return $this->hasOne(Product::className(), ['id' => 'pid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }
}
