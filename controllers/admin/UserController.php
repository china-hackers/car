<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\User;

class UserController extends AController
{

    public function actionList(){
        @$p = intval($this->post['p'])?$this->post['p']:1;
        @$name = $this->post['name'];
        if($name){
            $count = User::find()->where('name like "%'.$name.'%"')->count();
            $list = User::find()->where('name like "%'.$name.'%"')->offset(($p-1)*20)->limit(20)->all();
        }else{
            $count = User::find()->count();
            $list = User::find()->offset(($p-1)*20)->limit(20)->all();
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


}
