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
        'css/fonts/font-awesome-4.7.0/css/font-awesome.css',
        'css/bootstrap/css/bootstrap.css',
        'css/bootstrap/css/bootstrap-theme.css',
        //'css/bootstrap-select.css',
        
        'css/select2.min.css',
        'css/dropzone.css',
        //'css/jquery.dataTables.css',
        'css/bootstrap-datepicker.min.css',
        'css/datatables.css',
        'css/styles.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/jquery.cookie.js',
        'css/bootstrap/js/bootstrap.js',
        'js/jquery.validate.min.js',
        'js/select2.min.js',
        'js/dropzone.js',
        //'js/jquery.dataTables.min.js',
        'js/bootstrap-datepicker.min.js',
        'js/datatables.min.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
    //to load js files in header position
    public $jsOptions = array(
        'position' => \yii\web\View::POS_BEGIN
    );
}
