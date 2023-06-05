<?php
$params = require(__DIR__ . '/params.php');
$config = array(
    'id' => 'appfrd',
    'basePath' => dirname(__DIR__),
    'bootstrap' => array('log'),
    'language'=>'es',
    'controllerNamespace' =>'app\controllers',
    'components' => array(	
       'urlManager' =>  array(
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            //'suffix' => '.html',
            'rules' => array( 
                     '/'=>'site/index', 
                     '/site/captcha' => 'site/captcha',                        
                     'contacta-con-nosotros'=>'site/contactus',                    
                     '<title:[\d\w\-_]+>-<id:\d+>'   => 'article/view', 
                     '<title:[\d\w\-_]+>-<id:\d+>'   => 'article/viewblog',                    
                     '<title:[\d\w\-_]+>-c<cid:\d+>' => 'article/index',                     
                     //Article    
                     'sobre-nosotros' =>'article/viewaboutus',      
                     'oferta-de-trabajo' => 'article/recruitment',                      
                     //'useful-information' => 'article/travelinformation',                 
                     'sobre-nuestros-servicios' => 'article/travelinformation',                       
                     'antes-del-viaje' => 'article/beforetrips',//before-the-trips                                          
                     'proponer-tu-plan-de-viaje' => 'tour/customize',//propose-your-travel-plan                     
                     '<tid:\d+>/peticion-precio' =>'tour/requestprice',    
                     'peticion-precio' =>'tour/requestprice', 
                     //Tour 
                     '<page:\d+>/<per-page:\d+>/paquetes-de-viaje'=>'tour/alltour',   
                     'paquetes-de-viaje'=>'tour/alltour',                
                     //'<language:\w+>/package-holidays-tours/<title:[\d\w\-_]+>' => 'tour/index',    
                     'viaje-vietnam-clasico'=>'tour/index',                
                     'viaje-al-norte-de-vietnam'=>'tour/index',                                        
                     'viaje-vietnam-autentico'=>'tour/index',                       
                     'viajes-vietnam-laos-camboya'=>'tour/index',                       
                     'viajes-a-myanmar'=>'tour/index',
                     'viajes-a-laos'=>'tour/index',
                     'viajes-a-camboya'=>'tour/index', 
                     'paquetes-de-viaje/<title:[\d\w\-_]+>'=>'tour/view',                     
                      //ourteam
                     'equipo-de-authentik-travel' =>'ourteam/index',  
                     'equipo-de-authentik-travel/<id:\d+>/<title:[\d\w\-_]+>'=>'ourteam/view',
                      //review   
                     '<page:\d+>/<per-page:\d+>/comentarios-de-clientes'=>'review/index',                   
                     'comentarios-de-clientes'=>'review/index', 
                     'comentarios-de-clientes/<title:[\d\w\-_]+>'   => 'review/view',                   
                     //comment  
                     'comment/savecm' => 'comment/savecm',                    
                     //newsletter
                     'newsletters/addnewsletter' =>'newsletters/addnewsletter', 
                     //'<title:[\d\w\-_]+>-b<id:\d+>'=>'blog/view',
                     '<page:\d+>/<per-page:\d+>/blog-de-viajes-vietnam'=>'blog/index',                   
                     'blog-de-viajes-vietnam/<title:[\d\w\-_]+>'=>'blog/index',     
                     'blog-de-viajes-vietnam/<txttag:[\d\w\-_]+>'=>'blog/index',                  
                     'blog-de-viajes-vietnam'=>'blog/index',    
                     '<title:[\d\w\-_]+>'=>'blog/view',   
                     //begin es                                      
                     '<controller:\w+>/<action:\w+>/<id:\d+>-<title:[\d\w\-_]+>'=>'<controller>/<action>',
                     '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),
        'view' => array(
            'theme' => array(
                'basePath' => '@app/themes/web',
                'baseUrl' => '@app/themes/web',
                'pathMap' => array(
                    '@app/views' => '@app/themes/web/views',
                    '@app/viewsmobi' =>'@app/themes/mobi/views',
                    '@app/viewstablet' =>'@app/themes/tablet/views',
                ),
            ),
        ),
        'mobileDetect' => array(
            'class' => 'skeeks\yii2\mobiledetect\MobileDetect'
        ),
        'request' =>array(
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'HG24&2kdOdh',
        ),
        'cache' => array(
            'class' => 'yii\caching\FileCache',
        ),
        'user' => array(
            'identityClass' => 'common\models\Account',
            'enableAutoLogin' => true,
            'identityCookie' => array(
                'name' => '_frdUser',
                'httpOnly' => true,
                'path'=>'/runtime/web',
                'domain' => 'authentiktravel.com',
             ),
        ),
        'session' =>array(
            'name' => '_FrdSessId', // unique for backend
            'savePath' => __DIR__ . '/../runtime/session', // a temporary folder on backend
            'timeout' => 43200,//=60*60*12 = 1/2 ngay
            'cookieParams' =>array(
                'domain' => 'authentiktravel.es',
                'httpOnly' => true,
            ),
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),   
        'log' => array(
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => array(
                array(
                    'class' => 'yii\log\FileTarget',
                    'levels' => array('error', 'warning'),
                ),
            ),
        ),
       'assetManager' => array(
            'bundles' => array(
                'yii\web\JqueryAsset' => false,
            ),
        ),
        //'db' => require(__DIR__ . '/db.php'),
    ),
    'params' => $params,
);

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = array(
        'class' => 'yii\debug\Module',
    );

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = array(
        'class' => 'yii\gii\Module',
    );
}
return $config;