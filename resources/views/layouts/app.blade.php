<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>


<style>


/* =========================================
   JSTN - RIOT INSPIRED PORTFOLIO
========================================= */

/* GLOBAL */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: #111111;
    color: #f5f5f5;
    line-height: 1.6;
    overflow-x: hidden;
}

main {
    width: 100%;
    max-width: 1400px;
    min-height: 80vh;
    margin: auto;
    padding: 65px 55px;
}


/* =========================
   HEADER JSTN
========================= */

.main-header {
    width: 100%;
    height: 82px;
    background: #101010;
    position: relative;
    z-index: 1000;
}

.header-container {
    width: 96%;
    height: 100%;
    margin: auto;

    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 45px;
}

/* LOGO */

.brand-logo {
    color: white;
    text-decoration: none;
    font-size: 28px;
    font-weight: 900;
    letter-spacing: -1.5px;
    flex-shrink: 0;
}

.brand-logo span {
    color: #e63946;
}

/* NAVIGATION */

.nav-menu {
    display: flex;
    align-items: center;
    gap: 40px;
}

.nav-menu a {
    color: white;
    text-decoration: none;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 0.5px;
    transition: 0.3s;
}

.nav-menu a:hover,
.nav-menu a.active {
    color: #e63946;
}

/* SEARCH */

.search-box {
    margin-left: auto;
    width: 190px;
    height: 38px;

    display: flex;
    align-items: center;

    border: 1px solid white;
    border-radius: 30px;
    padding: 0 12px;
}

.search-box input {
    width: 100%;
    background: transparent;
    border: none;
    outline: none;

    color: white;
    font-size: 12px;
}

.search-box input::placeholder {
    color: white;
}

.search-box button {
    background: transparent;
    border: none;
    color: white;
    font-size: 22px;
    cursor: pointer;
}

/* LOGIN BUTTON */

.login-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 10px 18px;
    background: #e63946;
    color: white;

    text-decoration: none;
    font-size: 13px;
    font-weight: 800;

    border-radius: 30px;
    transition: 0.3s ease;
    white-space: nowrap;
}

.login-btn:hover {
    background: white;
    color: #e63946;
    transform: translateY(-2px);
}


/* RESPONSIVE */

@media (max-width: 650px) {
    .header-container {
        gap: 18px;
    }

    .nav-menu {
        gap: 15px;
    }

    .nav-menu a {
        font-size: 10px;
    }

    .search-box {
        width: 120px;
    }
}


/* =========================================
   HOME / HERO
========================================= */

.hero {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    min-height: 440px;
    padding: 90px 70px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    border-radius: 8px;
    background:
        radial-gradient(circle at 85% 20%,
            rgba(232, 59, 70, 0.35),
            transparent 30%),
        linear-gradient(110deg, #252525, #111111 70%);
    border: 1px solid #333333;
    animation: fadeUp 0.8s ease;
}

.hero::before {
    content: "J";
    position: absolute;
    z-index: -1;
    right: 40px;
    top: -125px;
    font-size: 530px;
    line-height: 1;
    font-weight: 950;
    color: rgba(232, 59, 70, 0.08);
    pointer-events: none;
}

.hero::after {
    content: "";
    position: absolute;
    width: 7px;
    height: 180px;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    background: #e83b46;
}

.subtitle {
    color: #e83b46;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 4px;
    text-transform: uppercase;
    margin-bottom: 20px;
}

.hero h1 {
    max-width: 850px;
    color: white;
    font-size: clamp(48px, 8vw, 90px);
    font-weight: 950;
    line-height: 0.98;
    letter-spacing: -4px;
    text-transform: uppercase;
    margin-bottom: 28px;
}

.hero p:not(.subtitle) {
    max-width: 620px;
    color: #c3c3c3;
    font-size: 17px;
    margin-bottom: 35px;
}

.hero-button {
    display: inline-block;
    width: fit-content;
    padding: 15px 30px;
    color: white;
    background: #e83b46;
    border: 1px solid #e83b46;
    text-decoration: none;
    text-transform: uppercase;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 1px;
    border-radius: 3px;
    transition: 0.3s;
}

.hero-button:hover {
    background: white;
    color: #111111;
    border-color: white;
    transform: translateY(-4px);
}

/* =========================================
   PAGE TITLES
========================================= */

.page-title {
    position: relative;
    display: inline-block;
    color: white;
    font-size: clamp(38px, 6vw, 64px);
    font-weight: 950;
    line-height: 1.1;
    letter-spacing: -3px;
    text-transform: uppercase;
    margin-bottom: 12px;
}

.page-title::after {
    content: "";
    display: block;
    width: 75px;
    height: 5px;
    margin-top: 15px;
    background: #e83b46;
}

.page-description {
    color: #999999;
    font-size: 16px;
    margin-top: 10px;
    margin-bottom: 40px;
}

/* =========================================
   DATA DIRI
========================================= */

.profile-wrapper {
    width: 100%;
    max-width: 900px;
}

.profile-card {
    width: 100%;
    padding: 30px 35px;
    background: #1b1b1b;
    border: 1px solid #333333;
    border-radius: 5px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
}

.profile-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    padding: 21px 14px;
    border-bottom: 1px solid #333333;
    transition: 0.3s;
}

.profile-row:hover {
    background: #272020;
    border-left: 4px solid #e83b46;
    padding-left: 22px;
}

.profile-row:last-child {
    border-bottom: none;
}

.profile-label {
    color: #999999;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.profile-value {
    color: white;
    font-size: 15px;
    font-weight: 700;
    text-align: right;
}



/* =========================================
   HOBBY SECTION
========================================= */

.hobby-container {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 25px;
    max-width: 900px;
}

.hobby-card {
    width: 100%;
    max-width: 430px;
    overflow: hidden;
    background: #1b1b1b;
    border: 1px solid #333;
    border-radius: 8px;
}

/* SLIDER */

.hobby-slider {
    width: 100%;
    height: 220px;
    overflow: hidden;
    position: relative;
    background: #222;
}

.hobby-track {
    display: flex;
    width: 100%;
    height: 100%;
    transition: transform 0.6s ease-in-out;
}

.hobby-slide {
    flex: 0 0 100%;
    width: 100%;
    height: 100%;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* BACKGROUND BLUR */

.hobby-slide::before {
    content: "";
    position: absolute;
    inset: -15px;
    background-image: var(--hobby-bg);
    background-size: cover;
    background-position: center;
    filter: blur(15px) brightness(0.65);
    transform: scale(1.1);
}

/* FOTO UTAMA */

.hobby-slide img {
    position: relative;
    z-index: 1;
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 12px;
}

/* JUDUL HOBI */

.hobby-card h3 {
    padding: 15px 18px;
    color: white;
    font-size: 18px;
    font-weight: 850;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* SLIDER DOTS */

.slider-dots {
    position: absolute;
    bottom: 10px;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: center;
    gap: 7px;
    z-index: 2;
}

.slider-dot {
    width: 8px;
    height: 8px;
    padding: 0;
    border: none;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    cursor: pointer;
    transition: 0.3s;
}

.slider-dot.active {
    width: 22px;
    border-radius: 10px;
    background: white;
}

/* RESPONSIVE */

@media (max-width: 700px) {
    .hobby-container {
        grid-template-columns: 1fr;
    }

    .hobby-card {
        max-width: 100%;
    }

    .hobby-slider {
        height: 220px;
    }
}


/* =========================================
   FOOTER
========================================= */

footer {
    position: relative;
    margin-top: 70px;
    padding: 40px 20px;
    text-align: center;
    background: #090909;
    border-top: 1px solid #333333;
}

footer p {
    color: #888888;
    font-size: 13px;
    letter-spacing: 1px;
}

/* =========================================
   ANIMATION
========================================= */

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(25px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 700px) {

    header {
        padding: 18px 5%;
        flex-direction: column;
        gap: 15px;
    }

    .brand-logo {
        font-size: 28px;
    }

    nav {
        flex-wrap: wrap;
        justify-content: center;
        gap: 4px;
    }

    nav a {
        padding: 10px 13px;
        font-size: 12px;
    }

    main {
        padding: 40px 5%;
    }

    .hero {
        min-height: 380px;
        padding: 60px 28px;
    }

    .hero h1 {
        letter-spacing: -2px;
    }

    .hero::before {
        font-size: 300px;
        right: -40px;
        top: -50px;
    }

    .page-title {
        letter-spacing: -2px;
    }

    .profile-card {
        padding: 18px;
    }

    .profile-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }

    .profile-value {
        text-align: left;
    }

    .hobby-container {
        grid-template-columns: 1fr;
    }

    .hobby-image-wrapper {
        height: 240px;
    }


/* ===========================
   HOBBY IMAGE SLIDER
=========================== */

.hobby-slider {
    width: 100%;
    height: 280px;
    overflow: hidden;
    position: relative;
    border-radius: 12px;
    background: #222;
}

.hobby-track {
    display: flex;
    width: 100%;
    height: 100%;
    transition: transform 0.6s ease-in-out;
}

.hobby-slide {
    flex: 0 0 100%;
    width: 100%;
    height: 100%;
    position: relative;
    overflow: hidden;

    display: flex;
    align-items: center;
    justify-content: center;
    background: #222;
}

/* BACKGROUND BLUR */

.hobby-slide::before {
    content: "";
    position: absolute;
    inset: -15px;
    background-image: var(--hobby-bg);
    background-size: cover;
    background-position: center;
    filter: blur(15px) brightness(0.65);
    transform: scale(1.1);
}

/* FOTO UTAMA */

.hobby-slide img {
    position: relative;
    z-index: 1;
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 10px;
}

/* SLIDER DOTS */

.slider-dots {
    position: absolute;
    bottom: 12px;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: center;
    gap: 7px;
    z-index: 2;
}

.slider-dot {
    width: 8px;
    height: 8px;
    padding: 0;
    border: none;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    cursor: pointer;
    transition: 0.3s;
}

.slider-dot.active {
    width: 22px;
    border-radius: 10px;
    background: white;
}

/* RESPONSIVE SLIDER */

@media (max-width: 700px) {
    .hobby-slider {
        height: 240px;
    }
}

</style>


<body>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>