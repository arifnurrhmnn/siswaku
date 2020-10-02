<?php

// use Illuminate\Routing\Route;

Route::get('/', 'PagesController@homepage');
Route::get('about', 'PagesController@about');

// Menangani method index(), create(), store(), show(), edit(), destroy(). 
Route::resource('siswa', 'SiswaController');


Route::get('date-mutator', 'SiswaController@dateMutator');

// Named Route
Route::get('halaman-rahasia', 'RahasiaController@halamanRahasia')->name('secret');

Route::get('showmesecret', 'RahasiaController@showMeSecret');

