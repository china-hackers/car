<?php
/**
 * Created by PhpStorm.
 * User: Leonidax
 * Date: 2018/10/8
 * Time: 下午11:00
 */

namespace app\controllers\mobile;

use app\models\ILoan;
use app\models\ILoanLog;
use app\models\ISafe;
use app\controllers\base\MController;
use app\models\ISafeLog;

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

    public function actionSafeadd(){
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
}