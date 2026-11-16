
@extends('layouts.app')

@section('title', 'Data Diri - My Portfolio')

@section('content')

<h1 class="page-title">About Me</h1>

<p class="page-description">
    Kenali saya lebih dekat melalui informasi berikut.
</p>

<div class="profile-wrapper">

    <div class="profile-card">

        @foreach ($dataDiri as $key => $value)
            <div class="profile-row">
                <span class="profile-label">
                    {{ ucfirst($key) }}
                </span>

                <span class="profile-value">
                    {{ $value }}
                </span>
            </div>
        @endforeach

    </div>

</div>

@endsection
