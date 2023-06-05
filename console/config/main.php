<?php
$params = array_merge(
   // require(__DIR__ . '/../../common/config/params.php'),
    //require(__DIR__ . '/../../common/config/params-local.php'),    
    //require(__DIR__ . '/params-local.php'),
    require(__DIR__ . '/params.php')
);
return array(
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => array('log'),
    'controllerNamespace' => 'console\controllers',
    'components' => array(
        'log' => array(
            'targets' => array(
                array(
                    'class' => 'yii\log\FileTarget',
                    'levels' =>array('error', 'warning'),
                ),
            ),
        ),
    ),
    'params' => $params,
);
