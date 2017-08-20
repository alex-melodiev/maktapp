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
        <?//= Html::a(Yii::t('frontend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?//= Html::a(Yii::t('frontend', 'Delete'), ['delete', 'id' => $model->id], [
        //            'class' => 'btn btn-danger',
        //            'data' => [
        //                'confirm' => Yii::t('frontend', 'Are you sure you want to delete this item?'),
        //                'method' => 'post',
        //            ],
        //        ]) ?>
    </p>
    <? if ($model->status == \common\models\Lesson::PENDING): ?>

        <div class="lesson-navigation mb-30px">
            <div class="row">
                <div class="col-sm-3"><? if (isset($prevLesson)) { ?>
                        <a href="<? echo \yii\helpers\Url::to(['lesson/' . $prevLesson->id]);?>" class="next-lesson">
                            <span class="glyphicon glyphicon-chevron-left"></span>

                            <div class="pl-text">
                                <span class="p-text"><?=Yii::t("frontend","Previous lesson")?></span>
                                <span class="p-lesson"><?  echo $prevLesson->getSubjectName(); ?></span>
                            </div>
                            <!--pl-text-->
                        </a><!--prev-lesson-->
                    <? } ?>
                </div>
                <!--col-sm-3-->
                <div class="col-sm-6">
                    <div class="lesson-date">
                        <div class="text-center">
                            <?=Yii::t("frontend","Today")?> <span><?= $model->lesson_date ?></span>
                        </div>
                        <!--text-center-->
                    </div>
                    <!--lesson-date-->
                </div>
                <div class="col-sm-3"><? if (isset($nextLesson)) { ?>
                        <a href="<? echo \yii\helpers\Url::to(['lesson/' . $nextLesson->id]);?>" class="next-lesson">
                            <span class="glyphicon glyphicon-chevron-right"></span>

                            <div class="pl-text">
                                <span class="p-text"><?=Yii::t("frontend","Next lesson")?></span>
                                <span class="p-lesson"><?  echo $nextLesson->getSubjectName(); ?></span>
                            </div>
                            <!--pl-text-->
                        </a><!--prev-lesson-->
                    <? } ?>
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
                            <div class="wb-info"><?=Yii::t("frontend","Group")?></div>
                            <div class="wb-title"><?= $model->getclassName() ?></div>
                        </div>
                        <!--white-block-->
                    </div>
                    <!--col-sm-4-->
                    <div class="col-sm-4">
                        <div class="white-block">
                            <div class="wb-info"><?=Yii::t("frontend","Time")?></div>
                            <div
                                class="wb-title"><?= $time_exploded[0].":".$time_exploded[1] ?></div>
                        </div>
                        <!--white-block-->
                    </div>
                    <!--col-sm-4-->
                    <div class="col-sm-4">
                        <div class="white-block">
                            <div class="wb-info"><?=Yii::t("frontend","Day")?></div>
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
            <a href="<?= \yii\helpers\Url::to(['lesson/start/' . $model->id]) ?>" class="btn btn-green"><?=Yii::t("frontend","Begin lesson")?>Начать урок</a>
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
                            <?=Yii::t("frontend","Today:")?><span><?= $model->lesson_date ?></span>
                        </div><!--text-center-->
                    </div>
                    <div class="text-center">
                        <h1><?= \common\models\Subject::findOne(['id' => $model->subject_id])->name ?></h1>
                    </div><!--text-center-->
                </div><!--col-sm-4-->
                <div class="col-sm-4">
                    <a href="<?= \yii\helpers\Url::to(['lesson/end/' . $model->id]) ?>" class="btn btn-default pull-right"><?=Yii::t("frontend","Finish lesson")?></a>
                </div><!--col-sm-4-->
            </div><!--row-->
        </div><!--list-lesson-info-->
        <div class="list-lesson-meta mb-20px">
            <div class="row">
                <div class="col-sm-4">
                    <div class="number-people"><?=Yii::t("frontend","Students count:")?><span><?= $lessonData->totalCount ?></span></div>
                </div><!--col-sm-4-->
                <div class="col-sm-4">
                    <div class="evaluation-list marks">
                        <div class="eval" data-val="2">2</div>
                        <div class="eval" data-val="3">3</div>
                        <div class="eval" data-val="4">4</div>
                        <div class="eval" data-val="5">5</div>
                        <div class="eval" data-val="0" style="color: black">X</div>
                    </div>
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
                            'valueIfNull' => '<span class="glyphicon glyphicon-plus-sign"></span>'.Yii::t("frontend","Give homework"),
                            'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                            'model' => $model,
                            'value' => $model->homework,
                            //'header' => '',
                            'submitOnEnter' => false,
                            'options' => [
                                'class'=>['add-button'],
                                'rows'=>5,
                                'style'=>'width:400px',
                                'placeholder'=> Yii::t("frontend","Enter homework...")
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

//-            echo GridView::widget([
        //-               'id' => 'kv-grid-demo',
//-                'dataProvider' => $lessonData,
        //'filterModel' => $searchModel,
//-                'columns' => $gridColumns,
//                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
//                'headerRowOptions' => ['class' => 'kartik-sheet-style'],
//                'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        //-               'pjax' => true, // pjax is set to always true for this demo
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
//-            ]);
//-            ?>




        <div class="raspisanie-table mb-30px with-th">
            <div class="rt-table">
                <table>
                    <thead class="rt-header">
                    <tr>
                        <td>№</td>
                        <td><?=Yii::t("frontend","Name")?></td>
                        <td><?=Yii::t("frontend","Presence")?></td>
                        <td><?=Yii::t("frontend","Homework mark")?></td>
                        <td><?=Yii::t("frontend","Note to homework")?></td>
                        <td><?=Yii::t("frontend","Add. mark")?></td>
                        <td><?=Yii::t("frontend","Note")?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <? $i = 1;
                    foreach ($lessonData->models as $dat) { ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $dat->name; ?></td>
                            <td><?
                                echo \kartik\checkbox\CheckboxX::widget([
                                    'name'=>'presence_checkbox_'.$dat->id,
                                    'value' => $dat->presence,
                                    'options'=>['id'=>'presence_'.$dat->id, 'class' => 'presence-checkbox', 'lesson-data-id' => $dat->id],
                                    'pluginOptions'=>['threeState'=>false],
                                    'pluginEvents' => [
                                        "change"=>'function(e) {

                                                $.ajax({
                                                url: "/lesson-data/update-value",
                                                type: "POST",
                                                data: {
                                                    "lesson_data_id": $(this).attr("lesson-data-id"),
                                                    "lesson_attr": "presence",
                                                    "lesson_attr_val": $(this).val(),
                                                },
                                                success: function (data) {
                                                    //alert(data);
                                                    console.log("presence updated");
                                                    console.log(data);

                                                },
                                                error: function(error){
                                                    console.log("error");
                                                    console.log(error);
                                                }
                                            });
                                            }',
                                    ],
                                ]);
                                ?></td>
                            <td class="lesson-mark" mark-type="homework" lesson-data-id="<?= $dat->id ?>"><?= $dat->homework_mark > 0 ? $dat->homework_mark : ''; ?></td>
                            <td><? //echo $model->homework;

                                // TODO Нужно тут оптимизировать, повесить одно событие на разные контролы, разместить все в scripts.js

                                echo \kartik\editable\Editable::widget([
                                    'name'=>'homework_note_'.$dat->id,
                                    'asPopover' => true,
                                    'inlineSettings' => [
                                        'templateBefore' => \kartik\editable\Editable::INLINE_BEFORE_2,
                                        'templateAfter' =>  \kartik\editable\Editable::INLINE_AFTER_2
                                    ],
                                    'valueIfNull' => '<span class="glyphicon glyphicon-plus-sign"></span>',
                                    'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                                    //'model' => $dat,
                                    'value' => $dat->homework_note,
                                    //'header' => '',
                                    'submitOnEnter' => false,
                                    'options' => [
                                        'lesson-data-id' => $dat->id,
                                        'class'=>'add-button',
                                        'rows'=>2,
                                        //'style'=>'width:400px',
                                        'placeholder'=>'',
                                        'displayValue' => '<span class="glyphicon glyphicon-pencil"></span>',
                                    ],
                                    'afterInput' => Html::hiddenInput('homework_note',$dat->homework_note),
                                    'pluginEvents' => [
                                        "editableSubmit"=>'function(event, val, form) {

                                                $.ajax({
                                                url: "/lesson-data/update-value",
                                                type: "POST",
                                                data: {
                                                    "lesson_data_id": '.$dat->id.',
                                                    "lesson_attr": "homework_note",
                                                    "lesson_attr_val": val,
                                                },
                                                success: function (data) {
                                                    //alert(data);
                                                    console.log("homework note updated");
                                                    console.log(data);

                                                },
                                                error: function(error){
                                                    console.log("error");
                                                    console.log(error);
                                                }
                                            });
                                            }',
                                    ],
                                ]);



                                // $dat->homework_note; ?></td>
                            <td class="lesson-mark" mark-type="additional" lesson-data-id="<?= $dat->id ?>"><?= $dat->additional_mark > 0 ? $dat->additional_mark : '' ; ?></td>
                            <td><?

                                echo \kartik\editable\Editable::widget([
                                    'name'=>'additional_note_'.$dat->id,
                                    'asPopover' => true,
                                    'inlineSettings' => [
                                        'templateBefore' => \kartik\editable\Editable::INLINE_BEFORE_2,
                                        'templateAfter' =>  \kartik\editable\Editable::INLINE_AFTER_2
                                    ],
                                    'valueIfNull' => '<span class="glyphicon glyphicon-plus-sign"></span>',
                                    'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                                    //'model' => $dat,
                                    'value' => $dat->additional_note,
                                    //'header' => '',
                                    'submitOnEnter' => false,
                                    'options' => [
                                        'lesson-data-id' => $dat->id,
                                        'class'=>'add-button',
                                        'rows'=>2,
                                        //'style'=>'width:400px',
                                        'placeholder'=>'',
                                        'displayValue' => '<span class="glyphicon glyphicon-pencil"></span>',
                                    ],
                                    'afterInput' => Html::hiddenInput('additional_note',$dat->additional_note),
                                    'pluginEvents' => [
                                        "editableSubmit"=>'function(event, val, form) {

                                                $.ajax({
                                                url: "/lesson-data/update-value",
                                                type: "POST",
                                                data: {
                                                    "lesson_data_id": '.$dat->id.',
                                                    "lesson_attr": "additional_note",
                                                    "lesson_attr_val": val,
                                                },
                                                success: function (data) {
                                                    //alert(data);
                                                    console.log("additional_note note updated");
                                                    console.log(data);

                                                },
                                                error: function(error){
                                                    console.log("error");
                                                    console.log(error);
                                                }
                                            });
                                            }',
                                    ],
                                ]);

                                $dat->additional_note; ?></td>

                        </tr>

                        <? $i++;
                    } ?>


                    </tbody>
                    <?


                    ?>
                </table>
            </div>
        </div>


    <? endif; ?>


</div>


<style>

    td.lesson-mark:hover {
        border: gray dotted 2px;
    }
</style>