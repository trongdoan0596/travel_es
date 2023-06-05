<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace backend\assets;
use yii\web\AssetBundle;
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';
    public $css = array(
        'themes/admin/css/uikit.min.css',
       // 'themes/admin/css/components/autocomplete.min.css',
        //'themes/admin/css/components/tooltip.min.css',
       // 'themes/admin/css/components/accordion.min.css',
       // 'themes/admin/css/components/sortable.min.css',
        'themes/admin/css/style.css',
    );
    public $js = array(
       // 'themes/web/js/uikit.min.js',
        'themes/admin/js/uikit.min.js',
      //  'themes/admin/js/components/autocomplete.min.js',  
      //  'themes/admin/js/components/tooltip.min.js',
      //  'themes/admin/js/components/accordion.min.js',   
      //  'themes/admin/js/components/sortable.min.js',   
        'themes/admin/js/funtion.js',
    ); 
   public $jsOptions = array(
          'position' =>\yii\web\View::POS_HEAD
          //'position' => View::POS_END // appear in the bottom of my page, but jquery is more down again
   );
    public $depends = array(
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    );
    
}
