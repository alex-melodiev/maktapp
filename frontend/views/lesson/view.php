<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Lesson */
/* @var $prevLesson common\models\Lesson */
/* @var $nextLesson common\models\Lesson */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('frontend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('frontend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('frontend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="lesson-navigation mb-30px">
        <div class="row">
            <div class="col-sm-3">
                <a href="<?php
                if(isset($prevLesson)){
                    echo \yii\helpers\Url::to(['lesson/'.$prevLesson->id]);
                }
                 ?>" class="prev-lesson">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <div class="pl-text">
                        <span class="p-text">Предыдущий урок</span>
                        <span class="p-lesson"><? if(isset($prevLesson)){ echo $prevLesson->getSubjectName(); }else echo '-';  ?></span>
                    </div><!--pl-text-->
                </a><!--prev-lesson-->
            </div><!--col-sm-3-->
            <div class="col-sm-6">
                <div class="lesson-date">
                    <div class="text-center">
                        Сегодня: <span><?= date("d.m.Y") ?></span>
                    </div><!--text-center-->
                </div><!--lesson-date-->
            </div>
            <div class="col-sm-3">
                <a href="<? if(isset($nextLesson)){ echo \yii\helpers\Url::to(['lesson/'.$nextLesson->id]); } ?>" class="next-lesson">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <div class="pl-text">
                        <span class="p-text">Следующий урок</span>
                        <span class="p-lesson"><? if(isset($nextLesson)){ echo $nextLesson->getSubjectName(); } else echo '-'; ?></span>
                    </div><!--pl-text-->
                </a><!--prev-lesson-->
            </div><!--col-sm-3-->
        </div><!--row-->
    </div><!--lesson-navigation-->
    <div class="text-center">
        <h1 class="mb-50px"><?= \common\models\Subject::findOne(['id' => $model->subject_id])->name ?></h1>
    </div><!--text-center-->
    <div class="row mb-60px">
        <div class="col-sm-offset-3 col-sm-6">
            <div class="row">
                <div class="col-sm-4">
                    <div class="white-block">
                        <div class="wb-info">Класс</div>
                        <div class="wb-title"><?= $model->getclassName() ?></div>
                    </div><!--white-block-->
                </div><!--col-sm-4-->
                <div class="col-sm-4">
                    <div class="white-block">
                        <div class="wb-info">Время</div>
                        <div class="wb-title"><?= \common\models\TimingType::findOne(['id' => $model->timing_id ])->start_time; //date('H:i', time()) ?></div>
                    </div><!--white-block-->
                </div><!--col-sm-4-->
                <div class="col-sm-4">
                    <div class="white-block">
                        <div class="wb-info">День</div>
                        <div class="wb-title"><?= $model->getDay() ?></div>
                    </div><!--white-block-->
                </div><!--col-sm-4-->
            </div><!--row-->
        </div><!--col-sm-6-->
    </div><!--row-->
    <div class="text-center">
        <a href="#" class="btn btn-green">Начать урок</a>
    </div><!--text-center-->

</div>
