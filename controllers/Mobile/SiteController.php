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
            $model->images = UploadedFile::getInstances($model, 'images');
            $list = $model->upload('safe');
            if (count($list)) {
                $this->data['data'] = $list[0];
                return $this->json();
            }else{
                return $this->json(401,'上传图片失败');
            }
        }
    }

    public function actionIndex()
    {
        $this->layout = false;
        return $this->render('index');
    }
}
