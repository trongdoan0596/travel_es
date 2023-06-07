<?php
echo 111;die;
defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/common/config/bootstrap.php');
require(__DIR__ . '/config/bootstrap.php');
$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/common/config/main.php'),
    require(__DIR__ . '/config/web.php')
);
$application = new yii\web\Application($config);
Yii::$app->on(\yii\base\Application::EVENT_BEFORE_REQUEST,function($event){
    $detect = Yii::$app->mobileDetect;    
    if($detect->isMobile() && !$detect->isTablet()){
        Yii::$app->view->theme->basePath ='@app/themes/mobi';
        Yii::$app->view->theme->baseUrl ='@app/themes/mobi';          
        Yii::$app->view->theme->pathMap['@app/views'] =  Yii::$app->view->theme->pathMap['@app/viewsmobi'];
    }elseif($detect->isTablet()){
        Yii::$app->view->theme->basePath ='@app/themes/tablet';
        Yii::$app->view->theme->baseUrl ='@app/themes/tablet';
        Yii::$app->view->theme->pathMap['@app/views'] =  Yii::$app->view->theme->pathMap['@app/viewstablet'];            
    }   
    $event->sender->response->on(yii\web\Response::EVENT_BEFORE_SEND, function($e){
        ob_start("ob_gzhandler");
    });
    $event->sender->response->on(yii\web\Response::EVENT_AFTER_SEND, function($e){
        ob_end_flush();
    });    
});
//Yii::$app->view->theme->basePath ='@app/themes/tablet';
//Yii::$app->view->theme->baseUrl ='@app/themes/tablet';
//Yii::$app->view->theme->pathMap['@app/views'] =  Yii::$app->view->theme->pathMap['@app/viewstablet'];
//Yii::$app->view->theme->pathMap['@app/views'] =  Yii::$app->view->theme->pathMap['@app/viewsmobi'];
$application->run();
?>