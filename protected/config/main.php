<?php
/**
 * Файл был автоматически обработан системой.
 *
 * Дата: Wed, 21 Mar 2012 23:37:26 +0400
 */

return array (
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'defaultController' => 'site',
    'name' => 'Юпи!',
    'language' => 'ru',
    'theme' => 'default',
    'preload' => array (
        0 => 'log',
    ),
    'import' => array (
        0 => 'application.components.*',
        1 => 'application.modules.user.UserModule',
        2 => 'application.modules.user.models.*',
        3 => 'application.modules.user.forms.*',
        4 => 'application.modules.user.components.*',
        5 => 'application.modules.page.models.*',
        6 => 'application.modules.news.models.*',
        7 => 'application.modules.contentblock.models.*',
        8 => 'application.modules.comment.models.*',
        9 => 'application.modules.image.models.*',
        10 => 'application.modules.vote.models.*',
        11 => 'application.modules.yupe.controllers.*',
        12 => 'application.modules.yupe.widgets.*',
        13 => 'application.modules.yupe.helpers.*',
        14 => 'application.modules.yupe.models.*',
        15 => 'application.modules.yupe.components.*',
        16 => 'application.modules.social.widgets.ysc.*',
        17 => 'application.modules.social.components.*',
        18 => 'application.modules.social.models.*',
        19 => 'application.modules.social.extensions.eoauth.*',
        20 => 'application.modules.social.extensions.eoauth.lib.*',
        21 => 'application.modules.social.extensions.lightopenid.*',
        22 => 'application.modules.social.extensions.eauth.services.*',
        23 => 'application.modules.install.extensions.migration.*',
    ),
    'components' => array (
        'image' => array (
            'class' => 'application.modules.yupe.extensions.image.CImageComponent',
            'driver' => 'GD',
            'params' => array (
                'directory' => '/usr/bin',
            ),
        ),
        'loid' => array (
            'class' => 'application.modules.social.extensions.lightopenid.loid',
        ),
        'eauth' => array (
            'class' => 'application.modules.social.extensions.eauth.EAuth',
            'popup' => true,
            'services' => array (
                'google' => array (
                    'class' => 'CustomGoogleService',
                ),
                'yandex' => array (
                    'class' => 'CustomYandexService',
                ),
            ),
        ),
        'mail' => array (
            'class' => 'application.modules.yupe.components.YMail',
        ),
        'urlManager' => array (
            'urlFormat' => 'path',
            'showScriptName' => true,
            'cacheID' => 'cache',
            'rules' => array (
                '/' => 'site/index',
                '/login' => 'user/account/login',
                '/logout' => 'user/account/logout',
                '/registration' => 'user/account/registration',
                '/feedback' => 'feedback/feedback',
                '/pages/<slug>' => 'page/page/show',
                '/story/<title>' => 'news/news/show/',
                '/post/<slug>.html' => 'blog/post/show/',
                '/blog/<slug>' => 'blog/blog/show/',
                '/blogs/' => 'blog/blog/index/',
            ),
        ),
        'request' => array (
            'class' => 'CHttpRequest',
            'enableCsrfValidation' => true,
            'csrfTokenName' => 'YUPE_TOKEN',
        ),
        'ajax' => array (
            'class' => 'application.modules.yupe.components.YAsyncResponse',
        ),
        'user' => array (
            'class' => 'application.modules.user.components.YWebUser',
            'loginUrl' => '/user/account/login/',
        ),
        
        // Настройки подключения к базе данных
        'db' => require( dirname(__FILE__) . '/database.php' ),
        
        'cache' => array (
            'class' => 'CFileCache',
        ),
        'log' => array (
            'class' => 'CLogRouter',
            'routes' => array (
                0 => array (
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning, info',
                ),
                1 => array (
                    'class' => 'application.modules.yupe.extensions.db_profiler.DbProfileLogRoute',
                    'countLimit' => 1,
                    'slowQueryMin' => 0.01,
                ),
            ),
        ),
    ),
    'modules' => array (
        'blog' => array (
            'class' => 'application.modules.blog.BlogModule',
        ),
        'social' => array (
            'class' => 'application.modules.social.SocialModule',
        ),
        'comment' => array (
            'class' => 'application.modules.comment.CommentModule',
            'defaultCommentStatus' => 0,
        ),
        'dictionary' => array (
            'class' => 'application.modules.dictionary.DictionaryModule',
        ),
        'gallery' => array (
            'class' => 'application.modules.gallery.GalleryModule',
        ),
        'vote' => array (
            'class' => 'application.modules.vote.VoteModule',
        ),
        'contest' => array (
            'class' => 'application.modules.contest.ContestModule',
        ),
        'image' => array (
            'class' => 'application.modules.image.ImageModule',
        ),
        'yupe' => array (
            'class' => 'application.modules.yupe.YupeModule',
            'brandUrl' => 'http://yupe.ru?from=engine',
        ),
        'install' => array (
            'class' => 'application.modules.install.InstallModule',
        ),
        'category' => array (
            'class' => 'application.modules.category.CategoryModule',
            'adminMenuOrder' => 5,
        ),
        'news' => array (
            'class' => 'application.modules.news.NewsModule',
            'adminMenuOrder' => 1,
        ),
        'user' => array (
            'class' => 'application.modules.user.UserModule',
            'adminMenuOrder' => 4,
            'autoRecoveryPassword' => true,
            'minPasswordLength' => 3,
            'maxPasswordLength' => 6,
            'emailAccountVerification' => false,
            'showCaptcha' => true,
            'minCaptchaLength' => 3,
            'maxCaptchaLength' => 5,
            'documentRoot' => '/home/lamo2k123/Yii/yupe',
            'avatarsDir' => '/yupe/avatars',
            'avatarMaxSize' => 100000,
            'avatarExtensions' => array (
                0 => 'jpg',
                1 => 'png',
                2 => 'gif',
            ),
            'notifyEmailFrom' => 'test@test.ru',
        ),
        'page' => array (
            'adminMenuOrder' => 2,
            'class' => 'application.modules.page.PageModule',
            'layout' => 'application.views.layouts.column2',
        ),
        'contentblock' => array (
            'class' => 'application.modules.contentblock.ContentBlockModule',
        ),
        'feedback' => array (
            'class' => 'application.modules.feedback.FeedbackModule',
            'adminMenuOrder' => 3,
            'types' => array (
                1 => 'Ошибка на сайте',
                2 => 'Предложение о сотрудничестве',
                3 => 'Прочее..',
            ),
            'showCaptcha' => true,
            'notifyEmailFrom' => 'test@test.ru',
            'backEnd' => array (
                0 => 'email',
                1 => 'db',
            ),
            'emails' => 'test_1@test.ru, test_2@test.ru',
            'enabled' => true,
        ),
        'gii' => array (
            'class' => 'system.gii.GiiModule',
            'password' => 'giiYupe',
        ),
    ),
    
    'behaviors' => array (
        0 => 'YupeStartUpBehavior',
    ),
    
);
