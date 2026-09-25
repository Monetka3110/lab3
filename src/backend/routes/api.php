<?php
// Таблица маршрутов: метод + путь -> контроллер::метод
return [
    ['POST',   '/api/auth/login',               'AuthController@login'],
    ['GET',    '/api/zones',                    'WorkplaceController@zones'],
    ['GET',    '/api/workplaces',               'WorkplaceController@index'],
    ['GET',    '/api/workplaces/{id}/availability', 'WorkplaceController@availability'],
    ['GET',    '/api/bookings/my',              'BookingController@my'],
    ['POST',   '/api/bookings',                 'BookingController@store'],
    ['DELETE', '/api/bookings/{id}',            'BookingController@cancel'],
    ['POST',   '/api/admin/workplaces',         'AdminController@createWorkplace'],
    ['PUT',    '/api/admin/workplaces/{id}',    'AdminController@updateWorkplace'],
    ['GET',    '/api/admin/bookings',           'AdminController@bookings'],
];
