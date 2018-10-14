<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\ILoan;
use app\models\ISafe;
use app\models\ILoanLog;
use app\models\ISafeLog;

class FinanceController extends AController
{


    public function actionSafelist(){
        $p = @$this->post['p']?$this->post['p']:1;
        if(@$this->post['name']) {
            $count = ISafe::find()->where('name like "%' . $this->post['name'] . '%"')->count();
            $list = ISafe::find()->where('name like "%' . $this->post['name'] . '%"')->offset(($p - 1) * 20)->limit(20)->all();
        }else{
            $count = ISafe::find()->count();
            $list = ISafe::find()->offset(($p-1)*20)->limit(20)->all();
        }
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $tmp = $li->attributes;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionLoanlist(){
        $p = @$this->post['p']?$this->post['p']:1;
        if(@$this->post['name']) {
            $count = ILoan::find()->where('name like "%' . $this->post['name'] . '%"')->count();
            $list = ILoan::find()->where('name like "%' . $this->post['name'] . '%"')->offset(($p - 1) * 20)->limit(20)->all();
        }else{
            $count = ILoan::find()->count();
            $list = ILoan::find()->offset(($p-1)*20)->limit(20)->all();
        }
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $tmp = $li->attributes;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionLoancheck(){
        if(empty($this->post['id'])) return $this->json(402,'ID不能为空');
        $model = ILoan::findOne($this->post['id']);
        if($model){
            $model->is_deal = 1;
            $model->save();
            return $this->json();
        }else{
            return $this->json(402,'没有找到该贷款记录');
        }
    }

    public function actionLoanlog(){
        $model = new ILoanLog();
        $model->attributes = $this->post;
        $model->created = time();
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model);
        }
    }

    public function actionSafecheck(){
        if(empty($this->post['id'])) return $this->json(402,'ID不能为空');
        $model = ISafe::findOne($this->post['id']);
        if($model){
            $model->is_deal = 1;
            $model->save();
            return $this->json();
        }else{
            return $this->json(402,'没有找到该贷款记录');
        }
    }

    public function actionSafelog(){
        $model = new ISafeLog();
        $model->attributes = $this->post;
        $model->created = time();
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model);
        }
    }

}
