<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Astra Perfect World / сайт сервера',
    'language' => 'ru',
    'charset' => 'utf-8',
    // preloading 'log' component
    'preload' => array('log'),
    'defaultController' => 'news',
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.easyimage.EasyImage',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.models.*',
        'application.modules.rights.components.*',
    ),
    'modules' => array(
        'user',
        'rights',        
        // uncomment the following to enable the Gii tool
        /*
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'makeroot',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        */
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'class'=>'RWebUser',
            'allowAutoLogin' => true,
        ),
        'authManager'=>array(
            'class'=>'RDbAuthManager',
            'defaultRoles' => array('Guest'),
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
          urlFormat' => 'path',
          'showScriptName' => False,
          'appendParams'=>false,
            'rules' => array(
                'news/<id:\d+>/<title:.*?>' => 'news/view',
                'news' => 'news/index',
                'news/imgUpload' => 'news/imgUpload',
                'news/fileUpload' => 'news/fileUpload',
                'news/update/<id:\d+>/<title:.*?>' => 'news/update',
                'news/delete/<id:\d+>/<title:.*?>' => 'news/delete',
                'gvg' => 'gvg/index',
                'gvg/<datestart:(\d{4}\-\d{2}\-\d{2})>' => 'gvg/view',
                'gvg/update/<datestart:(\d{4}\-\d{2}\-\d{2})>' => 'gvg/update',
                'gvg/delete/<datestart:(\d{4}\-\d{2}\-\d{2})>' => 'gvg/delete',
                'battle' => 'battle/index',
                'battle/<id:\d+>/<datestart:(\d{4}\-\d{2}\-\d{2})>/<defend:.*?>/<atack:.*?>' => 'battle/view',
                'battle/update/<id:\d+>/<datestart:(\d{4}\-\d{2}\-\d{2})>/<defend:.*?>/<atack:.*?>' => 'battle/update',
                'battle/delete/<id:\d+>/<datestart:(\d{4}\-\d{2}\-\d{2})>/<defend:.*?>/<atack:.*?>' => 'battle/delete',
                'clans' => 'clans/index',
                'clans/imgUpload' => 'clans/imgUpload',
                'clans/fileUpload' => 'clans/fileUpload',
                'clans/<id:\d+>/<name:.*?>' => 'clans/view',
                'clans/video/<id:\d+>/<name:.*?>' => 'clans/video',
                'clans/gvg/<id:\d+>/<name:.*?>' => 'clans/gvg',
                'clans/update/<id:\d+>/<name:.*?>' => 'clans/update',
                'clans/delete/<id:\d+>/<name:.*?>' => 'clans/delete',
                'video/<id:\d+>/<title:.*?>' => 'video/view',
                'video' => 'video/index',
                'video/update/<id:\d+>/<title:.*?>' => 'video/update',
                'video/delete/<id:\d+>/<title:.*?>' => 'video/delete',
                'frapser/admin' => 'frapser/admin',
                'frapser' => 'frapser/index',
                'frapser/create' => 'frapser/create',
                'frapser/update/<id:\d+>-<nick:.*?>' => 'frapser/update',
                'frapser/delete/<id:\d+>-<nick:.*?>' => 'frapser/delete',
                'frapserinfo/<id:\d+>-<nick:.*?>' => 'frapser/view',
                'library' => 'library/index',
                'library/imgUpload' => 'library/imgUpload',
                'library/fileUpload' => 'library/fileUpload',
                'library/update/<name:.*?>' => 'library/update',
                'library/delete/<name:.*?>' => 'library/delete',
                'library/<type:.*?>/<name:.*?>' => 'library/view',
                'librarys/<type:.*?>' => 'library/typeview',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        /*
          'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ),
          // uncomment the following to use a MySQL database

         */
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=database',
            'emulatePrepare' => true,
            'username' => 'username',
            'password' => 'password',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CWebLogRoute',
                    'categories' => 'application',
                    'showInFireBug' => true
                ),
                array(
                    'class' => 'CEmailLogRoute',
                    'levels' => 'error, warning',
                    'emails' => 'mail@astra-pw.ru',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'mail@astra-pw.ru',
    ),
);
