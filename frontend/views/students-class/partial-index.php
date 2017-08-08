<?
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $students Array */
/* @var $student \common\models\User */
?>

<div class="raspisanie-table mb-30px">
    <div class="rt-header text-center">

    </div>
    <!--rt-header-->
    <div class="rt-table">
        <table>
            <thead class="rt-header text-center">
            <tr>
                <td>Имя</td>
                <td>Родитель</td>
                <td>Номер телефона</td>
                <td>Статус Активации</td>
                <td>Отправить Активацию</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?
            foreach ($students as $student) {   ?>
                <tr>
                    <td><?= $student->userProfile->firstname.' '.$student->userProfile->lastname ?></td>
                    <td>Имя Фамилия</td>
                    <td><?= $student->userProfile->phone ?></td>
                    <td>Активен</td>
                    <td></td>
                    <td>x</td>
                </tr>
                <?
            }
            ?>
            </tbody>
        </table>
    </div>
    <!--rt-table-->
</div>

