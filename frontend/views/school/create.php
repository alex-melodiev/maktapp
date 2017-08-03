<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\School */

$this->title = Yii::t('frontend', 'Create School');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Schools'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
