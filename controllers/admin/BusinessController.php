<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\Business;
use app\models\User;

class BusinessController extends AController
{

    public function actionList(){
        @$p = intval($this->post['p'])?$this->post['p']:1;
        @$check = $this->post['check'];
        if($check === 0){
            $count = Business::find()->where('is_checked=0')->count();
            $list = Business::find()->where('is_checked=0')->offset(($p-1)*20)->limit(20)->all();
        }elseif($check == 1){
            $count = Business::find()->where('is_checked=1')->count();
            $list = Business::find()->where('is_checked=1')->offset(($p-1)*20)->limit(20)->all();
        }else{
            $count = Business::find()->count();
            $list = Business::find()->offset(($p-1)*20)->limit(20)->all();
        }
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

    public function actionCheck(){
        $bid = $this->post['bid'];
        $check = intval($this->post['check'])?1:0;
        $business = Business::findOne($bid);
        if(!$business) return $this->json(404,'未找到该车商');
        $user = User::find()->where('business_id='.$bid)->one();
        if(!$user){
            $business->delete();
            return $this->json(404,'申请者已经不存在');
        }
        if($check){
            $business->is_checked = 1;
            $user->is_checked = 1;
            $business->save();
            $user->save();
        }else{
            $business->delete();
            $user->is_checked = 0;
            $user->business_id = 0;
            $user->save();
        }
        return $this->json();
    }

    public function actionBusiness(){
        if(empty($this->post['id'])) return $this->json(404,'商家ID不能为空');
        $model = Business::findOne($this->post['id']);
        if($model){
            $this->data['data'] = $model->attributes;
            return $this->json();
        }else{
            return $this->json(404,'该商户不存在');
        }
    }

    public function actionUser(){
        if(empty($this->post['bid'])){
            $model = User::findOne($this->post['id']);
            if(!$model) return $this->json(404,'该用户不存在');
            $this->data['data'] = $model->attributes;
            return $this->json();
        }else{
            $model = User::find()->where('is_manager=1 and business_id='.$this->post['bid'])->one();
            if($model){
                $this->data['data'] = $model->attributes;
                return $this->json();
            }else{
                return $this->json(404,'该商户不存在');
            }
        }
    }

    public function actionUserlist(){
        $bid = $this->post['bid'];
        $list = User::find()->where('business_id='.$bid)->all();
        $count = count($list);
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $tmp = $li->attributes;
            //$tmp['role_name'] = $li->role->role;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionDeleteuser(){
        if(empty($this->post['id'])) return $this->json(403,'用户ID不能为空');
        $model = User::findOne($this->post['id']);
        if($model){
            $model->business_id = 0;
            $model->save();
        }
        return $this->json();
    }


}
