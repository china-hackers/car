<?php

namespace app\controllers\mobile;

use app\controllers\base\BaseController;
use app\models\UploadModel;
use yii\web\UploadedFile;
use yii;
use abei2017\wx\Application;

class SiteController extends BaseController
{


    public function actionSafeimg(){
        $this->layout = false;
        $model = new UploadModel();
        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstances($model, 'image');
            $path = $model->upload('safe');
            if ($path) {
                $this->data['data'][] = $path;
                return $this->json();
            }else{
                return $this->json(401,'上传图片失败');
            }
        }else{
            return $this->json(401,'未提交内容');
        }
    }

    public function actionLogin(){
        $this->layout = false;
        return $this->render('login');
    }

    public function actionIndex()
    {
        $this->layout = false;
        if(YII_DEBUG)
            return $this->render('index');
        
        if(Yii::$app->session->get('uid')){
            return $this->render('index');
        }else{
            $oauth = (new Application())->driver('mp.oauth');
            $oauth->send();
            die();
        }
    }
}
