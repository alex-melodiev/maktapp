<?php
/* @var $day */

use yii\helpers\Html;

echo '<label class="control-label">Сегодня: </label>';
echo \kartik\date\DatePicker::widget([
    'name' => 'monday_date',
    //'type' => \kartik\date\DatePicker::TYPE_INPUT,
    'removeButton' => false,
    'value' => date( 'Y-m-d', $monday_date),
    'convertFormat' => true,
    'pluginOptions' => [
        'format' => 'yyyy-MM-dd',
        'todayHighlight' => true
    ],
    'pluginEvents' => [
        "changeDate" => "function(e) {
         var d = new Date(e.date);
         window.location = window.location.protocol + '//' + window.location.hostname + window.location.pathname+ '?monday_date='+ Math.floor(d.getTime() / 1000); }",
    ]
]);

?>

<div class="raspisanie-table mb-30px">

    <div class="rt-header text-center">
        <div class="rt-title">Расписание на неделю</div>
        <?

        $monday = date( 'Y-m-d', strtotime( 'monday this week', intval($monday_date) ) );
        $saturday = date( 'Y-m-d', strtotime( 'saturday this week', intval($monday_date) ) );
        //die($monday);

        ?>
        <div class="rt-date"><?= $monday ?> - <?= $saturday ?></div>
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
            <?

            foreach ($timings as $timing) : ?>
                <tr>
                    <td><?= $timing->id ?></td>
                    <td><?= date("H:i", strtotime($timing->start_time)); ?></td>
                    <? foreach (\common\models\Lesson::days() as $day ) :
                        $lesson = \common\models\Lesson::find()->where([ 'lesson_date' => date( 'Y-m-d', strtotime( strtolower($day).' this week', $monday_date ) ), 'timing_id' => $timing->id,  'teacher_id' => Yii::$app->user->id])->andWhere(['not', ['parent_lesson_id' => null]])->one(); ?>
                        <td><?
                        if($lesson){
                            echo "<a class=".blue-link." href=". \yii\helpers\Url::to(['lesson/'.$lesson->id]).">";
                            echo $lesson->getSubjectName().'. '.$lesson->getclassName();
                        ?> </a>
                           &nbsp; <a href="<?= \yii\helpers\Url::to(['lesson/update-datetime/?id='.$lesson->id]) ?>" class="pull-right"><span class="schedule-edit glyphicon glyphicon-edit"></span></a>
                           <? } ?>
                        </td>
                    <? endforeach; ?>

                </tr>
            <? endforeach ?>
            <tr>

            </tr>

            </tbody>
        </table>
    </div><!--rt-table-->
</div><!--raspisanie-table-->
