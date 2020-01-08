<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use app\models\ContactForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\web\View;

$this->title = 'Contact';
//$this->params['breadcrumbs'][] = $this->title;

$pr = \app\models\Project::find()->where(['id'=>$_GET["id_pr"]])->one();
$arr = explode(',', $pr["us_access"]);

if(Yii::$app->user->identity->idAdmin!=0){
?>

<div class="addTask" style="display: none; position: absolute; left: 22%; top: 12%; width: 520px; height: 440px; background-color: whitesmoke; z-index: 1000; border: 1px solid #343a40;">
    <input type="hidden" value="<?=$_GET["id_pr"]?>" id="id_pr">
    <table style="margin: 20px; width: 100%; font-size: larger;">

        <tr>
        <td>Name:</td>
        <td style="width: 70%;">
        <input type="text" style="width:250px;" id="name" class="name form-control">
        </td></tr>
        <tr>
        <td>Priority:</td>
        <td style="width: 70%;">
            <select class="form-control" id="description" name="description" style="width: 70%;">
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Small">Small</option>
            </select>
        </td>
        </tr><tr>
        <td>Content:</td>
        <td style="width: 70%;">
        <input type="text" style="width:250px;" id="contentich" class="contentich form-control">
        </td></tr>
        <tr>
            <td>Responsible:</td>
            <td style="width: 70%;">
                <select class="form-control" id="sel1" name="sellist1" style="width: 70%;">
                    <?

                    foreach ($arr as $u) {
                        if ($u != '') {
                            $user = \app\models\User::find()->where(['id' => intval($u)])->one();

                            echo '<option value="' . $user["id"] . '">' . $user["surname"] . ' ' . $user["name"] . '</option>';

                        }
                    }
                    ?>
            </select>
        </td></tr>
        <tr>
        <td>Begin Task:</td>
        <td style="width: 70%;">
        <input type="text" style="width:250px;" id="f4" class="f4 form-control">
        </td>
        </tr>
        <tr>
        <td>End Task:</td>
        <td style="width: 70%;">
        <input type="text" style="width:250px;" id="f5" class="f5 form-control">
        </td>
        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'task btn btn-primary', 'name' => 'contact-button']) ?>

        <input type="button" onclick="closeTask()" value="Cancel" class="btn btn-danger">
    </div>


</div>


<div class="editTask" style="display: none; position: absolute; left: 25%; top: 15%; width: 500px; height: 260px; background-color: whitesmoke; z-index: 1000; border: 1px solid #343a40;">
    <input type="hidden" value="0" id="id_task">

    <table style="margin: 20px; width: 100%;">

        <tr>
            <td>Name:</td>
            <td style="width: 70%;">
                <input type="text" style="width:250px;" id="ename" class="ename">
            </td></tr>
        <tr>
            <td>Description:</td>
            <td style="width: 70%;">
                <input type="text" style="width:250px;" id="edescription" class="edescription" >
            </td>
        </tr><tr>
            <td>Content:</td>
            <td style="width: 70%;">
                <input type="text" style="width:250px;" id="econtentich" class="econtentich">
        </td></tr>
        <tr>
            <td>Begin Task:</td>
            <td style="width: 70%;">
                <input type="text" style="width:250px;" id="ef4" class="ef4">
            </td>
        </tr>
        <tr>
            <td>End Task:</td>
            <td style="width: 70%;">
                <input type="text" style="width:250px;" id="ef5" class="ef5">
            </td>
        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'edittask btn btn-primary', 'name' => 'contact-button']) ?>

        <input type="button" onclick="closeEdit()" value="Cancel" class="btn btn-danger">
    </div>


</div>

<? } ?>
<input type="hidden" id="who" value="<?=Yii::$app->user->identity->id?>">
<input type="hidden" id="place" value="0">
<div class="site-contact" style="position: relative;">
    <? if(Yii::$app->user->identity->idAdmin!=0){
        echo '<button class="btn btn-primary" onclick="addTask()" style="top: 0; right: 20px; z-index: 1000; margin-bottom: 20px;">Add Task</button>';
    } ?>

    <div id="result"></div>

    <div id="test">
        <?
//        $ex = explode('-', $_GET["ym"]);
//        $trr=$ex[0].'-'.(intval($ex[1])-1).'-'.$ex[2];
//        $time1 = date('Y-m-d', $trr);
//        $time=date('Y-m-d H:m:s', mktime(8,0,0, intval($ex[1]), intval($ex[2])-1, intval($ex[0])));
//        $ex = explode(' ', $time);
        $task = \app\models\PrTasks::find()->where(['<=', 'date_start', $_GET["ym1"]])->andWhere(['and',['>=', 'date_end', $_GET["ym"]]])->andWhere(['and',['id_pr'=>$_GET["id_pr"]]])->andWhere(['or', ['id_user'=>Yii::$app->user->identity->id], ['id_who'=>Yii::$app->user->identity->id]])->orderBy('date_end ASC')->all();
        $col =0;
        foreach ($task as $t){
        if($col==2) $col=0;
            $vr = explode(' ',$t["date_end"]);
            $vr1= explode('-', $vr[0]);
            $vr2 = explode('-', $_GET["ym"]);
            $fin = intval($vr1[2])-intval($vr2[2]);

            ?>
            <div class="<?=$t["complete"]==0?'row'.$col:($t["complete"]==1?'rowCom':'rowGrade')?> task-block">
                <div class="task-left-block">
                    <h2>A<?=$t["name"]?>  <?=$t["complete"]==2?' - <span style="color: #e84e4e;">'.$t["grade"].'%</span>':''?> <h2>
                            <p class="priority">priority: <?=$t["description"]?></p>
                            <p class="task-text"><?=$t["content"]?></p>
                            <data>до <time><?=$vr[0]?><time></data>
                </div>
                <div class="task-right-block">
                    <p class="<?=$fin<=3?'due-cl':'due-far'?> due-days"><?=$fin?> days left</p>
                    <div class="btn-group " role="group" aria-label="Basic example">
                        <?if($t["complete"]==1 && $t["id_user"]==Yii::$app->user->identity->id && $t["complete"]!=2){?>
                        <input class="form-control" style="height: 42px; background-color: white; width: 60px; margin-top: -0.3%;" type="text" id="grade" placeholder="%">
                        <button type="button" onclick="gradeTask(<?=$t["id"]?>)" class="btn btn-secondary">Grade</button>
                        <?}?>
                        <?if($t["complete"]==1 && $t["complete"]!=2){?>
                        <button type="button" onclick="uncompleteTask(<?=$t["id"]?>)" class="btn btn-secondary">Uncompleted</button>
                        <?}elseif($t["complete"]!=2){?>
                        <button type="button" onclick="completeTask(<?=$t["id"]?>)" class="btn btn-secondary">Complete</button>
                        <?}?>
                        <? if(Yii::$app->user->identity->idAdmin!=0){ ?>
                        <?if($t["complete"]!=2){?>
                        <button type="button" onclick="editTask(<?=$t["id"]?>)" class="btn btn-secondary">Edit</button>
                        <? } ?>
                            <button type="button" onclick="deleteTask(<?=$t["id"]?>)" class="btn btn-secondary">Delete</button>
                        <? } ?>
                        <button type="button" onclick="showComments('<?=$t["id"]?>')" class="combtn<?=$t["id"]?> btn btn-secondary">Comment</button>
                        <button type="button" onclick="closeComment('<?=$t["id"]?>')" style="display: none;" class="comcl<?=$t["id"]?> btn btn-secondary">Hide</button>

                    </div>
                </div>
                <div class="com<?=$t["id"]?>" style="display: none; overflow-y: scroll; padding: 5px; margin-left: -0.6%; background-color: white; width: 100%; min-height: 300px; border: 1px solid #e6e6e6;">
                    <? $com=\app\models\IComments::find()->where(['and', ['id_place'=>$t["id"], 'place'=>'task']])->all();
                    foreach ($com as $c){
                    $cu =\app\models\User::find()->where(['id'=>$c['id_who']])->one();
                    ?>
                    <div class="combl">

                        <div class="row">
                        <div class="col-1">
                            <div class="thumbnail" style="display: block; padding: 2px; margin-bottom: 20px; width: 75%; line-height: 1.22857143; background-color: #fff; border: 1px solid #ddd; border-radius: 4px;">
                            <img class="img-responsive user-photo" src="/basic/web/uploads/<?=$cu["image"]?>" style="margin-left: 7%; max-width: 85%; height: auto;">
                            </div><!-- /thumbnail -->
                        </div><!-- /col-sm-1 -->

                        <div class="col-sm-11">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong><?= $cu["surname"].' '.$cu["name"] ?></strong> <span class="text-muted"><?=$c["date"] ?></span>
                                </div>
                                <div class="panel-body">
                                    <?= $c["content"] ?>
                                </div><!-- /panel-body -->
                            </div><!-- /panel panel-default -->
                        </div><!-- /col-sm-5 -->
                    </div>


                    </div>

                    <? } ?>
                    <input type="text" class="comtext<?=$t["id"]?> form-control" style="position: absolute; bottom: 20px; width: 60%; border: none; border-bottom: 1px solid darkgrey;" placeholder="Your comments...">

                    <input type="button" class="btn btn-primary" value="Add comment" style="margin-top:10px; position: absolute; bottom: 20px; left: 62%;" onclick="addCommen2(<?=$t["id"]?>)">
                </div>
            </div>

            <?
            $col++;
        }

        ?>

    </div>


    <style>
        #test{
            border: 0.2px solid darkgray;
        }
        .row0{
            background-color: white;
        }
        .row1{
            background-color: gainsboro;
        }
        .rowCom{
            background-color: #ffe88c;
        }
        .rowGrade{
            background-color: lightgreen;
        }
        .due-cl{
            background-color: crimson;
        }
        .due-far{
            background-color: #ffe88c;
        }
        .btn-group{
            position: absolute;
            right: 30px;
            bottom: 10px;
        }
        .due-days{
            position: absolute;
            background-color: #FF6161;
            top:20px;
            right: 30px;
        }
    </style>
    <script>


            function addTask(){
                $('.addTask').show();
            }
            function showEdit(){
                $('.editTask').show();
            }
            function showComments(id){
                $('#place').val(id);
                $('.combtn'+id).hide();
                $('.comcl'+id).show();
                $('.com'+id).show();
            }
            function closeComment(id){
                $('#place').val(id);
                $('.combtn'+id).show();
                $('.comcl'+id).hide();
                $('.com'+id).hide();
            }
            function closeEdit(){
                $('.editTask').hide();
                $('#id_task').val(0);
            }
            function closeTask(){
                $('.addTask').hide();
            }

            function deleteTask(id){
                var data = 'do=delete&id='+id;

                $.ajax({
                    url: 'index.php?r=site/tasks',
                    type: 'POST',
                    data: data,
                    success: function(res){

                        location.reload();
                    },
                    error: function(){
                        alert('Error!');
                    }
                });
                return false;
            }

            function completeTask(id){
                var data = 'do=complete&id='+id;

                $.ajax({
                    url: 'index.php?r=site/tasks',
                    type: 'POST',
                    data: data,
                    success: function(res){

                        location.reload();
                    },
                    error: function(){
                        alert('Error!');
                    }
                });
                return false;
            }
            function uncompleteTask(id){
                var data = 'do=uncomplete&id='+id;

                $.ajax({
                    url: 'index.php?r=site/tasks',
                    type: 'POST',
                    data: data,
                    success: function(res){

                        location.reload();
                    },
                    error: function(){
                        alert('Error!');
                    }
                });
                return false;
            }

            function gradeTask(id){
                if($('#grade').val()==''){
                    alert("Input grade");
                }else {
                    var data = 'do=grade&id=' + id + '&grade=' + $('#grade').val();

                    $.ajax({
                        url: 'index.php?r=site/tasks',
                        type: 'POST',
                        data: data,
                        success: function (res) {

                            location.reload();
                        },
                        error: function () {
                            alert('Error!');
                        }
                    });
                }
                return false;
            }

            function editTask(id){
                var data = 'do=edit_show&id='+id;

                $.ajax({
                    url: 'index.php?r=site/tasks',
                    type: 'POST',
                    data: data,
                    dataType: "JSON",
                    success: function(res){
                        showEdit();
                        $('#id_task').val(res.id);
                        $('#ename').val(res["name"]);
                        $('#edescription').val(res.description);
                        $('#econtentich').val(res.content);
                        $('#ef4').val(res.date_start);
                        $('#ef5').val(res.date_end);
                    },
                    error: function(){
                        alert('showEdit!');
                    }
                });
                return false;
            }

            function addCommen2(id) {
                var pl = 'task';
                if($('#place').val()!=0 && $('.comtext'+id).val()!='') {
                    var data = 'do=add_comment&id_w=' + $('#who').val() + '&id_pl=' + $('#place').val() + '&place=' + pl + '&content=' + $('.comtext' + id).val();


                    $.ajax({
                        url: 'index.php?r=site/ownprof',
                        type: 'POST',
                        data: data,
                        success: function (res) {
                            $('.com'+id).append(res);
                        },
                        error: function () {
                            alert('showEdit!');
                        }
                    });
                }
            }

            function showComment(id){
                var data = 'do=edit_show&id='+id;

                $.ajax({
                    url: 'index.php?r=site/tasks',
                    type: 'POST',
                    data: data,
                    dataType: "JSON",
                    success: function(res){
                        showEdit();
                        $('#id_task').val(res.id);
                        $('#ename').val(res["name"]);
                        $('#edescription').val(res.description);
                        $('#econtentich').val(res.content);
                        $('#ef4').val(res.date_start);
                        $('#ef5').val(res.date_end);
                    },
                    error: function(){
                        alert('showEdit!');
                    }
                });
                return false;
            }

    </script>
        <?php

    $js= <<<JS
        
        $(function(){
            $('#f4').datetimepicker({

                lang:'ru',
                i18n:{
                    ru:{
                        months:[
                            'Январь','Февраль','Март','Апрель',
                            'Май','Июнь','Июль','Август',
                            'Сентябрь','Октябрь','Ноябрь','Декабрь',
                        ],
                        dayOfWeek:[
                            "Вс", "Пн", "Вт", "Ср",
                            "Чт", "Пт", "Сб",
                        ]
                    }
                },
                formatTime:'H:i',
                formatDate:'d.m.Y',
                format:'d.m.Y H:i'
            });
            $('#f5').datetimepicker({

                lang:'ru',
                i18n:{
                    ru:{
                        months:[
                            'Январь','Февраль','Март','Апрель',
                            'Май','Июнь','Июль','Август',
                            'Сентябрь','Октябрь','Ноябрь','Декабрь',
                        ],
                        dayOfWeek:[
                            "Вс", "Пн", "Вт", "Ср",
                            "Чт", "Пт", "Сб",
                        ]
                    }
                },
                formatTime:'H:i',
                formatDate:'d.m.Y',
                format:'d.m.Y H:i'
            });
            
            $('#ef4').datetimepicker({

                lang:'ru',
                i18n:{
                    ru:{
                        months:[
                            'Январь','Февраль','Март','Апрель',
                            'Май','Июнь','Июль','Август',
                            'Сентябрь','Октябрь','Ноябрь','Декабрь',
                        ],
                        dayOfWeek:[
                            "Вс", "Пн", "Вт", "Ср",
                            "Чт", "Пт", "Сб",
                        ]
                    }
                },
                formatTime:'H:i',
                formatDate:'d.m.Y',
                format:'d.m.Y H:i'
            });
            $('#ef5').datetimepicker({

                lang:'ru',
                i18n:{
                    ru:{
                        months:[
                            'Январь','Февраль','Март','Апрель',
                            'Май','Июнь','Июль','Август',
                            'Сентябрь','Октябрь','Ноябрь','Декабрь',
                        ],
                        dayOfWeek:[
                            "Вс", "Пн", "Вт", "Ср",
                            "Чт", "Пт", "Сб",
                        ]
                    }
                },
                formatTime:'H:i',
                formatDate:'d.m.Y',
                format:'d.m.Y H:i'
            });
            
            
        
    
    $('.task').on('click', function(){
       var data = 'do=add_task&name='+$('.name').val()+'&description='+$('#description').val()+'&content='+$('.contentich').val()+'&date_start='+$('.f4').val()+'&date_end='+$('.f5').val()+'&id_pr='+$('#id_pr').val()+'&id_wh='+$('#sel1').val();
        

        $.ajax({
            url: 'index.php?r=site/tasks',
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
    
    $('.edittask').on('click', function(){
       var data = 'do=edit_task&name='+$('.ename').val()+'&description='+$('.edescription').val()+'&content='+$('.econtentich').val()+'&date_start='+$('#ef4').val()+'&date_end='+$('#ef5').val()+'&id_pr='+$('#id_task').val();
        

        $.ajax({
            url: 'index.php?r=site/tasks',
            type: 'POST',
            data: data,
            success: function(res){
                location.reload();
            },
            error: function(){
                alert('Error!');
            }
        });
        return false;
    });
});
JS;

$this->registerJs($js);

    ?>
</div>
