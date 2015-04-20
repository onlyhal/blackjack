<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/datepicker/datepicker3.css',
    //    'font-awesome/css/font-awesome.css',    
    ];
    public $js = [
     //   'js/jquery-2.1.1.js',
        'js/datepicker/bootstrap-datepicker.js',
       // 'js/ajaxer.js',
       // 'js/jquery-2.1.1.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
