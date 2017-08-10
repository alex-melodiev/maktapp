<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LessonData */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Lesson Data',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Lesson Datas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-data-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
