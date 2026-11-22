{{-- resources/views/partials/about-extras.blade.php
     Dipanggil dari profile.blade.php:  @include('partials.about-extras')
     Isi: status magang + CV, statistik karakter (radar), quest log. --}}

@php
    // ===== Ubah di sini saja =====
    $openToWork = true;                          // true = tampil "Terbuka untuk magang"
    $cv         = 'cv/CV-Justine.pdf';           // letak CV di folder public (public/cv/CV-Justine.pdf)
    $hasCv      = file_exists(public_path($cv));

    // [atribut, nilai 0-100]
    $stats = [
        ['Logika', 70], ['Kreativitas', 75], ['Kerja Tim', 85],
        ['Disiplin', 70], ['Komunikasi', 70], ['Rasa Ingin Tahu', 90],
    ];

    // [jenis (utama/sampingan), judul, deskripsi, progres 0-100]
    $quests = [
        ['utama',     'Lulus S1 Informatika',        'Menyelesaikan kuliah di IBTI.',              38],
        ['utama',     'Magang pertama',              'Dapat pengalaman kerja di dunia IT.',         0],
        ['sampingan', 'Bangun portfolio sendiri',    'Website pribadi dengan Laravel.',            40],
        ['sampingan', 'Belajar framework baru',      'Tambah satu skill di luar materi kuliah.',   20],
    ];

    // Perhitungan grafik radar
    $cx = 200; $cy = 170; $r = 105; $n = count($stats);
    $pos = function ($i, $v) use ($cx, $cy, $r, $n) {
        $a = 2 * M_PI * $i / $n;
        return [round($cx + $r * $v / 100 * sin($a), 1), round($cy - $r * $v / 100 * cos($a), 1)];
    };
    $poly = [];
    foreach ($stats as $i => $s) { $poly[] = implode(',', $pos($i, $s[1])); }
    $poly = implode(' ', $poly);
    $rings = [];
    foreach ([25, 50, 75, 100] as $lvl) {
        $pts = [];
        for ($i = 0; $i < $n; $i++) { $pts[] = implode(',', $pos($i, $lvl)); }
        $rings[] = implode(' ', $pts);
    }
@endphp

<style>
.ab{--navy:#061a4d;--deep:#030c2b;--cyan:#22d3ee;--gold:var(--accent,#f9a825);--orange:var(--accent2,#ff8a00);
    --edge:#1e4fb8;display:grid;gap:64px;margin-top:70px;max-width:1000px;color:#fff}
.ab h2{font-size:clamp(1.5rem,3vw,2.1rem);margin:0 0 22px;color:var(--gold);text-shadow:3px 3px 0 var(--accent-dark,#7a3a00)}
.ab-panel{background:linear-gradient(160deg,var(--deep),var(--navy));border:2px solid var(--edge);
    box-shadow:6px 6px 0 rgba(30,79,184,.55);border-radius:4px}
.ab-rv{opacity:0;transform:translateY(26px);transition:opacity .6s ease,transform .6s ease}
.ab-rv.in{opacity:1;transform:none}
.ab-sr{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap}

/* Status magang */
.ab-status{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:20px;padding:24px 28px}
.ab-badge{display:inline-flex;align-items:center;gap:10px;font-weight:800;font-size:1.1rem}
.ab-dot{width:12px;height:12px;background:#4ade80;border-radius:0;animation:abpulse 1.6s ease-out infinite}
.ab-dot.off{background:#6f86c4;animation:none}
@keyframes abpulse{0%{box-shadow:0 0 0 0 rgba(74,222,128,.7)}100%{box-shadow:0 0 0 12px rgba(74,222,128,0)}}
.ab-status p{margin:6px 0 0;color:#b9c8f0;font-size:.95rem}
.ab-btn{display:inline-block;padding:12px 22px;background:var(--gold);color:var(--navy);font-weight:800;text-decoration:none;
    border:2px solid var(--gold);box-shadow:5px 5px 0 var(--orange);transition:transform .15s,box-shadow .15s}
.ab-btn:hover,.ab-btn:focus-visible{transform:translate(3px,3px);box-shadow:2px 2px 0 var(--orange);outline:none}
.ab-btn.off{background:#0a2466;border-color:var(--edge);color:#8ea3d8;box-shadow:none;cursor:default}

/* Statistik karakter */
.ab-stats{display:grid;grid-template-columns:minmax(260px,430px) 1fr;gap:32px;align-items:center;padding:24px}
.ab-radar{width:100%;height:auto;display:block}
.ab-ring{fill:none;stroke:var(--edge);stroke-width:1.5}
.ab-axis{stroke:var(--edge);stroke-width:1.5}
.ab-poly{transform-box:view-box;transform-origin:200px 170px;transform:scale(0);transition:transform 1s steps(10)}
.ab-rv.in .ab-poly{transform:scale(1)}
.ab-area{fill:var(--gold);fill-opacity:.3;stroke:var(--gold);stroke-width:3}
.ab-vert{fill:var(--gold)}
.ab-radar text{fill:#cfe0ff;font-size:12px;font-weight:700}
.ab-legend{list-style:none;margin:0;padding:0;display:grid;gap:10px}
.ab-legend li{display:flex;justify-content:space-between;gap:16px;padding:8px 12px;border:2px solid var(--edge);background:rgba(10,36,102,.5)}
.ab-legend b{color:var(--gold)}

/* Quest log */
.ab-quests{display:grid;gap:16px}
.ab-quest{display:grid;grid-template-columns:1fr auto;gap:6px 20px;align-items:center;padding:18px 22px}
.ab-tag{grid-column:1/-1;justify-self:start;padding:2px 10px;font-size:.72rem;font-weight:800;letter-spacing:.08em;
    text-transform:uppercase;border:2px solid var(--cyan);color:var(--cyan)}
.ab-tag.utama{border-color:var(--gold);color:var(--gold)}
.ab-quest b{font-size:1.1rem}
.ab-quest em{font-style:normal;font-weight:800;color:var(--cyan);text-align:right}
.ab-desc{grid-column:1/-1;color:#b9c8f0;font-size:.92rem}
.ab-bar{grid-column:1/-1;height:12px;background:#0a2466;border:2px solid var(--edge);margin-top:4px}
.ab-bar i{display:block;height:100%;width:0;transition:width 1.1s steps(14);
    background:repeating-linear-gradient(90deg,var(--gold) 0 10px,var(--orange) 10px 12px)}
.ab-rv.in .ab-bar i{width:var(--w)}
.ab-quest.done em{color:#4ade80}

@media (max-width:760px){.ab-stats{grid-template-columns:1fr}}
@media (prefers-reduced-motion:reduce){
    .ab-rv{opacity:1;transform:none;transition:none}
    .ab-poly{transform:scale(1);transition:none}
    .ab-bar i{transition:none;width:var(--w)}
    .ab-dot{animation:none}
}
</style>

<div class="ab">

    {{-- Status magang + CV --}}
    <section class="ab-rv" aria-label="Status dan CV">
        <div class="ab-panel ab-status">
            <div>
                <span class="ab-badge">
                    <span class="ab-dot {{ $openToWork ? '' : 'off' }}" aria-hidden="true"></span>
                    {{ $openToWork ? 'Terbuka untuk magang' : 'Sedang fokus kuliah' }}
                </span>
                <p>{{ $openToWork ? 'Mencari kesempatan magang di bidang pengembangan web.' : 'Belum membuka kesempatan magang saat ini.' }}</p>
            </div>
            @if ($hasCv)
                <a href="{{ asset($cv) }}" class="ab-btn" download>Unduh CV</a>
            @else
                <span class="ab-btn off">CV segera hadir</span>
            @endif
        </div>
    </section>

    {{-- Statistik karakter --}}
    <section class="ab-rv" aria-labelledby="ab-stat-title">
        <h2 id="ab-stat-title">Statistik Karakter</h2>
        <div class="ab-panel ab-stats">
            <svg class="ab-radar" viewBox="0 0 400 340" role="img" aria-label="Grafik radar statistik karakter">
                @foreach ($rings as $ring)
                    <polygon class="ab-ring" points="{{ $ring }}"/>
                @endforeach
                @foreach ($stats as $i => $s)
                    @php [$ax, $ay] = $pos($i, 100); @endphp
                    <line class="ab-axis" x1="{{ $cx }}" y1="{{ $cy }}" x2="{{ $ax }}" y2="{{ $ay }}"/>
                @endforeach
                <g class="ab-poly">
                    <polygon class="ab-area" points="{{ $poly }}"/>
                    @foreach ($stats as $i => $s)
                        @php [$vx, $vy] = $pos($i, $s[1]); @endphp
                        <rect class="ab-vert" x="{{ $vx - 4 }}" y="{{ $vy - 4 }}" width="8" height="8"/>
                    @endforeach
                </g>
                @foreach ($stats as $i => $s)
                    @php
                        $a = 2 * M_PI * $i / $n;
                        $lx = round($cx + ($r + 18) * sin($a), 1);
                        $ly = round($cy - ($r + 18) * cos($a) + 4, 1);
                        $anchor = sin($a) > .3 ? 'start' : (sin($a) < -.3 ? 'end' : 'middle');
                    @endphp
                    <text x="{{ $lx }}" y="{{ $ly }}" text-anchor="{{ $anchor }}">{{ $s[0] }}</text>
                @endforeach
            </svg>
            <ul class="ab-legend">
                @foreach ($stats as [$label, $val])
                    <li><span>{{ $label }}</span><b>{{ $val }}</b></li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Quest log --}}
    <section class="ab-rv" aria-labelledby="ab-quest-title">
        <h2 id="ab-quest-title">Quest Log</h2>
        <div class="ab-quests">
            @foreach ($quests as [$type, $title, $desc, $pct])
                <div class="ab-panel ab-quest {{ $pct >= 100 ? 'done' : '' }}">
                    <span class="ab-tag {{ $type }}">{{ $type === 'utama' ? 'Misi utama' : 'Misi sampingan' }}</span>
                    <b>{{ $title }}</b>
                    <em>{{ $pct >= 100 ? 'Selesai' : $pct . '%' }}</em>
                    <span class="ab-desc">{{ $desc }}</span>
                    <div class="ab-bar"><i style="--w:{{ $pct }}%"></i></div>
                </div>
            @endforeach
        </div>
    </section>
</div>

<script>
(function () {
    var items = document.querySelectorAll('.ab-rv');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if ('IntersectionObserver' in window && !reduce) {
        var io = new IntersectionObserver(function (es) {
            es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
        }, { threshold: 0.15 });
        items.forEach(function (el) { io.observe(el); });
    } else {
        items.forEach(function (el) { el.classList.add('in'); });
    }
})();
</script>
