<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentForm */
/* @var $form yii\widgets\ActiveForm */
/* @var $classes Array */
?>

<div class="user-form">

    <? print_r($classes); ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'middlename')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class_id')->dropDownList($classes) ?>

    <?php echo $form->field($model, 'password')->passwordInput() ?>
    <?php echo $form->field($model, 'status')->dropDownList(\common\models\User::statuses()) ?>


    <div class="form-group">
        <?= Html::submitButton( Yii::t('frontend', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
