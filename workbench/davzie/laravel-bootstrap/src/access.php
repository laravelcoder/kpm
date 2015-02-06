<?php

use Davzie\LaravelBootstrap\Access;

// Modules
Access::module('Dash', 'Загальне', true, false);
Access::module('Users', 'Користувачі', false);
Access::module('Roles', 'Ролі', false);
Access::module('Settings', 'Налаштування', false);
Access::module('Universities', 'Університети', true);
Access::module('Subjects', 'Предмети', true);
Access::module('BellsSchedule', 'Розклад дзвінків', true);
Access::module('Buildings', 'Корпуси', true);
Access::module('Classrooms', 'Робочі аудиторії', true);
Access::module('Departments', 'Кафедри', true);
Access::module('Faculties', 'Факультети', true);
Access::module('Groups', 'Групи', true);
Access::module('Teachers', 'Викладачі', false);
Access::module('Weeks', 'Тижні', false);
Access::module('Schedule', 'Розклад занятть', false);


// Simple actions
Access::dash('index', 'Головна', true);
Access::users('login', 'Сторінка входу', true);
Access::users('password', 'Зміна паролю', false);
Access::universities('access', 'Доступ до університету', false);
Access::universities('removeUser', 'Видалення зі списку доступу', false);
Access::roles('permissions', 'Права', false);

Access::teachers('subjects', 'Предмети викладача', false);
Access::teachers('removeSubject', 'Видалення предметів викладача', false);
Access::subjects('select', 'Вибір предмета', false);
Access::users('select', 'Вибір користувача', false);
Access::schedule('deleteAll', 'Видалити все', false);
