<?php

namespace app\controllers\admin;

use app\controllers\base\AController;
use app\models\Banner;
use app\models\WebSetting;

class BannerController extends AController
{

    public function actionRecommandsave(){
        $data = $this->post;
        $model = WebSetting::find()->where('k="RECOMMAND"')->one();
        $model->v = json_encode($data);
        $model->save();
        return $this->json();
    }

    public function actionDelete(){
        if(empty($this->post['id'])) return $this->json(403,'角色ID不能为空');
        $model = Banner::findOne($this->post['id']);
        if(empty($model)) return $this->json(403,'该记录不存在');
        $model->delete();
        return $this->json();
    }

    public function actionList()
    {
        $p = @intval($this->post['p'])?$this->post['p']:1;
        $count = Banner::find()->count();
        $list = Banner::find()->offset(($p-1)*20)->limit(20)->all();
        $data = ['total'=>intval($count)];
        $l2 = [];
        foreach($list as $li){
            $tmp = $li->attributes;
            $tmp['outdate'] = date('Y-m-d',$tmp['outdate']);
            $tmp['created'] = date('Y-m-d',$tmp['created']);
            $l2[] = $tmp;
        }
        $data['list'] = $l2;
        $this->data['data'] = $data;
        return $this->json();
    }

    public function actionSave()
    {
        if(!@$this->post['id'])
            $model = new Banner();
        else
            $model = Banner::findOne($this->post['id']);
        $model->attributes = $this->post;
        $model->outdate = @strtotime($this->post['outdate']);
        $model->created = time();
        if($model->save()) {
            return $this->json();
        }else{
            return $this->error($model);
        }
    }

}
