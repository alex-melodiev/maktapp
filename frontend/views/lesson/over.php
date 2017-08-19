<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.08.2017
 * Time: 17:02
 */

?>

<div class="text-center ">
    <img src="/images/ok-big.png" alt="ok" class="ok-big mb-50px" />
    <div class="lesson-over-title mb-40px"><?=Yii::t("frontend","Lesson finished")?></div>
    <div class="lo-name mb-15px"><?= $model->getSubjectName() ?>, <span><?= $model->getclassName() ?></span></div>
    <div class="lo-id mb-50px">ID: <?= $model->id ?></div>
    <div class="lo-info">
        <div class="home-work"><?=Yii::t("frontend","Homework")?></div>
        <div class="hw-info"><?= $model->homework ?></div>
    </div><!--lo-info-->
    <div class="h-edit">
        <div class="h-title"><?=Yii::t("frontend","To edit lesson please go to tab")?></div>
        <a href="#"><?=Yii::t("frontend","My groups")?></a>
    </div><!--h-edit-->
</div><!--text-center-->
