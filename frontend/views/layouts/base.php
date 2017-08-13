<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php')
?>
<header  id="header" class="mb-50px">
    <div class="row">
        <div class="col-sm-3">
            <a href="#" class="logo"><img src="/img/logo-small.png" alt="" /></a>
        </div><!--col-sm-3-->
        <div class="col-sm-6">
            <div class="header-nav">
                <?php echo Nav::widget([
                    'options' => ['class' => ''],
                    'items' => [
                        ['label' => Yii::t('frontend', 'Students'), 'url' => ['/student/index']],
                        ['label' => Yii::t('frontend', 'Schedule'), 'url' => ['/lesson/schedule']],
                        ['label' => Yii::t('frontend', 'Lessons'), 'url' => ['/lesson/index']],
                        ['label' => Yii::t('frontend', 'Journal'), 'url' => ['/students-class/index']],
                        ['label' => Yii::t('frontend', 'Subjects'), 'url' => ['/subject/index']],
                        ['label' => Yii::t('frontend', 'Home'), 'url' => ['/site/index'], 'visible'=>Yii::$app->user->isGuest],
                        ['label' => Yii::t('frontend', 'About'), 'url' => ['/page/view', 'slug'=>'about'], 'visible'=>Yii::$app->user->isGuest],
                        ['label' => Yii::t('frontend', 'События'), 'url' => ['/article/index']],
                        ['label' => Yii::t('frontend', 'Contact'), 'url' => ['/site/contact'], 'visible'=>Yii::$app->user->isGuest],
                        ['label' => Yii::t('frontend', 'Signup'), 'url' => ['/user/sign-in/signup'], 'visible'=>Yii::$app->user->isGuest],
                        ['label' => Yii::t('frontend', 'Login'), 'url' => ['/user/sign-in/login'], 'visible'=>Yii::$app->user->isGuest],
//                        [
//                            'label' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->getPublicIdentity(),
//                            'visible'=>!Yii::$app->user->isGuest,
//                            'items'=>[
//                                [
//                                    'label' => Yii::t('frontend', 'Settings'),
//                                    'url' => ['/user/default/index']
//                                ],
//                                [
//                                    'label' => Yii::t('frontend', 'Backend'),
//                                    'url' => Yii::getAlias('@backendUrl'),
//                                    'visible'=>Yii::$app->user->can('manager')
//                                ],
//                                [
//                                    'label' => Yii::t('frontend', 'Logout'),
//                                    'url' => ['/user/sign-in/logout'],
//                                    'linkOptions' => ['data-method' => 'post']
//                                ]
//                            ]
//                        ],
                        [
                            'label'=>Yii::t('frontend', 'Language'),
                            'items'=>array_map(function ($code) {
                                return [
                                    'label' => Yii::$app->params['availableLocales'][$code],
                                    'url' => ['/site/set-locale', 'locale'=>$code],
                                    'active' => Yii::$app->language === $code
                                ];
                            }, array_keys(Yii::$app->params['availableLocales']))
                        ]
                    ]
                ]); ?>
            </div>
        </div><!--col-sm-6-->
        <div class="col-sm-3 text-right">
            <a href="'/user/default/index'" class="registr-link">
                <? if(!Yii::$app->user->isGuest) {
                    echo Yii::$app->user->identity->getPublicIdentity();
    }
                ?>
            </a><!--registr-link-->
        </div><!--col-sm-4-->
    </div><!--row-->
</header>

<?php echo $content ?>

<footer class="footer">
    <div class="container">
        <p class="pull-left"></p>
        <p class="pull-right"></p>
    </div>
</footer>
<?php $this->endContent() ?>