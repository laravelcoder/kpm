<?php

use Davzie\LaravelBootstrap\Access;

// Modules
Access::module('Dash', 'Загальне', true, false);
Access::module('Users', 'Користувачі', false);
Access::module('Roles', 'Ролі', false);
Access::module('Settings', 'Налаштування', false);
Access::module('Langs', 'Мови', false);
Access::module('Storage', 'Файли', true);
Access::module('News', 'Новини', false);
Access::module('Rubrics', 'Рубрики', false);
Access::module('Pages', 'Сторінки', false);



// Simple actions
Access::dash('index', 'Головна', true);
Access::users('login', 'Сторінка входу', true);
Access::users('password', 'Зміна паролю', false);
Access::roles('permissions', 'Права', false);
Access::users('select', 'Вибір користувача', false);
Access::users('profile', 'Редагування профілю', true);
Access::users('ownPassword', 'Зміна свого паролю', true);
Access::storage('addDir', 'Створення папок', false);
Access::storage('editDir', 'Редагування папок', false);

// to all modules
Access::toAll('toggle', 'Кнопки-триггери', false);