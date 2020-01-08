<?
class Q{

//    public function __construct(){
//
//    }
//
//    public static function get($sql, $array, $one=0){
//        global $pdo;
//        $rs = $pdo->prepare($sql);
//        if (stripos($sql, ':from')){
//            $rs->bindValue(":from", $array['from'], PDO::PARAM_INT);
//            //unset ($array['from']);
//        }
//        if (stripos($sql, ':to')){
//            $rs->bindValue(":to", $array['to'], PDO::PARAM_INT);
//            //unset ($array['to']);
//        }
//        //vd($array);
//        $rs->execute(sizeof($array)>0?$array:NULL);
//        if (stripos($sql, 'count')){
//            //echo $sql.'<br /><br />';
//            //print_r($array);
//            //echo '<br /><br />';
//            //print_r($pdo->errorInfo());
//            //echo '<br />END2<br />';
//            return $rs->fetchColumn();
//        }else{
//
//            //echo $sql.'<br /><br />';
//            //print_r($array);
//            //echo '<br /><br />';
//            //print_r($pdo->errorInfo());
//            //echo '<br />END1<br />';
//            return $one==0?$rs->fetchAll(PDO::FETCH_ASSOC):$rs->fetch(PDO::FETCH_LAZY);
//        }
//    }
//
//    public static function query($sql, $array=array(), $one=0){
//        global $pdo;
//        $rs = $pdo->prepare($sql);
//        if (stripos($sql, ':from')){
//            $rs->bindValue(":from", $array['from'], PDO::PARAM_INT);
//            //unset ($array['from']);
//        }
//        if (stripos($sql, ':to')){
//            $rs->bindValue(":to", $array['to'], PDO::PARAM_INT);
//            //unset ($array['to']);
//        }
//        //vd($array);
//        $rs->execute(sizeof($array)>0?$array:NULL);
//        if (stripos($sql, 'count')){
//            //echo $sql.'<br /><br />';
//            //print_r($array);
//            //echo '<br /><br />';
//            //print_r($pdo->errorInfo());
//            //echo '<br />END2<br />';
//            return $rs->fetchColumn();
//        }else{
//
//            //echo $sql.'<br /><br />';
//            //print_r($array);
//            //echo '<br /><br />';
//            //print_r($pdo->errorInfo());
//            //echo '<br />END1<br />';
//            return $one==0?$rs->fetchAll(PDO::FETCH_ASSOC):$rs->fetch(PDO::FETCH_LAZY);
//        }
//    }
//
//    public static function get_not_count($sql, $array, $one=0){
//        global $pdo;
//        $rs = $pdo->prepare($sql);
//        if (stripos($sql, ':from')){
//            $rs->bindValue(":from", $array['from'], PDO::PARAM_INT);
//            //unset ($array['from']);
//        }
//        if (stripos($sql, ':to')){
//            $rs->bindValue(":to", $array['to'], PDO::PARAM_INT);
//            //unset ($array['to']);
//        }
//
//        $rs->execute(sizeof($array)>0?$array:NULL);
//        //echo $sql.'<br /><br />';
//        //print_r($array);
//        //echo '<br /><br />';
//        //print_r($pdo->errorInfo());
//        //echo '<br />END<br />';
//        return $one==0?$rs->fetchAll(PDO::FETCH_ASSOC):$rs->fetch(PDO::FETCH_LAZY);
//
//    }
//
//    public static function insert($sql, $array){
//        global $pdo;
//        $rs = $pdo->prepare($sql);
//        $rs->execute(sizeof($array)>0?$array:NULL);
//        //echo $sql.'<br /><br />';
//        //print_r($array);
//        //echo '<br /><br />';
//        //print_r($pdo->errorInfo());
//        //echo '<br />END3<br />';
//        return self::lastId($sql);
//    }
//
//    public static function insertDebug($sql, $array){
//        global $pdo;
//        $rs = $pdo->prepare($sql);
//        $rs->execute(sizeof($array)>0?$array:NULL);
//        echo $sql.'<br /><br />';
//        print_r($array);
//        echo '<br /><br />';
//        print_r($pdo->errorInfo());
//        echo '<br />END3<br />';
//        return self::lastId($sql);
//    }
//
//    public static function lastId($sql){
//        global $pdo;
//        $sql1 = explode('into ', $sql);
//        if (@$sql1[1]==''){
//            $sql1 = explode('INTO ', $sql);
//            if (@$sql1[1]==''){
//                $sql1 = explode('Into ', $sql);
//            }
//        }
//
//        if (@$sql1[1]==''){
//            return 'error';
//        }else{
//            $t = explode(' ', trim($sql1[1]));
//            $table = trim($t[0]);
//        }
//
//        if ($table){
//            $rs = $pdo->prepare("select max(id) from ".$table);
//            $rs->execute(NULL);
//            return $rs->fetchColumn();
//        }else{
//            return 'no table';
//        }
//    }
}

class Strings {

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
                    '08'=>'қазан',
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
            $date 		= explode('-', $date_time[0]);
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


    # Стоимость
    public function coast($str, $act='to')
    {
        $new_str = $str;

        # В
        if ($act == 'to')
        {
            if (strlen($str) > 3)
            {
                $u=0;
                $money_coast = '';
                for($i=strlen($str); $i>=0; $i--)
                {
                    $money_coast = substr($str, $i, 1).$money_coast;
                    if ($u == 3) { $money_coast = ' '.$money_coast; $u=0; }
                    $u++;
                }

                $new_str = $money_coast;
            }
        }

        # Из
        if ($act == 'from')
        {
            $new_str = eregi_replace(' ', $str);
        }

        return $new_str;
    }


    # MIME
    public function mime($str, $data_charset='utf-8', $send_charset='utf-8')
    {
        if($data_charset != $send_charset)
        {
            $str = iconv($data_charset, $send_charset, $str);
        }

        return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
    }


}
