<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\Business;
use app\models\User;
use app\models\UserBusiness;

class BusinessController extends AController
{

    public function actionSalerdelete(){
        $uid = $this->post['uid'];
        $model = UserBusiness::find()->where('uid='.$uid)->one();
        if(!$model) return $this->json(402,'没有找到该记录');
        $model->delete();
        return $this->json();
    }

    public function actionSalercheck(){
        $uid = $this->post['uid'];
        $model = UserBusiness::find()->where('uid='.$uid)->one();
        if(!$model) return $this->json(402,'没有找到该记录');
        $model->is_checked = 1;
        $model->save();
        return $this->json();
    }

    public function actionBind(){
        $bid = $this->post['bid'];
        $uid = $this->post['uid'];
        $model = UserBusiness::find()->where('uid='.$uid)->one();
        if(!$model) return $this->json(402,'没有找到该记录');
        $model->business_id = $bid;
        $model->save();
        return $this->json();
    }

    public function actionList(){
        @$p = intval($this->post['p'])?$this->post['p']:1;
        @$check = $this->post['check'];
        @$name = $this->post['name'];
        if($name)
            $where = ' AND name like "%'.$name.'%"';
        else
            $where = '';
        if($check === 0){
            $count = Business::find()->where('is_checked=0'.$where)->count();
            $list = Business::find()->where('is_checked=0'.$where)->offset(($p-1)*20)->limit(20)->all();
        }elseif($check == 1){
            $count = Business::find()->where('is_checked=1'.$where)->count();
            $list = Business::find()->where('is_checked=1'.$where)->offset(($p-1)*20)->limit(20)->all();
        }else{
            $count = Business::find()->where('1=1'.$where)->count();
            $list = Business::find()->where('1=1'.$where)->offset(($p-1)*20)->limit(20)->all();
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
        if($business->is_checked) return $this->json(402,'请不要重复审核，已经审核通过了');
        if($check){
            $business->is_checked = 1;
            $user->is_checked = 1;
            $user->is_manager = 1;
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

    public function actionSalerlist(){
        @$p = intval($this->post['p'])?$this->post['p']:1;
        $count = UserBusiness::find()->count();
        $list = UserBusiness::find()->orderBy('is_checked ASC')->offset(($p-1)*20)->limit(20)->all();
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $tmp = [];
            $user = $li->user;
            $tmp['uid'] = $li->uid;
            if($user) {
                $tmp['name'] = $user->name;
                $tmp['phone'] = $user->phone;
                $tmp['city'] = $user->city;
                $tmp['sex'] = $user->sex;
                $tmp['id_card'] = $user->id_card;
            }else{
                $li->delete();
            }
            $business = $li->business;
            if($business) {
                $tmp['business'] = $business->name;
            }else{
                $tmp['business'] = '';
            }
            $tmp['is_checked'] = $li->is_checked;
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
