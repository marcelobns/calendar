<?php

Auth::routes();
Route::get('/', 'PageController@index');
Route::get('dashboard/{month}/{group}', 'DashboardController@index')->where('month', '\d{4}-\d{2}')->where('group', '[0-9]+');

// Route::get('dashboard/users', 'UserController@index');

Route::get('schedule/add/{day}/{group?}', 'ScheduleController@add');
Route::get('schedule/add_weekday/{place_id}/{weekday}', 'ScheduleController@add_weekday');
Route::get('schedule/edit/{id}/{group?}', 'ScheduleController@edit');
Route::get('schedule/check/{placeId}/{dayS}/{dayE}/{hourS}/{hourE}', 'ScheduleController@check');
Route::post('schedule/save', 'ScheduleController@save');
Route::post('schedule/save_weekday', 'ScheduleController@save_weekday');
Route::post('schedule/delete', 'ScheduleController@delete');

Route::get('dashboard/groups', 'GroupController@index');
Route::get('group/{id?}', 'GroupController@form')->where('id', '[0-9]+');
Route::post('group/save', 'GroupController@save');
Route::delete('group/delete', 'GroupController@delete');

Route::get('dashboard/place/{id}', 'DashboardController@place')->where('id', '[0-9]+');
Route::get('dashboard/places', 'PlaceController@index');
Route::get('place/{id?}', 'PlaceController@form')->where('id', '[0-9]+');
Route::post('place/save', 'PlaceController@save');
Route::delete('place/delete', 'PlaceController@delete');

Route::get('dashboard/users', 'UserController@index');
Route::get('user/{id?}', 'UserController@form')->where('id', '[0-9]+');
Route::post('user/save', 'UserController@save');
Route::post('user/reset', 'UserController@reset');
Route::delete('user/delete', 'UserController@delete');
