<?php

return array (

    // Псевдоним директории расширения
    'class' => 'application.modules.yupe.extensions.migration.EMigrateCommand',

    // Псевдоним директории общих миграций (Core)
    'migrationPath' => 'application.modules.yupe.migrations',

    // Таблица хранения информации о миграциях
    'migrationTable' => '{{migration}}',

    // имя псевдомодуля для общих миграций. По умолчанию равно "core".
    'applicationModuleName' => 'yupe',

    // Определяем модули для которых применяем миграции
    'modulePaths' => array (
        'blog' => 'application.modules.blog.migrations',
        'category' => 'application.modules.category.migrations',
        'comment' => 'application.modules.comment.migrations',
        'contentblock' => 'application.modules.contentblock.migrations',
        'contest' => 'application.modules.contest.migrations',
        'dictionary' => 'application.modules.dictionary.migrations',
        'feedback' => 'application.modules.feedback.migrations',
        'gallery' => 'application.modules.gallery.migrations',
        'image' => 'application.modules.image.migrations',
        'news' => 'application.modules.news.migrations',
        'page' => 'application.modules.page.migrations',
        'social' => 'application.modules.social.migrations',
        'user' => 'application.modules.user.migrations',
        'vote' => 'application.modules.vote.migrations',
    ),

    // Отключение модулей от миграции
    'disabledModules' => array (
        //'blog', 
        //'category',
    ),

    // Название компонента подключения к базе
    'connectionID' => 'db',

    // Шаблон для новых миграции
    'templateFile' => 'application.modules.yupe.migrations.sample',

);

?>