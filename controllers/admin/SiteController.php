<?php

namespace app\controllers\admin;


use app\controllers\base\BaseController;
use app\models\Admin;
use Yii;

class SiteController extends BaseController
{

    public function actionIndex(){
        $this->layout = false;
        return $this->render('index');
    }

    public function actionLogin(){
        $this->layout = false;
        $json_str = file_get_contents('php://input');
        if(empty($json_str)) return $this->render('login');
        $this->post = json_decode($json_str,true);
        $model = Admin::login($this->post);
        if($model){
            return $this->json();
        }else{
            return $this->json(301);
        }
    }

    public function actionLogout(){
        Yii::$app->session->close();
        Yii::$app->session->destroy();
        return $this->redirect('/admin/login');
    }
}
