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

    <?= $form->field($model, 'timing_id')->dropDownList(\yii\helpers\ArrayHelper::map($timingtypes, 'id', 'start_time')) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
