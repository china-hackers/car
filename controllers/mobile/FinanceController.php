<?php
/**
 * Created by PhpStorm.
 * User: Leonidax
 * Date: 2018/10/8
 * Time: 下午11:00
 */

namespace app\controllers\mobile;

use app\models\ILoan;
use app\models\ISafe;
use app\controllers\base\MController;

class FinanceController extends MController{

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
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model);
        }
    }

    public function actionSafeadd(){
        $model = new ISafe();
        $model->attributes = $this->post;
        $model->uid = $this->uid;
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model);
        }
    }
}