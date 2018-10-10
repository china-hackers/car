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
use app\models\User;
use app\controllers\base\MController;

class FinanceController extends MController{

    public function actionLoanadd(){
        $model = new ILoan();
        $model->attributes = $this->post;
        $model->uid = $this->uid;
        $user = User::findOne($this->uid);
        $model->rid = $user->rid;
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