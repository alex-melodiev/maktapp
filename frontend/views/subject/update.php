<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subject */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'Subject',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="subject-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
