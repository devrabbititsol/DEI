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
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin_assets/vendor/bootstrap/css/bootstrap.css',
        'admin_assets/vendor/font-awesome/css/font-awesome.css',
        'admin_assets/vendor/magnific-popup/magnific-popup.css',
        'admin_assets/vendor/bootstrap-datepicker/css/datepicker3.css',
        'admin_assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css',
        'admin_assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css',
        'admin_assets/vendor/morris/morris.css',
        
        'admin_assets/stylesheets/theme.css',
        'admin_assets/stylesheets/skins/default.css',
        
        'css/select2.min.css',
        
        'admin_assets/vendor/dropzone/css/dropzone.css',
        'admin_assets/stylesheets/imageedit/image_edit.css',
        'admin_assets/stylesheets/imageedit/jquery.Jcrop.css',
        'admin_assets/stylesheets/theme-custom.css',
        'admin_assets/vendor/jquery-datatables-bs3/assets/css/datatables.css',
        'admin_assets/vendor/select2/select2.css',
        
    ];
    public $js = [
        //'admin_assets/vendor/jquery/jquery.js',
        'js/jquery.validate.min.js',
        'admin_assets/vendor/modernizr/modernizr.js',
        'admin_assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js',
        //'admin_assets/vendor/bootstrap/js/bootstrap.js',
        'admin_assets/vendor/nanoscroller/nanoscroller.js',
        'admin_assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js',
        'admin_assets/vendor/magnific-popup/magnific-popup.js',
        'admin_assets/vendor/jquery-placeholder/jquery.placeholder.js',
        'admin_assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js',
        'admin_assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js',
        'admin_assets/vendor/jquery-appear/jquery.appear.js',
        //'admin_assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js',
        'js/select2.min.js',
        'admin_assets/vendor/jquery-easypiechart/jquery.easypiechart.js',
        'admin_assets/vendor/flot/jquery.flot.js',
        'admin_assets/vendor/flot-tooltip/jquery.flot.tooltip.js',
        'admin_assets/vendor/flot/jquery.flot.pie.js',
        'admin_assets/vendor/flot/jquery.flot.categories.js',
        'admin_assets/vendor/flot/jquery.flot.resize.js',
        'admin_assets/vendor/jquery-sparkline/jquery.sparkline.js',
        'admin_assets/vendor/raphael/raphael.js',
        'admin_assets/vendor/morris/morris.js',
        'admin_assets/vendor/gauge/gauge.js',
        'admin_assets/vendor/snap-svg/snap.svg.js',
        'admin_assets/vendor/liquid-meter/liquid.meter.js',
        'admin_assets/vendor/jqvmap/jquery.vmap.js',
        'admin_assets/vendor/jqvmap/data/jquery.vmap.sampledata.js',
        'admin_assets/vendor/jqvmap/maps/jquery.vmap.world.js',
        'admin_assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js',
        'admin_assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js',
        'admin_assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js',
        'admin_assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js',
        'admin_assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js',
        'admin_assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js',
        
        
        //'admin_assets/javascripts/dashboard/examples.dashboard.js',
        'admin_assets/vendor/jquery-datatables/media/js/jquery.dataTables.js',
        //'admin_assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js',
        'admin_assets/vendor/jquery-datatables-bs3/assets/js/datatables.js',
        
        //'admin_assets/javascripts/tables/examples.datatables.row.with.details.js',
        //'admin_assets/javascripts/tables/examples.datatables.tabletools.js',
        //'admin_assets/vendor/select2/select2.js',
        'admin_assets/vendor/dropzone/dropzone.js',
        'admin_assets/javascripts/imageedit/image_altering.js',
        'admin_assets/javascripts/imageedit/jquery.Jcrop.js',
        'admin_assets/javascripts/ui-elements/examples.lightbox.js',
        
        'admin_assets/javascripts/theme.js',
        'admin_assets/javascripts/theme.custom.js',
        'admin_assets/javascripts/theme.init.js',
        'admin_assets/javascripts/tables/examples.datatables.default.js',
        //'admin_assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js',
    ];  
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
    //to load js files in header position
    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
}
