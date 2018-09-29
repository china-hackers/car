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
            $list = Brand::find()->select('id,letter,brand')->where('letter="'.$letter.'"')->groupBy('brand')->all();
        }else{
            $list = Brand::find()->select('id,letter,brand')->groupBy('brand')->orderBy('id asc')->all();
        }
        $count = count($list);
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $l2[] = array_filter($li->attributes);
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionModellist(){
        if(empty($this->post['brand'])) return $this->json(404,'没有传递品牌ID');
        $brand = $this->post['brand'];
        $list = Brand::find()->select('id,model')->where('brand="'.$brand.'"')->all();
        $count = count($list);
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $l2[] = array_filter($li->attributes);
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

}
