<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LessonData */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="lesson-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'student_id')->textInput() ?>

    <?php echo $form->field($model, 'lesson_id')->textInput() ?>

    <?php echo $form->field($model, 'presence')->textInput() ?>

    <?php echo $form->field($model, 'homework_mark')->textInput() ?>

    <?php echo $form->field($model, 'homework_note')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'additional_mark')->textInput() ?>

    <?php echo $form->field($model, 'additional_note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
