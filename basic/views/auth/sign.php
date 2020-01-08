<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use app\models\LoginForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="sign-in">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="images/workshop-si.png" alt="sing up image"></figure>
                <a href="signup.html" class="signup-image-link">Have your company?</a>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Sign in</h2>
<!--                <form method="POST" class="register-form" id="login-form">-->
<!--                    <div class="form-group">-->
<!--                        <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>-->
<!--                        <input type="text" name="your_name" id="your_name" placeholder="Your Login"/>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>-->
<!--                        <input type="password" name="your_pass" id="your_pass" placeholder="Password"/>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />-->
<!--                        <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>-->
<!--                    </div>-->
<!--                    <div class="form-group form-button">-->
<!--                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>-->
<!--                    </div>-->
<!--                </form>-->
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-1 control-label'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'name'=>'your_name', 'id'=>'your_name']) ?>

                    <?= $form->field($model, 'password')->passwordInput( ['autofocus' => true, 'name'=>'your_pass', 'id'=>'your_pass']) ?>

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ]) ?>

                    <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-11">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary form-submit', 'name' => 'signin', 'id'=>'signin']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <!--    <a href="--><?//=Url::toRoute('site/registr');?><!--">Registration</a>-->
                    <?= Html::a('Registration', ['auth/registr'], ['class' => 'btn btn-warning']) ?>





            </div>
        </div>
</section>