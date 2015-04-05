<?php

/**
 * The application configuration file, used to setup globally used values throughout the application
 */
return array(

    /**
     * The name of the application, will be used in the main management areas of the application
     */
    'name' => 'Your Fantastic CMS',

    /**
     * The email address associated with support enquires on a technical basis
     */
    'support_email' => 'example@example.com',

    /**
     * The base path to put uploads into
     */
    'upload_base_path'=>'uploads/',

    /**
     * The URL key to access the main admin area
     */
    'access_url'=>'admin',

    /**
     * The menu items shown at the top and side of the application
     */
    'menu_items'=>array(
        'langs'=>array(
            'name'=>'Мови',
            'icon'=>'flag',
            'top'=>true,
            'module' => 'Langs'
        ),
        'roles'=>array(
            'name'=>'Ролі',
            'icon'=>'group',
            'top'=>false,
            'module' => 'Roles'
        ),
        'users'=>array(
            'name'=>'Користувачі',
            'icon'=>'user',
            'top'=>false,
            'module' => 'Users'
        ),
        'storage'=>array(
            'name'=>'Файли',
            'icon'=>'hdd',
            'top'=>false,
            'module' => 'Storage'
        ),
        'settings'=>array(
            'name'=>'Налаштування',
            'icon'=>'cog',
            'top'=>true,
            'module' => 'Settings'
        ),
        'rubrics' =>array(
            'name'=>'Рубрики',
            'icon'=>'',
            'top'=>false,
            'module' => 'Rubrics'
        ),
        'news' =>array(
            'name'=>'Новини',
            'icon'=>'',
            'top'=>false,
            'module' => 'News'
        ),
        'pages' =>array(
            'name'=>'Сторінки',
            'icon'=>'',
            'top'=>false,
            'module' => 'Pages'
        ),
    )
);
