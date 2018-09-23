<?php

namespace app\controllers\base;

use yii\web\Controller;

class AController extends Controller
{
    protected $data = [
        'code'=>200,
        'data'=>[],
        'message'=>'操作成功'
        ];

    private $error = [
        200=>'操作成功',
        300=>'未登录',
        301=>'用户名或密码错误',
        400=>'请求方式错误：POST或GET反了',
        401=>'插入数据失败：',
        402=>'更新数据失败：',
        403=>'删除数据失败：',
    ];

    protected function json($code=200,$msg=''){
        $this->data['code'] = $code;
        $this->data['message'] = $this->error[$code].$msg;
        echo json_encode($this->data);
    }
}
