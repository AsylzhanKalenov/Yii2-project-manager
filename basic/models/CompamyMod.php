<?php


namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;

class CompamyMod extends Model
{

    public $name;
    public $description;
    public $date;
    public $id_admin;
    public $logo='';

    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'description', 'date'], 'required'],
            // rememberMe must be a boolean value
        ];
    }


    public function saveCom(UploadedFile $file){
        if($file!=null){
            $this->logo=$file->name;
        }
        if($this->validate()){
            $user= new ICompany();
            $user->attributes = $this->attributes;
            return $user->create();
        }
    }


}