<?php
/**
 * Created by PhpStorm.
 * User: Leonidax
 * Date: 2018/10/8
 * Time: 下午11:00
 */

namespace app\controllers\mobile;

use app\models\IBuy;
use app\models\IBuyLog;
use app\models\ILoan;
use app\models\ILoanLog;
use app\models\ISafe;
use app\controllers\base\MController;
use app\models\ISafeLog;
use app\models\Product;
use app\models\User;

class FinanceController extends MController{


    public function actionSafe(){
        if(empty($this->post['id'])) return $this->json(404,'ID不能为空');
        $model = ISafe::findOne($this->post['id']);
        if(!$model) return $this->json(404,'没有找到该车险');
        $this->data['data'] = $model->attributes;
        return $this->json();
    }

    public function actionSafelogs(){
        if(empty($this->post['id'])) return $this->json(404,'ID不能为空');
        $id = $this->post['id'];
        $list = ISafeLog::find()->where('sid = '.$id)->all();
        $count = count($list);
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

    public function actionSafeadd(){
        $this->checkUser();
        $model = new ISafe();
        $model->attributes = $this->post;
        $model->created = time();
        $model->uid = $this->uid;
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model);
        }
    }


    public function actionLoanlogs(){
        if(empty($this->post['id'])) return $this->json(404,'ID不能为空');
        $id = $this->post['id'];
        $list = ILoanLog::find()->where('lid = '.$id)->all();
        $count = count($list);
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

    public function actionLoan(){
        if(empty($this->post['id'])) return $this->json(404,'ID不能为空');
        $model = ILoan::findOne($this->post['id']);
        if(!$model) return $this->json(404,'没有找到该车贷');
        $this->data['data'] = $model->attributes;
        return $this->json();
    }

    public function actionLoanadd(){
        $this->checkUser();
        $model = new ILoan();
        $model->attributes = $this->post;
        $model->created = time();
        $model->uid = $this->uid;
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model);
        }
    }

    public function actionBuycheck(){
        $id = $this->post['id'];
        $check = $this->post['check'];
        $buy = IBuy::findOne($id);
        if($check==1){//成交
            $buy->price = @$this->post['price'];
            $buy->pid2 = @$this->post['pid'];
            $buy->is_deal = 2;
            $buy->save();
            //下架产品
            //if(@$this->post['pid'])Product::updateAll(['state'=>1],['id'=>$buy->pid2]);
            //增加日志
            IBuyLog::addLog($id,'成交！');
        }else{//失效
            $buy->is_deal = 2;
            $buy->save();
            //增加日志
            IBuyLog::addLog($id,'失效！');
        }
        return $this->json();
    }


    public function actionBuylogs(){
        if(empty($this->post['id'])) return $this->json(404,'ID不能为空');
        $id = $this->post['id'];
        $list = IBuyLog::find()->where('bid = '.$id)->all();
        $count = count($list);
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

    public function actionBuy(){
        if(empty($this->post['id'])) return $this->json(404,'ID不能为空');
        $model = IBuy::findOne($this->post['id']);
        if(!$model) return $this->json(404,'没有找到该记录');
        $this->data['data'] = $model->attributes;
        return $this->json();
    }

    public function actionBuyadd(){
        $this->checkUser();
        $model = new IBuy();
        $product = Product::findOne($this->post['pid']);
        $model->attributes = $this->post;
        $model->created = time();
        $model->uid = $this->uid;
        $model->bid = $product->business_id;
        $user = User::findOne($this->uid);
        if($user->uid)
            $model->saler_id = $user->uid;
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model);
        }
    }
}