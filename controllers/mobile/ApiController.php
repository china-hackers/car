<?php

namespace app\controllers\mobile;

use yii\web\Controller;
use abei2017\wx\Application;
use abei2017\wx\core\AccessToken;
use yii;

class ApiController extends Controller
{

    public function actionWeixin(){
        $this->layout = false;
        echo $_GET['echostr'];
        exit;
    }

    private function checkOauth(){
        $conf = [];
        $url = Yii::$app->request->getUrl();
        $callback = Yii::$app->urlManager->createAbsoluteUrl(['/wechat/oauth','url'=>urlencode($url)]);

        $conf['oauth']['callback'] = $callback;
        $app = new Application();

        $oauth = $app->driver('mp.oauth');
        $wxLoginUser = Yii::$app->session->get('wx_login_user');
        if($wxLoginUser == null){
            $oauth->send();
            die();
        }
    }

    public function actionOauth(){
        $url = Yii::$app->request->get('url');

        $oauth = (new Application())->driver('mp.oauth');
        $user = $oauth->user();

        $check = User::find()->where(['type'=>User::WX_MP_LOGIN,'auth_id'=>$user['openid']])->one();
        if($check == false){
            //生成新会员
        }

        Yii::$app->session->set('wx_login_user',$check);

        header('location:'.urldecode($url));
    }

    public function actionTest(){
        $this->checkOauth();
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
