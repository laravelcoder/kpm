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
Access::module('Adverts', 'Оголошення', false);
Access::module('Teachers', 'Викладачі', false);
Access::module('Feedback', 'Зворотній зв`язок', false);
Access::module('Galleries', 'Фотогалареї', false);



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
Access::storage('upload', 'Завантаження', true);
Access::storage('image', 'Image', true);
Access::storage('file', 'Перегляд файлу', false);

// to all modules
Access::toAll('toggle', 'Кнопки-триггери', false);