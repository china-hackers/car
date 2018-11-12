<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\Business;
use app\models\User;
use app\models\UserBusiness;

class BusinessController extends AController
{
    public function actionSave(){
        $id = $this->post['id'];
        $model = Business::findOne($id);
        unset($this->post['id']);
        $model->attributes = $this->post;
        $ub = UserBusiness::find()->where('business_id='.$id)->one();
        $user = User::findOne($ub->uid);
        $user->id_card = $this->post['ucard'];
        $user->city = $this->post['ucity'];
        $user->name = $this->post['uname'];
        $user->phone = $this->post['uphone'];
        $user->sex = $this->post['usex'];
        $user->save();
        if($model->save())
            return $this->json();
        else
            return $this->error($model,402);
    }

    public function actionSalers(){
        $bid = $this->post['bid'];
        $data = UserBusiness::find()->where(['business_id'=>$bid,'is_checked'=>1])->all();
        $list = [];
        foreach($data as $d){
            $user = $d->user;
            $tmp = $user->attributes;
            $tmp['is_manager'] = $d->is_manager;
            $tmp['uid'] = $d->uid;
            $list[] = $tmp;
        }
        $this->data['data'] = $list;
        return $this->json();
    }

    public function actionSalerdelete(){
        $uid = $this->post['uid'];
        $model = UserBusiness::find()->where('uid='.$uid)->one();
        if(!$model) return $this->json(403,'没有找到该记录');
        if($model->is_manager) return $this->json(403,'管理员不允许被删除');
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
            $ub = UserBusiness::find()->where('business_id='.$li->id)->one();
            if(empty($ub)){
                $li->delete();
                continue;
            }
            $user = User::findOne($ub->uid);
            $tmp['uname'] = $user->name;
            $tmp['uphone'] = $user->phone;
            $tmp['ucity'] = $user->city;
            $tmp['usex'] = $user->sex;
            $tmp['ucard'] = $user->id_card;
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
        if($check){
            $business->is_checked = 1;
            $business->save();
            return $this->json();
        }else{
            if($business->is_checked) return $this->json(402,'该车商已经审核通过了，不能删除');
            UserBusiness::deleteAll(['business_id'=>$business->id]);
            $business->delete();
            return $this->json();
        }
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
