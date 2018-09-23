<?php
/**
 * Created by PhpStorm.
 * User: Leonidax
 * Date: 2018/9/23
 * Time: 下午5:31
 */

namespace app\controllers\admin;

use yii\web\Controller;

class LoginController extends Controller{
    public function actionIndex(){
        $this->layout = false;
        return $this->render('index');
    }
}