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

class UserController extends MController{

    public function actionQrcode(){
        $qrcode = (new Application())->driver("mp.qrcode");
        $r = $qrcode->forever(@$this->post['id']);
        $this->data['data']['qrcode'] = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$r['ticket'];
        return $this->json();
    }

    public function actionUser(){
        $model = User::findOne($this->post['id']);
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
}
