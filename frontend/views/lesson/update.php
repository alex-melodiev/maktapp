<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Lesson */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'Lesson',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="lesson-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'years' => $years,
        'subjects' => $subjects,
        'classes' => $classes,
        'weeks' => $weeks,
        'days' => $days,
        'quarters' => $quarters,
        'timingtypes' => $timingtypes,
        'teachers' => $teachers,
    ]) ?>

</div>
