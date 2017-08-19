<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentsClassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Students Classes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-class-index">



    <div class="text-center">

        <h1 class="mb-50px">Ваши классы</h1>

    </div>
    <!--text-center-->
    <div class="teacher-settings-container text-center setting-page">
        <div class="setting-tab mb-60px">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#menu1">Руководитель</a></li>
                <li><a data-toggle="tab" href="#menu2">Преподаватель</a></li>
                <!-- <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>-->
            </ul>
        </div>
    </div>

    <div class="tab-content">
        <div id="menu1" class="tab-pane fade in active text-center">
            <div class="teacher-settings-container no-p">
                <div class="row">

                    <!--col-sm-2-->
                    <? foreach ($curatorClasses as $class): ?>

                        <div class="col-sm-1">

                            <div class="class-block">

                                <a href="#" onclick="getStudentsForClass(<?= $class->id ?>)" class="class-link">

                                    <span><?= $class->number . $class->register ?></span>

                                </a><!--class-link-->



                            </div>
                            <!--class-block-->

                        </div><!--col-sm-1-->
                    <? endforeach; ?>

                </div>
            </div>
                <!--row-->
            <div class="classdata">

            </div>
        </div>


        <div id="menu2" class="tab-pane fade">

            <div class="row">

                <!--col-sm-2-->
                <? foreach ($studyClasses as $class): ?>

                    <div class="col-sm-1">

                        <div class="class-block">

                            <a href="#" onclick="getStudentsForClass(<?= $class->id ?>)" class="class-link">

                                <span><?= $class->number . $class->register ?></span>

                            </a><!--class-link-->



                        </div>
                        <!--class-block-->

                    </div><!--col-sm-1-->
                <? endforeach; ?>

            </div>
            <!--row-->

            <div class="classdata">
            </div>
        </div>


    </div>



    <!--teacher-settings-->




</div>

<p>
    <?//= Html::a(Yii::t('frontend', 'Add Class'), ['create'], ['class' => 'btn btn-success']) ?>
</p>



<script type="text/javascript">
    function getStudentsForClass(classid) {
        console.log("start");
        $.ajax({
            url: '/students-class/students',
            type: 'POST',
            data: {
                "class_id": classid,
            },
            success: function (data) {
                $(".classdata").html(data);
            },
            error: function (data) {
                $(".classdata").html(data);
            }
        });

        console.log("end");

        return false;
    }
</script>
