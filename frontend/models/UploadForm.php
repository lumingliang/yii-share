<?php

namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model {

    /*@var UploadedFile
     *
     */ 
    public $imageFiles;

    public function rules() {

        return [
            [ ['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4 ],
        ];
    }

    public function upload() {

        if($this->validate()) {
            foreach( $this->imageFiles as $file ) {
            $file->saveAs('F:\ ' .$file->baseName .'.' .$file->extension);
            }
            // $this->imageFile->saveAs('F:\advanced\ ' .$this->imageFile->baseName .'.' .$this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
