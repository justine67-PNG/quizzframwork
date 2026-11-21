@extends('layouts.app')

@section('title', 'Sign In - My Portfolio')

@section('content')

<section class="login-section">
    <div class="login-card">
        <h1 class="page-title">Sign In</h1>
        <p class="page-description">Halaman ini hanya untuk tes.</p>

        @if ($errors->any())
            <div class="login-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="login-submit">Sign In</button>
        </form>

        <p class="login-hint">Akun tes: test@example.com / password</p>
    </div>
</section>

@endsection