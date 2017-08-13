<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StudentsClass */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Students Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-class-view">

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

                    <div class="class-block <? if(Yii::$app->request->get('id') == $class->id): ?> active <? endif; ?>">


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

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Успеваемость</a></li>
        <li><a data-toggle="tab" href="#menu1">Посещаемость</a></li>
       <!-- <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>-->
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <h3>HOME</h3>
            <p>Some content.</p>
        </div>
        <div id="menu1" class="tab-pane fade">
            <h3>Menu 1</h3>
            <p>Some content in menu 1.</p>
        </div>
        <div id="menu2" class="tab-pane fade">
            <h3>Menu 2</h3>
            <p>Some content in menu 2.</p>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'number',
            'register',
            'curator_id',
            'school_id',
        ],
    ]) ?>

</div>
<style>
    .class-block.active a {
        background: #ff1654;
        border-color: #ff1654;
    }
    .class-block.active span{
        color: #fff;
    }
</style>