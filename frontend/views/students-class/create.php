<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StudentsClass */

$this->title = Yii::t('frontend', 'Create Students Class');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Students Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
