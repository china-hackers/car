<?php

namespace app\controllers\admin;


use app\controllers\base\BaseController;
use app\models\Admin;
use app\models\ILoanImg;
use app\models\ProductImg;
use app\models\UploadModel;
use yii\web\UploadedFile;
use Yii;

class SiteController extends BaseController
{

    public function actionSafeimg(){
        $this->layout = false;
        $model = new UploadModel();
        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            $path = $model->upload('safe');
            if ($path) {
                $this->data['data'][] = $path;
                return $this->json();
            }else{
                return $this->json(401,'文件过大，不能超过10MB');
            }
        }else{
            return $this->json(401,'未提交内容');
        }
    }

    public function actionLoanimg(){
        $this->layout = false;
        $model = new UploadModel();
        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            $path = $model->upload('loan');
            if ($path) {
                $this->data['data'][] = $path;
                return $this->json();
            }else{
                return $this->json(401,'文件过大，不能超过10MB');
            }
        }else{
            return $this->json(401,'未提交内容');
        }
    }

    public function actionRecommandimg(){
        $this->layout = false;
        $model = new UploadModel();
        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            $path = $model->upload('recommand');
            if ($path) {
                $this->data['data'][] = $path;
                return $this->json();
            }else{
                return $this->json(401,'文件过大，不能超过10MB');
            }
        }else{
            return $this->json(401,'未提交内容');
        }
    }

    public function actionBannerimg(){
        $this->layout = false;
        $model = new UploadModel();
        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            $path = $model->upload('banner');
            if ($path) {
                $this->data['data'][] = $path;
                return $this->json();
            }else{
                return $this->json(401,'文件过大，不能超过10MB');
            }
        }else{
            return $this->json(401,'未提交内容');
        }
    }

    public function actionProductimg(){
        $this->layout = false;
        $model = new UploadModel();
        if (Yii::$app->request->isPost) {
            $model->images = UploadedFile::getInstances($model, 'images');
            $list = $model->uploads();
            $data = [];
            if (count($list)) {
                foreach($list as $li){
                    $img = new ProductImg();
                    $img->pid = $_POST['id'];
                    $img->img = $li;
                    $img->save();
                    $data[] = [intval($img->id) , $li];
                }
                $this->data['data'] = $data;
                return $this->json();
            }else{
                return $this->json(401,'文件过大，不能超过10MB');
            }
        }
    }

    public function actionIndex(){
        $this->layout = false;
        if(!Yii::$app->session->get('admin'))
            return $this->redirect('/admin/site/login');
        return $this->render('index');
    }

    public function actionLogin(){
        $this->layout = false;
        $json_str = file_get_contents('php://input');
        if(empty($json_str)) return $this->render('login');
        $this->post = json_decode($json_str,true);
        $model = Admin::login($this->post);
        if($model){
            Yii::$app->session->set('admin',$model->admin);
            return $this->json();
        }else{
            return $this->json(301);
        }
    }

    public function actionLogout(){
        Yii::$app->session->close();
        Yii::$app->session->destroy();
        return $this->redirect('/admin/login');
    }
}
