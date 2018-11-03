<?php
/**
 * Created by PhpStorm.
 * User: Leonidax
 * Date: 2018/10/8
 * Time: 下午11:00
 */

namespace app\controllers\mobile;


use app\controllers\base\MController;
use app\models\Banner;
use app\models\WebSetting;

class BannerController extends MController{

    public function actionRecommand(){
        $model = WebSetting::find()->where('k="RECOMMAND"')->one();
        $this->data['data'] = json_decode($model->v);
        return $this->json();
    }

    public function actionList(){
        $list = Banner::find()->where('outdate>'.time())->all();
        $data = ['total'=>count($list)];
        $l2 = [];
        foreach($list as $li){
            $tmp = $li->attributes;
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

}