<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Lesson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lesson-form">

    <?php $form = ActiveForm::begin(); ?>

    <? var_dump( $model->getErrors() );?>

    <?= $form->field($model, 'academic_year_id')->dropDownList(\yii\helpers\ArrayHelper::map($years, 'id', 'start_year')) ?>

    <?= $form->field($model, 'subject_id')->dropDownList(\yii\helpers\ArrayHelper::map($subjects, 'id', 'name')) ?>

    <?= $form->field($model, 'academic_hours')->input('integer') ?>
    <p>
        Один урок один раз в неделю. Соответственно, количество академ. часов нужно указывать с учетом одного урока в неделю.
        Например, если на урок выделено 20 часов в четверти по 2 урока в неделю, то на один урок при создании нужно указать 20 / 2 = 10 часов.
        На другой день недели нужно создать еще один урок.
    </p>

    <?= $form->field($model, 'lesson_date')->widget(DatePicker::className(),[
        //'value' => date('Y-m-d', strtotime('+2 days')),
        'options' => ['placeholder' => 'Выберите дату первого урока ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd',
            'todayHighlight' => true
        ]
    ] ) ?>
    <?
//    echo '<label>Дата первого урока</label>';
//    echo DatePicker::widget([
//        'model' => $model,
//        'name' => 'lesson_date',
//        //'value' => date('Y-m-d', strtotime('+2 days')),
//        'options' => ['placeholder' => 'Выберите дату первого урока ...'],
//        'pluginOptions' => [
//            'format' => 'yyyy-mm-dd',
//            'todayHighlight' => true
//        ]
//    ]);
    ?>


    <!-- status -->

    <?= $form->field($model, 'class_id')->dropDownList(\yii\helpers\ArrayHelper::map($classes, 'id', 'fullName')) ?>

    <?= $form->field($model, 'quarter_id')->dropDownList(\yii\helpers\ArrayHelper::map($quarters, 'id', 'number')) ?>

    <?= $form->field($model, 'timing_id')->dropDownList(\yii\helpers\ArrayHelper::map($timingtypes, 'id', 'start_time')) ?>

    <?= $form->field($model, 'week_type')->dropDownList(\common\models\Lesson::weeks()) ?>

    <?= $form->field($model, 'day')->dropDownList(\common\models\Lesson::days()) ?>

    <?= $form->field($model, 'teacher_id')->dropDownList(\yii\helpers\ArrayHelper::map($teachers, 'id', 'fullName')) ?>

    <!-- School --->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
