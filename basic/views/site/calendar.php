<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use app\models\ContactForm;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Contact';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">


    <?php


        if (isset($_GET["week"])) $date=$_GET["week"];

        else $date=date("Y-m-d");
        $cal= new Calendar();



        $cal->get_week_calendar($_POST["id"],$date);

        ?>


</div>
