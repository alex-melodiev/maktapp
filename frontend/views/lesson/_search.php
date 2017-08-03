<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LessonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lesson-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'academic_year_id') ?>

    <?= $form->field($model, 'subject_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'class_id') ?>

    <?php // echo $form->field($model, 'quarter_id') ?>

    <?php // echo $form->field($model, 'timing_id') ?>

    <?php // echo $form->field($model, 'teacher_id') ?>

    <?php // echo $form->field($model, 'school_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
