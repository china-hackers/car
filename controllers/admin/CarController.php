<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\Brand;

class CarController extends AController
{

    public function actionAdd(){
        $model = new Brand();
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            $list = $model->getFirstErrors();
            $msg = '';
            foreach($list as $key=>$value){
                $msg .= $value;
            }
            return $this->json(401,$msg);
        }
    }

    public function actionCar(){
        $model = Brand::findOne($this->post['id']);
        if(!$model) return $this->json(404,'没有找到该车型');
        $this->data['data'] = $model->attributes;
        $key = explode('|',$model->keywords);
        $this->data['data']['keywords'] = $key;
        return $this->json();
    }

    public function actionEdit(){
        $model = Brand::findOne($this->post['id']);
        if(!$model) return $this->json(404,'没有找到该车型');
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            $list = $model->getFirstErrors();
            $msg = '';
            foreach($list as $key=>$value){
                $msg .= $value;
            }
            return $this->json(402,$msg);
        }
    }

    public function actionDelete(){
        $model = Brand::findOne($this->post['id']);
        if(!$model) return $this->json(404,'没有找到该车型');
        $model->delete();
        return $this->json();
    }

    public function actionLetterlist(){
        $list = Brand::find()->groupBy('letter')->all();
        $count = count($list);
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $l2[] = $li->letter;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionBrandlist(){
        @$letter = $this->post['letter'];
        if($letter){
            $list = Brand::find()->where('letter="'.$letter.'"')->groupBy('brand')->all();
        }else{
            $list = Brand::find()->groupBy('brand')->orderBy('id asc')->all();
        }
        $count = count($list);
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $l2[] = ($li->attributes);
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionModellist(){
        if(empty($this->post['brand'])) return $this->json(404,'没有传递品牌ID');
        $brand = $this->post['brand'];
        $list = Brand::find()->where('brand="'.$brand.'"')->all();
        $count = count($list);
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $l2[] = ($li->attributes);
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

}
