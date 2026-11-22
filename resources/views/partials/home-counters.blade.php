@php
    // [label, angka, akhiran]  (ubah sesuai dirimu)
    $counters = [
        ['Proyek dibuat',      3,  '+'],
        ['Tempat dikunjungi',  12, ''],
        ['Lagu favorit',       48, ''],
    ];
@endphp

<style>
.hx-count{padding-top:0}
.hx-count-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:24px}
.hx-count .hx-panel{padding:28px 24px;text-align:center}
.hx-num{font-size:clamp(2.6rem,6vw,3.6rem);font-weight:900;line-height:1;color:var(--gold);
    text-shadow:4px 4px 0 var(--accent-dark,#7a3a00)}
.hx-count .lbl{display:block;margin-top:12px;color:#b9c8f0;font-weight:700}
</style>

<div class="hx hx-count">
    <section aria-labelledby="hx-count-title">
        <h2 id="hx-count-title">Dalam Angka</h2>
        <div class="hx-count-grid">
            @foreach ($counters as [$label, $value, $suffix])
                <div class="hx-panel">
                    <div class="hx-num" data-to="{{ $value }}" data-suffix="{{ $suffix }}">{{ $value }}{{ $suffix }}</div>
                    <span class="lbl">{{ $label }}</span>
                </div>
            @endforeach
        </div>
    </section>
</div>

<script>
(function () {
    var nums = document.querySelectorAll('.hx-num');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce || !('IntersectionObserver' in window)) return; // angka akhir sudah tampil

    function run(el) {
        var to = parseInt(el.dataset.to, 10), suf = el.dataset.suffix || '', t0 = null, dur = 1200;
        (function step(ts) {
            if (!t0) t0 = ts;
            var p = Math.min((ts - t0) / dur, 1);
            el.textContent = Math.round(to * (1 - Math.pow(1 - p, 3))) + suf;
            if (p < 1) requestAnimationFrame(step);
        })(performance.now());
    }

    var io = new IntersectionObserver(function (es) {
        es.forEach(function (e) {
            if (e.isIntersecting) { run(e.target); io.unobserve(e.target); }
        });
    }, { threshold: 0.4 });

    nums.forEach(function (n) { n.textContent = '0' + (n.dataset.suffix || ''); io.observe(n); });
})();
</script>
