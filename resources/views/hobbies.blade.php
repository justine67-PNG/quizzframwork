@extends('layouts.app')

@section('title', 'Hobbies - My Portfolio')

@section('content')

@php
    $hobbies = [
        [
            'name'  => 'Gaming',
            'sub'   => 'Game',
            'image' => 'images/gaming.jpg',
            'desc'  => 'Enjoying games, competition, and unforgettable moments.',
            'url'   => url('/hobi/gaming'),
        ],
        [
            'name'  => 'Traveling',
            'sub'   => 'Perjalanan',
            'image' => 'images/traveling.jpg',
            'desc'  => 'Exploring new places and creating beautiful memories.',
            'url'   => url('/hobi/traveling'),
        ],
        [
            'name'  => 'Music',
            'sub'   => 'Musik',
            'image' => 'images/music.jpg',
            'desc'  => 'Finding comfort, energy, and inspiration through every melody.',
            'url'   => url('/hobi/music'),
        ],
    ];
@endphp

<h1 class="page-title">My Hobbies</h1>
<p class="page-description">Some activities that I like to do in my free time.</p>

<div class="hw-window" data-hw>

    <div class="hw-body">

        <div class="hw-left">
            <div class="hw-preview">
                @foreach ($hobbies as $i => $h)
                    <img src="{{ asset($h['image']) }}" alt="{{ $h['name'] }}"
                         class="hw-preview-img {{ $i === 0 ? 'is-active' : '' }}"
                         data-hw-item="{{ $i }}"
                         onerror="this.style.display='none'">
                @endforeach
            </div>

            <div class="hw-infos">
                @foreach ($hobbies as $i => $h)
                    <div class="hw-info {{ $i === 0 ? 'is-active' : '' }}" data-hw-item="{{ $i }}">
                        <small>MY PERSONAL INTEREST</small>
                        <h2>{{ $h['name'] }}</h2>
                        <p>{{ $h['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="hw-cols">
        @foreach ($hobbies as $i => $h)
            <a href="{{ $h['url'] }}" class="hw-col">
                <img src="{{ asset($h['image']) }}" alt="{{ $h['name'] }}"
                     onerror="this.style.display='none'">
                <div class="hw-label">
                    <small>{{ $h['sub'] }}</small>
                    <span class="hw-title">{{ $h['name'] }}</span>
                </div>
                <span class="hw-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
            </a>
        @endforeach
    </div>

    </div>
</div>

<script>
    (function () {
        const root = document.querySelector('[data-hw]');
        if (!root) return;

        const cols  = root.querySelectorAll('.hw-col');
        const items = root.querySelectorAll('[data-hw-item]');

        function setActive(i) {
            items.forEach(function (el) {
                el.classList.toggle('is-active', Number(el.dataset.hwItem) === i);
            });
        }

        cols.forEach(function (col, i) {
            col.addEventListener('mouseenter', function () { setActive(i); });
            col.addEventListener('focus',      function () { setActive(i); });
        });
    })();
</script>

@endsection