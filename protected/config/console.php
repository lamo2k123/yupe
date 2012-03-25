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

        // Настройки подключения к базе данных
        'db' => require( dirname(__FILE__) . '/database.php' ),
        
    ),
        
    'commandMap' => array (

        // Настройка работы с миграцией
        'migrate' => require( dirname(__FILE__) . '/migrate.php' ),

    ),
);