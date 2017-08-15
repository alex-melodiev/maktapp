<?php
/* @var $this yii\web\View */
/* @var $article \common\models\Article */
$this->title = Yii::t('frontend', 'Articles')
?>
<div id="article-index">
    <h1><?php echo Yii::t('frontend', 'Events') ?></h1>
    <?php
//    echo \yii\widgets\ListView::widget([
//        'dataProvider'=>$dataProvider,
//        'pager'=>[
//            'hideOnSinglePage'=>true,
//        ],
//        'itemView'=>'_item'
//    ])?>


    <div class="list-lesson-meta mb-20px">
        <div class="row">
            <div class="col-sm-4">
                <div class="number-people">Всего записей: <span>31</span></div>
            </div><!--col-sm-4-->

            <div class="col-sm-4 col-sm-offset-4">
                <div class="text-right">
                    <a href="#" class="add-button"><span class="glyphicon glyphicon-plus-sign"></span> Добавить запись</a>
                </div>
            </div><!--col-sm-4-->
        </div><!--row-->
    </div><!--list-lesson-meta-->
    <div class="events-container">
        <div class="event-container">
            <? foreach($dataProvider->getModels() as $article) ?>
            <div class="row">
                <div class="col-sm-2">
                    <div class="event-calendar">
                        <span class="glyphicon glyphicon-calendar"></span>
                        <?= date("d.m.Y", $article->published_at) ?>
                    </div><!--event-calendar-->
                </div><!--col-sm-2-->
                <div class="col-sm-10">
                    <div class="event-text">
                        <h3><?= $article->title ?></h3>
                        <div class="event-bottom-block">
                            <a href="#" class="e-name">Валентина Ивановна</a>
                            <div class="job">Учитель</div>
                        </div><!--event-bottom-block-->
                    </div><!--event-text-->
                </div><!--col-sm-10-->
            </div><!--row-->
        </div><!--event-container-->
    </div><!--events-container-->
</div>