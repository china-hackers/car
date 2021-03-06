<?php
/**
 * Created by PhpStorm.
 * User: Leonidax
 * Date: 2018/10/8
 * Time: 下午7:15
 */
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadModel extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $images;
    public $image;

    public function rules()
    {
        return [
            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 9],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    private function mkdirs($dir, $mode = 0777){
        if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
        if (!$this->mkdirs(dirname($dir), $mode)) return FALSE;
        return @mkdir($dir, $mode);
    }

    public function upload($path='product')
    {
        $path = 'upload/'.$path.'/';
        if ($this->validate(['image'])) {
            $date = date('Y-m');
            $time = time();
            $path .= $date.'/';
            $this->mkdirs($path);
            $name = $time.'.'.$this->image->extension;
            $this->image->saveAs($path . $name);
            return '/'.$path.$name;
        } else {
            return '';
        }
    }

    public function uploads($path='product')
    {
        $path = 'upload/'.$path.'/';
        if ($this->validate(['images'])) {
            $list = [];
            $date = date('Y-m');
            $time = str_replace(' ', '-',microtime());
            $path .= $date.'/';
            $this->mkdirs($path);
            foreach ($this->images as $i => $file) {
                $name = $time.'_'.$i.'.'.$file->extension;
                $file->saveAs($path . $name);
                $list[] = '/'.$path.$name;
            }
            return $list;
        } else {
            return [];
        }
    }
}