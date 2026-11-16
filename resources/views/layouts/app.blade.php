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

/* =========================================
   HEADER
========================================= */

header {
    position: sticky;
    top: 0;
    z-index: 100;
    width: 100%;
    padding: 20px 6%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #0a0a0a;
    border-bottom: 1px solid #292929;
}

.brand-logo {
    color: #ffffff;
    font-size: 32px;
    font-weight: 950;
    letter-spacing: -2px;
    transition: 0.3s;
}

.brand-logo span {
    color: #e83b46;
}

.brand-logo:hover {
    color: #e83b46;
}

nav {
    display: flex;
    align-items: center;
    gap: 12px;
}

nav a {
    position: relative;
    color: #b9b9b9;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    padding: 12px 20px;
    border-radius: 4px;
    transition: 0.3s;
}

nav a:hover {
    color: white;
    background: #242424;
}

nav a.active {
    color: white;
    background: #e83b46;
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
   FIX UKURAN FOTO HOBI + BACKGROUND BLUR
========================================= */

/* Ukuran card */
.hobby-container {
    display: grid !important;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 25px;
}

/* Pembungkus foto */
.hobby-image-wrapper {
    position: relative;
    width: 100%;
    height: 280px !important;
    overflow: hidden;
    border-radius: 12px;
    background: #202020;
    isolation: isolate;
}

/* Background foto yang blur */
.hobby-image-wrapper::before {
    content: "";
    position: absolute;
    inset: -20px;
    background-image: var(--hobby-bg);
    background-size: cover;
    background-position: center;
    filter: blur(15px);
    transform: scale(1.1);
    z-index: -1;
}

/* Foto utama */
.hobby-image-wrapper img {
    display: block;
    width: 100% !important;
    height: 100% !important;
    max-width: 100%;
    object-fit: contain !important;
    object-position: center;
    border-radius: 0;
    background: transparent;
    transition: transform 0.4s ease;
}

/* Efek hover */
.hobby-card:hover .hobby-image-wrapper img {
    transform: scale(1.03);
}

/* Tampilan HP */
@media (max-width: 700px) {
    .hobby-container {
        grid-template-columns: 1fr;
    }

    .hobby-image-wrapper {
        height: 240px !important;
    }
}


/* FOTO DAN BACKGROUND BLUR */

.hobby-image-wrapper {
    position: relative;
    width: 100%;
    height: 300px;
    overflow: hidden;
    border-radius: 3px;
    background: #252525;
    isolation: isolate;
}

.hobby-image-wrapper::before {
    content: "";
    position: absolute;
    inset: -20px;
    background-image: var(--hobby-bg);
    background-size: cover;
    background-position: center;
    filter: blur(18px) brightness(0.65);
    transform: scale(1.1);
    z-index: -1;
}

.hobby-image-wrapper img {
    display: block;
    position: relative;
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.5s ease;
}

.hobby-card:hover .hobby-image-wrapper img {
    transform: scale(1.04);
}

.hobby-card h3 {
    padding: 20px 10px 12px;
    color: white;
    font-size: 21px;
    font-weight: 850;
    text-transform: uppercase;
    letter-spacing: 1px;
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