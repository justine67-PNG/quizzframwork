@extends('layouts.app')

@section('title', 'Traveling - My Portfolio')

@section('content')

@php
    $places = [
        ['name' => 'Bali',      'image' => 'images/travel/gunung-batur.jpg',   'location' => 'Gunung Batur'],
        ['name' => 'Bali',     'image' => 'images/travel/kebunraya-bedugul.jpg',  'location' => 'Kebun Raya Bedugul'],
        ['name' => 'Malang','image' => 'images/travel/malang.jpg',  'location' => 'KAI KOTA Malang'],
        ['name' => 'Surabaya',  'image' => 'images/travel/surabaya.jpg', 'location' => 'AADK Surabaya'],
        ['name' => 'Bali',  'image' => 'images/travel/bukitasah.jpg', 'location' => 'Bukit Asah'],
        ['name' => 'Bali',  'image' => 'images/travel/hutanpinus.jpg', 'location' => 'Hutan Pinus'],
    ];
@endphp

<section class="games-section">

    <a href="{{ url('/hobi') }}" class="games-back">← Back to Hobbies</a>

    <h1 class="games-title">Traveling</h1>
    <p class="games-subtitle">Tempat-tempat yang pernah saya kunjungi.</p>

    <div class="games-row" data-games-row>
        @foreach ($places as $place)
            <div class="game-card">
                <img src="{{ asset($place['image']) }}" alt="{{ $place['name'] }}">
                <div class="game-info">
                    <h3>{{ $place['name'] }}</h3>
                    <span>{{ $place['location'] }}</span>
                </div>
            </div>
        @endforeach
    </div>

</section>

<script>
    (function () {
    const row = document.querySelector('[data-games-row]');
    const originals = Array.from(row.querySelectorAll('.game-card'));
    const N = originals.length;

    const INTERVAL = 6000;   // jeda antar geser (ms)
    const DURATION = 450;    // lama geser (ms)

    originals.forEach(function (card) {
        const clone = card.cloneNode(true);
        clone.setAttribute('aria-hidden', 'true');
        row.insertBefore(clone, originals[0]);
    });
    originals.forEach(function (card) {
        const clone = card.cloneNode(true);
        clone.setAttribute('aria-hidden', 'true');
        row.appendChild(clone);
    });

    const cards = Array.from(row.querySelectorAll('.game-card'));
    let index = N;
    let timer = null;
    let animating = false;
    let settleTimer = null;

    function targetLeft(i) {
        const card = cards[i];
        return card.offsetLeft - (row.clientWidth - card.offsetWidth) / 2;
    }

    function setWidth() {
        return cards[N].offsetLeft - cards[0].offsetLeft;
    }

    function normalize() {
        if (animating) return;
        if (index >= 2 * N) {
            row.scrollLeft -= setWidth();
        } else if (index < N) {
            row.scrollLeft += setWidth();
        }
        updateCenter();
    }

    function updateCenter() {
        const mid = row.scrollLeft + row.clientWidth / 2;
        let closest = 0;
        let min = Infinity;

        cards.forEach(function (card, i) {
            const d = Math.abs(card.offsetLeft + card.offsetWidth / 2 - mid);
            if (d < min) { min = d; closest = i; }
            card.classList.remove('is-center');
        });

        cards[closest].classList.add('is-center');
        index = closest;
    }

    function centerCard(i) {
        const start = row.scrollLeft;
        const distance = targetLeft(i) - start;
        const startTime = performance.now();
        animating = true;

        function step(now) {
            const t = Math.min((now - startTime) / DURATION, 1);
            const ease = 1 - Math.pow(1 - t, 3);
            row.scrollLeft = start + distance * ease;
            if (t < 1) {
                requestAnimationFrame(step);
            } else {
                animating = false;
                normalize();
            }
        }

        requestAnimationFrame(step);
    }

    function next() {
        if (animating) return;
        index = index + 1;
        centerCard(index);
    }

    function start() { stop(); timer = setInterval(next, INTERVAL); }
    function stop()  { if (timer) clearInterval(timer); }

    window.__stopGames = function () { stop(); };

    row.addEventListener('scroll', function () {
        updateCenter();
        clearTimeout(settleTimer);
        settleTimer = setTimeout(normalize, 150);
    });

    row.addEventListener('mouseenter', stop);
    row.addEventListener('mouseleave', start);
    row.addEventListener('touchstart', stop, { passive: true });
    row.addEventListener('touchend', start);

    row.scrollLeft = targetLeft(N);
    updateCenter();
    start();
})();
</script>

@endsection