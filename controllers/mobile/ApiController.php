<?php

namespace app\controllers\mobile;

use yii\web\Controller;

class ApiController extends Controller
{

    public function actionWeixin(){
        $this->layout = false;
        echo $_GET['echostr'];
    }
}
