{{-- resources/views/partials/hobbies-extras.blade.php
     Dipanggil dari hobbies.blade.php lewat @section('after_content') (di luar <main>).
     Isi: Level Hobi, Tier List, Galeri Momen (foto otomatis dari public/images/galeri). --}}

@php
    // ===== Ubah di sini saja =====

    // [hobi, level, % XP menuju level berikutnya, "sejak kapan", "seberapa sering"]
    $levels = [
        ['Gaming',    12, 70, 'Sejak SMP',     '±10 jam / minggu'],
        ['Traveling',  7, 45, 'Sejak 2022',    'Setiap ada libur'],
        ['Music',     15, 85, 'Sejak kecil',   'Hampir setiap hari'],
    ];

    // Tier list: tiap kategori punya tier S, A, B, C. Isi dengan pilihanmu.
    $tiers = [
        'Game' => [
            'S' => ['Valorant', 'Minecraft', 'GTA V'],
            'A' => ['Roblox', 'PUBG Mobile', 'Stardew Valley', 'EA FC', 'Peak', 'The Sims 4', 'Subnautica'],
            'B' => [],
            'C' => [],
        ],
        'Lagu' => [
            'S' => ['Hanna Montana', 'Sorrowful Reunion', 'Tipu Daya', 'Kalah Lagi', 'Kabar Bahagia', 'Metakritik', 'Bayangkan Jika Kita Tidak Menyerah'],
            'A' => ['15.000 langkah', 'Sambutlah', 'Rayakan Hari Ini', 'Dua Bilah Mata Pedang', 'Sway'],
            'B' => ['Lewat Jam Malam'],
            'C' => [],
        ],
        'Tempat' => [
            'S' => ['Gunung Batur', 'Bukit Asah', 'Malang', 'Surabaya'],
            'A' => ['Kebun Raya Bedugul', 'Hutan Pinus'],
            'B' => [],
            'C' => [],
        ],
    ];

    // Galeri: semua foto di public/images/galeri otomatis tampil. Nama file jadi keterangan foto.
    $dir = public_path('images/galeri');
    $photos = collect(is_dir($dir) ? scandir($dir) : [])
        ->filter(fn ($f) => preg_match('/\.(jpe?g|png|webp|gif)$/i', $f))
        ->sort()->values()->take(24)
        ->map(fn ($f) => [
            'src' => asset('images/galeri/' . rawurlencode($f)),
            'cap' => ucfirst(trim(str_replace(['-', '_'], ' ', pathinfo($f, PATHINFO_FILENAME)))),
        ]);
@endphp

<style>
/* Pita selebar layar di bawah <main>, menyambung langsung ke footer */
.hb{--navy:#061a4d;--deep:#030c2b;--cyan:#22d3ee;--gold:var(--accent,#f9a825);--orange:var(--accent2,#ff8a00);
    --edge:#1e4fb8;position:relative;display:grid;gap:64px;color:#fff;width:100%;margin:0;
    padding:80px max(55px, calc((100vw - 1400px) / 2 + 55px)) 90px;
    background:#041544;border-top:4px solid var(--edge)}
/* Pembatas pixel */
.hb::before{content:"";position:absolute;left:0;right:0;top:-4px;height:8px;
    background:repeating-linear-gradient(90deg,var(--gold) 0 12px,transparent 12px 24px)}
.hb>section{position:relative;z-index:1;max-width:1000px}
.hb h2{font-size:clamp(1.5rem,3vw,2.1rem);margin:0 0 22px;color:var(--gold);text-shadow:3px 3px 0 var(--accent-dark,#7a3a00)}
.hb-panel{background:linear-gradient(160deg,var(--deep),var(--navy));border:2px solid var(--edge);
    box-shadow:6px 6px 0 rgba(30,79,184,.55);border-radius:4px}
.hb-rv{opacity:0;transform:translateY(26px);transition:opacity .6s ease,transform .6s ease}
.hb-rv.in{opacity:1;transform:none}

/* Level hobi */
.hb-levels{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:24px}
.hb-level{padding:22px 24px}
.hb-level h3{margin:0;color:var(--cyan);font-size:1.1rem}
.hb-lv{display:flex;align-items:baseline;gap:8px;margin:10px 0 12px}
.hb-lv b{font-size:2.6rem;line-height:1;color:var(--gold);text-shadow:3px 3px 0 var(--accent-dark,#7a3a00)}
.hb-lv span{color:#b9c8f0;font-weight:700}
.hb-bar{height:14px;background:#0a2466;border:2px solid var(--edge)}
.hb-bar i{display:block;height:100%;width:0;transition:width 1.1s steps(14);
    background:repeating-linear-gradient(90deg,var(--gold) 0 10px,var(--orange) 10px 12px)}
.hb-rv.in .hb-bar i{width:var(--w)}
.hb-meta{margin:12px 0 0;color:#b9c8f0;font-size:.9rem;line-height:1.6}

/* Tier list */
.hb-tabs{display:flex;flex-wrap:wrap;gap:10px;margin-bottom:18px}
.hb-tab{cursor:pointer;font:inherit;font-weight:800;padding:8px 18px;color:#cfe0ff;background:#0a2466;border:2px solid var(--edge)}
.hb-tab[aria-selected="true"]{background:var(--gold);border-color:var(--gold);color:var(--navy)}
.hb-tab:focus-visible{outline:2px solid var(--cyan);outline-offset:2px}
.hb-tier{display:grid;grid-template-columns:64px 1fr;border-bottom:2px solid var(--edge)}
.hb-tier:last-child{border-bottom:0}
.hb-tier>b{display:grid;place-items:center;font-size:1.8rem;color:var(--navy);padding:14px 0}
.hb-tier.S>b{background:var(--gold)}
.hb-tier.A>b{background:var(--orange)}
.hb-tier.B>b{background:var(--cyan)}
.hb-tier.C>b{background:#6f86c4}
.hb-items{display:flex;flex-wrap:wrap;gap:8px;align-items:center;padding:12px 16px}
.hb-items span{padding:6px 12px;border:2px solid var(--edge);background:rgba(10,36,102,.6);font-weight:700;font-size:.9rem}
.hb-items em{font-style:normal;color:#6f86c4}

/* Galeri */
.hb-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:16px}
.hb-thumb{padding:0;cursor:pointer;overflow:hidden;aspect-ratio:4/3;background:#0a2466;border:2px solid var(--edge);
    box-shadow:4px 4px 0 rgba(30,79,184,.55);transition:transform .15s,border-color .15s}
.hb-thumb:hover,.hb-thumb:focus-visible{transform:translate(-2px,-2px);border-color:var(--gold);outline:none}
.hb-thumb img{display:block;width:100%;height:100%;object-fit:cover}
.hb-empty{padding:22px 24px;color:#b9c8f0;line-height:1.6}

/* Pendar emas dan partikel di dasar halaman */
.hb-embers{position:absolute;left:0;right:0;bottom:0;height:620px;overflow:hidden;pointer-events:none;z-index:0}
.hb-glow{position:absolute;inset:0;background:var(--gold);opacity:.3;
    -webkit-mask-image:linear-gradient(to top,#000,transparent);mask-image:linear-gradient(to top,#000,transparent)}
.hb-ember{position:absolute;bottom:-12px;width:var(--s);height:var(--s);background:var(--gold);opacity:0;
    animation:hbrise var(--d) linear var(--delay) infinite}
.hb-ember:nth-child(4n+1){background:#fff3c4}
@keyframes hbrise{
    0%{transform:translate(0,0);opacity:0}
    15%{opacity:.95}
    60%{opacity:.7}
    100%{transform:translate(var(--dx),-580px);opacity:0}
}

/* Lightbox (dipindah ke <body> oleh script, jadi variabel warnanya ditulis ulang di sini) */
.hb-lb{--gold:var(--accent,#f9a825);--orange:var(--accent2,#ff8a00);--navy:#061a4d;--cyan:#22d3ee;
    position:fixed;inset:0;z-index:9996;display:none;flex-direction:column;align-items:center;justify-content:center;
    gap:14px;padding:24px;background:rgba(3,12,43,.94);color:#fff}
.hb-lb.open{display:flex}
.hb-lb img{max-width:min(92vw,1100px);max-height:76vh;border:3px solid var(--gold);box-shadow:6px 6px 0 var(--orange)}
.hb-lb p{margin:0;color:#cfe0ff;font-weight:700;text-align:center}
.hb-lb button{cursor:pointer;font:inherit;font-weight:800;color:var(--navy);background:var(--gold);border:2px solid var(--gold);
    padding:8px 16px;box-shadow:3px 3px 0 var(--orange)}
.hb-lb button:focus-visible{outline:3px solid var(--cyan)}
.hb-lb-nav{display:flex;gap:12px}
.hb-lb-close{position:absolute;top:18px;right:18px}

@media (max-width:700px){.hb{padding:60px 5vw 70px}}
@media (max-width:600px){.hb-tier{grid-template-columns:48px 1fr}}
@media (prefers-reduced-motion:reduce){
    .hb-rv{opacity:1;transform:none;transition:none}
    .hb-bar i{transition:none;width:var(--w)}
    .hb-ember{display:none}
}
</style>

<div class="hb">

    <div class="hb-embers" aria-hidden="true">
        <div class="hb-glow"></div>
        @for ($i = 0; $i < 48; $i++)
            <span class="hb-ember" style="left:{{ ($i * 37 + 11) % 100 }}%;--s:{{ 4 + ($i % 3) * 2 }}px;--d:{{ 7 + ($i * 5) % 7 }}s;--delay:-{{ ($i * 3) % 13 }}s;--dx:{{ (($i * 13) % 60) - 30 }}px"></span>
        @endfor
    </div>

    {{-- Level hobi --}}
    <section class="hb-rv" aria-labelledby="hb-level-title">
        <h2 id="hb-level-title">Level Hobi</h2>
        <div class="hb-levels">
            @foreach ($levels as [$name, $lv, $xp, $since, $freq])
                <div class="hb-panel hb-level">
                    <h3>{{ $name }}</h3>
                    <div class="hb-lv"><b>{{ $lv }}</b><span>LEVEL</span></div>
                    <div class="hb-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"
                         aria-valuenow="{{ $xp }}" aria-label="XP {{ $name }}"><i style="--w:{{ $xp }}%"></i></div>
                    <p class="hb-meta">{{ $xp }}% menuju level {{ $lv + 1 }}<br>{{ $since }} &bull; {{ $freq }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Tier list --}}
    <section class="hb-rv" aria-labelledby="hb-tier-title">
        <h2 id="hb-tier-title">Tier List</h2>
        <div class="hb-tabs" role="tablist" aria-label="Kategori tier list">
            @foreach ($tiers as $cat => $rows)
                <button type="button" class="hb-tab" role="tab" id="hb-tab-{{ $loop->index }}"
                        aria-controls="hb-tp-{{ $loop->index }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $cat }}</button>
            @endforeach
        </div>
        @foreach ($tiers as $cat => $rows)
            <div class="hb-panel hb-tierpanel" role="tabpanel" id="hb-tp-{{ $loop->index }}"
                 aria-labelledby="hb-tab-{{ $loop->index }}" {{ $loop->first ? '' : 'hidden' }}>
                @foreach ($rows as $tier => $items)
                    <div class="hb-tier {{ $tier }}">
                        <b>{{ $tier }}</b>
                        <div class="hb-items">
                            @forelse ($items as $item)
                                <span>{{ $item }}</span>
                            @empty
                                <em>-</em>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </section>

    {{-- Galeri momen --}}
    <section class="hb-rv" aria-labelledby="hb-gal-title">
        <h2 id="hb-gal-title">Galeri Momen</h2>
        @if ($photos->isEmpty())
            <div class="hb-panel hb-empty">
                Belum ada foto. Taruh foto (jpg, png, atau webp) di folder <b>public/images/galeri</b>, lalu refresh halaman ini.
            </div>
        @else
            <div class="hb-grid">
                @foreach ($photos as $p)
                    <button type="button" class="hb-thumb" data-src="{{ $p['src'] }}" data-cap="{{ $p['cap'] }}"
                            aria-label="Buka foto: {{ $p['cap'] }}">
                        <img src="{{ $p['src'] }}" alt="{{ $p['cap'] }}" loading="lazy">
                    </button>
                @endforeach
            </div>

            <div class="hb-lb" id="hb-lb" role="dialog" aria-modal="true" aria-label="Foto besar">
                <button type="button" class="hb-lb-close" id="hb-lb-close">Tutup</button>
                <img id="hb-lb-img" src="" alt="">
                <p id="hb-lb-cap"></p>
                <div class="hb-lb-nav">
                    <button type="button" id="hb-lb-prev">Sebelumnya</button>
                    <button type="button" id="hb-lb-next">Berikutnya</button>
                </div>
            </div>
        @endif
    </section>
</div>

<script>
(function () {
    // Muncul pelan saat di-scroll
    var items = document.querySelectorAll('.hb-rv');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if ('IntersectionObserver' in window && !reduce) {
        var io = new IntersectionObserver(function (es) {
            es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
        }, { threshold: 0.12 });
        items.forEach(function (el) { io.observe(el); });
    } else {
        items.forEach(function (el) { el.classList.add('in'); });
    }

    // Tab tier list
    var tabs = document.querySelectorAll('.hb-tab'), panels = document.querySelectorAll('.hb-tierpanel');
    tabs.forEach(function (t) {
        t.addEventListener('click', function () {
            tabs.forEach(function (x) { x.setAttribute('aria-selected', x === t ? 'true' : 'false'); });
            panels.forEach(function (p) { p.hidden = p.id !== t.getAttribute('aria-controls'); });
        });
    });

    // Lightbox galeri. Dipindah ke <body> supaya tampil di atas header dan tombol lain.
    document.querySelectorAll('body > #hb-lb').forEach(function (el) { el.remove(); });
    var lb = document.getElementById('hb-lb');
    if (!lb) return;
    document.body.appendChild(lb);

    var thumbs = document.querySelectorAll('.hb-thumb');
    var img = document.getElementById('hb-lb-img'), cap = document.getElementById('hb-lb-cap');
    var idx = 0, opener = null;

    function show(i) {
        idx = (i + thumbs.length) % thumbs.length;
        var t = thumbs[idx];
        img.src = t.dataset.src;
        img.alt = t.dataset.cap;
        cap.textContent = t.dataset.cap + '  (' + (idx + 1) + '/' + thumbs.length + ')';
    }
    function openLb(i) {
        opener = thumbs[i];
        show(i);
        lb.classList.add('open');
        document.body.style.overflow = 'hidden';
        document.getElementById('hb-lb-close').focus();
    }
    function closeLb() {
        lb.classList.remove('open');
        document.body.style.overflow = '';
        if (opener) opener.focus();
    }

    thumbs.forEach(function (t, i) { t.addEventListener('click', function () { openLb(i); }); });
    document.getElementById('hb-lb-close').addEventListener('click', closeLb);
    document.getElementById('hb-lb-prev').addEventListener('click', function () { show(idx - 1); });
    document.getElementById('hb-lb-next').addEventListener('click', function () { show(idx + 1); });
    lb.addEventListener('click', function (e) { if (e.target === lb) closeLb(); });

    // Tombol keyboard. Handler lama dibuang dulu supaya tidak menumpuk saat pindah halaman.
    if (window.__hbKeys) document.removeEventListener('keydown', window.__hbKeys);
    window.__hbKeys = function (e) {
        if (!lb.classList.contains('open')) return;
        if (e.key === 'Escape') closeLb();
        else if (e.key === 'ArrowLeft') show(idx - 1);
        else if (e.key === 'ArrowRight') show(idx + 1);
    };
    document.addEventListener('keydown', window.__hbKeys);
})();
</script>
