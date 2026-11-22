(function () {
    // Daftar yang bisa dicari. Sesuaikan "url" dengan route-mu
    // (cek dengan: php artisan route:list)
    const PAGES = [
        { title: 'Home',       url: '/',            desc: 'Halaman utama',
          keywords: 'beranda utama home' },
        { title: 'About Me',   url: '/about',       desc: 'Data diri, pendidikan, dan pengalaman',
          keywords: 'tentang saya profil data diri education pendidikan sekolah journey pengalaman' },
        { title: 'Hobbies',    url: '/hobi',        desc: 'Hobi saya: gaming dan traveling',
          keywords: 'hobi hobby gaming travel traveling musik music' },
        { title: 'Games',      url: '/hobi/games',  desc: 'Game yang sering saya mainkan',
          keywords: 'game gaming valorant minecraft roblox pubg stardew valley ea fc peak sims gta block blast subnautica' },
        { title: 'Traveling',  url: '/hobi/travel', desc: 'Tempat-tempat yang pernah saya kunjungi',
          keywords: 'travel traveling jalan-jalan bali malang surabaya gunung batur bedugul bukit asah hutan pinus' },
    ];

    const box = document.querySelector('.search-box');
    const input = box && box.querySelector('input');
    if (!box || !input) return;

    const list = document.createElement('div');
    list.className = 'search-results';
    box.appendChild(list);

    function hide() { list.classList.remove('show'); }

    function render() {
        const words = input.value.toLowerCase().trim().split(/\s+/).filter(Boolean);
        list.textContent = '';

        if (!words.length) { hide(); return; }

        const results = PAGES.filter(function (p) {
            const text = (p.title + ' ' + p.keywords).toLowerCase();
            return words.every(function (w) { return text.includes(w); });
        });

        if (!results.length) {
            const empty = document.createElement('div');
            empty.className = 'search-empty';
            empty.textContent = 'Tidak ada hasil untuk "' + input.value.trim() + '"';
            list.appendChild(empty);
        }

        results.forEach(function (p) {
            const a = document.createElement('a');
            a.className = 'search-item';
            a.href = p.url;

            const t = document.createElement('strong');
            t.textContent = p.title;
            const d = document.createElement('span');
            d.textContent = p.desc;

            a.appendChild(t);
            a.appendChild(d);
            list.appendChild(a);
        });

        list.classList.add('show');
    }

    function openFirst() {
        const first = list.querySelector('a.search-item');
        if (first) first.click();
    }

    input.addEventListener('input', render);
    input.addEventListener('focus', render);

    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter')  { e.preventDefault(); openFirst(); }
        if (e.key === 'Escape') { hide(); input.blur(); }
    });

    const form = input.closest('form');
    if (form) form.addEventListener('submit', function (e) { e.preventDefault(); openFirst(); });

    const btn = box.querySelector('button');
    if (btn) btn.addEventListener('click', function (e) { e.preventDefault(); openFirst(); });

    list.addEventListener('click', hide);
    document.addEventListener('click', function (e) { if (!box.contains(e.target)) hide(); });

    /* ===== MENU BAHASA (tampilan saja, tidak mengganti bahasa) ===== */
(function () {
    const globe = document.querySelector('.globe-btn');
    if (!globe) return;

    const LANGS = [
        { code: 'ID', name: 'Bahasa Indonesia' },
        { code: 'EN', name: 'English' },
        { code: 'JA', name: '日本語' },
        { code: 'KO', name: '한국어' },
        { code: 'ES', name: 'Español' },
        { code: 'FR', name: 'Français' },
        { code: 'DE', name: 'Deutsch' },
    ];

    // bungkus tombol globe supaya menu bisa menempel di bawahnya
    const wrap = document.createElement('div');
    wrap.className = 'lang-wrap';
    globe.parentNode.insertBefore(wrap, globe);
    wrap.appendChild(globe);

    const menu = document.createElement('div');
    menu.className = 'lang-menu';

    LANGS.forEach(function (l, i) {
        const item = document.createElement('button');
        item.type = 'button';
        item.className = 'lang-item' + (i === 0 ? ' is-current' : '');

        const name = document.createElement('span');
        name.textContent = l.name;
        const code = document.createElement('small');
        code.textContent = l.code;

        item.appendChild(name);
        item.appendChild(code);
        menu.appendChild(item);
    });

    wrap.appendChild(menu);

    function close() { menu.classList.remove('show'); }

    globe.addEventListener('click', function (e) {
        e.stopPropagation();
        menu.classList.toggle('show');
    });

    // klik bahasa: menu menutup saja, bahasa tidak berubah
    menu.addEventListener('click', close);
    document.addEventListener('click', close);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') close();
    });

    /* ===== PARALLAX BACKGROUND ===== */
(function () {
    // kecepatan tiap lapisan: 1 = sama dengan konten, 0 = diam
    const SPEED_NEAR = 0.45;   // lapisan depan (lebih cepat)
    const SPEED_FAR  = 0.2;    // lapisan belakang (lebih lambat)

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const root = document.documentElement;
    let ticking = false;

    function update() {
        const y = window.scrollY;
        root.style.setProperty('--bg-near', Math.round(y * SPEED_NEAR) + 'px');
        root.style.setProperty('--bg-far',  Math.round(y * SPEED_FAR)  + 'px');
        ticking = false;
    }

    window.addEventListener('scroll', function () {
        if (!ticking) {
            requestAnimationFrame(update);
            ticking = true;
        }
    }, { passive: true });

    update();
})();

})();
})();