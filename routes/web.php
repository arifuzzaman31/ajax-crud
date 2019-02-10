<?php


Route::get('/', function () {
    return view('welcome');
});

Route::resource('contact','ContactController');

Route::get('allcontact','ContactController@Allcontact')->name('all.contact');
