<?php

use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $model common\models\Lesson */
/* @var $prevLesson common\models\Lesson */
/* @var $nextLesson common\models\Lesson */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$time_exploded = explode(":",\common\models\TimingType::findOne(['id' => $model->timing_id])->start_time);
?>
<div class="lesson-view">

    <h1><? // $students = \common\models\StudentSearch::find()->where(['class_id' => $model->class_id])->all(); var_dump(count($students)); ?></h1>

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
    <? if ($model->status == \common\models\Lesson::PENDING): ?>

    <div class="lesson-navigation mb-30px">
        <div class="row">
            <div class="col-sm-3">
                <a href="<?php
                if (isset($prevLesson)) {
                    echo \yii\helpers\Url::to(['lesson/' . $prevLesson->id]);
                }
                ?>" class="prev-lesson">
                    <span class="glyphicon glyphicon-chevron-left"></span>

                    <div class="pl-text">
                        <span class="p-text">Предыдущий урок</span>
                        <span class="p-lesson"><? if (isset($prevLesson)) {
                                echo $prevLesson->getSubjectName();
                            } else echo '-'; ?></span>
                    </div>
                    <!--pl-text-->
                </a><!--prev-lesson-->
            </div>
            <!--col-sm-3-->
            <div class="col-sm-6">
                <div class="lesson-date">
                    <div class="text-center">
                        Сегодня: <span><?= date("d.m.Y") ?></span>
                    </div>
                    <!--text-center-->
                </div>
                <!--lesson-date-->
            </div>
            <div class="col-sm-3">
                <a href="<? if (isset($nextLesson)) {
                    echo \yii\helpers\Url::to(['lesson/' . $nextLesson->id]);
                } ?>" class="next-lesson">
                    <span class="glyphicon glyphicon-chevron-right"></span>

                    <div class="pl-text">
                        <span class="p-text">Следующий урок</span>
                        <span class="p-lesson"><? if (isset($nextLesson)) {
                                echo $nextLesson->getSubjectName();
                            } else echo '-'; ?></span>
                    </div>
                    <!--pl-text-->
                </a><!--prev-lesson-->
            </div>
            <!--col-sm-3-->
        </div>
        <!--row-->
    </div>
    <!--lesson-navigation-->
    <div class="text-center">
        <h1 class="mb-50px"><?= \common\models\Subject::findOne(['id' => $model->subject_id])->name ?></h1>
    </div>
    <!--text-center-->
    <div class="row mb-60px">
        <div class="col-sm-offset-3 col-sm-6">
            <div class="row">
                <div class="col-sm-4">
                    <div class="white-block">
                        <div class="wb-info">Класс</div>
                        <div class="wb-title"><?= $model->getclassName() ?></div>
                    </div>
                    <!--white-block-->
                </div>
                <!--col-sm-4-->
                <div class="col-sm-4">
                    <div class="white-block">
                        <div class="wb-info">Время</div>
                        <div
                            class="wb-title"><?= $time_exploded[0].":".$time_exploded[1] ?></div>
                    </div>
                    <!--white-block-->
                </div>
                <!--col-sm-4-->
                <div class="col-sm-4">
                    <div class="white-block">
                        <div class="wb-info">День</div>
                        <div class="wb-title"><?=Yii::t('common',$model->getDay()) ?></div>
                    </div>
                    <!--white-block-->
                </div>
                <!--col-sm-4-->
            </div>
            <!--row-->
        </div>
        <!--col-sm-6-->
    </div>
    <!--row-->
    <div class="text-center">
            <a href="<?= \yii\helpers\Url::to(['lesson/start/' . $model->id]) ?>" class="btn btn-green">Начать урок</a>
        </div>
        <!--text-center-->
        <? elseif ($model->status == \common\models\Lesson::CURRENT): ?>


        <div class="list-lesson-info mb-20px">
            <div class="row">
                <div class="col-sm-4">
                    <div class="wb-title"><?= $model->getclassName() ?></div>
                    <div class="lo-id">ID: <?= $model->id ?></div>
                    <p><?//= $prevLesson->homework; ?></p>
                    <? //TODO get true homework of last lesson ?>
                </div><!--col-sm-4-->
                <div class="col-sm-4">
                    <div class="lesson-date mb-10px">
                        <div class="text-center">
                            Сегодня: <span><?= date("d.m.Y") ?></span>
                        </div><!--text-center-->
                    </div>
                    <div class="text-center">
                        <h1><?= \common\models\Subject::findOne(['id' => $model->subject_id])->name ?></h1>
                    </div><!--text-center-->
                </div><!--col-sm-4-->
                <div class="col-sm-4">
                    <a href="<?= \yii\helpers\Url::to(['lesson/end/' . $model->id]) ?>" class="btn btn-default pull-right">Завершить урок</a>
                </div><!--col-sm-4-->
            </div><!--row-->
        </div><!--list-lesson-info-->
        <div class="list-lesson-meta mb-20px">
            <div class="row">
                <div class="col-sm-4">
                    <div class="number-people">Кол-во учеников: <span><?= count($students) ?></span></div>
                </div><!--col-sm-4-->
                <div class="col-sm-4">
                    <div class="evaluation-list">
                        <div class="eval">2</div>
                        <div class="eval">3</div>
                        <div class="eval">4</div>
                        <div class="eval">5</div>
                    </div><!--evaluation-list-->
                </div><!--col-sm-4-->
                <div class="col-sm-4">
                    <div class="text-right">

                        <? //echo $model->homework;
                        echo \kartik\editable\Editable::widget([
                            'name'=>'homework',
                            'asPopover' => false,
                            'inlineSettings' => [
                                'templateBefore' => \kartik\editable\Editable::INLINE_BEFORE_2,
                                'templateAfter' =>  \kartik\editable\Editable::INLINE_AFTER_2
                            ],
                            'valueIfNull' => '<span class="glyphicon glyphicon-plus-sign"></span> Назначить домашнее задание',
                            'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                            'model' => $model,
                            'value' => $model->homework,
                            //'header' => '',
                            'submitOnEnter' => false,
                            'options' => [
                                'class'=>'add-button',
                                'rows'=>5,
                                'style'=>'width:400px',
                                'placeholder'=>'Ввести домашнее задание...'
                            ],
                            'afterInput' => Html::hiddenInput('homework',$model->homework)
                        ]);
                        ?>
                    </div>
                </div><!--col-sm-4-->
            </div><!--row-->
        </div><!--list-lesson-meta-->

            <?

            $gridColumns = [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'class' => 'kartik\grid\DataColumn',
                    'attribute' => 'name',

                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'presence',
                    'vAlign' => 'middle',
                    'headerOptions' => ['class' => 'kv-sticky-column'],
                    'contentOptions' => ['class' => 'kv-sticky-column'],
                    //'threeState'=>false,
                    'editableOptions' => ['header' => 'Presence', 'size' => 'md', 'inputType' => \kartik\editable\Editable::INPUT_CHECKBOX_X, 'asPopover' => false,
                        'displayValueConfig' => [
                            '0' => '<i class="glyphicon glyphicon-minus"></i>',
                            '1' => '<i class="glyphicon glyphicon-plus"></i>',
                        ],
                        //'threeState' => false,
                    ]
                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'homework_mark',
                    'vAlign' => 'middle',
                    'headerOptions' => ['class' => 'kv-sticky-column'],
                    'contentOptions' => ['class' => 'kv-sticky-column'],
                    'editableOptions' => ['header' => 'Mark', 'size' => 'md', 'inputType' => \kartik\editable\Editable::INPUT_SPIN]
                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'homework_note',
                    'vAlign' => 'middle',
                    'headerOptions' => ['class' => 'kv-sticky-column'],
                    'contentOptions' => ['class' => 'kv-sticky-column'],
                    'editableOptions' => ['header' => 'Note', 'size' => 'md', 'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA, 'displayValue' => '...']
                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'additional_mark',
                    'vAlign' => 'middle',
                    'headerOptions' => ['class' => 'kv-sticky-column'],
                    'contentOptions' => ['class' => 'kv-sticky-column'],
                    'editableOptions' => ['header' => 'Additional Mark', 'size' => 'md', 'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                        'data' => [2 => 2, 3 => 3 , 4 => 4 , 5 => 5 ],
                        'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
                        'displayValueConfig'=> [
                            '2' => '<i class="glyphicon glyphicon-thumbs-down"></i> 2',
                            '3' => '<i class="glyphicon glyphicon-thumbs-down"></i> 3',
                            '4' => '<i class="glyphicon glyphicon-thumbs-up"></i> 4',
                            '5' => '<i class="glyphicon glyphicon-flag"></i> 5',
                        ],
                        'asPopover' => false,
                    ]
                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'additional_note',
                    'vAlign' => 'middle',
                    'headerOptions' => ['class' => 'kv-sticky-column'],
                    'contentOptions' => ['class' => 'kv-sticky-column'],
                    'editableOptions' => ['header' => 'Note', 'size' => 'md', 'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA, 'displayValue' => '...']
                ],

            ];

            echo GridView::widget([
                'id' => 'kv-grid-demo',
                'dataProvider' => $lessonData,
                //'filterModel' => $searchModel,
                'columns' => $gridColumns,
//                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
//                'headerRowOptions' => ['class' => 'kartik-sheet-style'],
//                'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                'pjax' => true, // pjax is set to always true for this demo
                // set your toolbar
//                'toolbar' => [
//                    ['content' =>
//                        Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' ' .
//                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
//                    ],
//                    '{export}',
//                    '{toggleData}',
//                ],
                // set export properties
//                'export' => [
//                    'fontAwesome' => true
//                ],
                // parameters from the demo form
//                'bordered' => true,
//                'striped' => true,
//                'condensed' => false,
//                'responsive' => true,
                //'hover' => $hover,
                //'showPageSummary'=>$pageSummary,
//                'panel' => [
//                    'type' => GridView::TYPE_PRIMARY,
//                    'heading' => $heading,
//                ],
//                'persistResize' => false,
//                'toggleDataOptions' => ['minCount' => 10],
                //'exportConfig' => $exportConfig,
            ]);
            ?>


        <? endif; ?>


</div>
