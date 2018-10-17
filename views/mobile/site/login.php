<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;

?>
Hello world !
<form action="/admin/site/bannerimg" method="post" enctype="multipart/form-data">
    <input name="id" value="1"/>
    选择图片：<input type="file" name="UploadModel[image]" />
    <input type="submit" value="OK" />
</form>
<br/>