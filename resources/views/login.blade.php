@extends('layouts.app')

@section('title', 'Sign In - My Portfolio')

@section('content')

<section class="lg-section">

    <div class="lg-stage" data-login-stage data-state="idle">

        {{-- LATAR BERGERAK --}}
        <div class="lg-bg" aria-hidden="true">
            @for ($i = 0; $i < 28; $i++)
                <i class="lg-star" style="left:{{ ($i * 37) % 100 }}%;top:{{ ($i * 53) % 62 }}%;animation-delay:-{{ ($i % 7) * 0.4 }}s"></i>
            @endfor

            <i class="lg-cloud c1"></i>
            <i class="lg-cloud c2"></i>
            <i class="lg-cloud c3"></i>

            @for ($i = 0; $i < 10; $i++)
                <span class="lg-note" style="left:{{ ($i * 23 + 8) % 92 }}%;animation-duration:{{ 6 + ($i % 4) * 2 }}s;animation-delay:-{{ $i * 1.3 }}s">{{ $i % 2 ? '♫' : '♪' }}</span>
            @endfor

            <div class="lg-ground"></div>
        </div>

        {{-- KARAKTER KIRI & KANAN --}}
        <div class="lg-hero lg-hero-l" aria-hidden="true"><div class="lg-run"><i class="lg-sprite"></i></div></div>
        <div class="lg-hero lg-hero-r" aria-hidden="true"><div class="lg-run"><i class="lg-sprite"></i></div></div>

        {{-- PANEL FORM --}}
        <div class="lg-panel">

            <div class="lg-coin">PLAYER 1 · INSERT COIN</div>

            <div class="lg-face" aria-hidden="true">
                <span class="lg-eye"><i class="lg-pupil"></i></span>
                <span class="lg-eye"><i class="lg-pupil"></i></span>
                <span class="lg-hand l"></span>
                <span class="lg-hand r"></span>
            </div>

            <h1 class="lg-title">Sign In</h1>
            <p class="lg-sub">Halaman ini hanya untuk tes.</p>

            @if ($errors->any() || session('error'))
                <div class="lg-error" data-lg-error>
                    <strong>GAME OVER · LOGIN GAGAL</strong>
                    <span>{{ session('error') ?? $errors->first() }}</span>
                </div>
            @endif

            {{-- PENTING: sesuaikan action jika route login-mu berbeda --}}
            <form method="POST" action="{{ url()->current() }}" data-lg-form>
                @csrf

                <label class="lg-label" for="lg-email">Email</label>
                <input class="lg-input" id="lg-email" type="email" name="email"
                       value="{{ old('email') }}" required autocomplete="email">

                <label class="lg-label" for="lg-pass">Password</label>
                <input class="lg-input" id="lg-pass" type="password" name="password"
                       required autocomplete="current-password">

                <button type="submit" class="lg-submit">Sign In</button>

                <div class="lg-load" aria-hidden="true">
                    <small>LOADING...</small>
                    <div class="lg-bar"><i></i></div>
                </div>
            </form>

            <div class="lg-hint">Akun tes: test@example.com / password</div>
        </div>

    </div>

    <style>
    .lg-section{position:relative}
    .lg-stage{position:relative;max-width:1100px;min-height:640px;margin:20px auto 0;overflow:hidden;
        display:grid;place-items:center;padding:40px 20px 80px;
        background:linear-gradient(180deg,#030c2b 0%,#0a2a7a 70%,#1e4fb8 100%);
        border:3px solid #030c2b;box-shadow:0 0 0 3px #1e4fb8,10px 10px 0 3px rgba(30,79,184,.55)}
    .lg-stage::after{content:"";position:absolute;inset:0;z-index:5;pointer-events:none;
        background:repeating-linear-gradient(0deg,rgba(0,0,0,.12) 0 2px,transparent 2px 4px)}

    /* ===== LATAR ===== */
    .lg-bg{position:absolute;inset:0;z-index:0}
    .lg-star{position:absolute;width:4px;height:4px;background:#fff3b0;animation:lgTwinkle 2.8s steps(2) infinite}
    @keyframes lgTwinkle{50%{opacity:.15}}

    .lg-cloud{position:absolute;height:14px;width:56px;background:rgba(255,255,255,.4);
        box-shadow:12px -9px 0 rgba(255,255,255,.4);animation:lgCloud 26s linear infinite}
    .lg-cloud.c1{top:16%;animation-delay:-4s}
    .lg-cloud.c2{top:30%;animation-duration:36s;animation-delay:-20s}
    .lg-cloud.c3{top:8%;animation-duration:44s;animation-delay:-30s}
    @keyframes lgCloud{from{left:100%}to{left:-90px}}

    .lg-note{position:absolute;bottom:-30px;color:var(--accent,#f9a825);font-size:1.4rem;opacity:0;
        animation:lgNote 8s linear infinite}
    @keyframes lgNote{
        0%{transform:translateY(0);opacity:0}
        15%{opacity:.7}
        85%{opacity:.5}
        100%{transform:translateY(-520px);opacity:0}
    }

    .lg-ground{position:absolute;left:0;right:0;bottom:0;height:46px;
        background:repeating-linear-gradient(90deg,#8a5a2b 0 20px,#6e4520 20px 40px),#6e4520;
        border-top:6px solid #3ddc84;background-size:40px 100%;animation:lgGround .8s linear infinite}
    @keyframes lgGround{to{background-position:-40px 0}}

    /* ===== PANEL ===== */
    .lg-panel{position:relative;z-index:3;width:min(400px,100%);padding:26px 28px 22px;
        background:linear-gradient(160deg,#030c2b,#061a4d);
        border:3px solid #030c2b;box-shadow:0 0 0 3px #1e4fb8,8px 8px 0 3px rgba(30,79,184,.55)}
    .lg-coin{margin-bottom:14px;color:#22d3ee;font-size:.62rem;letter-spacing:.22em;
        text-align:center;animation:lgBlink 1.1s steps(2) infinite}
    @keyframes lgBlink{50%{opacity:.35}}

    .lg-title{margin:0;color:#fff;font-size:clamp(1.6rem,4vw,2.4rem);text-align:center}
    .lg-sub{margin:8px 0 18px;color:#b9c8f0;font-size:.66rem;letter-spacing:.14em;
        text-align:center;text-transform:uppercase}

    .lg-label{display:block;margin:14px 0 6px;color:#22d3ee;font-size:.66rem;
        letter-spacing:.18em;text-transform:uppercase}
    .lg-input{display:block;width:100%;height:44px;padding:0 14px;color:#fff;font:inherit;font-size:.85rem;
        background:#0a2466;border:2px solid #1e4fb8;outline:none;
        caret-color:var(--accent,#f9a825);caret-shape:block;
        transition:border-color .15s,background .15s}
    .lg-input:focus{border-color:var(--accent,#f9a825);background:#102f7a}

    .lg-submit{display:block;width:100%;margin-top:22px;padding:13px 0;cursor:pointer;font:inherit;
        font-weight:800;font-size:.85rem;letter-spacing:.14em;text-transform:uppercase;
        color:#061a4d;background:var(--accent,#f9a825);border:2px solid var(--accent,#f9a825);
        box-shadow:5px 5px 0 var(--accent2,#ff8a00);
        transition:transform .15s,box-shadow .15s,background .15s}
    .lg-submit:hover,.lg-submit:focus-visible{transform:translate(3px,3px);
        box-shadow:2px 2px 0 var(--accent2,#ff8a00);background:#fff;border-color:#fff;outline:none}
    .lg-submit:active{transform:translate(5px,5px);box-shadow:0 0 0 var(--accent2,#ff8a00)}

    .lg-hint{margin-top:18px;color:#b9c8f0;font-size:.56rem;letter-spacing:.14em;
        text-align:center;text-transform:uppercase}

    /* ===== LOADING ===== */
    .lg-load{display:none;margin-top:16px}
    .lg-load small{display:block;margin-bottom:6px;color:#fff3b0;font-size:.62rem;letter-spacing:.2em}
    .lg-bar{height:14px;border:2px solid #1e4fb8;background:#030c2b}
    .lg-bar i{display:block;height:100%;width:0;background:var(--accent,#f9a825)}
    [data-state="loading"] .lg-load{display:block}
    [data-state="loading"] .lg-bar i{animation:lgFill 1.2s steps(10) forwards}
    @keyframes lgFill{to{width:100%}}
    [data-state="loading"] .lg-submit{pointer-events:none;opacity:.6}

    /* ===== ERROR ===== */
    .lg-error{margin-bottom:6px;padding:10px 12px;text-align:center;
        background:rgba(255,93,122,.12);border:2px solid #ff5d7a}
    .lg-error strong{display:block;color:#ff5d7a;font-size:.7rem;letter-spacing:.14em}
    .lg-error span{display:block;margin-top:5px;color:#ffd0d8;font-size:.58rem;letter-spacing:.06em}
    .lg-stage.is-shake .lg-panel{animation:lgShake .5s steps(8)}
    @keyframes lgShake{
        0%,100%{transform:translateX(0)}
        20%{transform:translateX(-10px)}
        40%{transform:translateX(10px)}
        60%{transform:translateX(-8px)}
        80%{transform:translateX(8px)}
    }

    /* ===== KARAKTER PENGINTIP ===== */
    .lg-face{position:relative;width:76px;height:54px;margin:0 auto 16px;
        background:var(--accent,#f9a825);border:3px solid #030c2b;
        box-shadow:4px 4px 0 var(--accent2,#ff8a00);
        display:flex;align-items:center;justify-content:center;gap:12px}
    .lg-eye{position:relative;width:16px;height:16px;background:#fff;border:2px solid #030c2b;overflow:hidden}
    .lg-pupil{position:absolute;left:4px;top:4px;width:6px;height:6px;background:#030c2b;
        transition:transform .15s steps(3)}
    .lg-hand{position:absolute;top:100%;width:30px;height:22px;background:#fff3b0;border:3px solid #030c2b;
        transition:top .2s steps(3)}
    .lg-hand.l{left:2px}
    .lg-hand.r{right:2px}
    [data-state="password"] .lg-hand{top:10px}
    [data-state="error"] .lg-eye{background:#ff5d7a}

    /* ===== KARAKTER SAMPING ===== */
    .lg-hero{position:absolute;bottom:46px;z-index:2;width:30px;height:40px;
        transform:scale(2.4);transform-origin:bottom center}
    .lg-hero-l{left:7%}
    .lg-hero-r{right:7%;transform:scale(-2.4,2.4)}
    .lg-run{position:relative;width:30px;height:40px;animation:lgRun .4s steps(2) infinite}
    @keyframes lgRun{50%{transform:translateY(-3px)}}
    .lg-sprite{position:absolute;left:0;top:0;width:5px;height:5px;background:transparent;
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

    @media (max-width:760px){
        .lg-hero{display:none}
    }
    @media (prefers-reduced-motion:reduce){
        .lg-star,.lg-cloud,.lg-note,.lg-ground,.lg-run,.lg-coin{animation:none}
    }
    </style>

    <script>
    (function () {
        const stage = document.querySelector('[data-login-stage]');
        if (!stage) return;

        const form   = stage.querySelector('[data-lg-form]');
        const email  = stage.querySelector('#lg-email');
        const pass   = stage.querySelector('#lg-pass');
        const pupils = stage.querySelectorAll('.lg-pupil');
        const hasErr = stage.querySelector('[data-lg-error]');
        let busy = false;

        function setState(s) { stage.dataset.state = s; }

        function look() {
            const x = Math.min(email.value.length, 10) - 3;
            pupils.forEach(function (p) { p.style.transform = 'translate(' + x + 'px,3px)'; });
        }

        email.addEventListener('focus', function () { setState('email'); look(); });
        email.addEventListener('input', look);
        pass.addEventListener('focus', function () { setState('password'); });
        [email, pass].forEach(function (el) {
            el.addEventListener('blur', function () {
                if (!busy && document.activeElement !== email && document.activeElement !== pass) {
                    setState('idle');
                }
            });
        });

        // bar LOADING dulu, baru form dikirim seperti biasa
        form.addEventListener('submit', function (e) {
            if (busy) return;
            if (!form.checkValidity()) return;
            e.preventDefault();
            busy = true;
            setState('loading');
            setTimeout(function () { form.submit(); }, 1300);
        });

        if (hasErr) {
            setState('error');
            stage.classList.add('is-shake');
        }
    })();
    </script>

</section>

@endsection