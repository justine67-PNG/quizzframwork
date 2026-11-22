@php
    // ===== Ubah di sini saja =====
    $semester      = 3;   // semester kamu sekarang
    $totalSemester = 8;   // total semester S1
    $dice = [
        'Push rank sampai naik tier',
        'Ngoding satu fitur kecil',
        'Cari kopi dan dengar playlist baru',
        'Jalan-jalan sore keliling Singaraja',
        'Rapikan kode yang kemarin berantakan',
        'Istirahat. Layar boleh dimatikan sebentar',
        'Belajar satu hal baru tentang Laravel',
    ];
    $percent = round($semester / $totalSemester * 100);
@endphp

<style>
.hx-mini{padding-top:0}
.hx-mini-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px}
.hx-mini .hx-panel{padding:24px}
.hx-mini h3{margin:0 0 14px;color:var(--cyan);font-size:1.1rem}

/* Jam */
.hx-clock{font-family:ui-monospace,Consolas,monospace;font-size:2.8rem;font-weight:800;color:var(--gold);
    text-shadow:3px 3px 0 #7a3a00;letter-spacing:.04em;line-height:1}
.hx-date{margin:10px 0 0;color:#b9c8f0;font-size:.9rem}
.hx-greet{margin:16px 0 0;font-weight:700;font-size:1.05rem}

/* Progress */
.hx-level{display:flex;justify-content:space-between;align-items:baseline;margin-bottom:8px}
.hx-level b{font-size:1.6rem;color:var(--gold)}
.hx-xp{height:18px;background:#0a2466;border:2px solid var(--edge)}
.hx-xp i{display:block;height:100%;width:var(--w);
    background:repeating-linear-gradient(90deg,var(--gold) 0 10px,var(--orange) 10px 12px)}
.hx-mini p.hx-sub{margin:12px 0 0;color:#b9c8f0;font-size:.9rem}

/* Dadu */
.hx-dice-out{min-height:3.2em;font-weight:700;font-size:1.1rem;line-height:1.4;margin:0 0 16px}
.hx-mini .hx-btn{margin:0;cursor:pointer;font:inherit;font-weight:800}
</style>

<div class="hx hx-mini">
    <section aria-labelledby="hx-mini-title">
        <h2 id="hx-mini-title">Status Hari Ini</h2>
        <div class="hx-mini-grid">

            <div class="hx-panel">
                <h3>Waktu Bali</h3>
                <div class="hx-clock" id="hx-clock">--:--:--</div>
                <p class="hx-date" id="hx-date"></p>
                <p class="hx-greet" id="hx-greet"></p>
            </div>

            <div class="hx-panel">
                <h3>Progress Kuliah</h3>
                <div class="hx-level"><b>Level {{ $semester }}</b><span>{{ $percent }}% menuju S1</span></div>
                <div class="hx-xp" role="progressbar" aria-valuemin="0" aria-valuemax="{{ $totalSemester }}"
                     aria-valuenow="{{ $semester }}" aria-label="Progress semester"><i style="--w:{{ $percent }}%"></i></div>
                <p class="hx-sub">Semester {{ $semester }} dari {{ $totalSemester }}.</p>
            </div>

            <div class="hx-panel">
                <h3>Dadu Hari Ini</h3>
                <p class="hx-dice-out" id="hx-dice-out" aria-live="polite">Lempar dadu untuk tahu kegiatan hari ini.</p>
                <button type="button" class="hx-btn" id="hx-dice-btn">Lempar dadu</button>
            </div>

        </div>
    </section>
</div>

<script>
(function () {
    var tz = 'Asia/Makassar'; // WITA, waktu Bali

    // Jam dan sapaan
    var clock = document.getElementById('hx-clock'),
        dateEl = document.getElementById('hx-date'),
        greet = document.getElementById('hx-greet');
    function tick() {
        var now = new Date();
        clock.textContent = now.toLocaleTimeString('id-ID', { timeZone: tz, hour12: false }).replace(/\./g, ':');
        dateEl.textContent = now.toLocaleDateString('id-ID', { timeZone: tz, weekday: 'long', day: 'numeric', month: 'long' });
        var h = parseInt(now.toLocaleString('en-GB', { timeZone: tz, hour: '2-digit', hour12: false }), 10) % 24;
        greet.textContent = h < 4  ? 'Begadang lagi, pemain?'
                          : h < 11 ? 'Selamat pagi, pemain.'
                          : h < 15 ? 'Selamat siang, pemain.'
                          : h < 18 ? 'Selamat sore, pemain.'
                          :          'Selamat malam, pemain.';
    }
    tick(); setInterval(tick, 1000);

    // Dadu
    var picks = @json($dice);
    var out = document.getElementById('hx-dice-out'), btn = document.getElementById('hx-dice-btn');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    function rand() { return picks[Math.floor(Math.random() * picks.length)]; }
    btn.addEventListener('click', function () {
        btn.disabled = true;
        var n = reduce ? 0 : 8;
        (function roll() {
            if (n-- > 0) { out.textContent = rand(); setTimeout(roll, 70); }
            else { out.textContent = 'Hari ini: ' + rand(); btn.disabled = false; btn.textContent = 'Lempar lagi'; }
        })();
    });
})();
</script>
