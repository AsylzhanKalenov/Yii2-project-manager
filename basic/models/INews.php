<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_news".
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property string $date
 * @property string $img
 * @property int $id_who
 * @property mixed id_company
 */
class INews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'content', 'date', 'img', 'id_who', 'id_company'], 'required'],
            [['content'], 'string'],
            [['date'], 'safe'],
            [['id_who'], 'integer'],
            [['name', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'content' => 'content',
            'date' => 'date',
            'img' => 'img',
            'id_who' => 'id_who',
            'id_company'=>'id_company'
        ];
    }

    public function create(){
        return $this->save(false);
    }
}
