<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Quarter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quarter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd']) ?>

    <?= $form->field($model, 'end_date')->widget(\yii\jui\DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd']) ?>

    <?= $form->field($model, 'academic_year_id')->dropDownList(\yii\helpers\ArrayHelper::map($years, 'id', 'start_year')) ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
