@extends('layouts.app')

@section('title', 'Games - My Portfolio')

@section('content')

@php
    // =====================================================================
    //  DATA GAME  (satu-satunya tempat yang perlu diedit saat menambah game)
    //  Wajib : name, image, platform, genre
    //  Opsional: 'tier' => 'S' | 'A' | 'B' | 'C'   (kosong = masuk baris "?")
    //            'hours'  => 120                    (jam main)
    //            'rating' => 1..5                   (hati pixel di sisi belakang kartu)
    //            'note'   => 'catatan singkat'
    //  Field opsional yang kosong tidak ditampilkan.
    // =====================================================================
    $games = [
        ['name' => 'VALORANT',       'image' => 'images/games/valorant.jpg',      'platform' => 'PC',          'genre' => 'Shooter'],
        ['name' => 'Minecraft',      'image' => 'images/games/minecraft.jpg',     'platform' => 'PC / Mobile', 'genre' => 'Survival', 'tier' => 'S'],
        ['name' => 'Roblox',         'image' => 'images/games/roblox.jpg',        'platform' => 'PC / Mobile', 'genre' => 'Sandbox'],
        ['name' => 'Pubg',           'image' => 'images/games/pubg.jpg',          'platform' => 'Mobile',      'genre' => 'Shooter'],
        ['name' => 'Stardew Valley', 'image' => 'images/games/stardewvalley.jpg', 'platform' => 'PC',          'genre' => 'Simulasi'],
        ['name' => 'EA FC',          'image' => 'images/games/eafc.jpg',          'platform' => 'PC',          'genre' => 'Olahraga'],
        ['name' => 'Peak',           'image' => 'images/games/peak.jpg',          'platform' => 'PC',          'genre' => 'Survival'],
        ['name' => 'The Sims',       'image' => 'images/games/thesims.jpg',       'platform' => 'PC',          'genre' => 'Simulasi'],
        ['name' => 'GTA V',          'image' => 'images/games/gtav.jpg',          'platform' => 'PC',          'genre' => 'Action'],
        ['name' => 'Block Blast',    'image' => 'images/games/blockblast.jpg',    'platform' => 'Mobile',      'genre' => 'Puzzle'],
        ['name' => 'Subnautica',     'image' => 'images/games/subnautica.jpg',    'platform' => 'PC',          'genre' => 'Survival'],
    ];

    $games = collect($games)->map(fn ($g) => array_merge(
        ['genre' => '', 'tier' => null, 'hours' => null, 'rating' => null, 'note' => ''],
        $g
    ))->values()->all();

    // ---- Kartu pemain ----
    $player = ['name' => 'JSTN', 'level' => 12, 'goalHours' => 1000];

    // ---- Dinding trofi: isi title, desc, dan ubah unlocked jadi true saat sudah tercapai ----
    $trophies = [
        ['title' => null, 'desc' => null, 'unlocked' => false],
        ['title' => null, 'desc' => null, 'unlocked' => false],
        ['title' => null, 'desc' => null, 'unlocked' => false],
        ['title' => null, 'desc' => null, 'unlocked' => false],
        ['title' => null, 'desc' => null, 'unlocked' => false],
        ['title' => null, 'desc' => null, 'unlocked' => false],
    ];

    // ---- Statistik otomatis ----
    $weeklyHours = '±10 JAM';
    $hasPc       = collect($games)->contains(fn ($g) => str_contains($g['platform'], 'PC'));
    $hasMobile   = collect($games)->contains(fn ($g) => str_contains($g['platform'], 'Mobile'));
    $favGame     = collect($games)->firstWhere('tier', 'S');

    $gameStats = [
        ['icon' => '🎮', 'label' => 'Total Game', 'value' => (string) count($games), 'note' => 'di koleksi'],
        ['icon' => '★',  'label' => 'Favorit',    'value' => $favGame['name'] ?? '-', 'note' => $favGame ? 'tier S' : 'belum dipilih'],
        ['icon' => '▶',  'label' => 'Platform',   'value' => ($hasPc && $hasMobile) ? 'PC / HP' : ($hasMobile ? 'HP' : 'PC'), 'note' => ($hasPc && $hasMobile) ? 'dua-duanya' : 'saja'],
        ['icon' => '⏱',  'label' => 'Jam Main',   'value' => $weeklyHours, 'note' => 'per minggu'],
    ];

    $total      = count($games);
    $genres     = collect($games)->pluck('genre')->filter()->unique()->values();
    $genreStats = collect($games)->filter(fn ($g) => $g['genre'] !== '')->groupBy('genre')
                    ->map(fn ($g) => $g->count())->sortDesc()->take(4);
    $totalHours = collect($games)->sum(fn ($g) => (int) ($g['hours'] ?? 0));
    $xpPct      = $player['goalHours'] > 0 ? min(100, (int) round($totalHours / $player['goalHours'] * 100)) : 0;

    // ---- Tier list ----
    $tierDefs = ['S' => '#ff5d7a', 'A' => '#f9a825', 'B' => '#3ddc84', 'C' => '#22d3ee'];
    $tierRows = [];
    foreach ($tierDefs as $t => $col) {
        $tierRows[$t] = [];
    }
    $unranked = [];
    foreach ($games as $i => $g) {
        if ($g['tier'] && isset($tierDefs[$g['tier']])) {
            $tierRows[$g['tier']][] = $i;
        } else {
            $unranked[] = $i;
        }
    }

    // ---- Sprite pixel (dibuat dari gambar ASCII, 1 '#' = 1 piksel) ----
    $px = function (array $rows, int $u = 3) {
        $out = [];
        foreach ($rows as $y => $row) {
            foreach (str_split($row) as $x => $ch) {
                if ($ch === '#') {
                    $out[] = ($x * $u) . 'px ' . ($y * $u) . 'px var(--c)';
                }
            }
        }
        return implode(',', $out);
    };
    $heartShadow = $px(['.##.##.', '#######', '#######', '.#####.', '..###..', '...#...']);
    $trophyShadow = $px(['.#######.', '#########', '#.#####.#', '..#####..', '...###...', '....#....', '....#....', '...###...', '..#####..']);

    // ---- Data untuk JavaScript ----
    $gameData = collect($games)->map(fn ($g, $i) => [
        'i'        => $i,
        'name'     => $g['name'],
        'img'      => asset($g['image']),
        'platform' => $g['platform'],
        'genre'    => $g['genre'],
        'tier'     => $g['tier'],
        'hours'    => $g['hours'],
        'rating'   => $g['rating'],
        'note'     => $g['note'],
    ])->values();
@endphp

<section class="games-section">

    <a href="{{ url('/hobi') }}" class="games-back gb-btn"><span class="gb-arrow">◀</span> BACK TO HOBBIES</a>

    <h1 class="games-title">Games</h1>
    <p class="games-subtitle">Game yang sering saya mainkan.</p>

    {{-- MINIGAME HEADER --}}
    <div class="gh-arcade" aria-hidden="true">
        <div class="gh-hud"><span>SCORE <b id="gh-score">000000</b></span><span>LV {{ $player['level'] }}</span></div>
        <i class="gh-cloud c1"></i><i class="gh-cloud c2"></i>
        <i class="gh-coin k1"></i><i class="gh-coin k2"></i><i class="gh-coin k3"></i>
        <i class="gh-block"></i>
        <div class="gh-hero"><i class="gh-sprite"></i></div>
        <div class="gh-ground"></div>
    </div>

    {{-- EFEK CRT (bisa dinyalakan lewat tombol CRT) --}}
    <div class="gm-crt" aria-hidden="true"></div>

    {{-- STATISTIK OTOMATIS --}}
    <div class="gs-band">
        <div class="gs-inner">
            <div class="gs-grid">
                @foreach ($gameStats as $s)
                    <div class="gs-box">
                        <i class="gs-icon">{{ $s['icon'] }}</i>
                        <small>{{ $s['label'] }}</small>
                        <strong>{{ $s['value'] }}</strong>
                        <span>{{ $s['note'] }}</span>
                    </div>
                @endforeach
            </div>
            <button type="button" class="gs-start" data-gm-start data-gm-scroll>▶ PRESS START</button>
        </div>
    </div>

    {{-- KONSOL + KARTU PEMAIN --}}
    <div class="gm-top">

        <div class="gm-console" data-console>
            <div class="gm-ch">
                <span>▶ GAME CONSOLE</span>
                <span class="gm-ctrl">
                    <button type="button" class="gm-mini" data-gm-sfx>SFX ON</button>
                    <button type="button" class="gm-mini" data-gm-crt>CRT OFF</button>
                </span>
            </div>

            <div class="gm-slot"><div class="gm-cart-mini" data-gm-cartmini></div></div>

            <div class="gm-screen" data-gm-screen>
                <div class="gm-off" data-gm-off>
                    <button type="button" class="gm-startbtn" data-gm-start data-gm-scroll-no>▶ PRESS START</button>
                </div>

                <div class="gm-loading" data-gm-loading hidden>
                    <span>LOADING</span><div class="gm-loadbar"><i></i></div>
                </div>

                <div class="gm-on" data-gm-on hidden>
                    <div class="gm-cover" data-gm-cover>
                        <img src="" alt="" data-gm-img>
                        <span class="gm-tierbadge" data-gm-tier hidden></span>
                    </div>
                    <div class="gm-info">
                        <small data-gm-no></small>
                        <h2 data-gm-name></h2>
                        <div class="gm-tags"><span data-gm-genre></span><span data-gm-platform></span></div>
                        <dl>
                            <dt data-gm-hours-dt hidden>JAM MAIN</dt><dd data-gm-hours hidden></dd>
                            <dt data-gm-rating-dt hidden>RATING</dt><dd data-gm-rating hidden></dd>
                        </dl>
                        <p class="gm-note" data-gm-note hidden></p>
                    </div>
                </div>
            </div>

            <div class="gm-pad">
                <div class="gm-dpad">
                    <button type="button" data-gm-prev aria-label="Game sebelumnya">◀</button>
                    <button type="button" data-gm-next aria-label="Game berikutnya">▶</button>
                </div>
                <span class="gm-padhint">▸ KLIK KARTRID DI BAWAH UNTUK MEMASUKKAN KE KONSOL</span>
                <button type="button" class="gm-mini" data-gm-eject>EJECT</button>
            </div>
        </div>

        {{-- KARTU PEMAIN --}}
        <aside class="gm-player">
            <div class="gm-ph">▶ PLAYER 1</div>

            <div class="gm-pid">
                <div class="gm-avatar"><div class="gm-hero"><i class="gh-sprite"></i></div></div>
                <div>
                    <strong>{{ $player['name'] }}</strong>
                    <span>LV {{ str_pad($player['level'], 2, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>

            <div class="gm-xp">
                <div class="gm-xplabel"><span>XP</span><span>{{ $xpPct }}%</span></div>
                <div class="gm-xpbar"><i style="width:{{ $xpPct }}%"></i></div>
            </div>

            <div class="gm-stats">
                <small>GENRE FAVORIT</small>
                @foreach ($genreStats as $genre => $count)
                    <div class="gm-stat">
                        <span>{{ strtoupper($genre) }}</span>
                        <div class="gm-statbar"><i style="width:{{ round($count / $total * 100) }}%"></i></div>
                        <b>{{ $count }}</b>
                    </div>
                @endforeach
            </div>

            <div class="gm-pfoot">
                @if ($totalHours > 0)
                    <span>JAM TERCATAT <b>{{ $totalHours }}</b></span>
                @endif
                <span>TROFI <b data-gm-tcount></b></span>
            </div>
        </aside>
    </div>

    {{-- FILTER GENRE + KARTRID --}}
    <div class="gm-filter" data-gm-filter>
        <button type="button" class="gm-chip is-active" data-genre="">SEMUA</button>
        @foreach ($genres as $genre)
            <button type="button" class="gm-chip" data-genre="{{ $genre }}">{{ strtoupper($genre) }}</button>
        @endforeach
    </div>

    <div class="games-row" data-games-row>
        @foreach ($games as $i => $game)
            <div class="game-card" data-i="{{ $i }}" data-genre="{{ $game['genre'] }}">
                @if ($game['tier'])
                    <span class="gc-tier">{{ $game['tier'] }}</span>
                @endif
                <button type="button" class="gc-flip" aria-label="Balik kartu {{ $game['name'] }}">↻</button>

                <img src="{{ asset($game['image']) }}" alt="{{ $game['name'] }}">
                <div class="game-info">
                    <h3>{{ $game['name'] }}</h3>
                    <span>{{ $game['platform'] }}</span>
                </div>

                <div class="gc-back">
                    <strong>{{ $game['name'] }}</strong>
                    @if ($game['genre'])<span>GENRE: {{ strtoupper($game['genre']) }}</span>@endif
                    <span>PLATFORM: {{ strtoupper($game['platform']) }}</span>
                    @if ($game['tier'])<span>TIER: {{ $game['tier'] }}</span>@endif
                    @if ($game['hours'])<span>JAM MAIN: {{ $game['hours'] }}</span>@endif
                    @if ($game['rating'])
                        <span class="gc-hearts">
                            @for ($h = 1; $h <= 5; $h++)
                                <span class="gm-heart {{ $h <= $game['rating'] ? 'on' : '' }}"><i></i></span>
                            @endfor
                        </span>
                    @endif
                    @if ($game['note'])
                        <em>{{ $game['note'] }}</em>
                    @elseif (!$game['rating'] && !$game['hours'])
                        <em class="gc-empty">BELUM ADA CATATAN</em>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- TIER LIST --}}
    <div class="gm-panel gm-tiers">
        <div class="gm-ph">▶ TIER LIST <span>KLIK GAME UNTUK DIMASUKKAN KE KONSOL</span></div>

        @foreach ($tierDefs as $t => $col)
            <div class="gm-tr">
                <div class="gm-tl" style="background:{{ $col }}">{{ $t }}</div>
                <div class="gm-tb">
                    @forelse ($tierRows[$t] as $i)
                        <button type="button" class="gm-tier-item" data-gm-pick="{{ $i }}" data-name="{{ $games[$i]['name'] }}" title="{{ $games[$i]['name'] }}">
                            <img src="{{ asset($games[$i]['image']) }}" alt="{{ $games[$i]['name'] }}">
                        </button>
                    @empty
                        <span class="gm-empty">KOSONG</span>
                    @endforelse
                </div>
            </div>
        @endforeach

        @if (count($unranked))
            <div class="gm-tr">
                <div class="gm-tl" style="background:#8a93b8">?</div>
                <div class="gm-tb">
                    @foreach ($unranked as $i)
                        <button type="button" class="gm-tier-item" data-gm-pick="{{ $i }}" data-name="{{ $games[$i]['name'] }}" title="{{ $games[$i]['name'] }}">
                            <img src="{{ asset($games[$i]['image']) }}" alt="{{ $games[$i]['name'] }}">
                        </button>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- DINDING TROFI --}}
    <div class="gm-panel gm-trophies">
        <div class="gm-ph">▶ ACHIEVEMENTS <span><b data-gm-tcount></b> TERBUKA</span></div>

        <div class="gm-tgrid">
            @foreach ($trophies as $t)
                <div class="gm-trophy {{ $t['unlocked'] ? 'is-unlocked' : '' }}">
                    <div class="gm-ti"><i></i></div>
                    <strong>{{ $t['unlocked'] && $t['title'] ? $t['title'] : '???' }}</strong>
                    <span>{{ $t['unlocked'] && $t['desc'] ? $t['desc'] : 'TERKUNCI' }}</span>
                </div>
            @endforeach

            {{-- trofi rahasia: terbuka lewat Konami code --}}
            <div class="gm-trophy gm-secret" data-gm-secret>
                <div class="gm-ti"><i></i></div>
                <strong data-gm-secret-title>???</strong>
                <span data-gm-secret-desc>TERKUNCI</span>
            </div>
        </div>
    </div>

    <style>
    .games-section{position:relative}

    /* ===== MINIGAME HEADER ===== */
    .gh-arcade{position:absolute;top:20px;right:6%;z-index:6;width:min(420px,38%);height:190px;overflow:hidden;
        background:linear-gradient(180deg,#0a2a7a 0%,#1e4fb8 70%,#22d3ee 100%);
        border:3px solid #030c2b;box-shadow:0 0 0 3px #1e4fb8,8px 8px 0 3px rgba(30,79,184,.55)}
    .gh-arcade::before{content:"";position:absolute;inset:0;z-index:5;pointer-events:none;
        background:repeating-linear-gradient(0deg,rgba(0,0,0,.14) 0 2px,transparent 2px 4px)}
    .gh-hud{position:absolute;top:8px;left:12px;right:12px;z-index:4;display:flex;justify-content:space-between;
        color:#fff;font-size:.65rem;letter-spacing:.15em}
    .gh-hud b{color:var(--accent,#f9a825);font-weight:700}
    .gh-ground{position:absolute;left:0;right:0;bottom:0;height:34px;
        background:repeating-linear-gradient(90deg,#8a5a2b 0 20px,#6e4520 20px 40px),#6e4520;
        border-top:6px solid #3ddc84;background-size:40px 100%;animation:ghGround .6s linear infinite}
    @keyframes ghGround{to{background-position:-40px 0}}
    .gh-hero{position:absolute;left:60px;bottom:40px;z-index:3;width:30px;height:40px;animation:ghJump 3s linear infinite}
    .gh-sprite{position:absolute;left:0;top:0;width:5px;height:5px;background:transparent;
        --c:var(--accent,#f9a825);
        box-shadow:
            10px 0 var(--c),15px 0 var(--c),20px 0 var(--c),
            5px 5px var(--c),10px 5px var(--c),15px 5px var(--c),20px 5px var(--c),25px 5px var(--c),
            5px 10px var(--c),15px 10px var(--c),25px 10px var(--c),
            10px 15px var(--c),15px 15px var(--c),20px 15px var(--c),
            5px 20px var(--c),10px 20px var(--c),15px 20px var(--c),20px 20px var(--c),25px 20px var(--c),
            5px 25px var(--c),10px 25px var(--c),15px 25px var(--c),20px 25px var(--c),25px 25px var(--c),
            5px 30px var(--c),10px 30px var(--c),20px 30px var(--c),25px 30px var(--c),
            5px 35px var(--c),10px 35px var(--c),20px 35px var(--c),25px 35px var(--c)}
    @keyframes ghJump{
        0%,70%{transform:translateY(0)}
        78%{transform:translateY(-62px)}
        86%{transform:translateY(-62px)}
        94%,100%{transform:translateY(0)}
    }
    .gh-block{position:absolute;bottom:40px;left:100%;z-index:2;width:22px;height:22px;
        background:#ff5d7a;border:3px solid #030c2b;box-shadow:inset 0 0 0 3px #ff9bb0;animation:ghMove 3s linear infinite}
    @keyframes ghMove{from{left:100%}to{left:-30px}}
    .gh-coin{position:absolute;z-index:2;width:12px;height:12px;background:var(--accent,#f9a825);
        border:2px solid #030c2b;animation:ghCoin 3s linear infinite}
    .gh-coin.k1{top:70px;animation-delay:-.2s}
    .gh-coin.k2{top:95px;animation-delay:-1.2s}
    .gh-coin.k3{top:60px;animation-delay:-2.1s}
    @keyframes ghCoin{from{left:100%}to{left:-20px}}
    .gh-cloud{position:absolute;z-index:1;height:14px;width:46px;background:rgba(255,255,255,.55);
        box-shadow:10px -8px 0 rgba(255,255,255,.55);animation:ghCloud 14s linear infinite}
    .gh-cloud.c1{top:34px;animation-delay:-3s}
    .gh-cloud.c2{top:62px;animation-duration:20s;animation-delay:-11s}
    @keyframes ghCloud{from{left:100%}to{left:-70px}}

    /* ===== TOMBOL BACK ===== */
    .gb-btn{display:inline-flex;align-items:center;gap:12px;margin-bottom:28px;padding:12px 20px;
        color:#061a4d !important;font-size:.8rem !important;font-weight:800;letter-spacing:.14em;text-transform:uppercase;
        background:var(--accent,#f9a825);border:2px solid var(--accent,#f9a825);
        box-shadow:5px 5px 0 var(--accent2,#ff8a00);
        transition:transform .15s,box-shadow .15s,background .15s,color .15s}
    .gb-btn:hover,.gb-btn:focus-visible{transform:translate(3px,3px);box-shadow:2px 2px 0 var(--accent2,#ff8a00);
        background:#fff;border-color:#fff;color:#061a4d !important;outline:none}
    .gb-btn:active{transform:translate(5px,5px);box-shadow:0 0 0 var(--accent2,#ff8a00)}
    .gb-arrow{display:inline-block;font-size:.8rem;animation:gbNudge 1s steps(2) infinite}
    .gb-btn:hover .gb-arrow{animation-duration:.4s}
    @keyframes gbNudge{50%{transform:translateX(-4px)}}

    /* ===== BAND STATISTIK ===== */
    .gs-band{width:100vw;margin:70px 0 0 calc(50% - 50vw);padding:38px 0 30px;
        background:linear-gradient(180deg,rgba(3,12,43,.8),rgba(6,26,77,.6));
        border-top:4px dashed var(--accent,#f9a825);border-bottom:4px dashed var(--accent,#f9a825)}
    .gs-inner{width:92%;max-width:1500px;margin:0 auto}
    .gs-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:26px}
    .gs-box{position:relative;padding:28px 26px 24px;color:#fff;
        background:linear-gradient(160deg,#030c2b,#061a4d);
        border:2px solid #1e4fb8;box-shadow:6px 6px 0 rgba(30,79,184,.55);
        transition:transform .15s,box-shadow .15s}
    .gs-box:hover{transform:translate(3px,3px);box-shadow:3px 3px 0 rgba(30,79,184,.55)}
    .gs-icon{position:absolute;top:16px;right:20px;font-style:normal;font-size:1.6rem;color:var(--accent,#f9a825);opacity:.35}
    .gs-box small{display:block;color:#22d3ee;font-size:.8rem;letter-spacing:.14em;text-transform:uppercase}
    .gs-box strong{display:block;margin:14px 0 8px;color:var(--accent,#f9a825);
        font-size:clamp(1.5rem,2.6vw,2.5rem);line-height:1.15}
    .gs-box span{color:#b9c8f0;font-size:.78rem;text-transform:uppercase;letter-spacing:.1em}
    .gs-start{display:block;margin:24px auto 0;padding:8px 18px;cursor:pointer;font:inherit;background:none;border:0;
        color:#22d3ee;font-size:.8rem;letter-spacing:.3em;animation:gsBlink 1.1s steps(2) infinite}
    .gs-start:hover,.gs-start:focus-visible{color:#fff3b0;outline:none}
    @keyframes gsBlink{50%{opacity:.25}}

    /* ===== PANEL UMUM ===== */
    .gm-panel,.gm-console,.gm-player{
        background:linear-gradient(160deg,#030c2b,#061a4d);
        border:3px solid #030c2b;box-shadow:0 0 0 3px #1e4fb8,8px 8px 0 3px rgba(30,79,184,.55);position:relative}
    .gm-ph{display:flex;justify-content:space-between;gap:12px;color:#fff;font-size:.7rem;letter-spacing:.2em}
    .gm-ph span{color:#fff3b0;font-size:.55rem;letter-spacing:.14em}
    .gm-ph span b{color:#fff3b0}
    .gm-mini{cursor:pointer;font:inherit;padding:6px 10px;color:#fff3b0;background:#061a4d;border:2px solid #fff3b0;
        font-size:.55rem;letter-spacing:.14em;transition:transform .15s,background .15s,color .15s}
    .gm-mini:hover,.gm-mini:focus-visible{background:#fff3b0;color:#061a4d;outline:none}
    .gm-mini.is-off{opacity:.5}
    .games-section [hidden]{display:none !important}

    /* ===== KONSOL ===== */
    .gm-top{display:grid;grid-template-columns:minmax(0,1.7fr) minmax(280px,1fr);gap:44px;align-items:start;
        margin-top:54px;max-width:1500px;position:relative;z-index:6}
    .gm-console{padding:18px 22px 20px}
    .gm-ch{display:flex;justify-content:space-between;align-items:center;gap:12px;color:#fff;font-size:.7rem;letter-spacing:.2em}
    .gm-ctrl{display:flex;gap:8px}

    .gm-slot{margin:16px auto 0;width:46%;height:24px;background:#02081f;border:3px solid #1e4fb8;border-bottom:0;
        display:flex;align-items:flex-end;justify-content:center;overflow:hidden}
    .gm-cart-mini{width:84%;height:18px;display:grid;place-items:center;visibility:hidden;
        background:var(--accent,#f9a825);color:#061a4d;border:2px solid #030c2b;border-bottom:0;
        font-size:.45rem;letter-spacing:.1em;white-space:nowrap;overflow:hidden}
    .gm-cart-mini.is-loaded{visibility:visible}
    .gm-cart-mini.is-insert{animation:gmInsert .5s steps(5)}
    @keyframes gmInsert{from{transform:translateY(-110%)}to{transform:none}}

    .gm-screen{position:relative;aspect-ratio:16/8.4;min-height:250px;background:#02081f;overflow:hidden;
        border:6px solid #030c2b;box-shadow:0 0 0 3px #1e4fb8,inset 0 0 0 3px #1e4fb8}
    .gm-screen::after{content:"";position:absolute;inset:0;z-index:6;pointer-events:none;
        background:repeating-linear-gradient(0deg,rgba(0,0,0,.18) 0 2px,transparent 2px 4px)}
    .gm-off{position:absolute;inset:0;display:grid;place-items:center}
    .gm-startbtn{cursor:pointer;font:inherit;padding:14px 26px;color:#061a4d;font-size:.85rem;font-weight:800;letter-spacing:.25em;
        background:var(--accent,#f9a825);border:2px solid var(--accent,#f9a825);box-shadow:5px 5px 0 var(--accent2,#ff8a00);
        animation:gsBlink 1.1s steps(2) infinite;transition:transform .15s,box-shadow .15s,background .15s}
    .gm-startbtn:hover,.gm-startbtn:focus-visible{transform:translate(3px,3px);box-shadow:2px 2px 0 var(--accent2,#ff8a00);
        background:#fff;border-color:#fff;outline:none;animation:none}

    .gm-loading{position:absolute;inset:0;z-index:5;display:grid;place-content:center;justify-items:center;gap:14px;
        background:#02081f;color:#fff;font-size:.8rem;letter-spacing:.3em}
    .gm-loadbar{width:200px;height:14px;border:3px solid #fff3b0;padding:2px}
    .gm-loadbar i{display:block;height:100%;width:0;background:var(--accent,#f9a825);animation:gmLoad .75s steps(8) forwards}
    @keyframes gmLoad{to{width:100%}}

    .gm-on{position:absolute;inset:0;display:grid;grid-template-columns:44% minmax(0,1fr);gap:18px;padding:16px}
    .gm-screen.is-booting .gm-on{animation:gmOn .45s steps(5)}
    @keyframes gmOn{from{transform:scaleY(.04);filter:brightness(2.5)}to{transform:none;filter:none}}
    .gm-cover{position:relative;min-height:0;border:3px solid #fff3b0;background:#030c2b}
    .gm-cover img{display:block;width:100%;height:100%;object-fit:cover}
    .gm-cover.is-flash img{animation:mpFlash .3s steps(3)}
    @keyframes mpFlash{from{filter:brightness(2.2) contrast(.6)}to{filter:none}}
    .gm-tierbadge{position:absolute;top:6px;left:6px;width:30px;height:30px;display:grid;place-items:center;
        font-size:.9rem;font-weight:800;color:#061a4d;background:var(--accent,#f9a825);border:2px solid #030c2b}
    .gm-info{min-width:0;display:flex;flex-direction:column;gap:9px;color:#fff;overflow:hidden}
    .gm-info small{color:#22d3ee;font-size:.55rem;letter-spacing:.2em}
    .gm-info h2{margin:0;color:var(--accent,#f9a825);font-size:clamp(1rem,1.9vw,1.6rem);line-height:1.15;overflow-wrap:anywhere}
    .gm-tags{display:flex;flex-wrap:wrap;gap:6px}
    .gm-tags span{padding:3px 7px;border:2px dashed #fff3b0;font-size:.55rem;letter-spacing:.12em;text-transform:uppercase}
    .gm-info dl{display:grid;grid-template-columns:auto 1fr;gap:6px 12px;margin:0;font-size:.6rem;letter-spacing:.1em;text-transform:uppercase}
    .gm-info dt{color:#22d3ee}
    .gm-info dd{margin:0;color:#fff}
    .gm-note{margin:0;max-height:70px;overflow:auto;color:#b9c8f0;font-size:.6rem;line-height:1.7;letter-spacing:.06em}

    .gm-pad{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-top:16px}
    .gm-dpad{display:flex;gap:8px}
    .gm-dpad button{width:46px;height:40px;cursor:pointer;font:inherit;color:#fff3b0;background:#030c2b;border:3px solid #fff3b0;
        transition:transform .15s,background .15s,color .15s}
    .gm-dpad button:hover,.gm-dpad button:focus-visible{background:#fff3b0;color:#061a4d;outline:none}
    .gm-dpad button:active{transform:translate(2px,2px)}
    .gm-padhint{flex:1;color:#b9c8f0;font-size:.5rem;letter-spacing:.12em;line-height:1.7;text-align:center}

    /* ===== KARTU PEMAIN ===== */
    .gm-player{padding:20px 22px 18px}
    .gm-pid{display:flex;align-items:center;gap:16px;margin-top:16px}
    .gm-avatar{width:64px;height:76px;flex:none;position:relative;display:grid;place-items:center;
        background:rgba(30,79,184,.35);border:3px solid #fff3b0}
    .gm-hero{position:relative;width:30px;height:40px;transform:scale(1.2)}
    .gm-pid strong{display:block;color:var(--accent,#f9a825);font-size:1.15rem;letter-spacing:.1em}
    .gm-pid span{display:block;margin-top:6px;color:#22d3ee;font-size:.7rem;letter-spacing:.2em}
    .gm-xp{margin-top:18px}
    .gm-xplabel{display:flex;justify-content:space-between;color:#fff;font-size:.55rem;letter-spacing:.2em;margin-bottom:6px}
    .gm-xpbar,.gm-statbar{height:12px;border:2px solid #fff3b0;padding:1px;background:#030c2b}
    .gm-xpbar i,.gm-statbar i{display:block;height:100%;background:var(--accent,#f9a825)}
    .gm-stats{margin-top:20px;display:flex;flex-direction:column;gap:9px}
    .gm-stats small{color:#22d3ee;font-size:.55rem;letter-spacing:.2em}
    .gm-stat{display:grid;grid-template-columns:78px 1fr 22px;gap:10px;align-items:center;color:#fff;font-size:.55rem;letter-spacing:.1em}
    .gm-stat b{color:#fff3b0;text-align:right}
    .gm-statbar{height:10px}
    .gm-statbar i{background:#22d3ee}
    .gm-pfoot{display:flex;justify-content:space-between;gap:12px;margin-top:20px;padding-top:12px;
        border-top:2px dashed #fff3b0;color:#fff;font-size:.6rem;letter-spacing:.14em}
    .gm-pfoot b{color:#fff3b0}

    /* ===== FILTER GENRE ===== */
    .gm-filter{display:flex;flex-wrap:wrap;gap:10px;max-width:1500px;margin:54px 0 20px;position:relative;z-index:6}
    .gm-chip{cursor:pointer;font:inherit;padding:9px 14px;color:#fff;background:#061a4d;border:2px solid #1e4fb8;
        font-size:.62rem;letter-spacing:.16em;box-shadow:3px 3px 0 rgba(30,79,184,.55);
        transition:transform .15s,box-shadow .15s,background .15s}
    .gm-chip:hover,.gm-chip:focus-visible{transform:translate(2px,2px);box-shadow:1px 1px 0 rgba(30,79,184,.55);outline:none}
    .gm-chip.is-active{background:var(--accent,#f9a825);border-color:var(--accent,#f9a825);color:#061a4d}

    /* ===== KARTRID: tier, tombol balik, sisi belakang ===== */
    .game-card{position:relative;cursor:pointer}
    .gc-tier{position:absolute;top:10px;left:10px;z-index:3;width:28px;height:28px;display:grid;place-items:center;
        font-size:.85rem;font-weight:800;color:#061a4d;background:var(--accent,#f9a825);border:2px solid #030c2b}
    .gc-flip{position:absolute;top:10px;right:10px;z-index:4;width:30px;height:30px;padding:0;cursor:pointer;font:inherit;
        color:#fff3b0;background:#061a4d;border:2px solid #fff3b0;transition:background .15s,color .15s}
    .gc-flip:hover,.gc-flip:focus-visible{background:#fff3b0;color:#061a4d;outline:none}
    .gc-back{position:absolute;inset:0;z-index:3;display:none;flex-direction:column;gap:8px;padding:16px 14px 14px;overflow:auto;
        background:rgba(3,12,43,.95);border:3px solid var(--accent,#f9a825);color:#fff;
        font-size:.6rem;letter-spacing:.1em;line-height:1.5;text-transform:uppercase}
    .gc-back strong{margin-right:34px;color:var(--accent,#f9a825);font-size:.8rem;line-height:1.25}
    .gc-back em{font-style:normal;color:#b9c8f0;text-transform:none;letter-spacing:.04em}
    .gc-back em.gc-empty{color:#6f84c4;text-transform:uppercase;letter-spacing:.12em}
    .game-card.is-flipped .gc-back{display:flex;animation:gcFlip .35s steps(4)}
    @keyframes gcFlip{from{transform:scaleX(0)}to{transform:scaleX(1)}}

    /* hati pixel */
    .gm-heart{--c:#1e4fb8;position:relative;display:inline-block;width:21px;height:18px;margin-right:4px}
    .gm-heart.on{--c:#ff5d7a}
    .gm-heart i{position:absolute;left:0;top:0;width:3px;height:3px;background:transparent;box-shadow:{!! $heartShadow !!}}
    .gc-hearts{display:flex;flex-wrap:wrap}

    /* ===== TIER LIST ===== */
    .gm-tiers,.gm-trophies{max-width:1500px;margin-top:60px;padding:20px 26px 24px;z-index:6}
    .gm-tr{display:grid;grid-template-columns:72px 1fr;margin-top:10px;border:2px solid #030c2b;min-height:76px}
    .gm-tl{display:grid;place-items:center;font-size:1.5rem;font-weight:800;color:#061a4d}
    .gm-tb{display:flex;flex-wrap:wrap;align-items:center;gap:10px;padding:10px;background:rgba(3,12,43,.55)}
    .gm-empty{color:#6f84c4;font-size:.55rem;letter-spacing:.16em}
    .gm-tier-item{position:relative;width:58px;height:58px;padding:0;cursor:pointer;background:#030c2b;border:2px solid #fff3b0;
        transition:transform .15s}
    .gm-tier-item img{display:block;width:100%;height:100%;object-fit:cover}
    .gm-tier-item:hover,.gm-tier-item:focus-visible{transform:translateY(-3px);outline:none}
    .gm-tier-item::after{content:attr(data-name);position:absolute;left:50%;bottom:calc(100% + 8px);transform:translateX(-50%);
        padding:5px 8px;background:#030c2b;border:2px solid #fff3b0;color:#fff;font-size:.5rem;letter-spacing:.1em;
        text-transform:uppercase;white-space:nowrap;opacity:0;visibility:hidden;pointer-events:none;z-index:5}
    .gm-tier-item:hover::after,.gm-tier-item:focus-visible::after{opacity:1;visibility:visible}

    /* ===== TROFI ===== */
    .gm-tgrid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:18px;margin-top:18px}
    .gm-trophy{--c:#3b4f8f;padding:20px 12px 16px;text-align:center;color:#6f84c4;
        background:rgba(3,12,43,.55);border:3px dashed #3b4f8f;transition:transform .15s}
    .gm-trophy:hover{transform:translateY(-3px)}
    .gm-trophy strong{display:block;margin-top:14px;font-size:.7rem;letter-spacing:.1em;text-transform:uppercase}
    .gm-trophy span{display:block;margin-top:6px;font-size:.5rem;letter-spacing:.14em}
    .gm-trophy.is-unlocked{--c:var(--accent,#f9a825);color:#fff;border-style:solid;border-color:var(--accent,#f9a825)}
    .gm-trophy.is-unlocked span{color:#22d3ee}
    .gm-trophy.just-unlocked{animation:gmPop .6s steps(5)}
    @keyframes gmPop{50%{transform:scale(1.12)}}
    .gm-ti{position:relative;width:27px;height:27px;margin:0 auto}
    .gm-ti i{position:absolute;left:0;top:0;width:3px;height:3px;background:transparent;box-shadow:{!! $trophyShadow !!}}

    /* ===== PEMANIS: CRT, confetti, toast ===== */
    .gm-crt{position:fixed;inset:0;z-index:40;display:none;pointer-events:none;
        background:
            repeating-linear-gradient(0deg,rgba(0,0,0,.16) 0 1px,transparent 1px 3px),
            radial-gradient(ellipse at center,transparent 58%,rgba(0,0,0,.38) 100%);
        animation:gmFlicker .14s steps(2) infinite}
    .games-section.is-crt .gm-crt{display:block}
    @keyframes gmFlicker{50%{opacity:.9}}
    .gm-confetti{position:fixed;top:-12px;width:8px;height:8px;z-index:60;pointer-events:none;animation:gmFall linear forwards}
    @keyframes gmFall{to{transform:translateY(108vh) rotate(540deg)}}
    .gm-toast{position:fixed;left:50%;bottom:90px;z-index:61;transform:translateX(-50%);padding:14px 22px;
        background:#030c2b;border:3px solid #fff3b0;box-shadow:5px 5px 0 rgba(0,0,0,.4);
        color:#fff3b0;font-size:.75rem;letter-spacing:.2em;text-align:center;animation:gmToast 2.8s steps(14) forwards}
    @keyframes gmToast{0%{opacity:0;transform:translate(-50%,16px)}10%,85%{opacity:1;transform:translate(-50%,0)}100%{opacity:0}}

    @media (prefers-reduced-motion:reduce){
        .gm-crt,.gm-startbtn,.gs-start,.gm-cart-mini.is-insert,.gm-screen.is-booting .gm-on,.gm-cover.is-flash img,
        .gm-trophy.just-unlocked,.game-card.is-flipped .gc-back{animation:none}
        .gm-confetti{display:none}
    }
    @media (max-width:1000px){
        .gm-top{grid-template-columns:1fr;gap:40px}
    }
    @media (max-width:900px){
        .gh-arcade{position:relative;top:auto;right:auto;width:100%;margin-top:24px}
    }
    @media (max-width:640px){
        .gm-screen{aspect-ratio:auto;min-height:420px}
        .gm-on{grid-template-columns:1fr;grid-template-rows:150px minmax(0,1fr);overflow:auto}
        .gm-padhint{display:none}
        .gm-pad{justify-content:space-between}
        .gm-tiers,.gm-trophies{padding:18px 16px 20px}
        .gm-tr{grid-template-columns:52px 1fr}
    }
    </style>

</section>

{{-- ================= SKOR HEADER ================= --}}
<script>
(function () {
    const el = document.getElementById('gh-score');
    if (!el) return;
    let s = 0;
    const t = setInterval(function () {
        if (!document.body.contains(el)) { clearInterval(t); return; }
        s += 10;
        el.textContent = String(s).padStart(6, '0');
    }, 100);
})();
</script>

{{-- ================= KARTRID (carousel tak berujung + filter) ================= --}}
<script>
(function () {
    const row = document.querySelector('[data-games-row]');
    if (!row) return;

    window.__GM_GAMES = @json($gameData);
    const GAMES = window.__GM_GAMES;

    const INTERVAL = 6000;   // jeda antar geser (ms)
    const DURATION = 450;    // lama geser (ms)

    // simpan kartu asli sebagai cetakan, lalu bangun ulang tiap filter berubah
    const bases = Array.from(row.querySelectorAll('.game-card')).map(function (c) { return c.cloneNode(true); });

    let cards = [];
    let N = 0;
    let index = 0;
    let filter = '';
    let timer = null;
    let animating = false;
    let animId = 0;
    let settleTimer = null;

    function targetLeft(i) {
        const card = cards[i];
        return card.offsetLeft - (row.clientWidth - card.offsetWidth) / 2;
    }

    function setWidth() {
        return cards[N].offsetLeft - cards[0].offsetLeft;
    }

    function normalize() {
        if (animating || !N) return;
        if (index >= 2 * N) {
            row.scrollLeft -= setWidth();
        } else if (index < N) {
            row.scrollLeft += setWidth();
        }
        updateCenter();
    }

    function updateCenter() {
        if (!cards.length) return;
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

        // beri tahu konsol hanya saat tidak sedang animasi geser
        if (!animating) {
            const gi = Number(cards[closest].dataset.i);
            window.__gmCenter = gi;
            row.dispatchEvent(new CustomEvent('gcenter', { detail: gi }));
        }
    }

    function centerCard(i) {
        const id = ++animId;
        const start = row.scrollLeft;
        const distance = targetLeft(i) - start;
        const startTime = performance.now();
        animating = true;

        function step(now) {
            if (id !== animId) return;
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
        if (animating || !N) return;
        index = index + 1;
        centerCard(index);
    }

    function start() { stop(); if (N) timer = setInterval(next, INTERVAL); }
    function stop()  { if (timer) clearInterval(timer); timer = null; }

    function mount(f) {
        stop();
        filter = f || '';
        row.innerHTML = '';

        const list = bases.filter(function (b) { return !filter || b.dataset.genre === filter; });
        N = list.length;

        function make(b, isClone) {
            const c = b.cloneNode(true);
            if (isClone) {
                c.setAttribute('aria-hidden', 'true');
                c.querySelectorAll('button').forEach(function (btn) { btn.tabIndex = -1; });
            }
            return c;
        }

        list.forEach(function (b) { row.appendChild(make(b, true)); });
        list.forEach(function (b) { row.appendChild(make(b, false)); });
        list.forEach(function (b) { row.appendChild(make(b, true)); });

        cards = Array.from(row.querySelectorAll('.game-card'));
        index = N;
        animating = false;
        animId++;

        if (N) {
            row.scrollLeft = targetLeft(N);
            updateCenter();
            start();
        }
        row.dispatchEvent(new CustomEvent('gfilter', { detail: filter }));
    }

    function goto(i) {
        const g = GAMES[i];
        if (!g) return;
        if (filter && g.genre !== filter) mount('');
        const pos = cards.findIndex(function (c, k) { return k >= N && k < 2 * N && Number(c.dataset.i) === i; });
        if (pos < 0) return;
        stop();
        index = pos;
        centerCard(index);
        start();
    }

    function stepBy(d) {
        if (!N) return;
        stop();
        index = index + d;
        centerCard(index);
        start();
    }

    window.__stopGames = function () { stop(); };
    window.__gmGoto  = goto;
    window.__gmStep  = stepBy;
    window.__gmMount = mount;

    // klik kartrid: balik kartu (tombol ↻) atau masukkan ke konsol
    row.addEventListener('click', function (e) {
        const flip = e.target.closest('.gc-flip');
        if (flip) {
            e.stopPropagation();
            const card = flip.closest('.game-card');
            const gi = card.dataset.i;
            const willFlip = !card.classList.contains('is-flipped');
            row.querySelectorAll('.game-card[data-i="' + gi + '"]').forEach(function (c) {
                c.classList.toggle('is-flipped', willFlip);
            });
            return;
        }
        const card = e.target.closest('.game-card');
        if (!card) return;
        const gi = Number(card.dataset.i);
        if (window.__gmLoad) window.__gmLoad(gi); else goto(gi);
    });

    row.addEventListener('scroll', function () {
        updateCenter();
        clearTimeout(settleTimer);
        settleTimer = setTimeout(normalize, 150);
    });

    row.addEventListener('mouseenter', stop);
    row.addEventListener('mouseleave', start);
    row.addEventListener('touchstart', stop, { passive: true });
    row.addEventListener('touchend', start);

    mount('');
})();
</script>

{{-- ================= KONSOL, FILTER, SFX, CRT, TROFI, KONAMI ================= --}}
<script>
(function () {
    const GAMES     = window.__GM_GAMES || [];
    const row       = document.querySelector('[data-games-row]');
    const consoleEl = document.querySelector('[data-console]');
    const section   = document.querySelector('.games-section');
    if (!row || !consoleEl || !section) return;

    const $  = function (sel, root) { return (root || consoleEl).querySelector(sel); };
    const screen   = $('[data-gm-screen]');
    const offEl    = $('[data-gm-off]');
    const loadEl   = $('[data-gm-loading]');
    const onEl     = $('[data-gm-on]');
    const cover    = $('[data-gm-cover]');
    const imgEl    = $('[data-gm-img]');
    const tierEl   = $('[data-gm-tier]');
    const noEl     = $('[data-gm-no]');
    const nameEl   = $('[data-gm-name]');
    const genreEl  = $('[data-gm-genre]');
    const platEl   = $('[data-gm-platform]');
    const hoursDt  = $('[data-gm-hours-dt]');
    const hoursEl  = $('[data-gm-hours]');
    const ratingDt = $('[data-gm-rating-dt]');
    const ratingEl = $('[data-gm-rating]');
    const noteEl   = $('[data-gm-note]');
    const cartMini = $('[data-gm-cartmini]');

    let on = false;
    let current = 0;
    let lastRendered = -1;
    let bootTimer = null;

    function store(k, v) { try { localStorage.setItem(k, v); } catch (e) {} }
    function read(k)     { try { return localStorage.getItem(k); } catch (e) { return null; } }

    /* ---------- SFX 8-bit ---------- */
    let sfxOn = read('gm_sfx') !== '0';
    let armed = false;
    let ctx = null;

    function arm() { armed = true; }
    document.addEventListener('pointerdown', arm, { once: true });
    document.addEventListener('keydown', arm, { once: true });

    function beep(freq, dur, type, vol) {
        if (!sfxOn || !armed) return;
        try {
            if (!ctx) ctx = new (window.AudioContext || window.webkitAudioContext)();
            if (ctx.state === 'suspended') ctx.resume();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.type = type || 'square';
            osc.frequency.value = freq;
            gain.gain.value = vol || 0.035;
            osc.connect(gain);
            gain.connect(ctx.destination);
            const t = ctx.currentTime;
            osc.start(t);
            gain.gain.setValueAtTime(vol || 0.035, t);
            gain.gain.exponentialRampToValueAtTime(0.0001, t + (dur || 0.06));
            osc.stop(t + (dur || 0.06));
        } catch (e) {}
    }
    function jingle(notes) {
        notes.forEach(function (f, k) { setTimeout(function () { beep(f, 0.09); }, k * 90); });
    }

    document.addEventListener('mouseover', function (e) {
        const t = e.target.closest('.game-card, .gm-chip, .gm-dpad button, .gm-tier-item, .gm-mini, .gm-startbtn');
        if (t && !t.contains(e.relatedTarget)) beep(880, 0.03);
    });
    document.addEventListener('click', function (e) {
        if (e.target.closest('.game-card, .gm-chip, .gm-dpad button, .gm-tier-item, .gm-mini, .gm-startbtn, .gs-start')) beep(440, 0.07);
    });

    const sfxBtn = $('[data-gm-sfx]');
    function paintSfx() {
        sfxBtn.textContent = sfxOn ? 'SFX ON' : 'SFX OFF';
        sfxBtn.classList.toggle('is-off', !sfxOn);
    }
    sfxBtn.addEventListener('click', function () {
        sfxOn = !sfxOn;
        store('gm_sfx', sfxOn ? '1' : '0');
        paintSfx();
        if (sfxOn) beep(660, 0.08);
    });
    paintSfx();

    /* ---------- CRT ---------- */
    const crtBtn = $('[data-gm-crt]');
    function paintCrt(v) {
        section.classList.toggle('is-crt', v);
        crtBtn.textContent = v ? 'CRT ON' : 'CRT OFF';
        crtBtn.classList.toggle('is-off', !v);
    }
    let crtOn = read('gm_crt') === '1';
    paintCrt(crtOn);
    crtBtn.addEventListener('click', function () {
        crtOn = !crtOn;
        store('gm_crt', crtOn ? '1' : '0');
        paintCrt(crtOn);
    });

    /* ---------- Layar konsol ---------- */
    function heartsEl(n) {
        const w = document.createElement('span');
        w.className = 'gc-hearts';
        for (let k = 1; k <= 5; k++) {
            const h = document.createElement('span');
            h.className = 'gm-heart' + (k <= n ? ' on' : '');
            h.appendChild(document.createElement('i'));
            w.appendChild(h);
        }
        return w;
    }

    function render(i) {
        const d = GAMES[i];
        if (!d) return;
        current = i;
        lastRendered = i;

        if (imgEl.getAttribute('src') !== d.img) imgEl.setAttribute('src', d.img);
        imgEl.alt = d.name;
        noEl.textContent   = 'GAME ' + String(i + 1).padStart(2, '0') + ' / ' + String(GAMES.length).padStart(2, '0');
        nameEl.textContent = d.name;
        genreEl.textContent = d.genre;
        genreEl.hidden = !d.genre;
        platEl.textContent = d.platform;

        tierEl.textContent = d.tier || '';
        tierEl.hidden = !d.tier;

        const hasHours = !!d.hours;
        hoursEl.textContent = hasHours ? d.hours + ' JAM' : '';
        hoursEl.hidden = !hasHours;
        hoursDt.hidden = !hasHours;

        const hasRating = !!d.rating;
        ratingEl.innerHTML = '';
        if (hasRating) ratingEl.appendChild(heartsEl(d.rating));
        ratingEl.hidden = !hasRating;
        ratingDt.hidden = !hasRating;

        noteEl.textContent = d.note || '';
        noteEl.hidden = !d.note;

        cover.classList.remove('is-flash');
        void cover.offsetWidth;
        cover.classList.add('is-flash');
    }

    function cartInsert(i) {
        const d = GAMES[i];
        if (!d) return;
        cartMini.textContent = d.name.toUpperCase().slice(0, 12);
        cartMini.classList.add('is-loaded');
        cartMini.classList.remove('is-insert');
        void cartMini.offsetWidth;
        cartMini.classList.add('is-insert');
    }

    function powerOn(i) {
        if (on) { render(i); return; }
        on = true;
        render(i);
        offEl.hidden = true;
        onEl.hidden = true;
        loadEl.hidden = false;
        screen.classList.add('is-booting');
        jingle([392, 523, 659, 784]);
        clearTimeout(bootTimer);
        bootTimer = setTimeout(function () {
            loadEl.hidden = true;
            onEl.hidden = false;
            setTimeout(function () { screen.classList.remove('is-booting'); }, 500);
        }, 800);
        // ulangi animasi bar loading
        const bar = loadEl.querySelector('.gm-loadbar i');
        bar.style.animation = 'none';
        void bar.offsetWidth;
        bar.style.animation = '';
    }

    function eject() {
        on = false;
        clearTimeout(bootTimer);
        screen.classList.remove('is-booting');
        onEl.hidden = true;
        loadEl.hidden = true;
        offEl.hidden = false;
        cartMini.classList.remove('is-loaded');
        beep(220, 0.15);
    }

    window.__gmLoad = function (i) {
        cartInsert(i);
        if (!on) powerOn(i); else render(i);
        if (window.__gmGoto) window.__gmGoto(i);
    };

    // kartu di tengah berganti -> layar ikut (kalau konsol menyala)
    row.addEventListener('gcenter', function (e) {
        current = e.detail;
        if (on && lastRendered !== current) {
            render(current);
            cartInsert(current);
        }
    });

    document.querySelectorAll('[data-gm-start]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const gi = (typeof window.__gmCenter === 'number') ? window.__gmCenter : current;
            if (!on) powerOn(gi);
            if (btn.hasAttribute('data-gm-scroll')) {
                consoleEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    });

    $('[data-gm-eject]').addEventListener('click', eject);

    $('[data-gm-prev]').addEventListener('click', function () {
        if (!on) powerOn((typeof window.__gmCenter === 'number') ? window.__gmCenter : current);
        if (window.__gmStep) window.__gmStep(-1);
    });
    $('[data-gm-next]').addEventListener('click', function () {
        if (!on) powerOn((typeof window.__gmCenter === 'number') ? window.__gmCenter : current);
        if (window.__gmStep) window.__gmStep(1);
    });

    /* ---------- Filter genre ---------- */
    const chips = document.querySelectorAll('[data-gm-filter] .gm-chip');
    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            if (window.__gmMount) window.__gmMount(chip.dataset.genre);
        });
    });
    row.addEventListener('gfilter', function (e) {
        chips.forEach(function (c) { c.classList.toggle('is-active', c.dataset.genre === e.detail); });
    });

    /* ---------- Tier list: klik game -> masuk konsol ---------- */
    document.querySelectorAll('[data-gm-pick]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            window.__gmLoad(Number(btn.dataset.gmPick));
            consoleEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });

    /* ---------- Trofi ---------- */
    const secret = document.querySelector('[data-gm-secret]');
    function countTrophies() {
        const all = document.querySelectorAll('.gm-trophy');
        const got = document.querySelectorAll('.gm-trophy.is-unlocked');
        document.querySelectorAll('[data-gm-tcount]').forEach(function (el) {
            el.textContent = got.length + ' / ' + all.length;
        });
    }
    function unlockSecret(animate) {
        if (!secret || secret.classList.contains('is-unlocked')) return false;
        secret.classList.add('is-unlocked');
        secret.querySelector('[data-gm-secret-title]').textContent = 'KODE RAHASIA';
        secret.querySelector('[data-gm-secret-desc]').textContent = 'KONAMI CODE';
        if (animate) secret.classList.add('just-unlocked');
        countTrophies();
        return true;
    }
    if (read('gm_secret') === '1') unlockSecret(false);
    countTrophies();

    /* ---------- Konami code ---------- */
    const seq = ['arrowup', 'arrowup', 'arrowdown', 'arrowdown', 'arrowleft', 'arrowright', 'arrowleft', 'arrowright', 'b', 'a'];
    let pos = 0;

    function confetti() {
        const colors = ['#f9a825', '#ff5d7a', '#3ddc84', '#22d3ee', '#fff3b0'];
        for (let k = 0; k < 46; k++) {
            const c = document.createElement('i');
            c.className = 'gm-confetti';
            c.style.left = Math.random() * 100 + 'vw';
            c.style.background = colors[k % colors.length];
            c.style.animationDuration = (1.8 + Math.random() * 1.6) + 's';
            c.style.animationDelay = (Math.random() * 0.6) + 's';
            document.body.appendChild(c);
            setTimeout(function () { c.remove(); }, 4200);
        }
    }
    function toast(text) {
        const t = document.createElement('div');
        t.className = 'gm-toast';
        t.textContent = text;
        document.body.appendChild(t);
        setTimeout(function () { t.remove(); }, 2900);
    }

    document.addEventListener('keydown', function (e) {
        const tag = (e.target && e.target.tagName) || '';
        if (tag === 'INPUT' || tag === 'TEXTAREA') return;
        const k = (e.key || '').toLowerCase();
        if (k === seq[pos]) {
            pos++;
            if (pos === seq.length) {
                pos = 0;
                confetti();
                jingle([523, 659, 784, 1047, 784, 1047]);
                const first = unlockSecret(true);
                if (first) store('gm_secret', '1');
                toast(first ? 'CHEAT ACTIVATED! TROFI RAHASIA TERBUKA' : 'CHEAT ACTIVATED! +30 LIVES');
            }
        } else {
            pos = (k === seq[0]) ? 1 : 0;
        }
    });
})();
</script>

@endsection
