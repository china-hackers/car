<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\Brand;
use app\models\Product;

class ProductController extends AController
{

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
            //$tmp['role_name'] = $li->role->role;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

}
