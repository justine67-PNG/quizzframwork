<?php

use Illuminate\Support\Facades\Route;

// Halaman Utama
Route::get('/', function () {
    return view('home');
});

// Halaman Data Diri
Route::get('/data-diri', function () {
    $dataDiri = [
        'name' => 'Putu Justine Eza Satria Darma',
        'date of birth' => 'Singaraja, 6 April 2007',
        'nim' => '2501010171',
        'major' => 'Informatika S1',
        'campus' => 'Institut Bisnis dan Teknologi Indonesia',
        'Email' => 'putujustine2007@gmail.com',
    ];

    return view('profile', compact('dataDiri'));
});


// Halaman Hobi
Route::get('/hobi', function () {
    $hobbies = [
        [
            'nama' => 'Gaming',
            'fotos' => [
                'images/gaming.jpg',
            ],
        ],
        [
            'nama' => 'Traveling',
            'fotos' => [
                'images/traveling.jpg',
            ],
        ],
        [
            'nama' => 'Listening Music',
            'fotos' => [
                'images/music.jpg',
            ],
        ],
    ];

    return view('hobbies', compact('hobbies'));
});

Route::get('/hobi/gaming', function () {
    return view('games');
});

Route::get('/hobi/traveling', function () {
    return view('travel');
});

Route::get('/hobi/music', function () {
    return view('music');
});