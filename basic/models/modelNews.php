<?php


namespace app\models;


use yii\base\Model;

class modelNews extends Model
{


    public $name;
    public $content;
    public $date;
    public $img;
    public $id_who;
    public $id_company;


    public function addNews(){
        $new = new INews();
        $new->attributes = $this->attributes;
        return $new->create();
    }

}