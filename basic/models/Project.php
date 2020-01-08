<?php


namespace app\models;
use yii\db;
/**
* @property int id_company
*/
class Project extends db\ActiveRecord
{

    public static function tableName()
    {
        return 'i_project';
    }

    public function attributeLabels()
    {
        return [
            'name' => 'name',
        ];
    }

    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'description', 'content', 'date', 'date_start', 'date_end'], 'required'],
            // email has to be a valid email address

            // verifyCode needs to be entered correctly

        ];
    }



}