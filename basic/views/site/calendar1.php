<?

use app\models\ContactForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Contact';
//$this->params['breadcrumbs'][] = $this->title;

function define_week_start_and_end($what, $data)

{

    $time_stamp = strtotime($data);

    $cur_day = getdate($time_stamp);

    $month_day = $cur_day['mday'];

    $month_num = $cur_day['mon'];

    $year_num = $cur_day['year'];

    $day_num = $cur_day['wday'];

    if ($day_num!=0)

    {

        $week_start = $month_day-$day_num+1;

    }

    else

    {

        $week_start = $month_day-6;

    }

    $week_end = $week_start+6;

    $week_start_month_num = $month_num;

    $week_end_month_num = $month_num;

    $week_start_year_num = $year_num;

    $week_end_year_num = $year_num;

    if ($week_start < 1)

    {

        if ($month_num == 1)

        {

            $week_start_year_num--;

            $week_start_month_num = 12;

        }

        else

        {

            $week_start_month_num--;

        }

        $last_day_in_previous_month = 31;

        while (!checkdate ($week_start_month_num, $last_day_in_previous_month, $week_start_year_num))

        {

            $last_day_in_previous_month--;

        }

        $week_start += $last_day_in_previous_month;

    }

    $last_day_in_month = 31;

    while (!checkdate ($week_start_month_num, $last_day_in_month, $week_start_year_num))

    {

        $last_day_in_month--;

    }

    if ($week_end > $last_day_in_month)

    {

        if ($month_num == 12)

        {

            $week_end_year_num++;

            $week_end_month_num = 1;

        }

        else

        {

            $week_end_month_num++;

        }

        $week_end = $week_end-$last_day_in_month;

    }

    $week_start_time_stamp = gmmktime (0, 0, 0, $week_start_month_num, $week_start, $week_start_year_num);

    $week_end_time_stamp = gmmktime (23, 59, 59,  $week_end_month_num, $week_end, $week_end_year_num);

    if ($what == "start")

    {

        return $week_start_time_stamp;

    }

    else if ($what == "end")

    {

        return $week_end_time_stamp;

    }

    return NULL;

}

// проверяем передали ли нам месяц и год

if(isset($_GET["ym"]))

{

    $year  = substr($_GET["ym"], 0, 4);

    $month = substr($_GET["ym"], 4, 2);

}

else{ // иначе выводить текущие месяц и год

    $month = date("m", mktime(0,0,0,date('m'),1,date('Y')));

    $year  = date("Y", mktime(0,0,0,date('m'),1,date('Y')));

}

$dd=$year.'-'.$month.'-01';
$api = new Strings;

$date = $api->date('ru', $dd, 'sql', 'datetext');

$date=explode(" ",$date);

?>
<input type="hidden" value="<?=$_GET["id"]?>" id="id_pr">
    <label for="sel1" style="width: 40%; margin-left: 0.7%;font-size:1.7em;">Add employee:</label>
<div class="row" style="margin: 20px 0;">

<select class="form-control" id="sel1" name="sellist1" style="width: 40%; margin-left: 1.7%;">
    <?
    $user = \app\models\User::find()->where(['id_company'=>Yii::$app->user->identity->id_company])->all();

    foreach ($user as $u){
        echo '<option value="'.$u["id"].'">'.$u["surname"].' '.$u["name"].'</option>';
    }
    ?>
</select>
<input type="button" onclick="addEmpl()" class="addempl btn btn-default" value="Add to project" style="width: 10%; margin-left: 1.7%;">
</div>
<?php

if (isset($_GET["day"]))

{

    $tod=$_GET["day"];

}

else{$tod=date("Y-m-d");

}

$week_start_stamp = define_week_start_and_end("start",$tod);

$week_end_stamp = define_week_start_and_end("end",$tod)-86400;

$begin=date("Y-m-d",$week_start_stamp);

$end=date("Y-m-d",$week_end_stamp);

// Вычисляем число дней в текущем месяце

$dayofmonth = date("t", mktime(0,0,0,$month,1,$year));

// Счётчик для дней месяца

$day_count = 1;

// 1. Первая неделя

$num = 0;

for($i = 0; $i < 7; $i++)

{

    // Вычисляем номер дня недели для числа

    $dayofweek = date('w',

        mktime(0, 0, 0, $month, $day_count,$year));

    // Приводим к числа к формату 1 - понедельник, ..., 6 - суббота

    $dayofweek = $dayofweek - 1;

    if($dayofweek == -1) $dayofweek = 6;

    if($dayofweek == $i)

    {

        // Если дни недели совпадают,

        // заполняем массив $week

        // числами месяца

        $week[$num][$i] = $day_count;

        $day_count++;

    }

    else

    {

        $week[$num][$i] = "";

    }

}

// 2. Последующие недели месяца

while(true)

{

    $num++;

    for($i = 0; $i < 7; $i++)

    {

        $week[$num][$i] = $day_count;

        $day_count++;

        // Если достигли конца месяца - выходим

        // из цикла

        if($day_count > $dayofmonth) break;

    }

    // Если достигли конца месяца - выходим

    // из цикла

    if($day_count > $dayofmonth) break;

}

// 3. Выводим содержимое массива $week

// в виде календаря

// Выводим таблицу

echo '<div style=" margin:0px 10px 40px 10px" ><table id="calendar" class="table-bordered table-striped table-hover" border=0 width="100%" height="600" style=" border-collapse:collapse; border:1px solid #CCE9FB; ">

<tr height="50">

<td colspan="7" align="center" valign="middle" style=" padding:7px;font-size:22px;" class="table_title">

<a href="'.Url::to(['site/calendar1', 'ym' => date("Ym", mktime(0,0,0,$month-1,1,$year)), 'id'=>$_GET["id"]]).'" class="btn btn-mini btn-success">Назад</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$date[1].' '.$year.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.Url::to(['site/calendar1', 'ym' => date("Ym", mktime(0,0,0,$month+1,1,$year)), 'id'=>$_GET["id"]]).'" class="btn btn-mini btn-success">Вперед</a>

</td>

</tr>

';

for($i = 0; $i < count($week); $i++)

{

    if($week[$i][0]<10)

    {

        $da='0'.$week[$i][0];

    }

    else{

        $da=$week[$i][0];

    }

    $dat=$year.'-'.$month.'-'.$da;

    if ($begin==$dat)

    {

//        echo '<tr>';
        echo '<tr class="week'.$i.'" rel="'.$i.'" sel="0">';

    }

    else

        echo '<tr class="week'.$i.'" rel="'.$i.'" sel="0">';

//        echo "<tr>";

    for($j = 0; $j < 7; $j++)

    {

        if ($j==6) $st='background:#D56E64;';else $st='';

        if ($j==5) $st1='background:#0E7DAE;';else $st1='';

        if(!empty($week[$i][$j]))

        {

            // Если имеем дело с субботой и воскресенья

            // подсвечиваем их

            if($week[$i][$j]<10)

            {

                $da='0'.$week[$i][$j];

            }

            else{

                $da=$week[$i][$j];

            }

            $dat=$year.'-'.$month.'-'.$da;

            if ($dat==date("Y-m-d"))

            {

                $like = "".$dat."%";

//                $ra = Yii::$app->db->createCommand('SELECT * FROM i_project')->queryAll();

//                $ra =\app\models\Project::find()->where(['id'=>$_GET["id"]])->where((['date_start'=>date("Y-m-d H:m:s", mktime(0,0,0,$month,$week[$i][$j],$year))])->one();

                $ra =\app\models\Project::find()->andWhere(['id'=>$_GET["id"]])->andWhere(['and',['<=','date_start',date('Y-m-d H:m:s',mktime(0,0, 0, $month, $da, $year ))]])->andWhere(['and',['>=','date_end',date('Y-m-d H:m:s',mktime(0,0, 0, $month, $da, $year ))]])->one();

                $rt = \app\models\PrTasks::find()->andWhere(['>=', 'date_end', date('Y-m-d H:m:s',mktime(0,0, 0, $month, $da, $year ))])->andWhere(['and', ['<=', 'date_start', date('Y-m-d H:m:s',mktime(0,0, 0, $month, $da+1, $year ))]])->andWhere(['and', ['id_pr'=>$_GET["id"]]])->andWhere(['or', ['id_user'=>Yii::$app->user->identity->id], ['id_who'=>Yii::$app->user->identity->id]])->all();



                $kol=$ra;

                $task ='';
                $numn=0;
                $all=0;
                foreach ($rt as $rss){
                    $all++;
                    $numn+=$rss["complete"]==2?1:0;
                }
                $task.=$all!=0?'<div style="position: absolute; right: 10px; top: 7px; width: 80px; font-size: small;">Done '.$numn.' from'.$all.'</div>':'';


                if ($kol>0)

                {

                    echo '<td class="table_title1" valign="top" style="position: relative; background:#CCE9FB;padding:2px;font-size:18px;  border:5px solid #FF1C23; '.$st.' '.$st1.'"><a href="'.(isset($_GET["ym"])?'?ym='.$_GET["ym"].'&day='.$da.'':'?day='.$dat.'').'" style=" font-size:18px; color:#0078FF">'.$week[$i][$j].'</a>'.($task!=''?$task:'').'<a style=" position:absolute; left:10px; bottom:10px; font-size:10px; color:#333; background:#fff; padding:2px; cursor:pointer;" href="'.Url::to(['site/tasks', 'ym' => date("Y-m-d", mktime(0,0,0,$month,$week[$i][$j],$year)),'ym1' => date("Y-m-d", mktime(0,0,0,$month,$week[$i][$j]+1,   $year)) , 'id_pr'=>$_GET["id"]]).'" class="sel'.$i.' btn btn-mini btn-info">Выбрать день</a></td>';

                }

                else

                    echo "<td  class='table_title1' valign='top' style='background:#CCE9FB;padding:2px;font-size:18px;  border:1px solid #CCE9FB; ".$st." ".$st1."'>".$week[$i][$j]."</td>";

            }

            else

            {

                $ra =\app\models\Project::find()->andWhere(['id'=>$_GET["id"]])->andWhere(['and',['<=','date_start',date('Y-m-d H:m:s',mktime(0,0, 0, $month, $da, $year ))]])->andWhere(['and',['>=','date_end',date('Y-m-d H:m:s',mktime(0,0, 0, $month, $da, $year ))]])->one();

                $rt = \app\models\PrTasks::find()->andWhere(['>=', 'date_end', date('Y-m-d H:m:s',mktime(0,0, 0, $month, $da, $year ))])->andWhere(['and', ['<=', 'date_start', date('Y-m-d H:m:s',mktime(0,0, 0, $month, $da+1, $year ))]])->andWhere(['and', ['id_pr'=>$_GET["id"]]])->andWhere(['or', ['id_user'=>Yii::$app->user->identity->id], ['id_who'=>Yii::$app->user->identity->id]])->all();

                $kol=$ra;
                $task ='';

                $numn=0;
                $all=0;
                foreach ($rt as $rss){
                    $all++;
                    $numn+=$rss["complete"]==2?1:0;
                }
                $task.=$all!=0?'<div style="position: absolute; right: 10px; top: 7px; width: 80px; font-size: small;">Done '.$numn.' from'.$all.'</div>':'';

                if ($kol>0)

                {

                    echo '<td valign="top" style="position: relative; padding:2px;font-size:18px;  border:1px solid #FF1C23; '.$st.' '.$st1.'"><a href="'.(isset($_GET["ym"])?'?ym='.$_GET["ym"].'&day='.$da.'':'?day='.$dat.''). '" style=" font-size:18px; color:#ff1c23">' .$week[$i][$j].'</a>'.($task!=''?$task:'').'<a style=" position:absolute; left:10px; bottom:10px; font-size:10px; color:#333; background:#fff; padding:2px; cursor:pointer;" href="'.Url::to(['site/tasks', 'ym' => date("Y-m-d", mktime(0,0,0,$month,$week[$i][$j],$year)),'ym1' => date("Y-m-d", mktime(0,0,0,$month,$week[$i][$j]+1,   $year)), 'id_pr'=>$_GET["id"]]).'" class="sel'.$i.' btn btn-mini btn-info">Выбрать день</a></td>';

                }

                else

                    echo "<td valign='top' style='padding:2px;font-size:18px;  border:1px solid #CCE9FB; ".$st." ".$st1."'>".$week[$i][$j]."</td>";

            }

        }

        else echo "<td style=' border:1px solid #CCE9FB; ".$st." ".$st1."'>&nbsp;</td>";

    }

    echo "</tr>";

}

echo "</table></div>";

?>

<script>

    function addEmpl(){
        alert("Works");
        var data = 'do=add_emps&id_us='+$('#sel1').val()+'&id_pr='+$('#id_pr').val();


        $.ajax({
            url: 'index.php?r=site/profile',
            type: 'POST',
            data: data,
            success: function(res){
                if(res=='success'){
                    alert("Employree added");
                }
            },
            error: function(){
                alert('Error!');
            }
        });
        return false;
    }

</script>


<script type="text/javascript">


    $(document).ready(function()

    {






        $('#calendar tr').mouseenter(function()

            {

                var a = $(this).attr("rel");

                var b = $('.sel'+a).attr("rel");

                if (b=='0')

                {

                    $('.sel'+a).html("Выделить неделю");

                }

                else{$('.sel'+a).html("Снять выделение");

                }

                $('.sel'+a).show();

            }

        )

        $('#calendar tr').mouseleave(function()

            {

                var a = $(this).attr("rel");

                $('.sel'+a).hide();

            }

        )

        $('#calendar td').mouseenter(function()

            {

                if ($(this).css("background-color")=='rgb(213, 110, 100)')

                    $(this).css("background","#0095DE");

                else if ($(this).css("background-color")=='rgb(14, 125, 174)')

                    $(this).css("background","#0095DF");

                else

                    $(this).css("background","#0095DD");

            }

        )

        $('#calendar td').mouseleave(function()

            {

                //alert($(this).css("background"));

                if ($(this).css("background-color")=='rgb(0, 149, 222)')

                    $(this).css("background","#D56E64");

                else if ($(this).css("background-color")=='rgb(0, 149, 223)')

                    $(this).css("background","#0E7DAE");

                else

                    $(this).css("background","none");

                //$(this).css("background","none");

            }

        )

        $('#calendar .table_title').mouseenter(function()

            {

                $(this).css("background","none");

            }

        )

        $('#calendar .table_title').mouseleave(function()

            {

                $(this).css("background","none");

            }

        )

        $('#calendar .table_title1').mouseenter(function()

            {

                $(this).css("background","#0095DD");

            }

        )

        $('#calendar .table_title1').mouseleave(function()

            {

                $(this).css("background","#CCE9FB");

            }

        )

    }
</script>
