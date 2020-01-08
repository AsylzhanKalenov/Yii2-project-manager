<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pr_tasks".
 *
 * @property int $id
 * @property int $id_pr
 * @property string $name
 * @property string $description
 * @property int $id_user
 * @property string $date_start
 * @property string $date_end
 * @property string $content
 *
 * @property IProject $pr
 * @property User $user
 * @property mixed idwho
 */
class PrTasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pr_tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pr', 'name', 'description', 'id_user', 'date_start', 'date_end', 'content'], 'required'],
            [['id_pr', 'id_user', 'id_who'], 'integer'],
            [['description', 'content'], 'string'],
            [['date_start', 'date_end'], 'safe'],
            [['name'], 'string', 'max' => 255]
//            [['id_pr'], 'exist', 'skipOnError' => true, 'targetClass' => IProject::className(), 'targetAttribute' => ['id_pr' => 'id']],
//            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'id_pr' => 'id_pr',
            'name' => 'name',
            'description' => 'description',
            'id_user' => 'id_user',
            'date_start' => 'date_start',
            'date_end' => 'date_end',
            'content' => 'content',
            'id_who'=>'id_who'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPr()
    {
        return $this->hasOne(Project::className(), ['id' => 'id_pr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    public function create()
    {
        return $this->save(false);
    }
}
