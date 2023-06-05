<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
   // require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
    //require(__DIR__ . '/params-local.php')
);
return array(
    'id' => 'appbd',
    'basePath' => dirname(__DIR__),
    'bootstrap' => array('log'),
    'controllerNamespace' => 'backend\controllers',   
    'components' => array(
        'user' => array(
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' =>array('site/login'),
            'identityCookie' => array(
                'name' => '_bkUser',
                'httpOnly' => true,
                'path'=>'/backend/runtime/web',
                'domain' => 'authentik-travel.com',
             ),
        ),
        'session' =>array(
            'name' => '_BdSesId', // unique for backend
            'savePath' => __DIR__ . '/../runtime/session', // a temporary folder on backend
        ),
        'urlManager' =>  array(
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            //'suffix' => '.html',
            'rules' =>  array(
                     '<language:(en|es)>/' => 'site/index',
                     '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                     '<language:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                     '<language:\w+>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                     '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
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
        'i18n' =>array(
            'translations' => array(
                'app*' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@common/messages',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => array(
                        'app' => 'app.php',
                        //'app/error' => 'error.php',
                    ),
                ),
            ),
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
       
        'request' =>array(
            //!!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' =>'Ad3@ik71a)1fa',
        ),        
        'view' => array(
            'theme' => array(
                'basePath' => '@backend/themes/admin',
                'baseUrl' => '@backend/themes/admin',
                'pathMap' => array(
                    '@backend/views' => '@backend/themes/admin',
                ),
            ),
        ),
        
    ),
    'params' => $params,
);