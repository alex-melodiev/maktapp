<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LessonData */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Lesson Data',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Lesson Datas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="lesson-data-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
