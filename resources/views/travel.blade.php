@extends('layouts.app')

@section('title', 'Traveling - My Portfolio')

@section('content')

@php
    // Urutan di sini = urutan STAGE di peta. Tambah tempat cukup dengan satu baris.
    // lat/lng = koordinat (negatif lat = Selatan). 'date' boleh diisi, mis. '12 JUL 2025', atau null.
    // CATATAN: koordinat di bawah masih perkiraan, ganti dengan koordinat asli dari Google Maps.
    $places = [
        ['name' => 'Bali',      'image' => 'images/travel/gunung-batur.jpg',      'location' => 'Gunung Batur',       'lat' => -8.2421, 'lng' => 115.3750, 'date' => null],
        ['name' => 'Bali',      'image' => 'images/travel/kebunraya-bedugul.jpg', 'location' => 'Kebun Raya Bedugul', 'lat' => -8.2750, 'lng' => 115.1660, 'date' => null],
        ['name' => 'Malang',    'image' => 'images/travel/malang.jpg',            'location' => 'KAI KOTA Malang',    'lat' => -7.9770, 'lng' => 112.6370, 'date' => null],
        ['name' => 'Surabaya',  'image' => 'images/travel/surabaya.jpg',          'location' => 'AADK Surabaya',      'lat' => -7.2575, 'lng' => 112.7521, 'date' => null],
        ['name' => 'Bali',      'image' => 'images/travel/bukitasah.jpg',         'location' => 'Bukit Asah',         'lat' => -8.5000, 'lng' => 115.5900, 'date' => null],
        ['name' => 'Bali',      'image' => 'images/travel/hutanpinus.jpg',        'location' => 'Hutan Pinus',        'lat' => -8.3400, 'lng' => 115.0900, 'date' => null],
    ];

    $cities = collect($places)->groupBy('name')->map(fn ($g) => $g->pluck('location')->values());
    $firstCity = $places[0]['name'];
    $total = count($places);

    // format koordinat: -8.2421 -> "8.24S"
    $fmtLat = fn ($v) => number_format(abs($v), 2) . ($v < 0 ? 'S' : 'N');
    $fmtLng = fn ($v) => number_format(abs($v), 2) . ($v < 0 ? 'W' : 'E');

    // ===== PETA PIXEL: Jawa Timur + Bali (grid 45 x 22 sel, 1 sel = sekitar 0,1 derajat) =====
    // Bentuk daratan digambar per baris: [kolom_awal, kolom_akhir]. Bentuknya stylized, bukan peta akurat.
    $mapCols = 45;
    $mapRows = 22;
    $landRanges = [
        0  => [[14, 22]],
        1  => [[0, 6],  [12, 26]],
        2  => [[0, 8],  [15, 26]],
        3  => [[0, 10], [17, 23]],
        4  => [[0, 12]],
        5  => [[0, 12]],
        6  => [[0, 12]],
        7  => [[0, 13]],
        8  => [[0, 14]],
        9  => [[0, 24]],
        10 => [[0, 26]],
        11 => [[0, 27]],
        12 => [[0, 28]],
        13 => [[0, 28], [33, 38]],
        14 => [[0, 28], [31, 40]],
        15 => [[0, 28], [30, 42]],
        16 => [[3, 27], [30, 43]],
        17 => [[12, 26], [31, 43]],
        18 => [[23, 27], [32, 42]],
        19 => [[24, 27], [33, 41]],
        20 => [[25, 26], [35, 39]],
        21 => [[36, 38]],
    ];
    $land = [];
    foreach ($landRanges as $r => $list) {
        foreach ($list as $range) {
            for ($c = $range[0]; $c <= $range[1]; $c++) {
                $land[$r][$c] = true;
            }
        }
    }

    // Posisi pin per kota [kolom, baris]. Pin hanya muncul untuk kota yang ada di $places,
    // jadi kalau nanti menambah tempat dengan 'name' => 'Banyuwangi', pinnya otomatis muncul.
    $pinPos = [
        'Bali'       => [36, 16],
        'Banyuwangi' => [27, 13],
        'Malang'     => [11, 11],
        'Surabaya'   => [12, 4],
    ];

    // Data kartu "tempat aktif" di samping peta (dipakai juga oleh JS untuk berganti kartu)
    $placeCards = collect($places)->map(fn ($p) => [
        'img'      => asset($p['image']),
        'name'     => $p['name'],
        'location' => $p['location'],
        'coord'    => $fmtLat($p['lat']) . ' ' . $fmtLng($p['lng']),
        'date'     => $p['date'] ?? '',
    ])->values();
    $firstCard = $placeCards[0];
@endphp

{{-- LANGIT PIXEL: awan + burung melintas --}}
<div class="tr-sky" aria-hidden="true">
    <div class="tr-cloud" style="top:9%;  --s:1.6; animation-duration:80s;  animation-delay:-12s"><i></i></div>
    <div class="tr-cloud" style="top:24%; --s:1;   animation-duration:58s;  animation-delay:-40s"><i></i></div>
    <div class="tr-cloud" style="top:44%; --s:2;   animation-duration:105s; animation-delay:-70s"><i></i></div>
    <div class="tr-cloud" style="top:68%; --s:1.2; animation-duration:70s;  animation-delay:-25s"><i></i></div>

    <div class="tr-bird" style="top:14%; animation-duration:26s; animation-delay:-4s"><i></i></div>
    <div class="tr-bird" style="top:33%; animation-duration:34s; animation-delay:-19s"><i></i></div>
    <div class="tr-bird" style="top:58%; animation-duration:30s; animation-delay:-9s"><i></i></div>
</div>

{{-- KOMPAS PIXEL --}}
<div class="tr-compass" aria-hidden="true">
    <div class="tr-compass-ring">
        <div class="tr-compass-face">
            <span class="cn">N</span><span class="ce">E</span><span class="cs">S</span><span class="cw">W</span>
            <div class="tr-needle"><i></i></div>
        </div>
    </div>
</div>

<section class="games-section">

    <a href="{{ url('/hobi') }}" class="gb-btn"><span class="gb-arrow">◀</span> BACK TO HOBBIES</a>

    <h1 class="games-title">Traveling</h1>
    <p class="games-subtitle">Tempat-tempat yang pernah saya kunjungi.</p>

    <div class="tv-top">

        {{-- PASPOR --}}
        <div class="pp-book" data-passport>
            <div class="pp-page pp-left">
                <small>PASSPORT</small>
                <div class="pp-holder">PEMEGANG: JSTN</div>
                <div class="pp-city" data-pp-city>{{ strtoupper($firstCity) }}</div>
                <ul class="pp-list" data-pp-list>
                    @foreach ($cities[$firstCity] as $loc)
                        <li>{{ $loc }}</li>
                    @endforeach
                </ul>
                <div class="pp-count" data-pp-count>{{ count($cities[$firstCity]) }} TEMPAT</div>
            </div>

            <div class="pp-page pp-right">
                <small>STAMPS</small>
                <div class="pp-stamps">
                    @foreach ($cities as $city => $locs)
                        <button type="button" class="pp-stamp {{ $city === $firstCity ? 'is-active' : '' }}" data-city="{{ $city }}">
                            <small>VISITED</small>
                            <strong>{{ strtoupper($city) }}</strong>
                            <span>{{ count($locs) }} TEMPAT</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- PETA STAGE --}}
        <div class="st-map" data-stage-map>
            <div class="st-head">▶ SELECT STAGE <span>{{ str_pad($total, 2, '0', STR_PAD_LEFT) }} STAGES</span></div>

            <div class="st-track">
                <div class="st-line"></div>

                @foreach ($places as $i => $place)
                    @php $x = $total > 1 ? ($i / ($total - 1)) * 100 : 50; @endphp
                    <button type="button" class="st-node {{ $i === 0 ? 'is-active' : '' }} {{ $i % 2 ? 'is-low' : '' }}"
                            style="left:{{ $x }}%" data-i="{{ $i }}">
                        <b>{{ $i + 1 }}</b>
                        <em>{{ $place['location'] }}</em>
                    </button>
                @endforeach

                <div class="st-bike" data-st-bike style="left:0%"><i class="tr-sprite"></i></div>
            </div>

            <div class="st-foot">
                <span>STAGE <b data-st-num>01</b></span>
                <span data-st-name>{{ $places[0]['location'] }}</span>
            </div>
        </div>

    </div>

    {{-- PETA PIXEL JAWA TIMUR + BALI --}}
    <div class="mp-panel" data-pixel-map>
        <div class="mp-head">▶ WORLD MAP <span>JAWA TIMUR + BALI</span></div>

        <div class="mp-body">
            <div class="mp-map">
                <svg class="mp-svg" viewBox="0 0 {{ $mapCols * 10 }} {{ $mapRows * 10 }}" preserveAspectRatio="none" aria-hidden="true">
                    @for ($r = 0; $r < $mapRows; $r++)
                        @for ($c = 0; $c < $mapCols; $c++)
                            @if (!empty($land[$r][$c]))
                                @php
                                    $top = !empty($land[$r - 1][$c]);
                                    $bot = !empty($land[$r + 1][$c]);
                                    $fill = !$top ? '#8ef0b0' : (!$bot ? '#1c7d4b' : ((($r + $c) % 2) ? '#2fbf71' : '#29b068'));
                                @endphp
                                <rect x="{{ $c * 10 }}" y="{{ $r * 10 }}" width="10" height="10" fill="{{ $fill }}"/>
                            @endif
                        @endfor
                    @endfor
                    <text x="30" y="76">JAWA TIMUR</text>
                    <text x="165" y="58">MADURA</text>
                    <text x="392" y="124">BALI</text>
                </svg>

                @foreach ($cities as $city => $locs)
                    @if (isset($pinPos[$city]))
                        @php
                            [$pc, $pr] = $pinPos[$city];
                            $px = (($pc + 0.5) / $mapCols) * 100;
                            $py = (($pr + 0.5) / $mapRows) * 100;
                        @endphp
                        <button type="button"
                                class="mp-pin {{ $city === $firstCity ? 'is-active' : '' }} {{ $pr < 8 ? 'tip-down' : '' }}"
                                style="left:{{ $px }}%;top:{{ $py }}%"
                                data-city="{{ $city }}"
                                aria-label="{{ $city }}: {{ count($locs) }} tempat">
                            <span class="mp-dot"></span>
                            <span class="mp-tip">
                                <b>{{ strtoupper($city) }}</b>
                                <ul>
                                    @foreach ($locs as $loc)
                                        <li>{{ $loc }}</li>
                                    @endforeach
                                </ul>
                                <em>{{ count($locs) }} TEMPAT</em>
                            </span>
                        </button>
                    @endif
                @endforeach
            </div>

            {{-- KARTU TEMPAT AKTIF --}}
            <div class="mp-card">
                <div class="mp-photo" data-mp-photo>
                    <img src="{{ $firstCard['img'] }}" alt="" data-mp-img>
                </div>
                <div class="mp-cap">
                    <span class="mp-stage">STAGE <b data-mp-stage>01</b> / {{ str_pad($total, 2, '0', STR_PAD_LEFT) }}</span>
                    <strong data-mp-name>{{ $firstCard['location'] }}</strong>
                    <span class="mp-citytag" data-mp-citytag>{{ strtoupper($firstCard['name']) }}</span>
                    <div class="mp-meta">
                        <span data-mp-coord>▸ {{ $firstCard['coord'] }}</span>
                        <span data-mp-date @if (!$firstCard['date']) hidden @endif>{{ $firstCard['date'] }}</span>
                    </div>
                </div>
            </div>

            {{-- STATISTIK PERJALANAN --}}
            <div class="mp-stats">
                <div class="mp-statrow">
                    <div class="mp-stat"><b>{{ str_pad(count($cities), 2, '0', STR_PAD_LEFT) }}</b><span>KOTA</span></div>
                    <div class="mp-stat"><b>{{ str_pad($total, 2, '0', STR_PAD_LEFT) }}</b><span>TEMPAT</span></div>
                </div>

                <div class="mp-fuel">
                    <small>PERJALANAN</small>
                    <div class="mp-fuel-bar" data-mp-fuel>
                        @for ($i = 0; $i < $total; $i++)
                            <i class="{{ $i === 0 ? 'on' : '' }}"></i>
                        @endfor
                    </div>
                </div>

                <ul class="mp-cities">
                    @foreach ($cities as $city => $locs)
                        <li data-city="{{ $city }}" class="{{ $city === $firstCity ? 'is-active' : '' }}">
                            <span>{{ strtoupper($city) }}</span><b>{{ str_pad(count($locs), 2, '0', STR_PAD_LEFT) }}</b>
                        </li>
                    @endforeach
                </ul>

                <p class="mp-hint">▸ ARAHKAN KURSOR KE PIN, KLIK UNTUK LOMPAT</p>
            </div>
        </div>

        <div class="mp-foot">
            <span>LOKASI <b data-mp-city>{{ strtoupper($firstCity) }}</b></span>
            <span data-mp-count>{{ count($cities[$firstCity]) }} TEMPAT</span>
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

    /* ===== BARIS ATAS ===== */
    .tv-top{display:grid;grid-template-columns:minmax(380px,520px) 1fr;gap:44px;align-items:start;
        margin-top:34px;max-width:1500px;position:relative;z-index:6}

    /* ===== PASPOR ===== */
    .pp-book{display:grid;grid-template-columns:1fr 1fr;min-height:280px;
        background:linear-gradient(160deg,#030c2b,#061a4d);
        border:3px solid #030c2b;box-shadow:0 0 0 3px #1e4fb8,8px 8px 0 3px rgba(30,79,184,.55);position:relative}
    .pp-book::after{content:"";position:absolute;top:0;bottom:0;left:50%;width:4px;margin-left:-2px;
        background:repeating-linear-gradient(to bottom,#1e4fb8 0 8px,transparent 8px 14px)}
    .pp-page{padding:20px 20px 18px;min-width:0}
    .pp-page > small{display:block;color:#22d3ee;font-size:.65rem;letter-spacing:.25em;margin-bottom:12px}
    .pp-holder{font-size:.62rem;letter-spacing:.14em;color:#b9c8f0;padding-bottom:10px;border-bottom:2px dashed #1e4fb8}
    .pp-city{margin:14px 0 10px;color:var(--accent,#f9a825);font-size:clamp(1.2rem,2.2vw,1.8rem);line-height:1.1;
        overflow-wrap:anywhere}
    .pp-list{list-style:none;display:flex;flex-direction:column;gap:6px;max-height:110px;overflow:auto}
    .pp-list li{color:#fff;font-size:.66rem;letter-spacing:.06em;text-transform:uppercase;line-height:1.35}
    .pp-list li::before{content:"▸ ";color:var(--accent,#f9a825)}
    .pp-count{margin-top:12px;color:#22d3ee;font-size:.62rem;letter-spacing:.2em}

    .pp-stamps{display:flex;flex-wrap:wrap;gap:14px}
    .pp-stamp{cursor:pointer;font:inherit;min-width:104px;padding:10px 12px;text-align:center;
        color:var(--accent,#f9a825);background:rgba(3,12,43,.6);border:3px dashed var(--accent,#f9a825);
        transform:rotate(-4deg);transition:transform .2s,background .2s}
    .pp-stamp:nth-child(even){transform:rotate(3deg)}
    .pp-stamp:hover,.pp-stamp:focus-visible{transform:rotate(0) scale(1.06);outline:none}
    .pp-stamp small{display:block;color:#22d3ee;font-size:.5rem;letter-spacing:.2em}
    .pp-stamp strong{display:block;margin:4px 0 3px;font-size:.85rem;letter-spacing:.08em}
    .pp-stamp span{color:#b9c8f0;font-size:.5rem;letter-spacing:.12em}
    .pp-stamp.is-active{background:var(--accent,#f9a825);border-style:solid;color:#061a4d}
    .pp-stamp.is-active small,.pp-stamp.is-active span{color:#061a4d}

    /* ===== PETA STAGE ===== */
    .st-map{padding:20px 26px 18px;min-width:0;
        background:linear-gradient(180deg,#0a2a7a 0%,#1e4fb8 100%);
        border:3px solid #030c2b;box-shadow:0 0 0 3px #1e4fb8,8px 8px 0 3px rgba(30,79,184,.55);position:relative}
    .st-map::before{content:"";position:absolute;inset:0;pointer-events:none;
        background:repeating-linear-gradient(0deg,rgba(0,0,0,.12) 0 2px,transparent 2px 4px)}
    .st-head{display:flex;justify-content:space-between;color:#fff;font-size:.7rem;letter-spacing:.2em;position:relative}
    .st-head span{color:#fff3b0}
    .st-track{position:relative;height:170px;margin:20px 34px 0}
    .st-line{position:absolute;left:0;right:0;top:50%;height:0;border-top:4px dashed #fff3b0;opacity:.8}

    .st-node{position:absolute;top:50%;width:34px;height:34px;margin:-17px 0 0 -17px;padding:0;cursor:pointer;
        font:inherit;background:#061a4d;border:3px solid #fff3b0;color:#fff3b0;
        display:grid;place-items:center;transition:transform .15s,background .15s}
    .st-node b{font-size:.75rem}
    .st-node em{position:absolute;top:44px;left:50%;transform:translateX(-50%);width:92px;text-align:center;
        font-style:normal;font-size:.5rem;letter-spacing:.06em;line-height:1.3;color:#fff;text-transform:uppercase}
    .st-node.is-low em{top:auto;bottom:44px}
    .st-node:hover,.st-node:focus-visible{transform:scale(1.15);outline:none}
    .st-node.is-active{background:var(--accent,#f9a825);color:#061a4d;border-color:#fff}

    .st-bike{position:absolute;top:calc(50% - 46px);width:30px;height:20px;margin-left:-15px;pointer-events:none;
        transition:left .9s steps(9);animation:trBob .4s steps(2) infinite}
    @keyframes trBob{50%{transform:translateY(-2px)}}
    .tr-sprite{position:absolute;left:0;top:0;width:5px;height:5px;background:transparent;
        --c:var(--accent,#f9a825);
        box-shadow:
            5px 0 var(--c),10px 0 var(--c),15px 0 var(--c),
            0 5px var(--c),5px 5px #fff3b0,10px 5px var(--c),15px 5px #fff3b0,20px 5px var(--c),25px 5px var(--c),
            0 10px var(--c),5px 10px var(--c),10px 10px var(--c),15px 10px var(--c),20px 10px var(--c),25px 10px var(--c),
            5px 15px #030c2b,20px 15px #030c2b}

    .st-foot{display:flex;justify-content:space-between;gap:12px;margin-top:6px;padding-top:12px;
        border-top:2px dashed #fff3b0;color:#fff;font-size:.68rem;letter-spacing:.14em;text-transform:uppercase;position:relative}
    .st-foot b{color:#fff3b0}

    /* ===== LANGIT: AWAN + BURUNG PIXEL ===== */
    .tr-sky{position:fixed;inset:0;overflow:hidden;pointer-events:none;z-index:1}

    .tr-cloud{position:absolute;left:-340px;transform-origin:0 0;opacity:.2;
        animation:trDrift linear infinite}
    .tr-cloud i{display:block;width:6px;height:6px;background:transparent;--c:#fff;
        box-shadow:
            18px 0 var(--c),24px 0 var(--c),
            12px 6px var(--c),18px 6px var(--c),24px 6px var(--c),30px 6px var(--c),36px 6px var(--c),
            0 12px var(--c),6px 12px var(--c),12px 12px var(--c),18px 12px var(--c),24px 12px var(--c),30px 12px var(--c),36px 12px var(--c),42px 12px var(--c)}
    @keyframes trDrift{
        from{transform:translateX(0) scale(var(--s,1))}
        to{transform:translateX(calc(100vw + 700px)) scale(var(--s,1))}
    }

    .tr-bird{position:absolute;left:-60px;opacity:.55;animation:trFly linear infinite}
    .tr-bird i{display:block;width:4px;height:4px;background:transparent;--c:#dbe7ff;
        box-shadow:0 0 var(--c),16px 0 var(--c),4px 4px var(--c),12px 4px var(--c),8px 8px var(--c);
        animation:trFlap .5s steps(1) infinite}
    @keyframes trFlap{
        0%{box-shadow:0 0 var(--c),16px 0 var(--c),4px 4px var(--c),12px 4px var(--c),8px 8px var(--c)}
        50%{box-shadow:0 4px var(--c),4px 0 var(--c),8px 4px var(--c),12px 0 var(--c),16px 4px var(--c)}
    }
    @keyframes trFly{
        0%{transform:translate(0,0)}
        50%{transform:translate(55vw,-26px)}
        100%{transform:translate(calc(100vw + 120px),12px)}
    }

    /* ===== KOMPAS PIXEL ===== */
    .tr-compass{position:fixed;top:108px;right:28px;z-index:7;pointer-events:none}
    .tr-compass-ring{width:68px;height:68px;padding:4px;background:#fff3b0;
        clip-path:polygon(0 18%,8% 18%,8% 8%,18% 8%,18% 0,82% 0,82% 8%,92% 8%,92% 18%,100% 18%,100% 82%,92% 82%,92% 92%,82% 92%,82% 100%,18% 100%,18% 92%,8% 92%,8% 82%,0 82%)}
    .tr-compass-face{position:relative;width:100%;height:100%;background:#061a4d;
        clip-path:polygon(0 18%,8% 18%,8% 8%,18% 8%,18% 0,82% 0,82% 8%,92% 8%,92% 18%,100% 18%,100% 82%,92% 82%,92% 92%,82% 92%,82% 100%,18% 100%,18% 92%,8% 92%,8% 82%,0 82%)}
    .tr-compass-face span{position:absolute;color:#fff3b0;font-size:.4rem;line-height:1}
    .tr-compass-face .cn{top:5px;left:50%;transform:translateX(-50%);color:var(--accent,#f9a825)}
    .tr-compass-face .cs{bottom:5px;left:50%;transform:translateX(-50%)}
    .tr-compass-face .ce{right:6px;top:50%;transform:translateY(-50%)}
    .tr-compass-face .cw{left:6px;top:50%;transform:translateY(-50%)}
    .tr-needle{position:absolute;inset:0;display:grid;place-items:center;
        animation:trSpin 14s steps(28) infinite}
    .tr-needle i{display:block;width:10px;height:34px;
        background:linear-gradient(to bottom,var(--accent,#f9a825) 50%,#fff 50%);
        clip-path:polygon(50% 0,100% 50%,50% 100%,0 50%)}
    @keyframes trSpin{to{transform:rotate(360deg)}}

    /* ===== KARTU FOTO ALA POLAROID ===== */
    .game-card{position:relative}
    .tr-no{position:absolute;top:10px;left:10px;z-index:2;padding:4px 7px;
        background:#061a4d;color:#fff3b0;border:2px solid #fff3b0;
        font-size:.55rem;letter-spacing:.14em;line-height:1}
    .tr-meta{display:flex;flex-wrap:wrap;gap:6px 12px;margin-top:8px;padding-top:8px;
        border-top:2px dashed rgba(255,243,176,.55);
        font-size:.55rem;letter-spacing:.1em;line-height:1.3;color:#22d3ee;text-transform:uppercase}
    .tr-meta .tr-date{color:#fff3b0}

    /* ===== PETA PIXEL JAWA TIMUR + BALI ===== */
    .mp-panel{max-width:1500px;margin-top:44px;padding:20px 26px 18px;position:relative;z-index:6;
        background:linear-gradient(180deg,#0a2a7a 0%,#1e4fb8 100%);
        border:3px solid #030c2b;box-shadow:0 0 0 3px #1e4fb8,8px 8px 0 3px rgba(30,79,184,.55)}
    .mp-panel::before{content:"";position:absolute;inset:0;pointer-events:none;
        background:repeating-linear-gradient(0deg,rgba(0,0,0,.12) 0 2px,transparent 2px 4px)}
    .mp-head{display:flex;justify-content:space-between;color:#fff;font-size:.7rem;letter-spacing:.2em;position:relative}
    .mp-head span{color:#fff3b0}
    .mp-body{position:relative;z-index:1;display:grid;grid-template-columns:minmax(0,1.7fr) minmax(0,1fr) 190px;gap:24px;margin-top:16px;align-items:center}
    .mp-map{position:relative;aspect-ratio:45/22;min-width:0}
    .mp-svg{display:block;width:100%;height:100%;shape-rendering:crispEdges}
    .mp-svg text{font-family:inherit;font-size:7px;letter-spacing:.5px;fill:#cfe3ff}

    /* kartu tempat aktif (polaroid) */
    .mp-card{position:relative;padding:12px 12px 14px;background:#f4f0e1;color:#061a4d;
        border:3px solid #030c2b;box-shadow:5px 5px 0 rgba(3,12,43,.5);transform:rotate(1.5deg)}
    .mp-card::before{content:"";position:absolute;top:-13px;left:50%;width:70px;height:18px;margin-left:-35px;
        background:rgba(249,168,37,.9);border:2px dashed rgba(3,12,43,.45);transform:rotate(-3deg)}
    .mp-photo{position:relative;aspect-ratio:16/10;background:#030c2b;border:3px solid #030c2b;overflow:hidden}
    .mp-photo img{display:block;width:100%;height:100%;object-fit:cover}
    .mp-photo::after{content:"";position:absolute;inset:0;pointer-events:none;
        background:repeating-linear-gradient(0deg,rgba(0,0,0,.1) 0 2px,transparent 2px 4px)}
    .mp-photo.is-flash img{animation:mpFlash .3s steps(3)}
    @keyframes mpFlash{from{filter:brightness(2.2) contrast(.6)}to{filter:none}}
    .mp-cap{display:flex;flex-direction:column;gap:5px;margin-top:10px}
    .mp-stage{font-size:.5rem;letter-spacing:.18em;color:#1e4fb8}
    .mp-stage b{color:#061a4d}
    .mp-cap strong{font-size:.8rem;letter-spacing:.06em;line-height:1.25;text-transform:uppercase;overflow-wrap:anywhere}
    .mp-citytag{font-size:.55rem;letter-spacing:.16em;color:#c25e00}
    .mp-meta{display:flex;flex-wrap:wrap;gap:4px 12px;margin-top:4px;padding-top:7px;
        border-top:2px dashed #1e4fb8;font-size:.5rem;letter-spacing:.1em;line-height:1.3;color:#1e4fb8;text-transform:uppercase}
    .mp-meta [hidden]{display:none}

    /* statistik perjalanan */
    .mp-stats{display:flex;flex-direction:column;gap:12px;min-width:0}
    .mp-statrow{display:grid;grid-template-columns:1fr 1fr;gap:10px}
    .mp-fuel,.mp-cities{padding:9px 10px;background:rgba(3,12,43,.55);border:2px dashed #fff3b0}
    .mp-fuel small{display:block;margin-bottom:7px;color:#fff;font-size:.5rem;letter-spacing:.18em}
    .mp-fuel-bar{display:flex;gap:3px}
    .mp-fuel-bar i{flex:1;height:10px;background:#061a4d;border:2px solid #030c2b}
    .mp-fuel-bar i.on{background:var(--accent,#f9a825)}
    .mp-cities{list-style:none;display:flex;flex-direction:column;gap:6px}
    .mp-cities li{display:flex;justify-content:space-between;gap:8px;color:#b9c8f0;font-size:.55rem;letter-spacing:.12em}
    .mp-cities li b{color:#fff3b0}
    .mp-cities li.is-active{color:var(--accent,#f9a825)}
    .mp-cities li.is-active span::before{content:"▸ "}
    .mp-stat{padding:10px 12px;background:rgba(3,12,43,.55);border:2px dashed #fff3b0;text-align:center}
    .mp-stat b{display:block;color:var(--accent,#f9a825);font-size:1.3rem;line-height:1}
    .mp-stat span{display:block;margin-top:6px;color:#fff;font-size:.5rem;letter-spacing:.18em}
    .mp-hint{color:#fff3b0;font-size:.5rem;letter-spacing:.14em;line-height:1.7}

    .mp-foot{display:flex;justify-content:space-between;gap:12px;margin-top:14px;padding-top:12px;
        border-top:2px dashed #fff3b0;color:#fff;font-size:.68rem;letter-spacing:.14em;text-transform:uppercase;
        position:relative;z-index:1}
    .mp-foot b{color:#fff3b0}

    .mp-pin{position:absolute;width:18px;height:18px;margin:-9px 0 0 -9px;padding:0;border:0;background:none;
        cursor:pointer;font:inherit;z-index:2}
    .mp-pin:focus-visible{outline:2px dashed #fff;outline-offset:6px}
    .mp-dot{position:absolute;inset:0;background:var(--accent,#f9a825);border:3px solid #030c2b;
        animation:mpBlink 1s steps(2) infinite;transition:transform .15s}
    .mp-dot::before{content:"";position:absolute;inset:-6px;border:2px solid var(--accent,#f9a825);
        animation:mpPing 1.6s steps(4) infinite}
    .mp-dot::after{content:"";position:absolute;left:50%;bottom:-9px;width:6px;height:6px;margin-left:-3px;background:#030c2b}
    @keyframes mpBlink{50%{background:#fff}}
    @keyframes mpPing{from{opacity:.9;transform:scale(.6)}to{opacity:0;transform:scale(1.9)}}
    .mp-pin:hover .mp-dot,.mp-pin:focus-visible .mp-dot{transform:scale(1.2)}
    .mp-pin.is-active .mp-dot{background:#fff;border-color:#030c2b;transform:scale(1.25);
        animation-name:mpBlinkActive}
    @keyframes mpBlinkActive{50%{background:var(--accent,#f9a825)}}

    .mp-tip{position:absolute;left:50%;bottom:26px;transform:translateX(-50%);min-width:130px;padding:10px 12px;
        background:#030c2b;border:3px solid #fff3b0;box-shadow:4px 4px 0 rgba(0,0,0,.35);
        color:#fff;font-size:.55rem;letter-spacing:.08em;line-height:1.3;text-transform:uppercase;text-align:left;white-space:nowrap;
        opacity:0;visibility:hidden;pointer-events:none;transition:opacity .12s;z-index:5}
    .mp-pin.tip-down .mp-tip{bottom:auto;top:26px}
    .mp-pin:hover .mp-tip,.mp-pin:focus-visible .mp-tip{opacity:1;visibility:visible}
    .mp-tip b{display:block;margin-bottom:6px;color:var(--accent,#f9a825);font-size:.65rem}
    .mp-tip ul{list-style:none;display:flex;flex-direction:column;gap:4px}
    .mp-tip li::before{content:"▸ ";color:#22d3ee}
    .mp-tip em{display:block;margin-top:8px;font-style:normal;color:#22d3ee}

    @media (hover:none){
        .mp-pin.is-active .mp-tip{opacity:1;visibility:visible}
    }
    @media (max-width:1100px){
        .mp-body{grid-template-columns:1fr 1fr;gap:24px}
        .mp-map{grid-column:1 / -1}
    }
    @media (max-width:700px){
        .mp-body{grid-template-columns:1fr;gap:22px}
        .mp-card{transform:none}
    }
    @media (prefers-reduced-motion:reduce){
        .mp-dot,.mp-dot::before,.mp-photo.is-flash img{animation:none}
    }

    @media (prefers-reduced-motion:reduce){
        .tr-cloud,.tr-bird,.tr-bird i,.tr-needle{animation:none}
        .tr-cloud{left:12%}
        .tr-bird{left:40%}
    }

    @media (max-width:1000px){
        .tv-top{grid-template-columns:1fr;gap:34px}
        .st-track{margin:20px 40px 0}
    }
    @media (max-width:1250px){
        .tr-compass{display:none}
    }
    @media (max-width:560px){
        .pp-book{grid-template-columns:1fr}
        .pp-book::after{display:none}
        .st-node em{display:none}
    }
    </style>

    <div class="games-row" data-games-row>
        @foreach ($places as $i => $place)
            <div class="game-card">
                <span class="tr-no">NO.{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <img src="{{ asset($place['image']) }}" alt="{{ $place['name'] }}">
                <div class="game-info">
                    <h3>{{ $place['name'] }}</h3>
                    <span>{{ $place['location'] }}</span>
                    <div class="tr-meta">
                        <span class="tr-coord">▸ {{ $fmtLat($place['lat']) }} {{ $fmtLng($place['lng']) }}</span>
                        @if (!empty($place['date']))
                            <span class="tr-date">{{ $place['date'] }}</span>
                        @endif
                    </div>
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
        row.dispatchEvent(new CustomEvent('trcenter', { detail: ((closest % N) + N) % N }));
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

    // dipakai peta stage: lompat ke kartu ke-i
    window.__trGoto = function (i) {
        if (animating) return;
        stop();
        index = N + i;
        centerCard(index);
        start();
    };

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

<script>
(function () {
    const row   = document.querySelector('[data-games-row]');
    const map   = document.querySelector('[data-stage-map]');
    const book  = document.querySelector('[data-passport]');
    if (!row || !map || !book) return;

    const places = @json($places);
    const cities = @json($cities);
    const total  = places.length;

    const nodes  = map.querySelectorAll('.st-node');
    const bike   = map.querySelector('[data-st-bike]');
    const numEl  = map.querySelector('[data-st-num]');
    const nameEl = map.querySelector('[data-st-name]');

    const cityEl  = book.querySelector('[data-pp-city]');
    const listEl  = book.querySelector('[data-pp-list]');
    const countEl = book.querySelector('[data-pp-count]');
    const stamps  = book.querySelectorAll('.pp-stamp');

    const mapPanel = document.querySelector('[data-pixel-map]');
    const pins     = mapPanel ? mapPanel.querySelectorAll('.mp-pin') : [];
    const mpCity   = mapPanel ? mapPanel.querySelector('[data-mp-city]') : null;
    const mpCount  = mapPanel ? mapPanel.querySelector('[data-mp-count]') : null;

    const cardsData = @json($placeCards);
    const q = function (sel) { return mapPanel ? mapPanel.querySelector(sel) : null; };
    const mpPhoto   = q('[data-mp-photo]');
    const mpImg     = q('[data-mp-img]');
    const mpStage   = q('[data-mp-stage]');
    const mpName    = q('[data-mp-name]');
    const mpCityTag = q('[data-mp-citytag]');
    const mpCoord   = q('[data-mp-coord]');
    const mpDate    = q('[data-mp-date]');
    const fuelSegs  = mapPanel ? mapPanel.querySelectorAll('[data-mp-fuel] i') : [];
    const cityRows  = mapPanel ? mapPanel.querySelectorAll('.mp-cities li') : [];
    let lastCard = 0;

    function showCity(name) {
        const locs = cities[name] || [];
        cityEl.textContent = name.toUpperCase();
        listEl.innerHTML = '';
        locs.forEach(function (l) {
            const li = document.createElement('li');
            li.textContent = l;
            listEl.appendChild(li);
        });
        countEl.textContent = locs.length + ' TEMPAT';
        stamps.forEach(function (s) { s.classList.toggle('is-active', s.dataset.city === name); });

        pins.forEach(function (p) { p.classList.toggle('is-active', p.dataset.city === name); });
        if (mpCity)  mpCity.textContent  = name.toUpperCase();
        if (mpCount) mpCount.textContent = locs.length + ' TEMPAT';
        cityRows.forEach(function (li) { li.classList.toggle('is-active', li.dataset.city === name); });
    }

    function showCard(i) {
        const d = cardsData[i];
        if (!mapPanel || !d) return;

        if (mpImg && mpImg.getAttribute('src') !== d.img) mpImg.setAttribute('src', d.img);
        if (mpStage)   mpStage.textContent   = String(i + 1).padStart(2, '0');
        if (mpName)    mpName.textContent    = d.location;
        if (mpCityTag) mpCityTag.textContent = d.name.toUpperCase();
        if (mpCoord)   mpCoord.textContent   = '▸ ' + d.coord;
        if (mpDate) {
            mpDate.textContent = d.date;
            mpDate.hidden = !d.date;
        }
        fuelSegs.forEach(function (s, k) { s.classList.toggle('on', k <= i); });

        // efek kilat kecil hanya saat tempatnya benar-benar berganti
        if (mpPhoto && i !== lastCard) {
            mpPhoto.classList.remove('is-flash');
            void mpPhoto.offsetWidth;
            mpPhoto.classList.add('is-flash');
        }
        lastCard = i;
    }

    function showStage(i) {
        nodes.forEach(function (n, k) { n.classList.toggle('is-active', k === i); });
        bike.style.left = (total > 1 ? (i / (total - 1)) * 100 : 50) + '%';
        numEl.textContent = String(i + 1).padStart(2, '0');
        nameEl.textContent = places[i].location;
        showCity(places[i].name);
        showCard(i);
    }

    // kartu foto di tengah berganti -> motor dan paspor ikut
    row.addEventListener('trcenter', function (e) { showStage(e.detail); });

    // klik titik stage -> kartu foto ikut ke tengah
    nodes.forEach(function (n) {
        n.addEventListener('click', function () {
            const i = Number(n.dataset.i);
            showStage(i);
            if (window.__trGoto) window.__trGoto(i);
        });
    });

    // klik stempel -> buka halaman kota, lompat ke tempat pertama kota itu
    stamps.forEach(function (s) {
        s.addEventListener('click', function () {
            const first = places.findIndex(function (p) { return p.name === s.dataset.city; });
            if (first < 0) return;
            showStage(first);
            if (window.__trGoto) window.__trGoto(first);
        });
    });

    // klik pin di peta -> sama seperti klik stempel
    pins.forEach(function (p) {
        p.addEventListener('click', function () {
            const first = places.findIndex(function (pl) { return pl.name === p.dataset.city; });
            if (first < 0) return;
            showStage(first);
            if (window.__trGoto) window.__trGoto(first);
        });
    });
})();
</script>

@endsection
