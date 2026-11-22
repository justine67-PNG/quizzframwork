@extends('layouts.app')

@section('title', 'Listening Music - My Portfolio')

@section('content')

@php
    // Tambah playlist lain cukup dengan menambah satu baris
    // Urutan di sini juga jadi urutan peringkat di leaderboard
    $playlists = [
        ['title' => 'The Panturas', 'id' => '7e7P8G6nQklyL5Y11Jctge'],
        ['title' => 'Hindia, .Feast, Lomba Sihir', 'id' => '4PDRmj0OhDaTX81fSlMLTg'],
        ['title' => 'ANTI NORMAL', 'id' => '31C2xJ5wKEYMeVUDuNkUKK'],
        ['title' => 'Perunggu', 'id' => '6FQTiLhRSMo7v1mFFlJusO'],
        ['title' => 'Alkateri', 'id' => '4EIYyFXU8gbjZg1OZkqyPo'],
    ];
    $ordinals = ['1ST', '2ND', '3RD'];
@endphp

<section class="games-section">

    <a href="{{ url('/hobi') }}" class="gb-btn"><span class="gb-arrow">◀</span> BACK TO HOBBIES</a>

    <h1 class="games-title">Listening Music</h1>
    <p class="games-subtitle">Playlist Spotify yang sering saya dengarkan.</p>

    {{-- EQUALIZER --}}
    <div class="jb-eq" aria-hidden="true">
        @for ($i = 0; $i < 48; $i++)
            <i style="--d:{{ number_format((($i * 37) % 100) / 100 * -1.2, 2) }}s;--s:{{ number_format(0.6 + (($i * 53) % 70) / 100, 2) }}s"></i>
        @endfor
    </div>

    <div class="jb-stage">

        {{-- SPEAKER KIRI --}}
        <div class="jb-left" aria-hidden="true">
            <div class="jb-spk"><b></b><i></i></div>
            <div class="jb-spk"><b></b><i style="animation-delay:-.25s"></i></div>
        </div>

        {{-- JUKEBOX --}}
        <div class="jb-cabinet" data-jukebox>

            <div class="jb-side">
                <div class="jb-side-title">▶ SELECT SONG</div>
                <div class="jb-list">
                    @foreach ($playlists as $i => $playlist)
                        <button type="button"
                                class="jb-btn {{ $i === 0 ? 'is-active' : '' }}"
                                data-id="{{ $playlist['id'] }}"
                                data-title="{{ $playlist['title'] }}"
                                data-code="{{ chr(65 + $i) }}1">
                            <b>{{ chr(65 + $i) }}1</b>
                            <span>{{ $playlist['title'] }}</span>
                        </button>
                    @endforeach
                </div>
                <div class="jb-coin">INSERT COIN <i></i></div>
            </div>

            <div class="jb-screen">
                <div class="jb-now">
                    <small>▶ NOW PLAYING</small>
                    <strong data-jb-title>{{ $playlists[0]['title'] }}</strong>
                </div>

                <iframe
                    data-jb-frame
                    src="https://open.spotify.com/embed/playlist/{{ $playlists[0]['id'] }}?utm_source=generator&theme=0"
                    width="100%"
                    height="480"
                    frameborder="0"
                    allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                    title="{{ $playlists[0]['title'] }}">
                </iframe>
            </div>

        </div>

        {{-- VINYL + LEADERBOARD KANAN --}}
        <div class="jb-right" data-jb-right>

            <div class="jb-deck" aria-hidden="true">
                <div class="jb-vinyl">
                    <div class="jb-vinyl-label">
                        <span data-jb-code>A1</span>
                        <small data-jb-vtitle>{{ $playlists[0]['title'] }}</small>
                    </div>
                </div>
                <div class="jb-arm"></div>
            </div>

            <div class="jb-board">
                <div class="jb-board-title">★ TOP PLAYLIST</div>
                @foreach ($playlists as $i => $playlist)
                    <div class="jb-rank {{ $i === 0 ? 'is-active' : '' }}" data-id="{{ $playlist['id'] }}">
                        <em>{{ $ordinals[$i] ?? ($i + 1) . 'TH' }}</em>
                        <span>{{ $playlist['title'] }}</span>
                        <i style="width:{{ max(30, 100 - $i * 14) }}%"></i>
                    </div>
                @endforeach
            </div>

        </div>

    </div>

    <style>
    /* ===== TOMBOL BACK ===== */
    .gb-btn{display:inline-flex;align-items:center;gap:12px;margin-bottom:28px;padding:12px 20px;
        color:#061a4d !important;font-size:.8rem !important;font-weight:800;letter-spacing:.14em;text-transform:uppercase;
        background:var(--accent,#f9a825);border:2px solid var(--accent,#f9a825);
        box-shadow:5px 5px 0 var(--accent2,#ff8a00);text-decoration:none;
        transition:transform .15s,box-shadow .15s,background .15s}
    .gb-btn:hover,.gb-btn:focus-visible{transform:translate(3px,3px);box-shadow:2px 2px 0 var(--accent2,#ff8a00);
        background:#fff;border-color:#fff;outline:none}
    .gb-btn:active{transform:translate(5px,5px);box-shadow:0 0 0 var(--accent2,#ff8a00)}
    .gb-arrow{display:inline-block;font-size:.8rem;animation:gbNudge 1s steps(2) infinite}
    @keyframes gbNudge{50%{transform:translateX(-4px)}}

    /* ===== EQUALIZER ===== */
    .jb-eq{display:flex;align-items:flex-end;gap:5px;height:90px;margin:34px 0 10px;max-width:1100px;
        padding-bottom:6px;border-bottom:4px dashed var(--accent,#f9a825)}
    .jb-eq i{flex:1;height:100%;min-width:4px;transform-origin:bottom;
        background:linear-gradient(to top,var(--accent,#f9a825) 0 60%,#22d3ee 60% 85%,#ff5d7a 85%);
        animation:jbBar var(--s) steps(8) infinite alternate;animation-delay:var(--d)}
    @keyframes jbBar{from{transform:scaleY(.12)}to{transform:scaleY(1)}}

    /* ===== STAGE ===== */
    .jb-stage{position:relative;max-width:1100px;margin-top:26px}

    /* ===== JUKEBOX ===== */
    .jb-cabinet{display:grid;grid-template-columns:300px 1fr;gap:0;
        background:linear-gradient(160deg,#030c2b,#061a4d);
        border:3px solid #030c2b;box-shadow:0 0 0 3px #1e4fb8,10px 10px 0 3px rgba(30,79,184,.55)}

    .jb-side{padding:22px 20px;border-right:3px solid #1e4fb8;display:flex;flex-direction:column;gap:16px}
    .jb-side-title{color:#22d3ee;font-size:.75rem;letter-spacing:.2em}
    .jb-list{display:flex;flex-direction:column;gap:12px}

    .jb-btn{display:flex;align-items:center;gap:14px;width:100%;padding:12px 14px;text-align:left;cursor:pointer;
        font:inherit;color:#fff;background:#0a2466;border:2px solid #1e4fb8;
        box-shadow:4px 4px 0 rgba(30,79,184,.55);
        transition:transform .15s,box-shadow .15s,background .15s}
    .jb-btn b{flex:0 0 auto;min-width:40px;padding:6px 8px;text-align:center;font-size:.85rem;
        color:#061a4d;background:#22d3ee}
    .jb-btn span{font-size:.7rem;letter-spacing:.08em;line-height:1.4;text-transform:uppercase;overflow-wrap:anywhere}
    .jb-btn:hover,.jb-btn:focus-visible{transform:translate(2px,2px);box-shadow:2px 2px 0 rgba(30,79,184,.55);outline:none}
    .jb-btn.is-active{background:var(--accent,#f9a825);border-color:var(--accent,#f9a825);
        color:#061a4d;box-shadow:4px 4px 0 var(--accent2,#ff8a00)}
    .jb-btn.is-active b{background:#061a4d;color:var(--accent,#f9a825)}

    .jb-coin{margin-top:auto;display:flex;align-items:center;justify-content:space-between;
        padding:10px 12px;color:#22d3ee;font-size:.65rem;letter-spacing:.2em;
        border:2px dashed #1e4fb8;animation:jbBlink 1.1s steps(2) infinite}
    .jb-coin i{width:8px;height:22px;background:#030c2b;border:2px solid var(--accent,#f9a825)}
    @keyframes jbBlink{50%{opacity:.35}}

    .jb-screen{padding:22px;min-width:0}
    .jb-now{margin-bottom:16px}
    .jb-now small{display:block;color:#22d3ee;font-size:.7rem;letter-spacing:.2em;animation:jbBlink 1.1s steps(2) infinite}
    .jb-now strong{display:block;margin-top:8px;color:var(--accent,#f9a825);
        font-size:clamp(1.1rem,2.2vw,1.8rem);line-height:1.25}
    .jb-screen iframe{display:block;border-radius:12px;border:0}

    /* ===== SPEAKER KIRI ===== */
    .jb-left{display:none}
    .jb-spk{position:relative;width:100%;height:270px;
        background:linear-gradient(160deg,#030c2b,#061a4d);
        border:3px solid #030c2b;box-shadow:0 0 0 3px #1e4fb8,6px 6px 0 3px rgba(30,79,184,.55)}
    .jb-spk b{position:absolute;top:28px;left:50%;width:54px;height:54px;margin-left:-27px;border-radius:50%;
        background:radial-gradient(circle,#22d3ee 0 28%,#030c2b 30% 100%);border:3px solid #1e4fb8}
    .jb-spk i{position:absolute;bottom:26px;left:50%;width:130px;height:130px;margin-left:-65px;border-radius:50%;
        background:radial-gradient(circle,#030c2b 0 22%,var(--accent,#f9a825) 23% 30%,#0a2466 31% 100%);
        border:4px solid #1e4fb8;animation:jbPulse .5s steps(2) infinite alternate}
    @keyframes jbPulse{from{transform:scale(1)}to{transform:scale(1.07)}}

    /* ===== VINYL + LEADERBOARD ===== */
    .jb-right{display:grid;grid-template-columns:260px 1fr;gap:26px;margin-top:30px;align-items:start}

    .jb-deck{position:relative;width:260px;height:250px}
    .jb-vinyl{position:absolute;left:0;top:10px;width:220px;height:220px;border-radius:50%;
        display:grid;place-items:center;
        background:repeating-radial-gradient(circle,#050a1f 0 3px,#0b1438 3px 6px);
        border:4px solid #1e4fb8;box-shadow:6px 6px 0 rgba(30,79,184,.55);
        animation:jbSpin 4s linear infinite}
    @keyframes jbSpin{to{transform:rotate(360deg)}}
    .jb-vinyl-label{display:flex;flex-direction:column;align-items:center;justify-content:center;
        width:92px;height:92px;padding:6px;border-radius:50%;text-align:center;
        background:var(--accent,#f9a825);color:#061a4d;border:3px solid #030c2b}
    .jb-vinyl-label span{font-size:.9rem;font-weight:800}
    .jb-vinyl-label small{font-size:.4rem;line-height:1.2;letter-spacing:.04em;text-transform:uppercase;
        max-height:2.4em;overflow:hidden}
    .jb-arm{position:absolute;right:14px;top:0;width:8px;height:130px;background:#22d3ee;
        border:2px solid #030c2b;transform-origin:top center;transform:rotate(28deg);
        animation:jbArm 4s ease-in-out infinite alternate}
    .jb-arm::after{content:"";position:absolute;bottom:-14px;left:-8px;width:20px;height:16px;
        background:var(--accent,#f9a825);border:2px solid #030c2b}
    @keyframes jbArm{from{transform:rotate(26deg)}to{transform:rotate(31deg)}}

    .jb-board{padding:20px 22px;min-width:0;
        background:linear-gradient(160deg,#030c2b,#061a4d);
        border:3px solid #030c2b;box-shadow:0 0 0 3px #1e4fb8,6px 6px 0 3px rgba(30,79,184,.55)}
    .jb-board-title{margin-bottom:14px;color:#22d3ee;font-size:.75rem;letter-spacing:.2em}
    .jb-rank{position:relative;display:flex;align-items:center;gap:14px;margin-bottom:10px;padding:10px 12px;
        color:#fff;background:#0a2466;border:2px solid #1e4fb8;overflow:hidden}
    .jb-rank em{flex:0 0 auto;min-width:40px;font-style:normal;font-size:.75rem;color:var(--accent,#f9a825)}
    .jb-rank span{position:relative;z-index:1;font-size:.68rem;letter-spacing:.08em;text-transform:uppercase;
        overflow-wrap:anywhere;line-height:1.3}
    .jb-rank i{position:absolute;left:0;bottom:0;height:3px;background:#22d3ee}
    .jb-rank.is-active{border-color:var(--accent,#f9a825);background:#102f7a}
    .jb-rank.is-active::after{content:"◀";position:absolute;right:12px;color:var(--accent,#f9a825);
        animation:jbBlink 1s steps(2) infinite}

    /* ===== LAYAR LEBAR: ISI RUANG KIRI & KANAN ===== */
    @media (min-width:1800px){
        .jb-left{display:flex;flex-direction:column;gap:30px;position:absolute;right:100%;top:0;
            width:200px;margin-right:34px}
        .jb-right{display:flex;flex-direction:column;gap:30px;position:absolute;left:100%;top:0;
            width:400px;margin:0 0 0 34px}
        .jb-deck{margin:0 auto}
    }

    @media (max-width:900px){
        .jb-cabinet{grid-template-columns:1fr}
        .jb-side{border-right:0;border-bottom:3px solid #1e4fb8}
        .jb-eq{height:60px}
        .jb-right{grid-template-columns:1fr}
        .jb-deck{margin:0 auto}
    }
    </style>

    <script>
    (function () {
        const root = document.querySelector('[data-jukebox]');
        if (!root) return;

        const frame  = root.querySelector('[data-jb-frame]');
        const title  = root.querySelector('[data-jb-title]');
        const btns   = root.querySelectorAll('.jb-btn');
        const right  = document.querySelector('[data-jb-right]');
        const code   = right ? right.querySelector('[data-jb-code]') : null;
        const vtitle = right ? right.querySelector('[data-jb-vtitle]') : null;
        const ranks  = right ? right.querySelectorAll('.jb-rank') : [];

        btns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                btns.forEach(function (b) { b.classList.toggle('is-active', b === btn); });
                title.textContent = btn.dataset.title;
                frame.title = btn.dataset.title;
                frame.src = 'https://open.spotify.com/embed/playlist/' + btn.dataset.id + '?utm_source=generator&theme=0';

                if (code)   code.textContent = btn.dataset.code;
                if (vtitle) vtitle.textContent = btn.dataset.title;
                ranks.forEach(function (r) {
                    r.classList.toggle('is-active', r.dataset.id === btn.dataset.id);
                });
            });
        });
    })();
    </script>

</section>

@endsection