<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lesson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lesson-form">

    <?php $form = ActiveForm::begin(); ?>

    <? var_dump( $model->getErrors() );?>

    <?= $form->field($model, 'academic_year_id')->dropDownList(\yii\helpers\ArrayHelper::map($years, 'id', 'start_year')) ?>

    <?= $form->field($model, 'subject_id')->dropDownList(\yii\helpers\ArrayHelper::map($subjects, 'id', 'name')) ?>

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
