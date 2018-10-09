<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\Brand;

class CarController extends AController
{

    public function actionAdd(){
        $model = new Brand();
        $model->attributes = $this->post;
        $keyword = implode("|",$this->post['keywords']);
        $model->keywords = $keyword;
        if($model->save()){
            $cache = \Yii::$app->cache;
            $cache->delete('car');
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
        if(empty($model->keywords))
            $key = [];
        else
            $key = explode('|',$model->keywords);
        $this->data['data']['keywords'] = $key;
        return $this->json();
    }

    public function actionEdit(){
        $model = Brand::findOne($this->post['id']);
        if(!$model) return $this->json(404,'没有找到该车型');
        $model->attributes = $this->post;
        if($model->save()){
            $cache = \Yii::$app->cache;
            $cache->delete('car');
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
            $tmp = ($li->attributes);
            if(empty($li->keywords))
                $key = [];
            else
                $key = explode('|',$tmp['keywords']);
            $tmp['keywords'] = $key;
            $l2[] = $tmp;
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
            $tmp = ($li->attributes);
            if(empty($li->keywords))
                $key = [];
            else
                $key = explode('|',$tmp['keywords']);
            $tmp['keywords'] = $key;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionCars(){
        $cache = \Yii::$app->cache;
        $cache->delete('cars');
        if($cache->exists('cars')){
            $data = $cache->get('cars');
        }else {
            $data = [];
            $list = Brand::find()->groupBy('letter')->all();
            foreach ($list as $li) {
                $d1 = ['value' => '', 'label' => ''];
                $d1['value'] = $li->letter;
                $d1['label'] = $li->letter;
                $list2 = Brand::find()->where('letter="' . $li->letter . '"')->groupBy('brand')->all();
                $child = [];
                $data2 = [];
                foreach ($list2 as $l2) {
                    $d2 = [];
                    $d2['value'] = $l2->brand;
                    $d2['label'] = $l2->brand;
                    $child[] = $d2;
                    $list3 = Brand::find()->where('brand="' . $l2->brand . '"')->all();
                    $child2 = [];
                    foreach ($list3 as $l3) {
                        $d3 = [];
                        $d3['value'] = $l3->id;
                        $d3['label'] = $l3->model;
                        $child2[] = $d3;
                    }
                    if ($child2) $d2['children'] = $child2;
                    $data2[] = $d2;
                }
                if ($child) $d1['children'] = $data2;
                $data[] = $d1;
            }
            $cache->add('cars',$data);
        }
        $this->data['data']=$data;
        return $this->json();
    }

}
