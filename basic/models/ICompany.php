<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_company".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $date
 * @property mixed id_admin
 * @property mixed logo
 */
class ICompany extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'description', 'date', 'id_admin', 'logo'], 'required'],
            [['id'], 'integer'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['name', 'logo'], 'string', 'max' => 400],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'date' => 'Date',
            'logo'=>'logo'
        ];
    }

    public function create(){
        return $this->save(false);
    }
}
