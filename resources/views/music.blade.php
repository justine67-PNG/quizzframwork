@extends('layouts.app')

@section('title', 'Listening Music - My Portfolio')

@section('content')

@php
    // Tambah playlist lain cukup dengan menambah satu baris
    $playlists = [
        ['title' => 'The Panturas', 'id' => '7e7P8G6nQklyL5Y11Jctge'],
        ['title' => 'Hindia, .Feast, Lomba Sihir', 'id' => '4PDRmj0OhDaTX81fSlMLTg'],
        ['title' => 'ANTI NORMAL', 'id' => '31C2xJ5wKEYMeVUDuNkUKK'],
        ['title' => 'Perunggu', 'id' => '6FQTiLhRSMo7v1mFFlJusO'],
        ['title' => 'Alkateri', 'id' => '4EIYyFXU8gbjZg1OZkqyPo'],
    ];
@endphp

<section class="games-section">

    <a href="{{ url('/hobi') }}" class="games-back">← Back to Hobbies</a>

    <h1 class="games-title">Listening Music</h1>
    <p class="games-subtitle">Playlist Spotify yang sering saya dengarkan.</p>

    <div class="music-grid">
        @foreach ($playlists as $playlist)
            <div class="music-card">
                <h3 class="music-card-title">{{ $playlist['title'] }}</h3>

                <iframe
                    src="https://open.spotify.com/embed/playlist/{{ $playlist['id'] }}?utm_source=generator&theme=0"
                    width="100%"
                    height="480"
                    frameborder="0"
                    allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                    loading="lazy"
                    title="{{ $playlist['title'] }}">
                </iframe>
            </div>
        @endforeach
    </div>

</section>

@endsection