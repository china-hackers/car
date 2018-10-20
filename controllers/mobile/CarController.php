<?php
/**
 * Created by PhpStorm.
 * User: Leonidax
 * Date: 2018/10/8
 * Time: 下午11:00
 */

namespace app\controllers\mobile;

use app\controllers\base\MController;
use app\models\Brand;

class CarController extends MController{


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
        $data = [];
        $list = Brand::find()->groupBy('letter')->all();
        foreach ($list as $li) {
            $d1 = [];
            $list2 = Brand::find()->where('letter="' . $li->letter . '"')->groupBy('brand')->all();
            $data2 = [];
            foreach ($list2 as $l2) {
                $data2[] = $l2->brand;
            }
            $d1['letter'] = $li->letter;
            $d1['list'] = $data2;
            $data[] = $d1;
        }
        $this->data['data']=$data;
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