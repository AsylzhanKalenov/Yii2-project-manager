<?php


use yii\helpers\Url;

class Calendar
{
    function define_week_start_and_end($what, $data)

    {

        // получаем данные текущего дня

        $time_stamp = strtotime($data);

        $cur_day = getdate($time_stamp);



        // номер дня в месяце

        $month_day = $cur_day['mday'];

        // номер месяца в году

        $month_num = $cur_day['mon'];

        // год

        $year_num = $cur_day['year'];

        // номер дня недели

        $day_num = $cur_day['wday'];



        // если номер дня недели не равен 0

        if ($day_num!=0)

        {

            //начало недели

            $week_start = $month_day-$day_num+1;

        }

        else

        {

            //начало недели

            $week_start = $month_day-6;

        }



        // конец недели

        $week_end = $week_start+6;

        // номер месяца для начала недели

        $week_start_month_num = $month_num;

        //номер месяца для конца недели

        $week_end_month_num = $month_num;

        // номер года для начала недели

        $week_start_year_num = $year_num;

        // номер года для конца недели

        $week_end_year_num = $year_num;



        // если начало недели не в текущем месяце

        if ($week_start < 1)

        {

            // если первый месяц

            if ($month_num == 1)

            {

                // то берем предыдущий год

                $week_start_year_num--;

                // последний месяц

                $week_start_month_num = 12;

            }

            else

            {

                // просто берем предыдущий месяц

                $week_start_month_num--;

            }

            // последний день в предыдущем месяце

            $last_day_in_previous_month = 31;



            // пока дата будет неправильно показывать

            while (!checkdate ($week_start_month_num, $last_day_in_previous_month, $week_start_year_num))

            {

                // то уменьшаем день в последнем месяце (может быть и 30 и 29 и 28 дней в месяце)

                $last_day_in_previous_month--;

            }



            //начало недели

            $week_start += $last_day_in_previous_month;

        }

        //последний день в месяце

        $last_day_in_month = 31;

        // пока дата будет неправильно показывать

        while (!checkdate ($week_start_month_num, $last_day_in_month, $week_start_year_num))

        {

            // то уменьшаем дату

            $last_day_in_month--;

        }



        // если конец недели больше последнего дня в месяце

        if ($week_end > $last_day_in_month)

        {

            // если конец года

            if ($month_num == 12)

            {

                // берем следующий год

                $week_end_year_num++;

                // первый месяц

                $week_end_month_num = 1;

            }

            else

            {

                // просто берем следующий месяц

                $week_end_month_num++;

            }

            // конец недели

            $week_end = $week_end-$last_day_in_month;

        }

        // возвращаем метку даты начала недели

        $week_start_time_stamp = gmmktime (0, 0, 0, $week_start_month_num, $week_start, $week_start_year_num);



        // возвращаем метку даны конца недели

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

    function get_month_calendar($date){



        // начало текущей недели

        $week_start_stamp = $this->define_week_start_and_end("start",$date);

        // конец текущей недели

        $week_end_stamp = $this->define_week_start_and_end("end",$date)-86400;

        // начало текущей недели

        $begin=date("Y-m-d",$week_start_stamp);

        // конец текущей недели

        $end=date("Y-m-d",$week_end_stamp);



        $date	= explode('-',$date);



        $year  	= $date[0];

        $month 	= $date[1];

        $day 	= $date[2];



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



        $curr_month = $this->date('ru',implode('-',$date),'sql','datetext');

        $curr_month = explode(" ",$curr_month);



        $day_week = array();



        $day_week[1]='ПН';

        $day_week[2]='ВТ';

        $day_week[3]='СР';

        $day_week[4]='ЧТ';

        $day_week[5]='ПТ';

        $day_week[6]='СБ';

        $day_week[7]='ВС';



        $string = array();



        $string[] = '<div class="cal_div">';

        $string[] = '<table id="calendar" border="0">';

        $string[] = '<tr class="cal_header">';

        $string[] = '<td colspan="7" class="table_title">';

        $string[] = '<a href="javascript:do_m(\''.date("Y-m-d", mktime(0,0,0,$month-1,$day,$year)).'\')">Назад</a>';

        $string[] = '<span>'.$curr_month[1].' '.$curr_month[2].' г.</span>';

        $string[] = '<a href="javascript:do_m(\''.date("Y-m-d", mktime(0,0,0,$month+1,$day,$year)).'\')">Вперед</a>';

        $string[] = '</td>';

        $string[] = '</tr>';

        $string[] = '<tr class="text_day">';



        for($i = 1; $i <= 7; $i++)

        {

            $string[] = '<td>'.$day_week[$i].'</td>';

        }

        $string[] = '</tr>';



        for($i = 0; $i < count($week); $i++)

        {

            if($week[$i][0]<10)

            {

                $da='0'.$week[$i][0];

            }

            else

            {

                $da=$week[$i][0];

            }



            $dat=$year.'-'.$month.'-'.$da;



            // текущая неделя

            if ($begin==$dat)

            {

                $string[] = '<tr class="now_week">';

            }

            else

                $string[] = "<tr>";



            for($j = 0; $j < 7; $j++)

            {

                // Если имеем дело с субботой и воскресенья

                // подсвечиваем их

                if ($j==6) $st='std';else $st='';

                if ($j==5) $st1='snd';else $st1='';



                if(!empty($week[$i][$j]))

                {



                    if($week[$i][$j]<10)

                    {

                        $da='0'.$week[$i][$j];

                    }

                    else

                    {

                        $da=$week[$i][$j];

                    }



                    $dat=$year.'-'.$month.'-'.$da;



                    if ($dat==date("Y-m-d"))

                    {

                        $string[] = '<td  class="day day_now">'.$week[$i][$j].'</td>';

                    }

                    else

                    {

                        $string[] = '<td class="day '.$st.' '.$st1.'">'.$week[$i][$j].'</td>';

                    }



                }

                else $string[] = '<td class="day '.$st.' '.$st1.'">&nbsp;</td>';

            }

            $string[] = "</tr>";

        }

        $string[] = "</table></div>";



        return join("\n",$string);

    }

    public function date($lang, $str, $type_from, $type_to)

    {

        $conv_date ='';

        $lang_mass = Array(

            'ru'=>Array(

                'at'=>'в',

                'mounth'=>Array(

                    '01'=>'Январь',

                    '02'=>'Февраль',

                    '03'=>'Март',

                    '04'=>'Апрель',

                    '05'=>'Май',

                    '06'=>'Июнь',

                    '07'=>'Июль',

                    '08'=>'Август',

                    '09'=>'Сентябрь',

                    '10'=>'Октябрь',

                    '11'=>'Ноябрь',

                    '12'=>'Декабрь')

            ),

            'en'=>Array(

                'at'=>'at',

                'mounth'=>Array(

                    '01'=>'january',

                    '02'=>'february',

                    '03'=>'march',

                    '04'=>'april',

                    '05'=>'may',

                    '06'=>'june',

                    '07'=>'july',

                    '08'=>'agust',

                    '09'=>'september',

                    '10'=>'october',

                    '11'=>'november',

                    '12'=>'december')

            ),



            'kz'=>Array(

                'at'=>'',

                'mounth'=>Array(

                    '01'=>'қаңтар',

                    '02'=>'ақпан',

                    '03'=>'наурыз',

                    '04'=>'сәуір',

                    '05'=>'мамыр',

                    '06'=>'маусым',

                    '07'=>'шілде',

                    '08'=>'тамыз',

                    '09'=>'қыркүйек',

                    '10'=>'қазан',

                    '11'=>'қараша',

                    '12'=>'желтоқсан')

            )

        );





        # Если из SQL формата

        if ($type_from == 'sql')

        {

            $date_time 	= explode(' ', $str);

            $date 		= explode('-', @$date_time[0]);

            $time 		= explode(':', @$date_time[1]);



            # Обычный тип даты

            if ($type_to == 'date')

            {

                $conv_date = $date[2].'.'.$date[1].'.'.$date[0];

            }



            # Текстовая дата

            if ($type_to == 'datetext')

            {

                $conv_date = $date[2].' '.$lang_mass[$lang]['mounth'][$date[1]].' '.$date[0];

            }



            # Дата и время

            if ($type_to == 'datetime')

            {

                $conv_date = $date[2].'.'.$date[1].'.'.$date[0].' '.$lang_mass[$lang]['at'].' '.$time[0].':'.$time[1];

            }



            # Текстовые дата и время

            if ($type_to == 'datetimetext')

            {

                if (substr($date[2], 0, 1) == 0) { $date[2] = substr($date[2], 1); }

                if (substr($time[0], 0, 1) == 0) { $time[0] = substr($time[0], 1); }

                $conv_date = $date[2].' '.$lang_mass[$lang]['mounth'][$date[1]].' '.$date[0].' '.$lang_mass[$lang]['at'].' '.$time[0].':'.$time[1];

            }

        }



        # Из обычного формата

        if ($type_from == 'date')

        {

            $date_time 	= explode('.', $str);



            # SQL

            if ($type_to == 'sql')

            {

                $conv_date = $date_time[2].'-'.$date_time[1].'-'.$date_time[0];

            }



        }



        return $conv_date;

    }

    function get_week_calendar($id,$date)

    {

        //$date='2012-11-01';

        // начало текущей недели

        $week_start_stamp = $this->define_week_start_and_end("start",$date);

        // конец текущей недели

        $week_end_stamp = $this->define_week_start_and_end("end",$date)-86400;

        // начало текущей недели

        $begin=date("Y-m-d",$week_start_stamp);

        // конец текущей недели

        $end=date("Y-m-d",$week_end_stamp).' 23:59:59';

        $endend=date("Y-m-d",$week_end_stamp).' 23:59:59';



        $begin_text = $this->date('ru',$begin,'sql','datetext');

        //$begin_text = explode(" ",$begin_text);



        $end_text = $this->date('ru',$end,'sql','datetext');

        //$end_text = explode(" ",$end_text);





        $date	= explode('-',$date);



        $year  	= $date[0];

        $month 	= $date[1];

        $day 	= $date[2];



        $begin_day1 = explode('-',$begin);

        $end_day1 = explode('-',$end);



        $begin_day=$begin_day1[2]+0;

        $end_day=$end_day1[2]+0;



        $day_week = array();



        $day_week[1]='ПН';

        $day_week[2]='ВТ';

        $day_week[3]='СР';

        $day_week[4]='ЧТ';

        $day_week[5]='ПТ';

        $day_week[6]='СБ';

        $day_week[7]='ВС';



        $shot_month = array();



        $shot_month['01']='Янв';

        $shot_month['02']='Фев';

        $shot_month['03']='Мрт';

        $shot_month['04']='Апр';

        $shot_month['05']='Май';

        $shot_month['06']='Инь';

        $shot_month['07']='Иль';

        $shot_month['08']='Авг';

        $shot_month['09']='Сен';

        $shot_month['10']='Окт';

        $shot_month['11']='Нбр';

        $shot_month['12']='Дек';




        $ra = Yii::$app->db->createCommand('SELECT * FROM pr_tasks')->queryAll();


        if ($ra)

        {

            $arr_false = array();
            //vd($ra);

            foreach ($ra as $r)

            {

                $data=strtotime($r["date"]);



                $data1=strtotime($r["date"]);



                $time=explode('-',$r["time"]);
                $obed=explode('-',$r["obed"]);




                $start=$time[0].':00';



                $end=$time[1].':00';

                $startobed=$obed[0].':00';



                $endobed=@$obed[1].':00';



                $data_time=strtotime(date("Y-m-d ".$start,$data));

                $data_time1=strtotime(date("Y-m-d ".$end,$data1));

                if ($r["obed"]!='-'){
                    $data_obed=strtotime(date("Y-m-d ".$startobed,$data));
                    $data_obed1=strtotime(date("Y-m-d ".$endobed,$data1));
                }else{
                    $data_obed=0;
                    $data_obed1=0;
                }



                $arr_false[]=array('title' => "Работает с ".$r["time"]."",'start' => date("Y-m-d ".$start,$data),'end' => date("Y-m-d ".$end,$data1),"data"=>$r["date"],'data_start'=>$data_time,'data_end'=>$data_time1,'data_startobed'=>$data_obed,'data_endobed'=>$data_obed1);


                //vd($arr_false);

            }

        }

//vd($arr_false);

        $ra = Yii::$app->db->createCommand('SELECT * FROM pr_tasks')->queryAll();


        //vd($ra);
        //vd($pr);

        $arr_user = array();
        if ($ra)

        {

            foreach ($ra as $r)

            {

                $sl = "select * from user where id=:id";
                $pr = array(
                    'id'=>$r["id_user"],

                );
                $ra1= Q::get($sl, $pr, 1);

                $ra1 = Yii::$app->db->createCommand('SELECT * FROM user')->queryAll();





                if ($ra1)

                {

                    $rr=$ra1;



                    $data=strtotime($r["date"]);



                    $data1=strtotime($r["date"]);


                    $sl = "select distinct on (p.id) p.*,pe.id as peid, pe.name as pename from price p left join price_center pc on p.id=pc.id_price left join price_element pe on pc.id_elem=pe.id where p.id=:id ".($r["id_elem"]!=0?"and pe.id=:id_elem":" and (pe.id=0 or pe.id is null)")." ";
                    $pr = array(
                        'id'=>$r["id_price"],

                    );

                    if ($r["id_elem"]!=0){
                        $pr["id_elem"] = $r["id_elem"];
                    }
                    $ra1= Q::get($sl, $pr, 1);



                    $rrr=$ra1;



                    $data_time=strtotime(date("Y-m-d H:i:s",$data));

                    $data_time1=strtotime(date("Y-m-d H:i:s",$data1));


                    if ($r["bron"]==1){
                        $arr_user[]=array('id'=>$r["id"],'title' => "".$rr["surname"]." ".$rr["name"]." - ".$rrr["name"]." ".$r["bron_fio"],'start' => date("Y-m-d H:i:s",$data),'end' => date("Y-m-d H:i:s",$data1),'data_start'=>$data_time,'data_end'=>$data_time1, "data"=>$r["date"], "who"=>'Записал: '.$r["who"],"bron"=>1,"vremya"=>$r["d_regis"], "id_pacient"=>$rr["id"], "data_pred"=>$r["data_pred"]);
                    }else{
                        $arr_user[]=array('id'=>$r["id"],'title' => "".$rr["surname"]." ".$rr["name"]." - ".$rrr["name"].". ".$rrr["pename"],'start' => date("Y-m-d H:i:s",$data),'end' => date("Y-m-d H:i:s",$data1),'data_start'=>$data_time,'data_end'=>$data_time1, "data"=>$r["date"],"who"=>'Записал: '.$r["who"],"bron"=>0,"vremya"=>$r["d_regis"], "id_pacient"=>$rr["id"], "data_pred"=>$r["data_pred"]);
                    }

                }

            }



        }









        echo '

<style>



.week_calendar{ border-collapse:collapse; width:100%}



.week_calendar td{ padding:5px; width:12.5%}



</style>

<div style="padding-right:0px;">

<table border="1" class="week_calendar"><tr style=" background:#a6a6a6" class="trnot">

<td colspan="8" align="center"><a href="'.Url::to(['site/calendar', 'week' => date("Y-m-d", mktime(0,0,0,$month,$day-7,$year))]).'" style="float:left; color:#fff" class="btn btn-mini btn-success">Назад</a>'.$begin_text.' - '.$end_text.'	

<a href="'.Url::to(['site/calendar', 'week' => date("Y-m-d", mktime(0,0,0,$month,$day+7,$year))]).'" style="float:right; color:#fff" class="btn btn-mini btn-success">Вперед</a></tr>

<tr style="background:#bfbfbf" class="trnot">

<td align="center">День/Время</td>

';



        $arr_day = array();



        for ($i=1; $i<=7; $i++)

        {

            $begin_day1[2]=($begin_day<10?'0'.$begin_day.'':''.$begin_day.'');
            $begin_day1[1]=($begin_day1[1]<10?'0'.($begin_day1[1]+0):$begin_day1[1]);


            $arr_day[$i]=implode('-',$begin_day1);



            echo '<td align="center">'.($begin_day<10?'0'.$begin_day.'':''.$begin_day.'').'  '.$shot_month[($begin_day1[1]<10?'0':'').($begin_day1[1]+0)].' ('.$day_week[$i].') </td>';



            $begin_day = $begin_day+1;



            if (!checkdate($begin_day1[1], $begin_day, $begin_day1[0])){

                $begin_day=1;



                $begin_day1[1]=$begin_day1[1]+1;



                if ($begin_day1[1]>12)

                {

                    $begin_day1[1]='01';

                    $begin_day1[0]=$begin_day1[0]+1;

                }



            }



        }



        echo '</tr></table>

</div>

<div style="width:100%; height:1560px; ">

<table border="1" class="week_calendar"><tr style=" background:#0599E1">';



        $h=1;

        $period = 48;

        $ra = Yii::$app->db->createCommand('SELECT * FROM user where id=2')->queryOne();

        $rus = $ra;

        if ($rus["priem"]==15) $period = 96;
        if ($rus["priem"]==10) $period = 144;
        if ($rus["priem"]==5) $period = 288;

//echo $period;

        for ($i=0; $i<$period; $i++)

        {


            if ($period==96){
                $ch=floor($i/4);

                echo '<tr class="tr'.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').'_00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').'_15':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').'_30':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').'_45':'').'"><td style=" background:#bfbfbf" align="right">'.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':15':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':45':'').'</td>';
            }else  if ($period==144){
                $ch=floor($i/6);

                //echo $ch;

                echo '<tr class="tr'.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').'_00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').'_10':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').'_20':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').'_30':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').'_40':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').'_50':'').'"><td style=" background:#bfbfbf" align="right">'.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':10':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':20':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').':40':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').':50':'').'</td>';
            }else if ($period==288){
                $ch=floor($i/12);

                //echo $ch;

                echo '<tr class="tr'.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').'_00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').'_05':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').'_10':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').'_15':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').'_20':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').'_25':'').''.($h==7?''.($ch<10?'0'.$ch.'':''.$ch.'').'_30':'').''.($h==8?''.($ch<10?'0'.$ch.'':''.$ch.'').'_35':'').''.($h==9?''.($ch<10?'0'.$ch.'':''.$ch.'').'_40':'').''.($h==10?''.($ch<10?'0'.$ch.'':''.$ch.'').'_45':'').''.($h==11?''.($ch<10?'0'.$ch.'':''.$ch.'').'_50':'').''.($h==12?''.($ch<10?'0'.$ch.'':''.$ch.'').'_55':'').'"><td style=" background:#bfbfbf" align="right">'.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':05':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':10':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':15':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').':20':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').':25':'').''.($h==7?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==8?''.($ch<10?'0'.$ch.'':''.$ch.'').':35':'').''.($h==9?''.($ch<10?'0'.$ch.'':''.$ch.'').':40':'').''.($h==10?''.($ch<10?'0'.$ch.'':''.$ch.'').':45':'').''.($h==11?''.($ch<10?'0'.$ch.'':''.$ch.'').':50':'').''.($h==12?''.($ch<10?'0'.$ch.'':''.$ch.'').':55':'').'</td>';
            }else{
                $ch=floor($i/2);

                echo '<tr class="tr'.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').'_00':''.($ch<10?'0'.$ch.'':''.$ch.'').'_30').'"><td style=" background:#bfbfbf" align="right">'.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':''.($ch<10?'0'.$ch.'':''.$ch.'').':30').'</td>';
            }
            //echo '<pre>';
            //print_r($arr_day);
            //echo '</pre>';
            for ($j=1;$j<=7;$j++)

            {

                $da=0;

                $new_data=array();

                $new_data_user=array();
                if (isset($arr_false))
                    foreach($arr_false as $k=>$v)

                    {
                        //vd($v);

                        if ($arr_day[$j]==$v["data"])

                        {

                            $da=1;



                            $new_data = $v;







                        }

                    }



                if ($da==1)

                {



                    if ($period==96){
                        $str=strtotime($arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':15':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':45':'').':00');


                        $class = '';
                        if (($new_data["data_startobed"]>0 && $new_data["data_endobed"]>0)){
                            if ($str>=$new_data["data_startobed"] && $str<$new_data["data_endobed"]){
                                $class="obed";
                            }
                        }



                        echo '<td rel="'.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':15':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':45':'').':00" class="'.$class.'"  '.($str>=$new_data["data_start"] && $str<=$new_data["data_end"]?''.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'style="background:#ddd"':'').'':'style="background:#ddd"').'>';
                    }else if ($period==144){
                        $str=strtotime($arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':10':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':20':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').':40':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').':50':'').':00');


                        $class = '';
                        if (($new_data["data_startobed"]>0 && $new_data["data_endobed"]>0)){
                            if ($str>=$new_data["data_startobed"] && $str<$new_data["data_endobed"]){
                                $class="obed";
                            }
                        }



                        echo '<td rel="'.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':10':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':20':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').':40':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').':50':'').':00" class="'.$class.'"  '.($str>=$new_data["data_start"] && $str<=$new_data["data_end"]?''.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'style="background:#ddd"':'').'':'style="background:#ddd"').'>';
                    }else if ($period==288){
                        $str=strtotime($arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':05':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':10':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':15':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').':20':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').':25':'').''.($h==7?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==8?''.($ch<10?'0'.$ch.'':''.$ch.'').':35':'').''.($h==9?''.($ch<10?'0'.$ch.'':''.$ch.'').':40':'').''.($h==10?''.($ch<10?'0'.$ch.'':''.$ch.'').':45':'').''.($h==11?''.($ch<10?'0'.$ch.'':''.$ch.'').':50':'').''.($h==12?''.($ch<10?'0'.$ch.'':''.$ch.'').':55':'').':00');


                        $class = '';
                        if (($new_data["data_startobed"]>0 && $new_data["data_endobed"]>0)){
                            if ($str>=$new_data["data_startobed"] && $str<$new_data["data_endobed"]){
                                $class="obed";
                            }
                        }



                        echo '<td rel="'.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':05':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':10':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':15':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').':20':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').':25':'').''.($h==7?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==8?''.($ch<10?'0'.$ch.'':''.$ch.'').':35':'').''.($h==9?''.($ch<10?'0'.$ch.'':''.$ch.'').':40':'').''.($h==10?''.($ch<10?'0'.$ch.'':''.$ch.'').':45':'').''.($h==11?''.($ch<10?'0'.$ch.'':''.$ch.'').':50':'').''.($h==12?''.($ch<10?'0'.$ch.'':''.$ch.'').':55':'').':00" class="'.$class.'"  '.($str>=$new_data["data_start"] && $str<=$new_data["data_end"]?''.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'style="background:#ddd"':'').'':'style="background:#ddd"').'>';
                    }else{

                        $str=strtotime($arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':''.($ch<10?'0'.$ch.'':''.$ch.'').':30').':00');


                        $class = '';
                        if (($new_data["data_startobed"]>0 && $new_data["data_endobed"]>0)){
                            if ($str>=$new_data["data_startobed"] && $str<$new_data["data_endobed"]){
                                $class="obed";
                            }
                        }


                        echo '<td rel="'.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':''.($ch<10?'0'.$ch.'':''.$ch.'').':30').':00" class="'.$class.'" '.($str>=$new_data["data_start"] && $str<=$new_data["data_end"]?''.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'style="background:#ddd"':'').'':'style="background:#ddd"').'>';
                    }



                    if ($str>=$new_data["data_start"] && $str<=$new_data["data_end"])

                    {

                        echo '<div style="margin-left:-5px;margin-top:-13px;padding-left:10px;position:relative;width: 100%; ">';

                        $sd=0;

                        foreach ($arr_user as $k=>$v)

                        {

                            if ($str>=$v["data_start"] && $str<=$v["data_end"])

                            {

                                if ($v["bron"]==1){
                                    echo '<div style="position:absolute;width:100%;height:30px; left:0px; top:-2px; background:red">';
                                    echo '<p style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis; color:#fff; padding:5px; cursor:pointer" title="'.$v["title"].' Время:'.$v["data_pred"].'" '.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'':'onclick="get_pac1('.$v["id"].',\''.$v["start"].'\', \''.$v["who"].'\');"').'>'.$v["title"].'</p>';
                                }else{
                                    echo '<div style="position:absolute;width:100%;height:30px; left:0px; top:-2px; background:green">';
                                    echo '<p style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis; color:#fff; padding:5px; cursor:pointer" title="'.$v["title"].' Время:'.$v["data_pred"].'" '.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'onclick="get_pac223('.$v["id"].',\''.$v["start"].'\', \''.$v["who"].'\', \''.$v["title"].'\', \''.$v["id_pacient"].'\', \''.$v["data_pred"].'\');"':'onclick="get_pac('.$v["id"].',\''.$v["start"].'\', \''.$v["who"].'\', \''.$v["title"].'\', \''.$v["id_pacient"].'\', \''.$v["vremya"].'\', \''.$v["data_pred"].'\');"').'>'.$v["title"].'</p>';
                                }
                                echo '</div>';

                                $sd=1;


                            }

                        }



                        if ($sd==0)

                        {


                            if (($new_data["data_startobed"]>0 && $new_data["data_startobed"]>$str) || ($new_data["data_endobed"]>0 && $new_data["data_endobed"]<=$str)){

                                if ($period==96){

                                    echo '<div style="position:absolute;width:100%;height:25px; text-align:center; vertical-align:middle; left:0px; top:0px;cursor:pointer; '.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'display:none;':'').'">

        <a href="javascript:show_div3('.$_POST["id"].',\''.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':15':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':45':'').':00\')" style="display:block; padding-top:5px; padding-bottom:5px;">&nbsp;</a>

        </div>';

                                }
                                else if ($period==144){

                                    echo '<div style="position:absolute;width:100%;height:25px; text-align:center; vertical-align:middle; left:0px; top:0px;cursor:pointer; '.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'display:none;':'').'">

        <a href="javascript:show_div3('.$_POST["id"].',\''.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':10':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':20':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').':40':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').':50':'').':00\')" style="display:block; padding-top:5px; padding-bottom:5px;">&nbsp;</a>

        </div>';

                                }
                                else if ($period==288){

                                    echo '<div style="position:absolute;width:100%;height:25px; text-align:center; vertical-align:middle; left:0px; top:0px;cursor:pointer; '.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'display:none;':'').'">

        <a href="javascript:show_div3('.$_POST["id"].',\''.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':05':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':10':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':15':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').':20':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').':25':'').''.($h==7?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==8?''.($ch<10?'0'.$ch.'':''.$ch.'').':35':'').''.($h==9?''.($ch<10?'0'.$ch.'':''.$ch.'').':40':'').''.($h==10?''.($ch<10?'0'.$ch.'':''.$ch.'').':45':'').''.($h==11?''.($ch<10?'0'.$ch.'':''.$ch.'').':50':'').''.($h==12?''.($ch<10?'0'.$ch.'':''.$ch.'').':55':'').':00\')" style="display:block; padding-top:5px; padding-bottom:5px;">&nbsp;</a>

        </div>';

                                }
                                else{

                                    echo '<div style="position:absolute;width:100%;height:25px; text-align:center; vertical-align:middle; left:0px; top:0px;cursor:pointer; '.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'display:none;':'').'">

       <a href="javascript:show_div3('.$_POST["id"].',\''.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':''.($ch<10?'0'.$ch.'':''.$ch.'').':30').':00\')" style="display:block; padding-top:5px; padding-bottom:5px;">&nbsp;</a>

       </div>';

                                }

                            }else if($new_data["data_endobed"]==0 && $new_data["data_endobed"]==0){

                                if ($period==96){

                                    echo '<div style="position:absolute;width:100%;height:25px; text-align:center; vertical-align:middle; left:0px; top:0px;cursor:pointer; '.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'display:none;':'').'">

        <a href="javascript:show_div3('.$_POST["id"].',\''.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':15':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':45':'').':00\')" style="display:block; padding-top:5px; padding-bottom:5px;">&nbsp;</a>

        </div>';

                                }
                                else if ($period==144){

                                    echo '<div style="position:absolute;width:100%;height:25px; text-align:center; vertical-align:middle; left:0px; top:0px;cursor:pointer; '.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'display:none;':'').'">

        <a href="javascript:show_div3('.$_POST["id"].',\''.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':10':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':20':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').':40':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').':50':'').':00\')" style="display:block; padding-top:5px; padding-bottom:5px;">&nbsp;</a>

        </div>';

                                }
                                else if ($period==288){

                                    echo '<div style="position:absolute;width:100%;height:25px; text-align:center; vertical-align:middle; left:0px; top:0px;cursor:pointer; '.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'display:none;':'').'">

        <a href="javascript:show_div3('.$_POST["id"].',\''.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':05':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':10':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':15':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').':20':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').':25':'').''.($h==7?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==8?''.($ch<10?'0'.$ch.'':''.$ch.'').':35':'').''.($h==9?''.($ch<10?'0'.$ch.'':''.$ch.'').':40':'').''.($h==10?''.($ch<10?'0'.$ch.'':''.$ch.'').':45':'').''.($h==11?''.($ch<10?'0'.$ch.'':''.$ch.'').':50':'').''.($h==12?''.($ch<10?'0'.$ch.'':''.$ch.'').':55':'').':00\')" style="display:block; padding-top:5px; padding-bottom:5px;">&nbsp;</a>

        </div>';

                                }
                                else{

                                    echo '<div style="position:absolute;width:100%;height:25px; text-align:center; vertical-align:middle; left:0px; top:0px;cursor:pointer; '.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'display:none;':'').'">

       <a href="javascript:show_div3('.$_POST["id"].',\''.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':''.($ch<10?'0'.$ch.'':''.$ch.'').':30').':00\')" style="display:block; padding-top:5px; padding-bottom:5px;">&nbsp;</a>

       </div>';

                                }
                            }

                        }



                        echo'</div>';

                    }



                    echo '</td>';



                }

                else

                {

                    if ($period==96) {
                        $str = strtotime($arr_day[$j] . ' ' . ($h == 1 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':00' : '') . '' . ($h == 2 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':15' : '') . '' . ($h == 3 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':30' : '') . '' . ($h == 4 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':45' : '') . ':00');
                    }else if ($period==144) {
                        $str = strtotime($arr_day[$j] . ' ' . ($h == 1 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':00' : '') . '' . ($h == 2 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':10' : '') . '' . ($h == 3 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':20' : '') . '' . ($h == 4 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':30' : '') . '' . ($h == 5 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':40' : '') . '' . ($h == 6 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':50' : '') . ':00');
                    }else if ($period==288) {
                        $str = strtotime($arr_day[$j] . ' ' . ($h == 1 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':00' : '') . '' . ($h == 2 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':05' : '') . '' . ($h == 3 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':10' : '') . '' . ($h == 4 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':15' : '') . '' . ($h == 5 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':20' : '') . '' . ($h == 6 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':25' : '') . '' . ($h == 7 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':30' : '') . '' . ($h == 8 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':35' : '') . '' . ($h == 9 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':40' : '') . '' . ($h == 10 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':45' : '') . '' . ($h == 11 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':50' : '') . '' . ($h == 12 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':55' : '') . ':00');
                    }else {
                        $str = strtotime($arr_day[$j] . ' ' . ($h == 1 ? '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':00' : '' . ($ch < 10 ? '0' . $ch . '' : '' . $ch . '') . ':30') . ':00');
                    }
                    if ($period==96){
                        echo '<td rel="'.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':15':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':45':'').':00" style=" background:#ddd" >';
                    }else if ($period==144){
                        echo '<td rel="'.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':10':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':20':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').':40':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').':50':'').':00" style=" background:#ddd" >';

                    }else if ($period==288){
                        echo '<td rel="'.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':'').''.($h==2?''.($ch<10?'0'.$ch.'':''.$ch.'').':05':'').''.($h==3?''.($ch<10?'0'.$ch.'':''.$ch.'').':10':'').''.($h==4?''.($ch<10?'0'.$ch.'':''.$ch.'').':15':'').''.($h==5?''.($ch<10?'0'.$ch.'':''.$ch.'').':20':'').''.($h==6?''.($ch<10?'0'.$ch.'':''.$ch.'').':25':'').''.($h==7?''.($ch<10?'0'.$ch.'':''.$ch.'').':30':'').''.($h==8?''.($ch<10?'0'.$ch.'':''.$ch.'').':35':'').''.($h==9?''.($ch<10?'0'.$ch.'':''.$ch.'').':40':'').''.($h==10?''.($ch<10?'0'.$ch.'':''.$ch.'').':45':'').''.($h==11?''.($ch<10?'0'.$ch.'':''.$ch.'').':50':'').''.($h==12?''.($ch<10?'0'.$ch.'':''.$ch.'').':55':'').':00" style=" background:#ddd" >';

                    }else{
                        echo '<td rel="'.$arr_day[$j].' '.($h==1?''.($ch<10?'0'.$ch.'':''.$ch.'').':00':''.($ch<10?'0'.$ch.'':''.$ch.'').':30').':00" style=" background:#ddd" >';
                    }

                    echo '<div style="margin-left:-5px;margin-top:-13px;padding-left:10px;position:relative;width: 100%; ">';
                    foreach ($arr_user as $k=>$v)
                    {
                        if ($str>=$v["data_start"] && $str<=$v["data_end"]){
                            if ($v["bron"]==1){
                                echo '<div style="position:absolute;width:100%;height:30px; left:0px; top:-2px; background:red">';
                                echo '<p style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis; color:#fff; padding:5px; cursor:pointer" title="'.$v["title"].' Время:'.$v["vremya"].'" '.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'':'onclick="get_pac1('.$v["id"].',\''.$v["start"].'\', \''.$v["who"].'\');"').'>'.$v["title"].'</p>';
                            }else{
                                echo '<div style="position:absolute;width:100%;height:30px; left:0px; top:-2px; background:blue">';
                                echo '<p style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis; color:#fff; padding:5px; cursor:pointer" title="'.$v["title"].','.$v["who"].' Время:'.$v["vremya"].'" '.(strtotime(date("Y-m-d"))>strtotime($arr_day[$j])?'':'onclick="get_pac223('.$v["id"].',\''.$v["start"].'\', \''.$v["who"].'\', \''.$v["title"].'\', \''.$v["id_pacient"].'\', \''.$v["data_pred"].'\');"').'>'.$v["title"].'</p>';
                            }

                            echo '</div>';}

                    }
                    echo '</div>';
                    echo '</td>';

                }









            }



            echo '</tr>';


            if ($period==96){
                if ($h==4) $h=0;
            }else if ($period==144){
                if ($h==6) $h=0;
            }else if ($period==288){
                if ($h==12) $h=0;
            }else{
                if ($h==2) $h=0;
            }




            $h++;

        }







        echo '</tr></table></div>';







    }

}