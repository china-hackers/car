<?php

namespace app\controllers\mobile;

use app\controllers\base\BaseController;

class SiteController extends BaseController
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = false;
        return $this->render('index');
    }
}
