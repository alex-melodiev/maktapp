<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Users'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'classes' => $classes
    ]) ?>

</div>
