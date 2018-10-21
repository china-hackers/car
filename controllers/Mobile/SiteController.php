<?php

namespace app\controllers\mobile;

use app\controllers\base\BaseController;
use app\models\UploadModel;
use yii\web\UploadedFile;
use yii;

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
        $this->checkOauth();
        return $this->render('index');
    }
}
