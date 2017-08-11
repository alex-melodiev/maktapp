<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\StudentForm */

$this->title = Yii::t('frontend', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'classes' => $classes,
    ]) ?>

</div>
