<?php

namespace app\controllers\mobile;

use app\controllers\base\BaseController;
use abei2017\wx\Application;
use app\models\User;
use yii;

class ApiController extends BaseController
{

    public function actionWeixin(){
        $this->layout = false;
        $server = (new Application())->driver("mp.server");

        $server->setMessageHandler(function($message) {
            file_put_contents('./t.txt',print_r($message,true));
            return "欢迎你";
        });

        $response = $server->serve();
        return $response;
    }

    public function actionOauth(){
        $oauth = (new Application())->driver('mp.oauth');
        $user = $oauth->user();
        $model = User::find()->where(['openid'=>$user['openid']])->one();
        if($model){
            Yii::$app->session->set('uid',$model->id);
        }else{
            $model = new User();
            $model->attributes = $user;
            $model->sex = ($user['sex']==1)?'男':'女';
            $model->save();
            Yii::$app->session->set('uid',$model->id);
        }
        return $this->redirect('/');
    }

    public function actionMenu(){
        $this->layout = false;
        $json = '{
            "button": [
                {
                    "type": "view", 
                    "name": "首页", 
                    "url": "http://test.iamlk.cn/#0", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "view", 
                    "name": "i拼车", 
                    "url": "http://test.iamlk.cn/#1", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "view", 
                    "name": "个人中心", 
                    "url": "http://test.iamlk.cn/#2", 
                    "sub_button": [ ]
                }
            ]
        }';
        $menu = (new Application())->driver("mp.menu");
        $menu->create($json);
        exit;
    }
}
