<?php
/**
 * Created by PhpStorm.
 * User: Leonidax
 * Date: 2018/10/8
 * Time: 下午11:00
 */

namespace app\controllers\mobile;

use app\controllers\base\MController;
use abei2017\wx\Application;

class UserController extends MController{

    public function actionQrcode(){
        $qrcode = (new Application())->driver("mp.qrcode");
        $r = $qrcode->forever(@$this->post['id']);
        $this->data['data']['qrcode'] = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$r['ticket'];
        return $this->json();
    }
}
