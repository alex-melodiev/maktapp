<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StudentsClass */
/* @var $subjects Array */
/* @var $subj \common\models\Subject */
/* @var $les \common\models\Lesson */
/* @var $lessons \yii\db\ActiveRecord[] */
/* @var $students \yii\db\ActiveRecord[] */
/* @var $stud \common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Students Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-class-view">

    <h1><?//= Html::encode($this->title) ?></h1>

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

    <div class="text-center">

        <h1 class="mb-50px">Ваши классы</h1>

    </div>
    <!--text-center-->

    <div class="teacher-settings-container">


        <div class="row">

            <div class="col-sm-2">

                <h4></h4>

            </div>
            <!--col-sm-2-->
            <? foreach ($curatorClasses as $class): ?>

                <div class="col-sm-1">

                    <div
                        class="class-block <? if (Yii::$app->request->get('id') == $class->id): ?> active <? endif; ?>">


                        <a href="<?= \yii\helpers\Url::to(['students-class/view/?id=' . $class->id]) ?>"
                           class="class-link">

                            <span><?= $class->number . $class->register ?></span>

                        </a><!--class-link-->

                        <a href="#" class="class-close"><span class="glyphicon glyphicon-remove"></span></a>

                    </div>
                    <!--class-block-->

                </div><!--col-sm-1-->
            <? endforeach; ?>

        </div>
        <!--row-->

    </div>
    <!--teacher-settings-->
    <ul>
        <? foreach ($subjects as $subj): ?>
            <li><?= $subj->name ?> <a href="/students-class/view/?id=<?= $model->id ?>&subj_id=<?= $subj->id ?>">
                    Журнал</a></li>
        <? endforeach; ?>
    </ul>
    <?
    //var_dump($lessons);
    //var_dump($students);
        if(count($lessons) > 0 && count($students) > 0) :
    ?>


    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Успеваемость</a></li>
        <li><a data-toggle="tab" href="#menu1">Посещаемость</a></li>
        <!-- <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>-->
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">

            <!-- Успеваемость -->
            <br><br>

            <div class="list-lesson-meta mb-20px">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="number-people">Кол-во учеников: <span><?= count($students) ?></span></div>
                    </div>
                    <!--col-sm-4-->
                    <div class="col-sm-4">
                        <div class="evaluation-list marks">
                            <div class="eval" data-val="2">2</div>
                            <div class="eval" data-val="3">3</div>
                            <div class="eval" data-val="4">4</div>
                            <div class="eval" data-val="5">5</div>
                            <div class="eval" data-val="0" style="color: black">X</div>
                        </div>
                        <!--evaluation-list-->
                    </div>
                    <!--col-sm-4-->
                    <div class="col-sm-4">
                        <div class="text-right">


                        </div>
                    </div>
                    <!--col-sm-4-->
                </div>
                <!--row-->
            </div>
            <!--list-lesson-meta-->

            <div class="raspisanie-table mb-30px">
                <div class="rt-table">
                    <table>
                        <thead class="rt-header">
                        <tr>
                            <td>№</td>
                            <td>ФИО</td>
                            <? foreach ($lessons as $les) : if ($les->parent_lesson_id == NULL) {
                                continue;
                            } ?>
                                <td><?= date("d M", strtotime($les->lesson_date)) ?></td>
                            <? endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <? $i = 1;
                        foreach ($students as $stud) { ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $stud->getfullName() ?></td>
                                <? foreach ($lessons as $les) {
                                    if ($les->parent_lesson_id == NULL) {
                                        continue;
                                    } ?>
                                    <? $dt = $les->getLessonData($stud->id); ?>
                                    <td id="lesson-data-<?= $dt->id ?>" lesson-data-id="<?= $dt->id ?>"
                                        class="lesson-mark"> <?

                                        // TODO update additional mark
                                        echo $dt->homework_mark > 0 ? $dt->homework_mark : '';

                                        //var_dump($dt); die();

                                        ?></td>

                                <? } ?>

                            </tr>

                            <? $i++;
                        } ?>


                        </tbody>
                        <?


                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div id="menu1" class="tab-pane fade">
            <!-- Посещаемость -->
            <br><br>

            <div class="list-lesson-meta mb-20px">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="number-people">Кол-во учеников: <span><?= count($students) ?></span></div>
                    </div>
                    <!--col-sm-4-->
                    <div class="col-sm-4">
                        <div class="evaluation-list presence">
                            <div class="eval" data-val="1">+</div>
                            <div class="eval" data-val="0">-</div>
                        </div>
                        <!--evaluation-list-->
                    </div>
                    <!--col-sm-4-->
                    <div class="col-sm-4">
                        <div class="text-right">


                        </div>
                    </div>
                    <!--col-sm-4-->
                </div>
                <!--row-->
            </div>
            <!--list-lesson-meta-->

            <div class="raspisanie-table mb-30px">
                <div class="rt-table">
                    <table>
                        <thead class="rt-header">
                        <tr>
                            <td>№</td>
                            <td>ФИО</td>
                            <? foreach ($lessons as $les) : if ($les->parent_lesson_id == NULL) {
                                continue;
                            } ?>
                                <td><?= date("d M", strtotime($les->lesson_date)) ?></td>
                            <? endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <? $i = 1;
                        foreach ($students as $stud) { ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $stud->getfullName() ?></td>
                                <? foreach ($lessons as $les) {
                                    if ($les->parent_lesson_id == NULL) {
                                        continue;
                                    } ?>
                                    <? $dt = $les->getLessonData($stud->id); ?>
                                    <td id="lesson-data-<?= $dt->id ?>" lesson-data-id="<?= $dt->id ?>"
                                        class="lesson-presence"> <?

                                        // TODO update additional mark
                                        echo $dt->presence == 0 ? '-' : '+';

                                        //var_dump($dt); die();

                                        ?></td>

                                <? } ?>

                            </tr>

                            <? $i++;
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="menu2" class="tab-pane fade">
            <h3>Menu 2</h3>

            <p>Some content in menu 2.</p>
        </div>
    </div>

    <? endif; ?>


</div>
<style>
    .class-block.active a {
        background: #ff1654;
        border-color: #ff1654;
    }

    .class-block.active span {
        color: #fff;
    }
    td.lesson-mark:hover {
        border: gray dotted 2px;
    }
</style>
