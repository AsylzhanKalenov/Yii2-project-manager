<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

function cmp($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a > $b) ? -1 : 1;
}

$this->title = 'Rating';
//$this->params['breadcrumbs'][] = $this->title;
$dat = explode('-',date('Y-m'));
$d=cal_days_in_month(CAL_GREGORIAN,intval($dat[1]),intval($dat[0]));

if(isset($_GET["ti"]) && $_GET["ti"]==2){
    $date1 = date('Y-m-d',$dat[0].'-'.(intval($dat[1])-3).'-01');
    $date2 = $dat[0].'-'.$dat[1].'-29';
}elseif(isset($_GET["ti"]) && $_GET["ti"]==3){
    $date1 = $dat[0].'-01-01';
    $date2 = $dat[0].'-12-31';
}else{
    $date1 = date('Y-m').'-01';
    $date2 = date('Y-m').'-'.$d;
}


$user = \app\models\User::find()->where(['id_company'=>Yii::$app->user->identity->id_company])->all();

$koef=array();
foreach ($user as $u){
    $task  = \app\models\PrTasks::find()->where(['>=', 'date_start', $date1])->andWhere(['<=', 'date_end', $date2])->andWhere(['and', ['complete'=>2, 'id_who'=>$u["id"]]])->all();
    $koefsum=0;

    foreach ($task as $t){
        $ex = explode(' ', $t["date_start"]);
        $ex = explode('-', $ex[0]);

        $ex1 = explode(' ', $t["date_end"]);
        $ex1 = explode('-', $ex1[0]);
        $day = ((intval($ex1[2])-intval($ex[2]))*100)/intval($d);

        $koefsum+=$t["grade"]/100+abs($day)/100;
    }
    if($koefsum!=0)
        $koef[$u["id"]] = $koefsum;

    }


uasort($koef, 'cmp');

?>
<div>
<h2 style="text-align: center;">Топ работников</h2>
    <select class="form-control" id="description" name="description" onchange="hrefdat()" style="width: 10%;">
        <option value="1">1 month</option>
        <option value="2">3 month</option>
        <option value="3">Year</option>
    </select>
</div>

<div id="gtco-main">
        <div class="row row-pb-md">
            <div class="col-md-12">
                <ul id="gtco-post-list">
                    <? $num=0;
                    foreach ($koef as $k=>$v){
                        $num++;
                        $us = \app\models\User::find()->where(['id'=>intval($k)])->one();

                        if($num<=3){
                        ?>
                    <li class="one-third entry animate-box" data-animate-effect="fadeIn">
                        <a href="single.html">
                            <div class="entry-img" style="background-image: url(/basic/web/uploads/<?=$us["image"]?>"></div>
                            <div class="entry-desc">
                                <h3> <?= $num.'. '.$us["surname"].' '.$us["name"] ?></h3>
                                <p>She packed her seven versalia, put her initial into the belt and made herself on the way.</p>
                            </div>
                        </a>
                    </li>
                    <? }
                    else{
                        ?>
                        <li class="one-fourth entry animate-box" data-animate-effect="fadeIn" style="width: 25%;">
                            <a href="single.html">
                                <div class="entry-img" style="background-image: url(/basic/web/uploads/<?=$us["image"]?>"></div>
                                <div class="entry-desc">
                                    <h3> <?= $num.'. '.$us["surname"].' '.$us["name"] ?></h3>
                                    <p>She packed her seven versalia, put her initial into the belt and made herself on the way.</p>
                                </div>
                            </a>
                        </li>
                        <?
                    }
                    } ?>
                </ul>
            </div>
        </div>
</div>
<script>
        function hrefdat() {
            var url = location.href+'&ti=';
            var url1 = url.substring(0, url.indexOf("&"))+'&ti='+$('#description').val();

            window.location = url1;
        }
        // $("#description").change(function() {
        //     alert( "Handler for .change() called." );
        // });
</script>

