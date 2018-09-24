<?php

namespace app\controllers\base;

use yii\web\Controller;

class BaseController extends Controller
{
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
        $this->data['code'] = $code;
        $this->data['message'] = $this->error[$code].$msg;
        echo json_encode($this->data);
    }
}
