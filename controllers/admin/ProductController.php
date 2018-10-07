<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\Brand;
use app\models\Product;
use app\models\ProductInfo;
use app\models\ProductBase;
use app\models\ProductEngine;
use app\models\ProductUnder;
use app\models\ProductTax;
use app\models\ProductTyre;
use app\models\ProductImg;

class ProductController extends AController
{
    public function actionImgsave(){
        if ($this->post['id']) {
            $code = 402;
            $model = ProductImg::find()->where('pid='.$this->post['id'])->one();
        }else{
            $code = 401;
            $model = new ProductImg();
        }
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            $list = $model->getFirstErrors();
            $msg = '';
            foreach($list as $key=>$value){
                $msg .= $value;
            }
            return $this->json($code,$msg);
        }
    }

    public function actionImg(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $list = ProductImg::find()->where('pid='.$this->post['id'])->all();
        if(empty($list)) return $this->json(404,'没有找到该商品');
        $data = ['total'=>intval(count($list))];
        $l2 = [];
        foreach($list as $li){
            $tmp = $li->attributes;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionTaxsave(){
        if ($this->post['id']) {
            $code = 402;
            $model = ProductTax::find()->where('pid='.$this->post['id'])->one();
        }else{
            $code = 401;
            $model = new ProductTax();
        }
        @$this->post['pid'] = $this->post['id'];
        unset($this->post['id']);
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            $list = $model->getFirstErrors();
            $msg = '';
            foreach($list as $key=>$value){
                $msg .= $value;
            }
            return $this->json($code,$msg);
        }
    }

    public function actionTax(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductTax::find()->where('pid='.$this->post['id'])->one();
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        unset($this->data['data']['id']);
        return $this->json();
    }

    public function actionTyresave(){
        if ($this->post['id']) {
            $code = 402;
            $model = ProductTyre::find()->where('pid='.$this->post['id'])->one();
        }else{
            $code = 401;
            $model = new ProductTyre();
        }
        @$this->post['pid'] = $this->post['id'];
        unset($this->post['id']);
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            $list = $model->getFirstErrors();
            $msg = '';
            foreach($list as $key=>$value){
                $msg .= $value;
            }
            return $this->json($code,$msg);
        }
    }

    public function actionTyre(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductTyre::find()->where('pid='.$this->post['id'])->one();
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        unset($this->data['data']['id']);
        return $this->json();
    }

    public function actionUndersave(){
        if ($this->post['id']) {
            $code = 402;
            $model = ProductUnder::find()->where('pid='.$this->post['id'])->one();
        }else{
            $code = 401;
            $model = new ProductUnder();
        }
        @$this->post['pid'] = $this->post['id'];
        unset($this->post['id']);
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            $list = $model->getFirstErrors();
            $msg = '';
            foreach($list as $key=>$value){
                $msg .= $value;
            }
            return $this->json($code,$msg);
        }
    }

    public function actionUnder(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductUnder::find()->where('pid='.$this->post['id'])->one();
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        unset($this->data['data']['id']);
        return $this->json();
    }

    public function actionEnginesave(){
        if ($this->post['id']) {
            $code = 402;
            $model = ProductEngine::find()->where('pid='.$this->post['id'])->one();
        }else{
            $code = 401;
            $model = new ProductEngine();
        }
        @$this->post['pid'] = $this->post['id'];
        unset($this->post['id']);
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            $list = $model->getFirstErrors();
            $msg = '';
            foreach($list as $key=>$value){
                $msg .= $value;
            }
            return $this->json($code,$msg);
        }
    }

    public function actionEngine(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductEngine::find()->where('pid='.$this->post['id'])->one();
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        unset($this->data['data']['id']);
        return $this->json();
    }

    public function actionInfosave(){
        if ($this->post['id']) {
            $code = 402;
            $model = ProductInfo::find()->where('pid='.$this->post['id'])->one();
        }else{
            $code = 401;
            $model = new ProductInfo();
        }
        @$this->post['pid'] = $this->post['id'];
        unset($this->post['id']);
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            $list = $model->getFirstErrors();
            $msg = '';
            foreach($list as $key=>$value){
                $msg .= $value;
            }
            return $this->json($code,$msg);
        }
    }

    public function actionInfo(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductInfo::find()->where('pid='.$this->post['id'])->one();
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        unset($this->data['data']['id']);
        return $this->json();
    }

    public function actionBasesave()
    {
        if ($this->post['id']) {
            $code = 402;
            $model = ProductBase::findOne($this->post['id']);
        }else{
            $code = 401;
            $model = new ProductBase();
        }
        @$this->post['pid'] = $this->post['id'];
        unset($this->post['id']);
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            $list = $model->getFirstErrors();
            $msg = '';
            foreach($list as $key=>$value){
                $msg .= $value;
            }
            return $this->json($code,$msg);
        }
    }

    public function actionBase(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductBase::findOne($this->post['id']);
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        unset($this->data['data']['id']);
        return $this->json();
    }

    public function actionProductsave()
    {
        if ($this->post['id']) {
            $code = 402;
            $model = Product::findOne($this->post['id']);
        }else{
            $code = 401;
            $model = new Product();
        }
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            $list = $model->getFirstErrors();
            $msg = '';
            foreach($list as $key=>$value){
                $msg .= $value;
            }
            return $this->json($code,$msg);
        }
    }

    public function actionProduct(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = Product::findOne($this->post['id']);
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        return $this->json();
    }

    public function actionList(){
        $p = @intval($this->post['p'])?$this->post['p']:1;
        $where = '1=1';
        if(@$this->post['letter']) $where .= ' AND letter="'.$this->post['letter'].'"';
        if(@$this->post['brand']) $where .= ' AND brand="'.$this->post['brand'].'"';
        if(@$this->post['car_id']) $where .= ' AND id="'.$this->post['car_id'].'"';
        $list = Brand::findAll($where);
        if(count($list)==0){
            $list = [];
            $count = 0;
        }else{
            if($where == '1=1'){
                $ids = '';
            }else{
                $id = [];
                foreach($list as $li){
                    $id[] = $li->id;
                }
                $ids = implode(',',$id);
                $ids = ' and car_id in ('.$ids.')';
            }
            $where = '1=1';
            if(@$this->post['price_from']) $where .= ' AND price>='.$this->post['price_from'];
            if(@$this->post['price_to']) $where .= ' AND price<='.$this->post['price_to'];
            $count = Product::find()->where($where.$ids)->count();
            $list = Product::find()->where($where.$ids)->offset(($p-1)*20)->limit(20)->all();
        }
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $tmp = $li->attributes;
            $tmp['city'] = empty($li->city->name)?'':$li->city->name;;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

}
