<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "i_comments".
 *
 * @property int $id
 * @property int $id_who
 * @property int $id_place
 * @property string $date
 * @property string $content
 * @property string $place
 */
class IComments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i_comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_who', 'id_place', 'date', 'content', 'place'], 'required'],
            [['id_who', 'id_place'], 'integer'],
            [['date'], 'safe'],
            [['content'], 'string'],
            [['place'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'id_who' => 'id_who',
            'id_place' => 'id_place',
            'date' => 'date',
            'content' => 'content',
            'place' => 'place',
        ];
    }
    public function create(){
        return $this->save(false);
    }
}
