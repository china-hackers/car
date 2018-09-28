<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\Business;

class BusinessController extends AController
{

    public function actionList(){
        @$check = $this->post['check'];
        if($check === 0){
            $list = Business::find()->where('is_checked=0')->all();
        }elseif($check == 1){
            $list = Business::find()->where('is_checked=1')->all();
        }else{
            $list = Business::find()->all();
        }
        $count = count($list);
        $l2 = [];
        foreach($list as $li){
            $tmp = $li->attributes;
            $l2[] = $tmp;
        }
        $data = ['total'=>intval($count)];
        $data['list'] = $l2;
        $this->data['data']=$data;
        return $this->json();
    }

    public function actionBusiness(){
        if(empty($this->post['id'])) return $this->json(403,'商家ID不能为空');
        $model = Business::findOne($this->post['id']);
        if($model){
            $this->data['data'] = $model->attributes;
            return $this->json();
        }else{
            return $this->json(404,'该商户不存在');
        }
    }

    public function actionDelete(){
        if(empty($this->post['id'])) return $this->json(403,'商家ID不能为空');
        $model = Business::findOne($this->post['id']);
        if($model)
            $model->delete();
        return $this->json();
    }


}
