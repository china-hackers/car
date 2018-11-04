<?php

namespace app\controllers\mobile;

use app\controllers\base\BaseController;
use abei2017\wx\Application;
use app\models\User;
use app\models\UserQrcode;
use yii;

class ApiController extends BaseController
{
    private $url = 'http://test.iamlk.cn/';

    public function actionJoin($key){
        return $this->redirect($this->url.'#/my/join');
    }

    public function actionWeixin(){
        $this->layout = false;
        $server = (new Application())->driver("mp.server");

        $server->setMessageHandler(function($message) {
            if($message['MsgType']=='text'){
                return "我们已收到您的留言，谢谢~";
            }elseif($message['MsgType']=='event'){
                if(@$message['EventKey'] && $message['Event']=='subscribe'){
                    return $message['Event'].$message['EventKey'];
                    $key = str_replace('qrscene_','',$message['EventKey']);
                    if(strpos($key,'B')){//车商二维码
                        return '欢迎关注我们的公众号~<br/>请点击该链接进行车商注册'.$this->url.'api/join/key/'.intval($key);
                    }
                    $model = new UserQrcode();
                    $model->uid =
                    $model->openid = $message['FromUserName'];
                    $model->created = time();
                    $model->save();
                }
                return "欢迎关注我们的公众号~".$message['Event'].$message['EventKey'];
            }
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
            $qrcode = UserQrcode::find()->where(['openid'=>$user['openid']])->one();
            $model = new User();
            $model->attributes = $user;
            $model->sex = ($user['sex']==1)?'男':'女';
            if($qrcode) $model->rid = $qrcode->uid;
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
