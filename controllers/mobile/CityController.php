<?php
/**
 * Created by PhpStorm.
 * User: Leonidax
 * Date: 2018/10/8
 * Time: 下午11:00
 */

namespace app\controllers\mobile;

use app\models\City;
use app\controllers\base\MController;

class CityController extends MController{
    public function actionCity(){
        if(empty($this->post['id'])) return $this->json(404,'城市ID不能为空');
        $model = City::findOne($this->post['id']);
        if(empty($model))return $this->json(404,'没有找到该城市');
        $this->data['data'] = $model->attributes;
        return $this->json();
    }

    public function actionList(){
        $id = $this->post['id'];
        if($id)
            $list = City::find()->where('parent_id='.$id)->all();
        else
            $list = City::find()->where('parent_id=0')->all();
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

    public function actionCities(){
        $cache = \Yii::$app->cache;
        if($cache->exists('city')){
            $data = $cache->get('city');
        }else {
            $data = [];
            $list = City::find()->where('parent_id=0')->all();
            foreach ($list as $li) {
                $d1 = ['value' => '', 'label' => ''];
                $d1['value'] = $li->id;
                $d1['label'] = $li->name;
                $list2 = City::find()->where('parent_id=' . $li->id)->all();
                $child = [];
                foreach ($list2 as $l2) {
                    $d2 = [];
                    $d2['value'] = $l2->id;
                    $d2['label'] = $l2->name;
                    $child[] = $d2;
                }
                if ($child) $d1['children'] = $child;
                $data[] = $d1;
            }
            $cache->add('city',$data);
        }
        $this->data['data']=$data;
        return $this->json();
    }
}