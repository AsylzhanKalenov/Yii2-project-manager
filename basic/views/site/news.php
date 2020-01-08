<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'News';
//$this->params['breadcrumbs'][] = $this->title;
?>


<!--<div class="addNewsblock">-->
<!--    <input type="text" class="name" placeholder="Название новости"><br>-->
<!--    <textarea name="content" id="content" cols="100" rows="5"></textarea>-->
<!--    <br>-->
<!--    <input type="button" class="addNews btn btn-default" value="Add news">-->
<!--    <input type="file" name="f" class="photo">-->
<!---->
<!--</div>-->
<? if(Yii::$app->user->identity->idAdmin!=0){ ?>
<div class="addNewsblock">
<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
<div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'class'=>'form-control']) ?>

        </div><div class="col-md-9">

            <?= $form->field($model, 'content')->textarea([  'rows' => '46', 'col'=>'50']) ?>

        </div>
        <div class="col-md-5">

            <?= $form->field($model, 'img')->fileInput([ 'class'=>'form-control']) ?>
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            <!--                <input type="reset" class="btn btn-default" value="Выйти">-->

        </div>

</div>
<?php ActiveForm::end(); ?>
</div>
<? } ?>

<ul id="gtco-post-list">
    <?php
    $news = \app\models\INews::find()->where(['id_company'=>Yii::$app->user->identity->id_company])->all();

    foreach ($news as $s){
        $date = explode(' ',$s["date"]);
        $date1 = date('Y-m-d');
//        $day = intval($date1[2])-intval($date[2])==0?0:intval($date1[2])-intval($date[2]);
        $user=\app\models\User::find()->where(['id'=>$s["id_who"]])->one();
    ?>
    <li class="full entry animate-box" data-animate-effect="fadeIn">
        <a href="single.html">
            <div class="entry-img" style="background-image: url(/basic/web/uploads/<?=$s["img"]?>)"></div>

            <div class="entry-desc">
                <h3><?=$s["name"]?></h3>
                <p><?=$s["content"]?></p>
            </div>
        </a>
        <a href="#" class="post-meta">Published by: <?=$user["surname"].' '.$user["name"]?>  <span class="date-posted">in <?=$date[0]==$date1?$date[1]:$date[0]?></span></a>
    </li>
    <?
    }
    ?>
</ul>
<script>
    $('.addNews').on('click', function(){
        var data = 'do=add_news&name='+$('.name').val()+'&content='+$('#content').val()+'&img='+$('.photo').val();


        $.ajax({
            url: 'index.php?r=site/news',
            type: 'POST',
            data: data,
            success: function(res){
                $('#test').append(res);
                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });
        return false;
    });
</script>