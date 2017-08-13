<?php
/* @var $day */

use yii\helpers\Html;

?>

<div class="raspisanie-table mb-30px">
    <div class="rt-header text-center">
        <div class="rt-title">Расписание на неделю</div>
        <div class="rt-date">21.05.2017</div>
    </div><!--rt-header-->
    <div class="rt-table">
        <table>
            <thead class="rt-header">
            <tr>
                <td>№</td>
                <td>Время урока</td>
                <? foreach ($days as $day_key => $day_value) : ?>
                <td>
                    <?= Yii::t('common', $day_value ); ?>
                </td>
               <? endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <? foreach ($timings as $timing) : ?>
                <tr>
                    <td><?= $timing->id ?></td>
                    <td><?= date("H:i", strtotime($timing->start_time)); ?></td>
                    <? foreach ($days as $day_key => $day_value) :
                        $lesson = \common\models\Lesson::find()->where(['timing_id' => $timing->id, 'day' => $day_key, 'teacher_id' => Yii::$app->user->id])->one(); ?>
                        <td><?
                        if($lesson){
                            echo "<a href=". \yii\helpers\Url::to(['lesson/'.$lesson->id]).">";
                            echo $lesson->getSubjectName().'. '.$lesson->getclassName();
                        } ?></a></td>
                    <? endforeach; ?>

                </tr>
            <? endforeach ?>
            <tr>

            </tr>

            </tbody>
        </table>
    </div><!--rt-table-->
</div><!--raspisanie-table-->
