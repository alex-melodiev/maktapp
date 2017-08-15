<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;
use common\assets\Html5shiv;

/**
 * Frontend application asset
 */
class FrontendAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';
    /**
     * @var string
     */
    public $baseUrl = '@web';

    /**
     * @var array
     */
    public $css = [
        'css/style.css',
        'css/owl.carousel.css',
        'css/select2.css',
        'css/jquery.steps.css',
        'css/custom.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'js/app.js',
        'js/bootstrap.js',
        'js/jquery.fancybox.js',
        'js/jquery.cookie-1.3.1.js',
        'js/jquery.plugin.js',
        //'js/jquery.plugin.min.js',
        'js/jquery.steps.js',
        //'js/jquery.steps.min.js',
        'js/jquery-ui.min.js',
        'js/owl.carousel.min.js',
        'js/select2.min.js',
        'js/scripts.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        Html5shiv::class,
    ];
}
