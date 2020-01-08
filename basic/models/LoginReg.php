<?php


namespace app\models;


use Yii;
use yii\base\Model;

class LoginReg extends Model
{

    public $name;
    public $surname;
    public $email;
    public $password;
    public $username;
    public $image = '';
    /**
     * @var int
     */
    public $idAdmin;
    /**
     * @var int
     */
    public $id_company;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name','surname', 'email', 'password', 'username'], 'required'],
            // rememberMe must be a boolean value
            ['email', 'email'],
            ['password', 'string', 'min'=>5],


        ];
    }

    public function logreg(){

        if($this->validate()){
            $hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $user= new User();
            $this->password = $hash;
            $user->attributes = $this->attributes;
            return $user->create();
        }
    }

    public function editprof(){

        if($this->validate()){
            $user= User::find()->where(['id'=>Yii::$app->user->identity->id])->one();

            $user->attributes = $this->attributes;
            return $user->create();
        }
    }
}