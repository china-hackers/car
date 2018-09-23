<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\AdminPermission;
use app\models\AdminR2P;
use app\models\AdminRole;

class PermissionController extends AController
{

    public function actionDelete(){
        if(empty($this->post['id'])) return $this->json(403,'权限ID不能为空');
        $model = AdminRole::find($this->post['id'])->one();
        if(empty($model)) return $this->json(403,'该权限不存在');
        $model->delete();
        return $this->json();
    }

    public function actionList()
    {
        $p = intval($this->post['p'])?$this->post['p']:1;
        $count = AdminPermission::find()->count();
        $list = AdminPermission::find()->offset(($p-1)*20)->limit(20)->all();
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $l2[] = $li->attributes;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionAdd()
    {
        $model = new AdminPermission();
        $model->attributes = $this->post;
        if($model->save()) {
            return $this->json();
        }else{
            $list = $model->getFirstErrors();
            $msg = '';
            foreach($list as $key=>$value){
                $msg .= $value;
            }
            return $this->json(401,$msg);
        }
    }

    public function actionEdit(){
        if(empty($this->post['id'])) return $this->json(402,'权限ID不能为空');
        $model = AdminPermission::find($this->post['id'])->one();
        if(empty($model)) return $this->json(402,'该权限不存在');
        $model->attributes = $this->post;
        if($model->save()) {
            return $this->json();
        }else{
            $list = $model->getFirstErrors();
            $msg = '';
            foreach($list as $key=>$value){
                $msg .= $value;
            }
            return $this->json(402,$msg);
        }
    }

}
