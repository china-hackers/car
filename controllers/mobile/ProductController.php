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
use app\models\Business;
use app\models\Product;
use app\models\ProductBase;
use app\models\ProductEngine;
use app\models\ProductImg;
use app\models\ProductInfo;
use app\models\ProductTax;
use app\models\ProductTyre;
use app\models\ProductUnder;
use app\models\User;
use app\models\UserBusiness;
use app\models\UserStore;

class ProductController extends MController{

    public function actionImgdelete(){
        if(empty($this->post['img_id'])) return $this->json(404,'图片ID不能为空');
        $model = ProductImg::findOne($this->post['img_id']);
        if($model) $model->delete();
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

    public function actionProductsave()
    {
        $this->checkUser();
        if (@$this->post['id']) {
            $code = 402;
            $model = Product::findOne($this->post['id']);
        }else{
            $code = 401;
            $model = new Product();
        }
        $model->attributes = $this->post;
        $model->user_id = $this->uid;
        $ub = UserBusiness::find()->where('uid='.$this->uid)->one();
        if(!$ub){
            return $this->json(404,'您还没有申请成为车商');
        }elseif($ub->is_checked==0){
            return $this->json(404,'您申请成为车商还未通过审核');
        }
        $model->business_id = $ub->business_id;
        @$car = Brand::findOne($model->car_id);
        @$model->brand = $car->brand;
        if($model->save()){
            if($code==401){
                $model = new ProductBase();
                $model->pid = $model->id;
                $model->save();
                $model = new ProductEngine();
                $model->pid = $model->id;
                $model->save();
                $model = new ProductInfo();
                $model->pid = $model->id;
                $model->save();
                $model = new ProductTax();
                $model->pid = $model->id;
                $model->save();
                $model = new ProductTyre();
                $model->pid = $model->id;
                $model->save();
                $model = new ProductUnder();
                $model->pid = $model->id;
                $model->save();
            }
            $this->data['data']['id'] = $model->id;
            return $this->json();
        }else{
            return $this->error($model,$code);
        }
    }

    public function actionStore(){
        $this->checkUser();
        if(empty($this->post['pid'])) return $this->json(404,'商品ID不能为空');
        $store = @$this->post['store'];
        $pid = $this->post['pid'];
        $this->data['data']['store'] = UserStore::store($store,$this->uid,$pid);
        return $this->json();
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

    public function actionBusiness(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = Product::findOne($this->post['id']);
        if(!$model)return $this->json(404,'没有找到该商品');
        $business = Business::findOne($model->business_id);
        $this->data['data'] = $business->attributes;
        return $this->json();
    }

    public function actionKoubei(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = Product::findOne($this->post['id']);
        if(!$model)return $this->json(404,'没有找到该商品');
        $car = Brand::findOne($model->car_id);
        $this->data['data']['keywords'] = explode("|",$car->keywords);
        $this->data['data']['star'] = $car->star;
        return $this->json();
    }

    public function actionTax(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductTax::find()->where('pid='.$this->post['id'])->one();
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        unset($this->data['data']['id']);
        return $this->json();
    }

    public function actionTyre(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductTyre::find()->where('pid='.$this->post['id'])->one();
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        unset($this->data['data']['id']);
        return $this->json();
    }

    public function actionUnder(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductUnder::find()->where('pid='.$this->post['id'])->one();
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        unset($this->data['data']['id']);
        return $this->json();
    }

    public function actionEngine(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductEngine::find()->where('pid='.$this->post['id'])->one();
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        unset($this->data['data']['id']);
        return $this->json();
    }

    public function actionInfo(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductInfo::find()->where('pid='.$this->post['id'])->one();
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        unset($this->data['data']['id']);
        return $this->json();
    }

    public function actionBase(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = ProductBase::find()->where('pid='.$this->post['id'])->one();
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        unset($this->data['data']['id']);
        return $this->json();
    }

    public function actionProduct(){
        if(empty($this->post['id'])) return $this->json(404,'商品ID不能为空');
        $model = Product::findOne($this->post['id']);
        if(empty($model)) return $this->json(404,'没有找到该商品');
        $this->data['data'] = $model->attributes;
        $business = $model->business;
        $this->data['data']['business'] = $business->name;
        $count = Product::find()->where('business_id='.$business->id)->count();
        $this->data['data']['business_cars'] = $count;
        $this->data['data']['user'] = $model->user->name;
        $this->data['data']['user_phone'] = $model->user->phone;
        $car = $model->car;
        $tmp = [$car->letter,$car->brand,$car->id];
        $this->data['data']['car'] = $tmp;
        $city = $model->city;
        $tmp = [$city->parent_id,$city->id];
        $this->data['data']['city'] = $tmp;
        $count = Product::find()->where('business_id='.$model->business_id)->count();
        $this->data['data']['cars_count'] = $count;
        return $this->json();
    }

    public function actionList(){
        $p = @intval($this->post['p'])?$this->post['p']:1;
        $order = @$this->post['order']?$this->post['order']:'id DESC';
        if(@$this->post['itype']) $where = 'itype="'.$this->post['itype'].'"';
        else{
            $where = 'itype="i尊车"';
            if(@$this->post['sort']){
                $this->checkUser();
                $model = User::findOne($this->uid);
                if(@$model->itype)
                    $itype = $model->itype;
                else
                    $itype = 'i尊车';
                $where = 'itype="'.$itype.'"';
            }elseif(@$this->post['store']){
                $this->checkUser();
                $data = UserStore::find()->where('uid='.$this->uid)->all();
                if($data){
                    $pid = [];
                    foreach($data as $d){
                        $pid[] = $d->pid;
                    }
                    $where = 'id in ('.implode(',',$pid).') ';
                }else{
                    $where = 'id=0 ';
                }
            }
        }
        if(@$this->post['pid']) $where = 'id='.intval($this->post['pid']); //单独返回1条数据
        if(@$this->post['brand']) $where .= ' AND brand="'.$this->post['brand'].'"';
        if(@$this->post['price_from']) $where .= ' AND price>='.$this->post['price_from'];
        if(@$this->post['price_to']) $where .= ' AND price<='.$this->post['price_to'];
        if(@$this->post['yuegong_from']) $where .= ' AND yuegong>='.$this->post['yuegong_from'];
        if(@$this->post['yuegong_to']) $where .= ' AND yuegong<='.$this->post['yuegong_to'];
        if(@$this->post['shoufu_from']) $where .= ' AND shoufu>='.$this->post['shoufu_from'];
        if(@$this->post['shoufu_to']) $where .= ' AND shoufu<='.$this->post['shoufu_to'];
        if(@$this->post['displacement_from']) $where .= ' AND displacement>='.$this->post['displacement_from'];
        if(@$this->post['displacement_to']) $where .= ' AND displacement<='.$this->post['displacement_to'];
        if(@$this->post['gear_box']) $where .= ' AND gear_box="'.$this->post['gear_box'].'"';
        if(@$this->post['air_in']) $where .= ' AND air_in="'.$this->post['air_in'].'"';
        if(@$this->post['gear_box']) $where .= ' AND gear_box="'.$this->post['gear_box'].'"';
        if(@$this->post['title']) $where .= ' AND title like "%'.$this->post['title'].'%"';
        $where .= ' AND state=0';
        $count = Product::find()->where($where)->count();
        $list = Product::find()->where($where)->orderBy($order)->offset(($p-1)*20)->limit(20)->all();
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $tmp = $li->attributes;
            $seconds = time()-strtotime($li->reg_date);
            $tmp['years'] = ceil(($seconds/86400)/365);
            if(!$li->reg_date) $tmp['years'] = 0;
            $tmp['img'] = empty($li->productImg)?'':@$li->productImg->img;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }
}