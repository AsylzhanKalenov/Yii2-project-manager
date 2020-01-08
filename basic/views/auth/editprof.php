<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="container">
    <h1>Edit Profile</h1>
    <hr>
    <div class="row">

<!--        <div class="col-md-3">-->
<!--            <div class="text-center avatar-placeholder">-->
<!--                <img src="assets/img/avatar-placeholder.png" class="avatar img-circle" alt="avatar">-->
<!--                <h6>Загрузите вашу фотаграфию</h6>-->
<!---->
<!--                <input id="put_image" type="file" class="form-control">-->
<!--            </div>-->
<!--        </div>-->


        <div class="col-md-12 personal-info">
            <div class="alert alert-info alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a>
                <i class="fa fa-coffee"></i>
                Какая-нибудь инфа (Можно убрать)
            </div>
            <h3>Персональная информация</h3>

<!--            <form class="form-horizontal" role="form">-->
<!--                <div class="form-group">-->
<!--                    <label class="col-lg-3 control-label">Имя:</label>-->
<!--                    <div class="col-lg-8">-->
<!--                        <input class="form-control" type="text" value="--><?//=Yii::$app->user->identity->name?><!--">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label class="col-lg-3 control-label">Фамилия:</label>-->
<!--                    <div class="col-lg-8">-->
<!--                        <input class="form-control" type="text" value="--><?//=Yii::$app->user->identity->surname?><!--">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label class="col-lg-3 control-label">Email:</label>-->
<!--                    <div class="col-lg-8">-->
<!--                        <input class="form-control" type="text" value="--><?//=Yii::$app->user->identity->email?><!--">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label class="col-md-3 control-label">Username:</label>-->
<!--                    <div class="col-md-8">-->
<!--                        <input class="form-control" type="text" value="--><?//=Yii::$app->user->identity->username?><!--">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label class="col-md-3 control-label">Пароль:</label>-->
<!--                    <div class="col-md-8">-->
<!--                        <input class="form-control" type="password" value="11111122333">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label class="col-md-3 control-label">Подтвердите пароль:</label>-->
<!--                    <div class="col-md-8">-->
<!--                        <input class="form-control" type="password" value="11111122333">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label class="col-md-3 control-label"></label>-->
<!--                    <div class="col-md-8">-->
<!--                        <input type="button" class="btn btn-primary" value="Сохранить">-->
<!--                        <span></span>-->
<!--                        <input type="reset" class="btn btn-default" value="Выйти">-->
<!--                    </div>-->
<!--                </div>-->
<!--            </form>-->


            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <div class="row">

            <div class="col-md-3">
                <img src="/basic/web/uploads/<?=Yii::$app->user->identity->image?>" style="margin-top:20px; height: 150px;" class="avatar img-circle" alt="avatar">

                <?= $form->field($model, 'image')->fileInput([ 'class'=>'form-control']) ?>
            </div>
            <div class="col-md-9">
            <div class="form-group">
            <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'class'=>'form-control', 'value'=>Yii::$app->user->identity->name]) ?>
            </div>
            <div class="form-group">
            <?= $form->field($model, 'surname')->textInput(['class'=>'form-control', 'value'=>Yii::$app->user->identity->surname]) ?>
            </div>
            <div class="form-group">
            <?= $form->field($model, 'email')->textInput(['class'=>'form-control', 'value'=>Yii::$app->user->identity->email]) ?>
            </div>


            <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['class'=>'form-control', 'value'=>Yii::$app->user->identity->username]) ?>
            <?= $form->field($model, 'password')->hiddenInput(['class'=>'form-control', 'value'=>Yii::$app->user->identity->password])->label(false) ?>

            </div>
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
<!--                <input type="reset" class="btn btn-default" value="Выйти">-->
                <?= Html::a('Go back', ['site/profile'], ['class' => 'btn btn-default']) ?>

            </div>
            </div>
            </div>
            <?php ActiveForm::end(); ?>




        </div>
    </div>
</div>

