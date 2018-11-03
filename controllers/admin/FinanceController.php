<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\IBuy;
use app\models\IBuyLog;
use app\models\ILoan;
use app\models\ISafe;
use app\models\ILoanLog;
use app\models\ISafeLog;
use app\models\User;
use app\models\UserBusiness;

class FinanceController extends AController
{
    public function actionSaler2user(){
        /**
         * 客户第一次提交需要一键指定销售
         * 客户第二次一键指定就应该指定上一次的销售
         * IBuy表中的销售也应该同步更新，第二次提交申请的时候，表中的销售ID就自动设置好
         */
        if(empty($this->post['id'])) return $this->json(402,'ID不能为空');
        $model = IBuy::findOne($this->post['id']);
        if($model->saler_id)
            $is_new = false;
        else
            $is_new = true;
        $user = User::findOne($model->uid);
        if($user->uid){
            $saler_id = $user->uid;
        }else{
            $saler = UserBusiness::find()->where('is_checked=1')->orderBy('users asc')->one();
            $saler_id = $saler->uid;
            $user->uid = $saler->uid;
            $user->save();
        }
        $model->saler_id = $saler_id;
        $model->save();
        if($is_new){//防止重复提交计数累加
            if(@!$saler) $saler = UserBusiness::find()->where('uid='.$saler_id)->one();
            $saler->users = $saler->users + 1;
            $saler->save();
        }
        return $this->json();
    }

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
            $model->attributes = $this->post;
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

    public function actionLoanstate(){
        if(empty($this->post['id'])) return $this->json(402,'ID不能为空');
        $model = ILoan::findOne($this->post['id']);
        if(!$model) return $this->json(402,'没有找到该车贷');
        if($model->state==4) return $this->json(402,'该贷款已成交，无法再变更');
        $log = new ILoanLog();
        $log->addLog($this->post['id'],'系统备注：变更状态:'.$model->state.'->'.$this->post['state']);

        $model->state = intval($this->post['state']);
        $model->save();
        return $this->json();
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

    public function actionBuycheck(){
        if(empty($this->post['id'])) return $this->json(402,'ID不能为空');
        $model = IBuy::findOne($this->post['id']);
        if($model){
            $model->is_deal = 1;
            $model->save();
            return $this->json();
        }else{
            return $this->json(402,'没有找到该记录');
        }
    }

    public function actionBuylog(){
        $model = new IBuyLog();
        $model->attributes = $this->post;
        $model->created = time();
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model);
        }
    }

    public function actionBuylist(){
        $p = @$this->post['p']?$this->post['p']:1;
        if(@$this->post['name']) {
            $count = IBuy::find()->where('name like "%' . $this->post['name'] . '%"')->count();
            $list = IBuy::find()->where('name like "%' . $this->post['name'] . '%"')->offset(($p - 1) * 20)->limit(20)->all();
        }else{
            $count = IBuy::find()->count();
            $list = IBuy::find()->offset(($p-1)*20)->limit(20)->all();
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

}
