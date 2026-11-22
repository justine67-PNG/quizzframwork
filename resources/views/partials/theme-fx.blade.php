{{-- resources/views/partials/theme-fx.blade.php
     Dipasang di layouts/app.blade.php (sebelum </body>) supaya aktif di semua halaman.
     Isi: pengganti warna tema + karakter pixel yang mengikuti kursor. --}}

<style>
/* Warna tema. Tema emas = bawaan (tanpa atribut data-theme) */
:root[data-theme="ungu"]  {--accent:#c084fc;--accent2:#9333ea;--accent-dark:#4c1d95}
:root[data-theme="hijau"] {--accent:#4ade80;--accent2:#16a34a;--accent-dark:#14532d}
:root[data-theme="merah"] {--accent:#fb7185;--accent2:#e11d48;--accent-dark:#7f1d1d}

/* Terapkan ke section Home dan jejak pixel */
:root[data-theme] .hx{--gold:var(--accent);--orange:var(--accent2)}
:root[data-theme] .hx h2,
:root[data-theme] .hx-clock,
:root[data-theme] .hx-box .front strong{text-shadow:3px 3px 0 var(--accent-dark)}
:root[data-theme] .hx-pixel{background:var(--accent)}

/* Tombol pengganti tema */
.hx-theme{position:fixed;left:16px;bottom:16px;z-index:9990;display:flex;gap:6px;padding:6px;
    background:#061a4d;border:2px solid #1e4fb8;box-shadow:3px 3px 0 rgba(30,79,184,.55)}
.hx-theme button{width:22px;height:22px;padding:0;cursor:pointer;background:var(--c);border:2px solid transparent}
.hx-theme button[aria-pressed="true"]{border-color:#fff}
.hx-theme button:focus-visible{outline:2px solid #22d3ee;outline-offset:2px}

/* Karakter pixel */
.hx-buddy{position:fixed;left:0;top:0;z-index:9998;pointer-events:none;opacity:0;transition:opacity .3s;
    width:30px;height:28px;padding-top:5px;display:flex;gap:3px;justify-content:center;
    background:var(--accent,#f9a825);border:3px solid var(--accent2,#ff8a00);box-shadow:3px 3px 0 rgba(0,0,0,.35)}
.hx-buddy.on{opacity:1}
.hx-buddy i{display:block;position:relative;width:9px;height:11px;background:#fff}
.hx-buddy b{position:absolute;left:2.5px;top:3.5px;width:4px;height:4px;background:#061a4d}
</style>

<div class="hx-theme" role="group" aria-label="Warna tema">
    <button type="button" data-theme-set=""      style="--c:#f9a825" aria-label="Tema emas"  aria-pressed="true"></button>
    <button type="button" data-theme-set="ungu"  style="--c:#c084fc" aria-label="Tema ungu"  aria-pressed="false"></button>
    <button type="button" data-theme-set="hijau" style="--c:#4ade80" aria-label="Tema hijau" aria-pressed="false"></button>
    <button type="button" data-theme-set="merah" style="--c:#fb7185" aria-label="Tema merah" aria-pressed="false"></button>
</div>

<div class="hx-buddy" id="hx-buddy" aria-hidden="true"><i><b></b></i><i><b></b></i></div>

<script>
(function () {
    // Tema warna (tersimpan di browser)
    var root = document.documentElement, KEY = 'hxTheme';
    var btns = document.querySelectorAll('[data-theme-set]');
    function apply(t) {
        if (t) root.setAttribute('data-theme', t); else root.removeAttribute('data-theme');
        btns.forEach(function (b) { b.setAttribute('aria-pressed', b.getAttribute('data-theme-set') === (t || '')); });
    }
    var saved = '';
    try { saved = localStorage.getItem(KEY) || ''; } catch (e) {}
    apply(saved);
    btns.forEach(function (b) {
        b.addEventListener('click', function () {
            var t = b.getAttribute('data-theme-set');
            apply(t);
            try { if (t) localStorage.setItem(KEY, t); else localStorage.removeItem(KEY); } catch (e) {}
        });
    });

    // Karakter pixel: mengikuti kursor, matanya menoleh ke kursor
    var buddy = document.getElementById('hx-buddy');
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches ||
        !window.matchMedia('(pointer: fine)').matches) { buddy.remove(); return; }

    var pupils = buddy.querySelectorAll('b');
    var mx = 0, my = 0, x = 0, y = 0, started = false;
    document.addEventListener('mousemove', function (e) {
        mx = e.clientX; my = e.clientY;
        if (!started) { started = true; x = mx; y = my; buddy.classList.add('on'); requestAnimationFrame(loop); }
    });
    function loop() {
        x += (mx + 26 - x) * 0.12;
        y += (my + 26 - y) * 0.12;
        buddy.style.transform = 'translate(' + x + 'px,' + y + 'px)';
        var dx = mx - (x + 15), dy = my - (y + 14);
        var d = Math.hypot(dx, dy) || 1, k = Math.min(1, d / 60) * 2.5;
        var t = 'translate(' + (dx / d * k) + 'px,' + (dy / d * k) + 'px)';
        pupils.forEach(function (p) { p.style.transform = t; });
        requestAnimationFrame(loop);
    }
})();
</script>
