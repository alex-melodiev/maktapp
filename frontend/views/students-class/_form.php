<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StudentsClass */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="students-class-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->dropDownList([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]) ?>

    <?= $form->field($model, 'register')->dropDownList(['А'=>'А', 'Б' => 'Б', 'В' => 'В', 'Г' => 'Г', 'Д' => 'Д', 'Е' => 'Е']) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
