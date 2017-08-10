<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LessonDataSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="lesson-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'student_id') ?>

    <?php echo $form->field($model, 'lesson_id') ?>

    <?php echo $form->field($model, 'presence') ?>

    <?php echo $form->field($model, 'homework_mark') ?>

    <?php // echo $form->field($model, 'homework_note') ?>

    <?php // echo $form->field($model, 'additional_mark') ?>

    <?php // echo $form->field($model, 'additional_note') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
