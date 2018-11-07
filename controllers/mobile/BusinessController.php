<?php
/**
 * Created by PhpStorm.
 * User: Leonidax
 * Date: 2018/10/8
 * Time: 下午11:00
 */

namespace app\controllers\mobile;


use app\controllers\base\MController;
use app\models\Business;
use abei2017\wx\Application;
use app\models\IBuy;
use app\models\IBuyLog;
use app\models\Product;
use app\models\User;
use app\models\UserBusiness;
use app\models\UserSms;
use yii;

class BusinessController extends MController{

    public function beforeAction($action)
    {
        $this->checkUser();
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function actionProductdeal(){
        $id = $this->post['id'];
        $ub = UserBusiness::find()->where('uid='.$this->uid)->one();
        $model = IBuy::findOne($id);
        if($ub->business_id != $model->bid) return $this->json(402,'该车辆不属于您所在的车商');
        $model->pid = $this->post['pid'];
        $model->price = $this->post['price'];
        $model->is_deal = 1;
        if($model->save()){
            $product = Product::findOne($model->pid);
            $product->state = 1;
            $product->save();
            $tmp = new IBuyLog();
            $tmp->addLog($model->id,'已成交!');
            $list = IBuy::find()->where('pid='.$model->pid)->all();
            if($list){
                foreach($list as $li){
                    $li->is_deal = 2;
                    $li->save();
                    $tmp = new IBuyLog();
                    $tmp->addLog($li->id,'该车已被其他客户成交');
                }
            }
            return $this->json();
        }else{
            return $this->error($model, 402);
        }
    }

    public function actionProductdelete(){
        $model = Product::findOne($this->post['id']);
        $ub = UserBusiness::find()->where('uid='.$this->uid)->one();
        if($model->business_id != $ub->business_id) return $this->json(402,'该车辆不属于您所在的车商');
        $count = Ibuy::find()->where('pid='.$model->id)->count();
        if($count){
            return $this->json(404,'已经有人咨询价格了，不允许删除');
        }else{
            $model->delete();
            return $this->json();
        }
    }

    public function actionProductclose(){
        $model = Product::findOne($this->post['id']);
        $ub = UserBusiness::find()->where('uid='.$this->uid)->one();
        if($model->business_id != $ub->business_id) return $this->json(402,'该车辆不属于您所在的车商');
        $model->state = 1;
        $model->save();
        $list = IBuy::find()->where('pid='.$model->id.' AND is_deal=0')->all();
        if($list){
            foreach($list as $b){
                $b->is_deal = 2;
                $b->save();
                $tmp = new IBuyLog();
                $tmp->addLog($b->id,'该商品已被车商设置为已售');
            }
        }
        return $this->json();
    }

    public function actionOrderlose(){
        $id = $this->post['id'];
        $model = IBuy::findOne($id);
        $model->is_deal = 2;
        $model->save();
        return $this->json();
    }

    public function actionOrderlist(){
        $p = @intval($this->post['p'])?$this->post['p']:1;
        $type = @intval($this->post['is_deal']);
        $ub = UserBusiness::find()->where('uid='.$this->uid)->one();
        $where = 'bid='.$ub->business_id;
        $where .= ' AND is_deal='.$type;
        $count = IBuy::find()->where($where)->count();
        $list = IBuy::find()->where($where)->orderBy('id DESC')->offset(($p-1)*20)->limit(20)->all();
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $tmp = $li->attributes;
            $product = Product::findOne($li->pid);
            $tmp['title'] = $product->title;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionSave(){
        $userBusiness = UserBusiness::find()->where('uid='.$this->uid)->one();
        if(!$userBusiness) return $this->json(404,'您还没有申请成为车商');
        if(!$userBusiness->is_checked) return $this->json(404,'您申请成为车商还在审核中');
        $business = Business::findOne($userBusiness->business_id);
        $business->attributes = $this->post;
        if($business->save()){
            return $this->json();
        }else{
            return $this->error($business);
        }
    }

    public function actionBusiness(){
        $userBusiness = UserBusiness::find()->where('uid='.$this->uid)->one();
        if(!$userBusiness) return $this->json(404,'您还没有申请成为车商');
        if(!$userBusiness->is_checked) return $this->json(404,'您申请成为车商还在审核中');
        $business = Business::findOne($userBusiness->business_id);
        $this->data['data'] = $business->attributes;
        $ub = UserBusiness::find()->where('business_id='.$userBusiness->business_id.' AND is_manager=1')->one();
        $user = User::findOne($ub->uid);
        $this->data['data']['uname'] = $user->name;
        $this->data['data']['uphone'] = $user->phone;
        $this->data['data']['usex'] = $user->sex;
        $this->data['data']['ucard'] = $user->id_card;
        $this->data['data']['ucity'] = $user->city;
        return $this->json();
    }

    public function actionSalerlist(){
        $business = UserBusiness::find()->where('uid='.$this->uid)->one();
        if(!$business) return $this->json(404,'您还没有申请成为车商');
        if(!$business->is_checked) return $this->json(404,'您申请成为车商还在审核中');
        $data = UserBusiness::find()->where('business_id='.$business->business_id)->all();
        $list = [];
        foreach($data as $d){
            $user = $d->user;
            $list[] = ['name'=>$user->name,'phone'=>$user->phone,'sex'=>$user->sex];
        }
        $this->data['data'] = $list;
        return $this->json();
    }

    public function actionProductlist(){
        $p = @intval($this->post['p'])?$this->post['p']:1;
        $state = @intval($this->post['state']);
        $title = @$this->post['title'];
        $business = UserBusiness::find()->where('uid='.$this->uid)->one();
        if(!$business) return $this->json(404,'您还没有申请成为车商');
        if(!$business->is_checked) return $this->json(404,'您申请成为车商还在审核中');
        $where = 'business_id='.$business->business_id.' AND state='.$state;
        if($title) $where .= ' AND title like "% '.$title.' %"';
        $count = Product::find()->where($where)->count();
        $list = Product::find()->select('id,title,price,car_id,state')->where($where)->orderBy('id DESC')->offset(($p-1)*20)->limit(20)->all();
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $tmp = [];
            foreach($li->attributes as $k=>$v){
                if($v===null) continue;
                $tmp[$k] = $v;
            }
            $tmp['img'] = empty($li->productImg)?'':@$li->productImg->img;
            $car = $li->car;
            $tmp['brand'] = $car->brand.'/'.$car->model;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionQrcode(){
        $model = UserBusiness::find()->where('uid='.$this->uid)->one();
        if(!$model){
            return $this->json(404,'您还不是车商');
        }elseif(!$model->is_checked){
            return $this->json(404,'您申请成为车商还没有通过审核');
        }elseif(!$model->is_manager){
            return $this->json(404,'您不是车商管理员');
        }
        $qrcode = (new Application())->driver("mp.qrcode");
        $r  = $qrcode->strTemp(2592000,$model->id.'B');
        $this->data['data']['qrcode'] = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.@$r['ticket'];
        return $this->json();
    }

    public function actionInfo(){
        $user = User::findOne($this->uid);
        if($user->phone){
            $this->data['data']['phone'] = $user->phone;
        }
        $session = Yii::$app->session;
        $bid = $session->get('bid');
        if($bid){
            $business = Business::findOne($bid);
            if($business){
                $this->data['data']['business'] = $business->name;
            }
        }
        return $this->json();
    }

    public function actionRegister(){
        $model = UserBusiness::find()->where('uid='.$this->uid)->one();
        if($model) return $this->json(401,'您已经提交过了');
        $user = User::findOne($this->uid);
        if(@$this->post['phone']){
            $sms = UserSms::find()->where('phone="'.$this->post['phone'].'"')->one();
            if(!$sms)   return $this->json(401,'未发送短信验证码');
            if($sms->code == $this->post['code']){
                $user->phone = $this->post['phone'];
                $sms->delete();
            }else{
                return $this->json(401,'短信验证码错误');
            }
        }
        $user->name = $this->post['name'];
        $user->sex = $this->post['sex'];
        $user->city = $this->post['city'];
        $user->id_card = $this->post['id_card'];
        $user->save();
        $model = new UserBusiness();
        $model->uid = $this->uid;
        $model->is_checked = 0;
        if(@$this->post['business']){
            $business = new Business();
            $business->name = $this->post['business'];
            $business->save();
            $model->business_id = $business->id;
            $model->is_manager = 1;
        }else{
            $session = Yii::$app->session;
            $bid = $session->get('bid');
            if($bid)
                $model->business_id = $bid;
            $model->is_manager = 0;
        }
        $model->created = time();
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model);
        }
    }

}