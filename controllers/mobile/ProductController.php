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
use app\models\Product;

class ProductController extends MController{


    public function actionList(){
        $p = @intval($this->post['p'])?$this->post['p']:1;
        $order = @$this->post['order']?$this->post['order']:'id DESC';
        if(@$this->post['itype']) $where = 'itype="'.$this->post['itype'].'"';
        else $where = 'itype="i尊车"';
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
        $count = Product::find()->where($where)->count();
        $list = Product::find()->where($where)->orderBy($order)->offset(($p-1)*20)->limit(20)->all();
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $tmp = $li->attributes;
            $tmp['img'] = empty($li->city->name)?'':@$li->productImg->img;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }
}