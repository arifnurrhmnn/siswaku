<?php

// use Illuminate\Routing\Route;

Route::get('/', 'PagesController@homepage');

Route::get('about', 'PagesController@about');

/**
 * Daftar Siswa
 */
Route::get('siswa', 'SiswaController@index');

Route::get('siswa/create', 'SiswaController@create');

Route::get('siswa/{siswa}', 'SiswaController@show'); // siswa/id

Route::post('siswa', 'SiswaController@store');

Route::get('siswa/{siswa}/edit', 'SiswaController@edit');

Route::patch('siswa/{siswa}', 'SiswaController@update');

Route::delete('siswa/{siswa}', 'SiswaController@destroy');

Route::get('date-mutator', 'SiswaController@dateMutator');



// Named Route
Route::get('halaman-rahasia', 'RahasiaController@halamanRahasia')->name('secret');

Route::get('showmesecret', 'RahasiaController@showMeSecret');

// Route::get('sampledata', function () {
//     DB::table('siswa')->insert([
//         [
//             'nisn' => '1003',
//             'nama_siswa' => 'Bayu Firmansyah',
//             'tanggal_lahir' => '1990-06-17',
//             'jenis_kelamin' => 'L',
//             'created_at' => '2016-03-10 19:10:15',
//             'updated_at' => '2016-03-10 19:10:15'
//         ],
//         [
//             'nisn' => '1004',
//             'nama_siswa' => 'Citra Rahmawati',
//             'tanggal_lahir' => '1991-12-12',
//             'jenis_kelamin' => 'P',
//             'created_at' => '2016-03-10 19:10:15',
//             'updated_at' => '2016-03-10 19:10:15'
//         ],
//         [
//             'nisn' => '1005',
//             'nama_siswa' => 'Dirgantara Laksana',
//             'tanggal_lahir' => '1990-10-10',
//             'jenis_kelamin' => 'L',
//             'created_at' => '2016-03-10 19:10:15',
//             'updated_at' => '2016-03-10 19:10:15'
//         ],
//         [
//             'nisn' => '1006',
//             'nama_siswa' => 'Eko Satrio',
//             'tanggal_lahir' => '1990-07-14',
//             'jenis_kelamin' => 'L',
//             'created_at' => '2016-03-10 19:10:15',
//             'updated_at' => '2016-03-10 19:10:15'
//         ],
//         [
//             'nisn' => '1007',
//             'nama_siswa' => 'Firda Ayu Larasati',
//             'tanggal_lahir' => '1992-02-02',
//             'jenis_kelamin' => 'P',
//             'created_at' => '2016-03-10 19:10:15',
//             'updated_at' => '2016-03-10 19:10:15'
//         ],
//         [
//             'nisn' => '1008',
//             'nama_siswa' => 'Galang Rambu Anarki',
//             'tanggal_lahir' => '1991-05-11',
//             'jenis_kelamin' => 'L',
//             'created_at' => '2016-03-10 19:10:15',
//             'updated_at' => '2016-03-10 19:10:15'
//         ],
//         [
//             'nisn' => '1009',
//             'nama_siswa' => 'Haris Purnomo',
//             'tanggal_lahir' => '1991-10-10',
//             'jenis_kelamin' => 'L',
//             'created_at' => '2016-03-10 19:10:15',
//             'updated_at' => '2016-03-10 19:10:15'
//         ],
//         [
//             'nisn' => '1010',
//             'nama_siswa' => 'Indra Birowo',
//             'tanggal_lahir' => '1991-12-04',
//             'jenis_kelamin' => 'L',
//             'created_at' => '2016-03-10 19:10:15',
//             'updated_at' => '2016-03-10 19:10:15'
//         ]
//     ]);
// });
