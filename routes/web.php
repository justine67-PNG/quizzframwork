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

use Illuminate\Http\Request;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    // HANYA UNTUK TES: akun contoh
    if ($request->email === 'test@example.com' && $request->password === 'password') {
        $request->session()->put('demo_user', 'Test User');
        return redirect('/');
    }

    return back()
        ->withErrors(['email' => 'Email atau password salah.'])
        ->withInput($request->only('email'));
});

Route::post('/logout', function (Request $request) {
    $request->session()->forget('demo_user');
    return redirect('/');
});