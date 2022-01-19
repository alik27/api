<?php


namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImageUploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $images;

    public function rules()
    {
        return [
            [['images'], 'file', 'skipOnEmpty' => false ,/* 'extensions' => 'png, jpg',*/ 'maxFiles' => 4],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->images as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return 'uploads/' . $file->baseName . '.' . $file->extension;
        } else {
            return false;
        }
    }
}