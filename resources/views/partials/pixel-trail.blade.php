<style>
.hx-pixel{position:fixed;width:10px;height:10px;background:#f9a825;pointer-events:none;z-index:9999;
    animation:hxfade .6s linear forwards}
@keyframes hxfade{to{opacity:0;transform:translateY(12px) scale(.4)}}
</style>

<script>
(function () {
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce || !window.matchMedia('(pointer: fine)').matches) return;

    var last = 0;
    document.addEventListener('mousemove', function (e) {
        var now = Date.now();
        if (now - last < 45) return;
        last = now;
        var p = document.createElement('span');
        p.className = 'hx-pixel';
        p.style.left = (Math.round(e.clientX / 10) * 10) + 'px';
        p.style.top  = (Math.round(e.clientY / 10) * 10) + 'px';
        document.body.appendChild(p);
        setTimeout(function () { p.remove(); }, 600);
    });
})();
</script>