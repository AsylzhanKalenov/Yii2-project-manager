<?php

/* @var $this yii\web\View */

use app\models\ICompany;
use app\models\Project;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Profil';
//$this->params['breadcrumbs'][] = $this->title;
$id_userrr = Yii::$app->user->identity->id;

?>
<h2></h2>

<?
if(Yii::$app->user->identity->idAdmin==1) {
    ?>
    <?= Html::a('Create new project', ['site/project'], ['class' => 'btn btn-warning']) ?>

    <!--    <div id="company"-->
<!--         style="position: absolute; top: 30%; left: 30%; width: 300px; height: 80px; background-color: lightgoldenrodyellow; border-radius: 3px; border: 1px solid slategray; text-align: center; z-index: 1000">-->
<!--        --><?//= Html::a('Yes', ['auth/regcompany'], ['class' => 'btn btn-warning', 'style' => 'margin-top:22px;']) ?>
<!--        --><?//= Html::button('No, individual worker', ['class' => 'closecom btn btn-warning', 'style' => 'margin-top:22px;']) ?>
<!--    </div>-->

    <?php
}
try {
//    $pr = Yii::$app->db->createCommand('SELECT * FROM i_project')->queryAll();

    if(Yii::$app->user->identity->idAdmin==1){
    $pr = Project::find()->where(['id_company'=>Yii::$app->user->identity->id_company])->all();
    }
    else {
        $pr = Yii::$app->db->createCommand('SELECT * FROM i_project WHERE us_access like :id')
            ->bindValue(':id', '%'.$id_userrr.'%')
            ->queryAll();

    }
    } catch (\yii\db\Exception $e) {
    echo $e;
}

foreach($pr as $p){
    ?>
    <div style="margin: 10px 0; padding: 8px; border: 1px solid #5a6268; border-radius: 5px;">
        <h2><?=$p["name"]?></h2>
        <p><?=$p["content"]?></p>
        <p><?=$p["date_start"]?> - <?=$p["date_end"]?></p>


        <div>
            <table class="table">
                <tr ondblclick="showEdit()">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Email</th>
                </tr>
                <?



                $com1 = explode(',', $p["us_access"]);
                $i=0;
                foreach($com1 as $c){
                    if($c!='') {
                        $use = User::find()->where(['id' => $c])->one();
                        $i++;

                        echo "<tr><td scope='col'>" . $i . "</td><td><a href='" . Url::to(['site/ownprof', 'id_pr' => $use["id"]]) . "'>" . $use["name"] . "</a></td><td> " . $use["surname"] . "</td><td> " . $use["email"] . "</td></tr>";
                    }
                }
                ?>
            </table>
        </div>


        <a href="<?=Url::to(['site/calendar1', 'id' => $p["id"]])?>" class="btn btn-mini btn-success">Calendar</a>
    </div>
    <?

}


?>


