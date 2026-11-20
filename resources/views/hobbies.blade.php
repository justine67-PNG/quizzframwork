@extends('layouts.app')

@section('title', 'My Hobbies')

@section('content')

<h1 class="page-title">My Hobbies</h1>

<p class="page-description">
    Some activities that I like to do in my free time.
</p>

<div class="hobby-container">

    @foreach ($hobbies as $hobby)

        <div class="hobby-card">

            <div class="hobby-slider" data-slider>

                <div class="hobby-track">

                    @foreach ($hobby['fotos'] as $foto)

                        <div class="hobby-slide"
                             style="--hobby-bg: url('{{ asset($foto) }}')">

                            <img
                                src="{{ asset($foto) }}"
                                alt="{{ $hobby['nama'] }}"
                            >

                        </div>

                    @endforeach

                </div>

                <!-- SLIDER DOTS -->
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

            <h3>{{ $hobby['nama'] }}</h3>

        </div>

    @endforeach

</div>

@endsection
