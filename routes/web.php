<?php

// use Illuminate\Routing\Route;

Route::get('/', 'PagesController@homepage');
Route::get('about', 'PagesController@about');

Auth::routes(['register' => false]); //menonaktifkan route untuk halaman register

Route::get('siswa/cari', 'SiswaController@cari');

// Menangani method index(), create(), store(), show(), edit(), destroy(). 
Route::resource('siswa', 'SiswaController');
Route::resource('kelas', 'KelasController')->parameters(['kelas' => 'kelas']); //supaya nama kelas tidak terbaca kela karena plurar laravel
Route::resource('hobi', 'HobiController');
Route::resource('user', 'UserController');


Route::get('date-mutator', 'SiswaController@dateMutator');

// Named Route
Route::get('halaman-rahasia', 'RahasiaController@halamanRahasia')->name('secret');

Route::get('showmesecret', 'RahasiaController@showMeSecret');



