<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use app\models\ContactForm;
use app\models\Project;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

$this->title = 'Company';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?=isset($_GET["id"])?'<h1>'.$_GET["id"].'</h1>':''?>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us.
        Thank you.
    </p>

    <div class="row">
        <div class="col-lg-5">


            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>


            <?= $form->field($model, 'description') ?>

            <?= $form->field($model, 'logo')->fileInput([ 'class'=>'form-control']) ?>


            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
