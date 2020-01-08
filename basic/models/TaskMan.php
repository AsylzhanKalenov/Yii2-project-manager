<?php


namespace app\models;


use Yii;
use yii\base\Model;

class TaskMan extends Model
{
    public $id_pr;
    public $name;
    public $description;
    public $id_user;
    public $date_start;
    public $date_end;
    public $content;
    public $id_who;

    public function rules()
    {
        return [
            // username and password are both required
            [['id_pr', 'name', 'description', 'id_user', 'date_start', 'date_end', 'content'], 'required'],
            // rememberMe must be a boolean value
        ];
    }

    public function addTask(){

        if($this->validate()){
            $task = new PrTasks();
            $task->attributes = $this->attributes;
            return $task->create();
        }
        else {
            return false;
        }

    }


}