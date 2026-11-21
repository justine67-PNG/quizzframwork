@extends('layouts.app')

@section('title', 'My Hobbies')

@section('content')

<h1 class="page-title">My Hobbies</h1>

<p class="page-description">
    Some activities that I like to do in my free time.
</p>

<div class="hobby-container">

    @foreach ($hobbies as $hobby)

        @php
            $nama = strtolower($hobby['nama']);
            $link = null;
            if ($nama == 'gaming') {
                $link = url('/hobi/gaming');
            } elseif (str_contains($nama, 'travel')) {
                $link = url('/hobi/traveling');
            }
            elseif (str_contains($nama, 'music')) {
                $link = url('/hobi/music');
            }
        @endphp

        <div class="hobby-card" data-hobby-card>

            {{-- 1. FOTO --}}
            <div class="hobby-slider" data-slider>
                <div class="hobby-track">
                    @foreach ($hobby['fotos'] as $foto)
                        <div class="hobby-slide">
                            <img src="{{ asset($foto) }}" alt="{{ $hobby['nama'] }}">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- 2. GRADIENT GELAP --}}
            <div class="hobby-overlay"></div>

            {{-- 3. TEKS + TOMBOL --}}
            <div class="hobby-content">
                <span class="hobby-subtitle">MY PERSONAL INTEREST</span>

                <h3>{{ strtoupper($hobby['nama']) }}</h3>

                <p class="hobby-description">
    @if ($nama == 'gaming')
        Enjoying games, competition, and unforgettable moments.
    @elseif (str_contains($nama, 'music'))
        Finding comfort, energy, and inspiration through every melody.
    @else
        Exploring new places and creating beautiful memories.
    @endif
            </p>

                @if ($link)
                    <a href="{{ $link }}" class="hobby-cta">
                        Explore {{ ucfirst($hobby['nama']) }}
                        <span class="hobby-arrow">↗</span>
                    </a>
                @else
                    <span class="hobby-cta">
                        Explore {{ ucfirst($hobby['nama']) }}
                        <span class="hobby-arrow">↗</span>
                    </span>
                @endif
            </div>

            {{-- 4. DOTS --}}
            <div class="slider-dots">
                @foreach ($hobby['fotos'] as $index => $foto)
                    <button
                        type="button"
                        class="slider-dot {{ $index == 0 ? 'active' : '' }}"
                        aria-label="Foto {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>

        </div>

    @endforeach

</div>

@endsection