<?php
/**
 * Created by PhpStorm.
 * User: Leonidax
 * Date: 2018/10/8
 * Time: 下午11:00
 */

namespace app\controllers\mobile;

use app\controllers\base\MController;
use abei2017\wx\Application;
use app\models\User;
use app\models\UserSms;
use app\models\UserStore;

class UserController extends MController{

    public function actionBindphone(){
        $this->checkUser();
        $phone = trim($this->post['phone']);
        $code = trim($this->post['code']);
        $model = UserSms::find()->where(['phone'=>$phone,'code'=>$code])->one();
        if(strlen($phone) != 11)
            return $this->json(402,'手机号长度必须是11位');
        if(!$model)
            return $this->json(402,'验证码错误');
        $model->delete();
        $model = User::findOne($this->uid);
        $model->phone = $phone;
        $model->save();
        return $this->json();
    }

    public function actionSendcode(){
        $this->checkUser();
        $phone = trim($this->post['phone']);
        if(strlen($phone) != 11)
            return $this->json(404,'手机号长度必须是11位');
        //todo
        $model = UserSms::find()->where('phone="'.$phone.'"')->one();
        if($model){
            $code = $model->code;
        }else{
            $code = rand(1000,9999);
            $model = new UserSms();
            $model->phone = $phone;
            $model->code = $code;
            $model->save();
        }
        return $this->json();
    }

    public function actionCarsave(){
        $this->checkUser();
        $model = User::findOne($this->uid);
        $model->car_id = $this->post['car_id'];
        $model->car_no = $this->post['car_no'];
        $model->car_price = $this->post['car_price'];
        if($model->car_price<10){
            $model->itype = 'i值车';
        }elseif($model->car_price<20){
            $model->itype = 'i优车';
        }elseif ($model->car_price<30){
            $model->itype = 'i享车';
        }elseif($model->car_price<70){
            $model->itype = 'i品车';
        }else{
            $model->itype = 'i尊车';
        }
        $model->save();
        if($model->hasErrors())
            return $this->error($model,402);
        else
            return $this->json();
    }

    public function actionQrcode(){
        $qrcode = (new Application())->driver("mp.qrcode");
        $r = $qrcode->forever(@$this->post['id']);
        $this->data['data']['qrcode'] = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.@$r['ticket'];
        return $this->json();
    }

    public function actionCar(){
        $this->checkUser();
        $model = User::findOne($this->uid);
        $this->data['data']['car_id'] = $model->car_id;
        $this->data['data']['car_no'] = $model->car_no;
        return $this->json();
    }

    public function actionUser(){
        $this->checkUser();
        $model = User::findOne($this->uid);
        if(!$model) return $this->json(404,'该用户不存在');
        $this->data['data'] = $model->attributes;
        if($model->user){
            $user = [];
            $user['name'] = $model->user->name;
            $user['phone'] = $model->user->phone;
            $this->data['data']['user'] = $user;
        }
        if($model->car) $this->data['data']['car'] = $model->car->attributes;
        return $this->json();
    }

    public function actionStorelist(){
        $this->checkUser();
        $data = UserStore::find()->where('uid='.$this->uid)->all();
        $list = [];
        foreach($data as $li){
            $list[] = $li->product->attributes;
        }
        $this->data['data'] = $list;
        return $this->json();
    }
}
