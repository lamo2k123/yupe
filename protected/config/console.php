<?php
    return array(
    // У вас этот путь может отличаться. Можно подсмотреть в config/main.php.
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Cron',

    'preload' => array('log'),

    'import' => array(
        'application.components.*',
        'application.models.*',
    ),
    // Перенаправляем журнал для cron-а в отдельные файлы
    'components' => array(
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'logFile' => 'cron.log',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'logFile' => 'cron_trace.log',
                    'levels' => 'trace',
                ),
            ),
        ),

    
        'db' => array (
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=yupe',
            'username' => 'root',
            'password' => '',
            'emulatePrepare' => true,
            'charset' => 'utf8',
            'enableParamLogging' => 1,
            'enableProfiling' => 1,
            'schemaCachingDuration' => 108000,
            'tablePrefix' => 'sws',
        ),    
    ),
);