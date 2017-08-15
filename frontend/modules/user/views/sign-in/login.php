<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */

$this->title = Yii::t('frontend', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">


        <div class="left-container">
            <div class="left-abs">
                <a href="#" class="logo-one mb-50px"><img src="/images/logo-one.png" alt="" class="img-responsive" /></a>
                <div class="welcome">Добро пожаловать в
                    MaktApp</div>

            </div><!--left-abs-->
            <div class="left-bottom-block">
                <div class="no-account mb-10px"><?php echo Html::a(Yii::t('frontend', 'Need an account? Sign up.'), ['signup']) ?></div>
                <a href="<?= \yii\helpers\Url::to(['signup']); ?>" class="btn btn-green">Новый учитель</a>
            </div><!--left-bottom-block-->
        </div><!--left-container-->
        <div class="right-container">
            <div class="right-abs">
                <div class="main-form-registration">
                    <div class="form-title mb-20px">Авторизация</div>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?php echo $form->field($model, 'identity') ?>
                    <?php echo $form->field($model, 'password')->passwordInput() ?>
                    <?php echo $form->field($model, 'rememberMe')->checkbox() ?>
                    <div style="color:#999;margin:1em 0">
                        <?php echo Yii::t('frontend', 'If you forgot your password you can reset it <a href="{link}">here</a>', [
                            'link'=>yii\helpers\Url::to(['sign-in/request-password-reset'])
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <?php echo Html::submitButton(Yii::t('frontend', 'Login'), ['class' => 'btn btn-default mb-15px', 'name' => 'login-button']) ?>
                    </div>
                  
                    <h2><?php //echo Yii::t('frontend', 'Log in with')  ?></h2>
                    <div class="form-group">
                        <?php
//                        echo yii\authclient\widgets\AuthChoice::widget([
//                            'baseAuthUrl' => ['/user/sign-in/oauth']
//                        ]) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div><!--form-registration-->
            </div><!--right-abs-->
        </div><!--right-container-->




</div>
