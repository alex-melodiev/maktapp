<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Lesson */

$this->title = Yii::t('frontend', 'Create Lesson');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-create">

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
