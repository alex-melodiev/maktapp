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

    <h1><?= Yii::t('frontend', 'Classes') ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Add Class'), ['create'], ['class' => 'btn btn-success']) ?>
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

                    <div class="class-block">

                        <a href="<?= \yii\helpers\Url::to(['students-class/view/?id=' . $class->id]) ?>"
                           onclick="//getStudentsForClass(<? //= $class->id ?>)" class="class-link">

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


</div>

<div id="classdata">

</div>


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
                $("#classdata").html(data);
            },
            error: function (data) {
                $("#classdata").html(data);
            }
        });

        console.log("end");

        return false;
    }
</script>
