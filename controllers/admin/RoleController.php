<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\AdminPermission;
use app\models\AdminR2P;
use app\models\AdminRole;

class RoleController extends AController
{

    public function actionDelete(){
        if(empty($this->post['id'])) return $this->json(403,'角色ID不能为空');
        $model = AdminRole::find($this->post['id'])->one();
        if(empty($model)) return $this->json(403,'该角色不存在');
        $count = Admin::find()->where('role_id='.$model->id)->count();
        if($count) return $this->json(403,'该角色还有管理员，请先删除管理员');
        $model->delete();
        return $this->json();
    }

    public function actionList()
    {
        $list = AdminRole::find()->all();
        $data = [];
        foreach($list as $li){
            $data[] = $li->attributes;
        }
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionAdd()
    {
        if(empty($this->post['permission'])) return $this->json(401,'没有勾选任何权限');
        $model = new AdminRole();
        $model['role'] = $this->post['role'];
        $model['note'] = $this->post['note'];
        if($model->save()) {
            $list = $this->post['permission'];
            foreach($list as $pid){
                $r2p = new AdminR2P();
                if(AdminPermission::find($pid)->one()){
                    $r2p->role_id = $model->id;
                    $r2p->menu_id = $pid;
                    $r2p->save();
                }
            }
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
        if(empty($this->post['id'])) return $this->json(402,'角色ID不能为空');
        $model = AdminRole::find($this->post['id'])->one();
        if(empty($model)) return $this->json(402,'该角色不存在');
        $model['role'] = $this->post['role'];
        $model['note'] = $this->post['note'];
        if($model->save()) {
            $list = $this->post['permission'];
            AdminR2P::deleteAll('role_id='.$model->id);
            foreach($list as $pid){
                $r2p = new AdminR2P();
                if(AdminPermission::find($pid)->one()){
                    $r2p->role_id = $model->id;
                    $r2p->menu_id = $pid;
                    $r2p->save();
                }
            }
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
