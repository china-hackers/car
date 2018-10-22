<?php

namespace app\controllers\base;

use yii;

class MController extends BaseController
{

    protected function checkUser(){
        if(!$this->uid){
            $this->json(300);
            Yii::$app->end();
        }
    }

    public function beforeAction($action){
        $this->layout = false;
        $post = file_get_contents('php://input');
        if(empty($post)) return $this->json(400);
        $this->post = json_decode($post,true);
        $this->uid = Yii::$app->session->get('uid');
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
}
