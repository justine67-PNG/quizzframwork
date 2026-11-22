@php
    // ===== Ubah isi data di sini saja =====
    $player = [
        'name'   => 'Justine',
        'class'  => 'Informatika S1',
        'guild'  => 'INSTIKI',
        'badges' => ['Gamer', 'Traveler', 'Music Lover'],
        'skills' => [
            ['Laravel / PHP', 50],
            ['Web Frontend', 50],
            ['Problem Solving', 51.1],
        ],
    ];
    $hobbies = [
        ['title' => 'Gaming',    'text' => 'Dari ranked sampai santai bareng teman.'],
        ['title' => 'Traveling', 'text' => 'Gunung, pantai, dan jalan-jalan di Bali.'],
        ['title' => 'Musik',     'text' => 'Playlist untuk ngoding dan perjalanan.'],
    ];
    // [judul, deskripsi, sudah terbuka? true/false]
    $achievements = [
        ['Mahasiswa Baru',   'Resmi masuk Informatika S1 di INSTIKI.',        true],
        ['Web Pertamaku',    'Membuat website pribadi dengan Laravel.',    true],
        ['Pemburu Pemandangan', 'Menjelajahi tempat-tempat baru di Bali.', true],
        ['Magang Pertama',   'Dapat pengalaman kerja di dunia IT.',        false],
        ['Proyek Besar',     'Menyelesaikan proyek yang dipakai orang lain.', false],
        ['Keliling Indonesia', 'Mengunjungi provinsi di luar Bali.',       false],
    ];
    // [label, isi fakta]  (ubah sesuai dirimu)
    $facts = [
        ['Kota asal',   'Singaraja, Bali.'],
        ['Game andalan', 'Apa aja yang penting asik.'],
        ['Teman ngoding', 'Musik. Youtube, AI pastinya.'],
        ['Tujuan hidup', 'bahagia, kaya, sukses, damai, gak tau apa lagi.'],
    ];
    $unlocked = count(array_filter($achievements, fn ($a) => $a[2]));
@endphp

<style>
.hx{--navy:#061a4d;--deep:#030c2b;--cyan:#22d3ee;--gold:#f9a825;--orange:#ff8a00;--edge:#1e4fb8;
    max-width:1280px;margin:0 auto;padding:40px 24px 90px;color:#fff;display:grid;gap:72px}
.hx h2{font-size:clamp(1.6rem,3vw,2.2rem);font-weight:800;margin:0 0 24px;color:var(--gold);
    text-shadow:3px 3px 0 #7a3a00}
.hx h2 small{font-size:.5em;color:var(--cyan);text-shadow:none;margin-left:10px}
.hx-panel{background:linear-gradient(160deg,var(--deep),var(--navy));border:2px solid var(--edge);
    box-shadow:6px 6px 0 rgba(30,79,184,.55);border-radius:4px}

/* Scroll reveal */
.hx-reveal{opacity:0;transform:translateY(28px);transition:opacity .6s ease,transform .6s ease}
.hx-reveal.in{opacity:1;transform:none}

/* Player card */
.hx-player{display:grid;grid-template-columns:200px 1fr;gap:32px;padding:32px}
.hx-avatar{aspect-ratio:1;display:grid;place-items:center;font-size:5rem;font-weight:900;color:var(--navy);
    background:var(--gold);border:3px solid var(--orange);box-shadow:5px 5px 0 var(--orange);overflow:hidden}
.hx-avatar img{width:100%;height:100%;object-fit:cover}
.hx-meta{margin:6px 0 16px;color:#b9c8f0;line-height:1.7}
.hx-meta b{color:var(--cyan)}
.hx-badges{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:24px}
.hx-badge{padding:4px 12px;border:2px solid var(--cyan);color:var(--cyan);font-weight:700;font-size:.85rem}
.hx-skill{margin-bottom:12px}
.hx-skill span{display:flex;justify-content:space-between;font-size:.9rem;margin-bottom:4px}
.hx-bar{height:14px;background:#0a2466;border:2px solid var(--edge)}
.hx-bar i{display:block;height:100%;width:0;background:repeating-linear-gradient(90deg,var(--gold) 0 10px,var(--orange) 10px 12px);
    transition:width 1.1s steps(14)}
.hx-reveal.in .hx-bar i{width:var(--w)}

/* Hobby cards (jajar genjang, tidak bisa diklik) */
.hx-hobbies{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:28px}
.hx-hobby{transform:skewX(-8deg);padding:28px 30px}
.hx-hobby>div{transform:skewX(8deg)}
.hx-hobby h3{margin:0 0 8px;color:var(--cyan);font-size:1.3rem}
.hx-hobby p{margin:0;color:#b9c8f0;line-height:1.5}

/* Button */
.hx-btn{display:inline-block;margin-top:28px;padding:12px 22px;background:var(--gold);color:var(--navy);
    font-weight:800;text-decoration:none;border:2px solid var(--gold);box-shadow:5px 5px 0 var(--orange);
    transition:transform .15s,box-shadow .15s}
.hx-btn:hover,.hx-btn:focus-visible{transform:translate(3px,3px);box-shadow:2px 2px 0 var(--orange);outline:none}

/* Pencapaian */
.hx-ach{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px}
.hx-ach-item{display:flex;gap:16px;align-items:center;padding:18px 20px}
.hx-ach-icon{flex:none;width:48px;height:48px;display:grid;place-items:center;font-size:1.5rem;font-weight:900;
    background:var(--gold);color:var(--navy);border:2px solid var(--orange);box-shadow:3px 3px 0 var(--orange)}
.hx-ach-item b{display:block;font-size:1.05rem}
.hx-ach-item span{display:block;color:#b9c8f0;font-size:.9rem;line-height:1.4;margin-top:2px}
.hx-ach-item em{display:block;font-style:normal;font-size:.8rem;font-weight:700;color:var(--cyan);margin-top:6px}
.hx-ach-item.locked{opacity:.6}
.hx-ach-item.locked .hx-ach-icon{background:#0a2466;color:#6f86c4;border-color:var(--edge);box-shadow:3px 3px 0 var(--edge)}
.hx-ach-item.locked em{color:#8ea3d8}

/* Kotak misteri */
.hx-hint{color:#b9c8f0;margin:-12px 0 24px}
.hx-facts{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px}
.hx-box{position:relative;min-height:130px;padding:20px;color:#fff;font:inherit;text-align:left;cursor:pointer;
    transition:transform .15s,box-shadow .15s}
.hx-box:hover,.hx-box:focus-visible{transform:translate(-3px,-3px);box-shadow:9px 9px 0 rgba(249,168,37,.6);
    border-color:var(--gold);outline:none}
.hx-box .front{display:grid;place-items:center;height:90px;text-align:center}
.hx-box .front strong{font-size:2.6rem;color:var(--gold);text-shadow:3px 3px 0 #7a3a00}
.hx-box .front span{font-size:.85rem;color:var(--cyan);font-weight:700}
.hx-box .back{display:none}
.hx-box.open .front{display:none}
.hx-box.open .back{display:block;animation:hxpop .3s steps(4)}
.hx-box .back small{display:block;color:var(--cyan);font-weight:700;margin-bottom:8px}
.hx-box .back b{font-size:1.1rem;line-height:1.4}
@keyframes hxpop{from{transform:scale(.7);opacity:0}to{transform:scale(1);opacity:1}}

/* Typing cursor */
#typed-role::after{content:"▌";margin-left:2px;color:#22d3ee;animation:hxblink 1s steps(1) infinite}
@keyframes hxblink{50%{opacity:0}}

@media (max-width:720px){.hx-player{grid-template-columns:1fr}.hx-avatar{max-width:160px}}
@media (prefers-reduced-motion:reduce){
    .hx-reveal{opacity:1;transform:none;transition:none}
    .hx-bar i{transition:none}
    #typed-role::after{animation:none}
    .hx-box.open .back{animation:none}
}
</style>

<div class="hx">

    {{-- Kartu pemain --}}
    <section class="hx-reveal" aria-labelledby="hx-player-title">
        <h2 id="hx-player-title">Kartu Pemain</h2>
        <div class="hx-panel hx-player">
            <div class="hx-avatar">
                {{-- Ganti dengan fotomu: <img src="{{ asset('images/avatar.jpg') }}" alt="Foto {{ $player['name'] }}"> --}}
                J
            </div>
            <div>
                <h3 style="margin:0;font-size:1.8rem">{{ $player['name'] }}</h3>
                <p class="hx-meta">Class: <b>{{ $player['class'] }}</b> &nbsp;|&nbsp; Guild: <b>{{ $player['guild'] }}</b></p>
                <div class="hx-badges">
                    @foreach ($player['badges'] as $badge)
                        <span class="hx-badge">{{ $badge }}</span>
                    @endforeach
                </div>
                @foreach ($player['skills'] as [$skill, $xp])
                    <div class="hx-skill">
                        <span><b>{{ $skill }}</b><em>{{ $xp }} XP</em></span>
                        <div class="hx-bar"><i style="--w:{{ $xp }}%"></i></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Cuplikan hobi --}}
    <section class="hx-reveal" aria-labelledby="hx-hobby-title">
        <h2 id="hx-hobby-title">Hobi Saya</h2>
        <div class="hx-hobbies">
            @foreach ($hobbies as $hobby)
                <div class="hx-panel hx-hobby">
                    <div>
                        <h3>{{ $hobby['title'] }}</h3>
                        <p>{{ $hobby['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ url('/hobi') }}" class="hx-btn">Lihat semua hobi</a>
    </section>

    {{-- Pencapaian --}}
    <section class="hx-reveal" aria-labelledby="hx-ach-title">
        <h2 id="hx-ach-title">Pencapaian <small>{{ $unlocked }}/{{ count($achievements) }} terbuka</small></h2>
        <div class="hx-ach">
            @foreach ($achievements as [$title, $desc, $done])
                <div class="hx-panel hx-ach-item {{ $done ? '' : 'locked' }}">
                    <div class="hx-ach-icon" aria-hidden="true">{{ $done ? '★' : '?' }}</div>
                    <div>
                        <b>{{ $title }}</b>
                        <span>{{ $desc }}</span>
                        <em>{{ $done ? 'Terbuka' : 'Terkunci' }}</em>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Kotak misteri --}}
    <section class="hx-reveal" aria-labelledby="hx-box-title">
        <h2 id="hx-box-title">Kotak Misteri</h2>
        <p class="hx-hint">Klik kotaknya untuk membuka fakta tentang saya.</p>
        <div class="hx-facts">
            @foreach ($facts as [$label, $text])
                <button type="button" class="hx-panel hx-box" aria-pressed="false">
                    <span class="front"><span><strong>?</strong><br>Klik untuk buka</span></span>
                    <span class="back"><small>{{ $label }}</small><b>{{ $text }}</b></span>
                </button>
            @endforeach
        </div>
    </section>
</div>

<script>
(function () {
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // 1. Muncul pelan saat di-scroll
    var items = document.querySelectorAll('.hx-reveal');
    if ('IntersectionObserver' in window && !reduce) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
            });
        }, { threshold: 0.15 });
        items.forEach(function (el) { io.observe(el); });
    } else {
        items.forEach(function (el) { el.classList.add('in'); });
    }

    // 2. Teks mengetik di hero  (butuh <span id="typed-role"></span> di hero)
    var target = document.getElementById('typed-role');
    if (target) {
        var words = ['Mahasiswa Informatika', 'Gamer', 'Traveler', 'Pendengar Musik'];
        if (reduce) { target.textContent = words.join(' • '); }
        else {
            var w = 0, c = 0, del = false;
            (function tick() {
                var word = words[w];
                c += del ? -1 : 1;
                target.textContent = word.slice(0, c);
                var wait = del ? 40 : 90;
                if (!del && c === word.length) { del = true; wait = 1400; }
                else if (del && c === 0) { del = false; w = (w + 1) % words.length; wait = 300; }
                setTimeout(tick, wait);
            })();
        }
    }

    // 3. Kotak misteri: klik untuk membuka / menutup
    document.querySelectorAll('.hx-box').forEach(function (box) {
        box.addEventListener('click', function () {
            var open = box.classList.toggle('open');
            box.setAttribute('aria-pressed', open);
        });
    });
})();
</script>
