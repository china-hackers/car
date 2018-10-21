<?php

namespace app\controllers\base;

use yii\web\Controller;
use yii;

class BaseController extends Controller
{
    protected $uid = 0;
    protected $post = [];

    protected $data = [
        'code'=>200,
        'data'=>[],
        'message'=>'操作成功'
        ];

    private $error = [
        200=>'操作成功',
        300=>'未登录',
        301=>'用户名或密码错误',
        302=>'没有该权限，禁止访问',
        400=>'请使用POST方式',
        401=>'插入数据失败：',
        402=>'更新数据失败：',
        403=>'删除数据失败：',
        404=>'获取数据失败：',
    ];

    protected function json($code=200,$msg=''){
        Yii::$app->response->statusCode = 200;
        $this->data['code'] = $code;
        $this->data['message'] = $this->error[$code].$msg;
        Yii::$app->response->content = json_encode($this->data);
    }

    protected function error($model,$code=401){
        $list = $model->getFirstErrors();
        $msg = '';
        foreach($list as $key=>$value){
            $msg .= $value;
        }
        return $this->json($code,$msg);
    }
}
