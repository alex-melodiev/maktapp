<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $students Array */
/* @var $student \common\models\User */

//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Students Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-page">
    <div class="students-class-view">


        <!--text-center-->
<div class="col-sm-3" ></div>
<div class="col-sm-6" >

    <div class="raspisanie-table mb-30px">
        <div class="rt-table">
            <table>
                <thead class="rt-header"><tr>
                    <td>№</td>
                    <td>ФИО</td>
                    <td>Дата рождения</td>
                </tr></thead>
                <tbody>
                <?
                $i = 0;
                foreach($students as $student): $i++;?>
                    <tr>
                        <td style="width: 39px;text-align:center;"><?= $i; ?></td>
                        <td><?= $student->getfullName(); ?></td>
                        <td><?= $student->getdatebirth() ?></td>
                    </tr>
                <? endforeach; ?>


                </tbody></table>
        </div><!--rt-table-->
    </div>
    <!--teacher-settings-->

</div>
<div class="col-sm-3" ></div>


    </div>
</div>
