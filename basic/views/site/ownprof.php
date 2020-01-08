<?php
$pos = Yii::$app->user->identity->surname;

$prof = \app\models\User::find()->where(['id'=>$_GET["id_pr"]])->one();
$pos1 = $prof["idAdmin"]==0?'Employee':'Administrator';

?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<div class="container">
        <div class="user-profile">
            <input type="hidden" id="who" value="<?=Yii::$app->user->identity->id?>">
            <input type="hidden" id="place" value="<?=$prof["id"]?>">

                <div class="row">

                    <div class="col-3">
                        <div class="user-profile-image">
                            <img src="/basic/web/uploads/<?=$prof["image"]?>">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="user-profile-info">
                            <div class="user-profile-info-name">Name: <?=$prof["name"]?></div>
                            <div class="user-profile-info-surname">Surname: <?=$prof["surname"]?></div>
                            <div class="user-profile-info-birthday"></div>
                            <div class="user-profile-info-role">Position: <?=$pos1?></div>
                            <div class="user-profile-info-mail">Email: <?=$prof["email"]?></div>
                        </div>
                    </div>


                    <div class="col-12" style="margin-top: 3%;">

                        <input type="text" class="form-control" id="comtext" style="width: 60%; border: none; border-bottom: 1px solid darkgrey;" placeholder="Your comments...">
                        <input type="button" class="btn btn-primary" value="Add comment" style="margin-top:10px;" onclick="addCommen2()">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>User Comment Example</h3>
                                </div><!-- /col-sm-12 -->
                            </div><!-- /row -->
                    <div class="row">
                        <div class="comment" style="width: 100%;">
                            <?
                            $com = \app\models\IComments::find()->where(['id_place'=>$prof["id"]])->andWhere(['and', ['place'=>'profile']])->orderBy('date ASC')->all();
                            foreach ($com as $c){
                                $us = \app\models\User::find()->where(['id'=>$c["id_who"]])->one();
                            ?>

                            <div class="combl">
                                <div class="col-sm-1">
                                    <div class="thumbnail">
                                        <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                    </div><!-- /thumbnail -->
                                </div><!-- /col-sm-1 -->

                                <div class="col-sm-11">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <strong><?=$us["surname"].' '.$us["name"]?></strong> <span class="text-muted"><?=$c["date"]?></span>
                                        </div>
                                        <div class="panel-body">
                                            <?=$c["content"]?>
                                        </div><!-- /panel-body -->
                                    </div><!-- /panel panel-default -->
                                </div><!-- /col-sm-5 -->
                            </div>

                            <? } ?>
                        </div>
                            <!-- /col-sm-5 -->
                    </div><!-- /row -->

                    </div>
</div>
</div>

</div>
<script type="application/javascript">


    function addCommen2() {
        var pl = 'profile';
        var data = 'do=add_comment&id_w='+$('#who').val()+'&id_pl='+$('#place').val()+'&place='+pl+'&content='+$('#comtext').val();


        $.ajax({
            url: 'index.php?r=site/ownprof',
            type: 'POST',
            data: data,
            success: function(res){
                $('.comment').prepend(res);
            },
            error: function(){
                alert('showEdit!');
            }
        });
    }
</script>




