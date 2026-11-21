@extends('layouts.app')

@section('title', 'Games - My Portfolio')

@section('content')

@php
    $games = [
        ['name' => 'VALORANT',        'image' => 'images/games/valorant.jpg',       'platform' => 'PC'],
        ['name' => 'Minecraft',       'image' => 'images/games/minecraft.jpg',      'platform' => 'PC / Mobile'],
        ['name' => 'Roblox',          'image' => 'images/games/roblox.jpg',         'platform' => 'PC / Mobile'],
        ['name' => 'Pubg',            'image' => 'images/games/pubg.jpg',           'platform' => 'Mobile'],
        ['name' => 'Stardew Valley',  'image' => 'images/games/stardewvalley.jpg',  'platform' => 'PC'],
        ['name' => 'EA FC',     'image' => 'images/games/eafc.jpg',          'platform' => 'PC'],
        ['name' => 'Peak',    'image' => 'images/games/peak.jpg',          'platform' => 'PC'],
        ['name' => 'The Sims',  'image' => 'images/games/thesims.jpg',          'platform' => 'PC'],
        ['name' => 'GTA V',  'image' => 'images/games/gtav.jpg',          'platform' => 'PC'],
        ['name' => 'Block Blast',  'image' => 'images/games/blockblast.jpg',          'platform' => 'Mobile'],
        ['name' => 'Subnautica',  'image' => 'images/games/subnautica.jpg',          'platform' => 'PC'],
    ];
@endphp

<section class="games-section">

    <a href="{{ url('/hobi') }}" class="games-back">← Back to Hobbies</a>

    <h1 class="games-title">Games</h1>
    <p class="games-subtitle">Game yang sering saya mainkan.</p>

    <div class="games-row" data-games-row>
        @foreach ($games as $game)
            <div class="game-card">
                <img src="{{ asset($game['image']) }}" alt="{{ $game['name'] }}">
                <div class="game-info">
                    <h3>{{ $game['name'] }}</h3>
                    <span>{{ $game['platform'] }}</span>
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

    // 1. Duplikat kartu: [salinan] [asli] [salinan]
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

    const cards = Array.from(row.querySelectorAll('.game-card')); // total 3N
    let index = N;           // mulai dari kartu asli pertama
    let timer = null;
    let animating = false;
    let settleTimer = null;

    function targetLeft(i) {
        const card = cards[i];
        return card.offsetLeft - (row.clientWidth - card.offsetWidth) / 2;
    }

    // lebar satu set kartu (untuk lompat diam-diam)
    function setWidth() {
        return cards[N].offsetLeft - cards[0].offsetLeft;
    }

    // pindahkan posisi ke set asli tanpa animasi
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
                normalize();     // kalau sudah di kartu salinan, lompat ke aslinya
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
        // kalau digeser manual, rapikan posisi setelah berhenti
        clearTimeout(settleTimer);
        settleTimer = setTimeout(normalize, 150);
    });

    row.addEventListener('mouseenter', stop);
    row.addEventListener('mouseleave', start);
    row.addEventListener('touchstart', stop, { passive: true });
    row.addEventListener('touchend', start);

    // posisi awal: kartu asli pertama di tengah (tanpa animasi)
    row.scrollLeft = targetLeft(N);
    updateCenter();
    start();
})();
</script>

@endsection