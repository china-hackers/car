<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\Brand;
use app\models\Business;
use app\models\IBuy;
use app\models\IBuyLog;
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

    public function actionImgdelete(){
        if(empty($this->post['img_id'])) return $this->json(404,'图片ID不能为空');
        $model = ProductImg::findOne($this->post['img_id']);
        if($model) $model->delete();
        return $this->json();
    }

    public function actionImg(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $list = ProductImg::find()->where('pid='.$this->post['id'])->all();
        //if(empty($list)) return $this->json(404,'没有找到该商品');
        $data = ['total'=>intval(count($list))];
        $l2 = [];
        if($list)
            foreach($list as $li){
                $tmp = $li->attributes;
                $l2[] = $tmp;
            }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionTaxsave(){
        $model = ProductTax::find()->where('pid='.$this->post['id'])->one();
        if ($model) {
        }else{
            $model = new ProductTax();
        }
        @$this->post['pid'] = $this->post['id'];
        unset($this->post['id']);
        $model->attributes = $this->post;
        $product = Product::findOne($this->post['pid']);
        $product->shoufu = $model->shoufu;
        $product->yuegong = $model->yuegong;
        $product->save();
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model,402);
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
        $model = ProductTyre::find()->where('pid='.$this->post['id'])->one();
        if ($model) {
        }else{
            $model = new ProductTyre();
        }
        @$this->post['pid'] = $this->post['id'];
        unset($this->post['id']);
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model,402);
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
        $model = ProductUnder::find()->where('pid='.$this->post['id'])->one();
        if ($model) {
        }else{
            $model = new ProductUnder();
        }
        @$this->post['pid'] = $this->post['id'];
        unset($this->post['id']);
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model,402);
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
        $model = ProductEngine::find()->where('pid='.$this->post['id'])->one();
        if ($model) {
        }else{
            $model = new ProductEngine();
        }
        @$this->post['pid'] = $this->post['id'];
        unset($this->post['id']);
        $model->attributes = $this->post;
        $product = Product::findOne($this->post['pid']);
        $product->displacement = $model->displacement;
        $product->air_in = $model->air_in;
        $product->save();
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model,402);
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
        $model = ProductInfo::find()->where('pid='.$this->post['id'])->one();
        if ($model) {

        }else{
            $model = new ProductInfo();
        }
        @$this->post['pid'] = $this->post['id'];
        unset($this->post['id']);
        $model->attributes = $this->post;
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model,402);
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
        $model = ProductBase::find()->where('pid='.$this->post['id'])->one();
        if ($model) {
        }else{
            $model = new ProductBase();
        }
        @$this->post['pid'] = $this->post['id'];
        unset($this->post['id']);
        $model->attributes = $this->post;
        $product = Product::findOne($this->post['pid']);
        $product->gear_box = $model->gear_box;
        $product->save();
        if($model->save()){
            return $this->json();
        }else{
            return $this->error($model,402);
        }
    }

    public function actionBase(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductBase::find()->where('pid='.$this->post['id'])->one();
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
        @$car = Brand::findOne($model->car_id);
        @$model->brand = $car->brand;
        if($model->save()){
            $this->data['data']['id'] = $model->id;
            return $this->json();
        }else{
            return $this->error($model,$code);
        }
    }

    public function actionProduct(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = Product::findOne($this->post['id']);
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        $this->data['data']['business'] = $model->business->name;
        $this->data['data']['user'] = $model->user->name;
        $car = $model->car;
        $tmp = [$car->letter,$car->brand,$car->id];
        $this->data['data']['car'] = $tmp;
        $city = $model->city;
        $tmp = [$city->parent_id,$city->id];
        $this->data['data']['city'] = $tmp;
        return $this->json();
    }

    public function actionClose(){
        $model = Product::findOne($this->post['id']);
        $model->state = 1;
        $model->save();
        $list = IBuy::find()->where('pid='.$model->id.' AND is_deal=0')->all();
        if($list){
            foreach($list as $b){
                $b->is_deal = 2;
                $b->save();
                $tmp = new IBuyLog();
                $tmp->addLog($b->id,'该商品已被车商设置为已售');
            }
        }
        return $this->json();
    }

    public function actionCheck(){
        $model = Product::findOne($this->post['id']);
        $model->state = 0;
        $model->save();
        return $this->json();
    }

    public function actionDelete(){
        $model = Product::findOne($this->post['id']);
        $count = Ibuy::find()->where('pid='.$model->id)->count();
        if($count){
            return $this->json(404,'已经有人咨询价格了，不允许删除');
        }else{
            $model->delete();
            return $this->json();
        }
    }

    public function actionList(){
        $p = @intval($this->post['p'])?$this->post['p']:1;
        $where = '1=1';
        if(@$this->post['letter']) $where .= ' AND letter="'.$this->post['letter'].'"';
        if(@$this->post['brand']) $where .= ' AND brand="'.$this->post['brand'].'"';
        if(@$this->post['car_id']) $where .= ' AND id="'.$this->post['car_id'].'"';
        $list = Brand::find()->where($where)->all();
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
            if(@$this->post['business_name']){
                $list = Business::find()->where('name like "%'.$this->post['business_name'].'%"')->all();
                if($list){
                    $bid = [];
                    foreach($list as $li){
                        $bid[] = $li->id;
                    }
                    $bid = implode(',',$bid);
                    $where = 'business_id in ('.$bid.')';
                }else{
                    $where = '1=0';
                }
            }else{
                $where = '1=1';
            }
            if(@$this->post['price_from']) $where .= ' AND price>='.$this->post['price_from'];
            if(@$this->post['price_to']) $where .= ' AND price<='.$this->post['price_to'];
            $count = Product::find()->where($where.$ids)->count();
            $list = Product::find()->where($where.$ids)->offset(($p-1)*20)->limit(20)->all();
        }
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $tmp = $li->attributes;
            $tmp['city'] = empty($li->city->name)?'':$li->city->name;
            $tmp['business_name'] = $li->business->name;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

}
