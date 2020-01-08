<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use app\models\Project;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Project';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

        <p>
            If you have business inquiries or other questions, please fill out the following form to contact us.
            Thank you.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

<!--                --><?php
//                $form->field($model, 'date')->textInput(DateTimePicker::widget([
//                    'name' => 'dp_1',
//                    'type' => DateTimePicker::TYPE_INPUT,
//                    'value' => '23-Feb-1982 10:10',
//                    'pluginOptions' => [
//                        'autoclose'=>true,
//                        'format' => 'dd-M-yyyy hh:ii'
//                    ]
//                ]));
//
//                ?>


                <?=
                $form->field($model, 'date_start')->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => 'Enter event time ...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                    ]
                ])?>

                <?=
                $form->field($model, 'date_end')->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => 'Enter event time ...'],
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ])?>


                <?= $form->field($model, 'description') ?>

                <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>


                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>



<!--    --><?php
//
//    $js=<<<JS
//    $(function() {
//
//            $('#s_data1').datetimepicker({
//
//                lang: 'ru',
//                i18n: {
//                    ru: {
//                        months: [
//                            'Январь', 'Февраль', 'Март', 'Апрель',
//                            'Май', 'Июнь', 'Июль', 'Август',
//                            'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь',
//                        ],
//                        dayOfWeek: [
//                            "Вс", "Пн", "Вт", "Ср",
//                            "Чт", "Пт", "Сб",
//                        ]
//                    }
//                },
//                formatTime: 'H:i',
//                formatDate: 'Y-m-d',
//                format: 'Y-m-d H:i'
//            });
//
//            $('#s_data2').datetimepicker({
//
//                lang: 'ru',
//                i18n: {
//                    ru: {
//                        months: [
//                            'Январь', 'Февраль', 'Март', 'Апрель',
//                            'Май', 'Июнь', 'Июль', 'Август',
//                            'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь',
//                        ],
//                        dayOfWeek: [
//                            "Вс", "Пн", "Вт", "Ср",
//                            "Чт", "Пт", "Сб",
//                        ]
//                    }
//                },
//                formatTime: 'H:i',
//                formatDate: 'Y-m-d',
//                format: 'Y-m-d H:i'
//            });
//        })
//
//
//JS;
//
//    $this->registerJs($js);
//
//    ?>
</div>
