<?php

use Illuminate\Support\Facades\Route;

// Halaman Utama
Route::get('/', function () {
    return view('home');
});

// Halaman Data Diri
Route::get('/data-diri', function () {
    $dataDiri = [
        'nama' => 'Putu Justine Eza Satria Darma',
        'nim' => '2501010171',
        'jurusan' => 'Informatika',
        'kampus' => 'INSTIKI',
    ];

    return view('profile', compact('dataDiri'));
});

// Halaman Hobi
Route::get('/hobi', function () {
    $hobbies = [
        [
            'nama' => 'Gaming',
            'foto' => 'images/gaming.jpg'
        ],
        [
            'nama' => 'Traveling',
            'foto' => 'images/traveling.jpg'
        ]
    ];

    return view('hobbies', compact('hobbies'));
});