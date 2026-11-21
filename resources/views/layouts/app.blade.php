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


/* =========================================
   JSTN FOOTER - RIOT INSPIRED
========================================= */


.site-footer {
    width: 100%;
    margin: 0 !important;
    padding: 55px 0 30px;
    background: #0b0b0b !important;
    border: none !important;
    box-sizing: border-box;
}


.footer-container {
    width: 88%;
    max-width: 1450px;
    margin: auto;
}


/* FOOTER TOP */

.footer-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 35px;
    padding-bottom: 40px;
}

/* LOGO */

.footer-logo {
    color: white;
    text-decoration: none;
    font-size: 35px;
    font-weight: 950;
    letter-spacing: -2px;
    flex-shrink: 0;
}

.footer-logo span {
    color: #e63946;
}

/* LINKS */

.footer-links {
    display: flex;
    flex-wrap: wrap;
    gap: 22px 28px;
    flex: 1;
    padding-top: 10px;
}

.footer-links a {
    color: white;
    font-size: 11px;
    font-weight: 800;
    text-decoration: none;
    transition: 0.3s;
}

.footer-links a:hover {
    color: #e63946;
}

/* SOCIAL MEDIA */

.footer-social {
    display: flex;
    align-items: center;
    gap: 18px;
    padding-top: 7px;
}

.footer-social a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 25px;
    height: 25px;
    color: white;
    transition: 0.3s ease;
}

.footer-social svg {
    width: 21px;
    height: 21px;
}

.footer-social a:hover {
    color: #e63946;
    transform: translateY(-4px);
}

/* DIVIDER */

.footer-divider {
    width: 100%;
    height: 1px;
    background: #383838;
    margin-bottom: 25px;
}


/* FOOTER BOTTOM */

.footer-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.footer-copyright {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.footer-copyright span {
    color: #cccccc;
    font-size: 12px;
}

.back-to-top {
    color: white;
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
    transition: 0.3s;
}

.back-to-top:hover {
    color: #e63946;
}

/* RESPONSIVE */

@media (max-width: 800px) {

    .footer-top {
        flex-direction: column;
        gap: 25px;
    }

    .footer-links {
        gap: 18px;
    }

    .footer-bottom {
        align-items: flex-start;
        flex-direction: column;
    }

}

@media (max-width: 500px) {

    .footer-container {
        width: 90%;
    }

    .footer-links {
        gap: 15px;
    }

    .footer-links a {
        font-size: 10px;
    }

}


/* =========================================
   MY JOURNEY SECTION
========================================= */

.journey-section {
    margin-top: 90px;
    width: 100%;
    max-width: 900px;
}

.journey-heading {
    margin-bottom: 45px;
}

.journey-heading h2 {
    color: white;
    font-size: clamp(38px, 6vw, 64px);
    font-weight: 950;
    letter-spacing: -3px;
    text-transform: uppercase;
}

.journey-line {
    width: 75px;
    height: 5px;
    background: #e63946;
    margin-top: 15px;
}

.journey-heading p {
    color: #999;
    margin-top: 15px;
    font-size: 15px;
}

/* TIMELINE */

.journey-container {
    position: relative;
    padding-left: 35px;
}

.journey-container::before {
    content: "";
    position: absolute;
    left: 9px;
    top: 5px;
    bottom: 10px;
    width: 2px;
    background: #444;
}

.journey-item {
    position: relative;
    margin-bottom: 30px;
}

.journey-dot {
    position: absolute;
    left: -33px;
    top: 25px;
    width: 17px;
    height: 17px;
    background: #e63946;
    border: 4px solid #111;
    border-radius: 50%;
    z-index: 2;
}

/* EXPERIENCE CARD */

.journey-card {
    padding: 27px 30px;
    background: #1b1b1b;
    border: 1px solid #333;
    border-radius: 7px;
    transition: 0.3s ease;
}

.journey-card:hover {
    transform: translateX(7px);
    border-color: #e63946;
    background: #202020;
}

.journey-category {
    display: inline-block;
    color: #e63946;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
    margin-bottom: 12px;
}

.journey-card h3 {
    color: white;
    font-size: 23px;
    font-weight: 850;
    margin-bottom: 14px;
}

.journey-info {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    color: #ccc;
    font-size: 13px;
    font-weight: 600;
}

.journey-badge {
    padding: 4px 10px;
    background: #303030;
    color: #ddd;
    border-radius: 3px;
    font-size: 11px;
}

.journey-card p {
    color: #999;
    font-size: 14px;
    margin-top: 15px;
    line-height: 1.7;
}

.journey-period {
    color: #e63946;
    font-size: 12px;
    font-weight: 800;
    margin-top: 18px;
    letter-spacing: 0.5px;
}

/* RESPONSIVE */

@media (max-width: 650px) {
    .journey-section {
        margin-top: 60px;
    }

    .journey-container {
        padding-left: 28px;
    }

    .journey-dot {
        left: -26px;
    }

    .journey-card {
        padding: 22px 18px;
    }

    .journey-card h3 {
        font-size: 19px;
    }
}



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

/* GROUP KANAN HEADER */

.header-actions {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 12px;
}

/* GLOBE */

.globe-btn {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.1);
    border: none;
    border-radius: 8px;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.globe-btn:hover {
    background: rgba(255,255,255,0.2);
}

/* SEARCH */

.search-box {
    width: 190px;
    height: 46px;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 0 16px 0 20px;
    border: 1px solid rgba(255,255,255,0.85);
    border-radius: 30px;
    transition: 0.3s;
}

.search-box:focus-within {
    border-color: #e63946;
}

.search-box input {
    width: 100%;
    background: transparent;
    border: none;
    outline: none;
    color: white;
    font-size: 14px;
    font-weight: 800;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.search-box input::placeholder {
    color: white;
    opacity: 1;
}

.search-box button {
    display: flex;
    align-items: center;
    background: transparent;
    border: none;
    color: white;
    cursor: pointer;
}

/* SIGN IN */

.login-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 46px;
    padding: 0 30px;
    background: #d13639;
    color: white;
    text-decoration: none;
    font-size: 14px;
    font-weight: 800;
    letter-spacing: 0.5px;
    border-radius: 30px;
    transition: 0.3s ease;
    white-space: nowrap;
}

.login-btn:hover {
    background: white;
    color: #d13639;
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
        width: 130px;
        height: 40px;
    }

    .login-btn {
        height: 40px;
        padding: 0 18px;
        font-size: 12px;
    }

    .globe-btn {
        display: none;
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
    max-width: 1300px;
    display: flex;
    align-items: flex-start;
    gap: 48px;
}

.profile-card {
    flex: 1;
    max-width: 900px;
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

.profile-photo {
    position: relative;
    flex-shrink: 0;
    width: 320px;
    height: 400px;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #333333;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.35);
}

.profile-photo img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center 75%;
    opacity: 0;
    animation: photoFade 20s infinite;          /* 5s x 4 foto */
    animation-delay: calc(5s * var(--i));       /* jeda tiap foto */
}

@keyframes photoFade {
    0%     { opacity: 0; }
    5%     { opacity: 1; }   /* fade in */
    25%    { opacity: 1; }   /* tetap tampil */
    30%    { opacity: 0; }   /* fade out */
    100%   { opacity: 0; }
}

/* =========================================
   EDUCATION SECTION
========================================= */

.education-section {
    margin-top: 70px;
    width: 100%;
    max-width: 900px;
}

.education-heading {
    margin-bottom: 35px;
}

.education-heading h2 {
    color: white;
    font-size: clamp(32px, 5vw, 52px);
    font-weight: 950;
    letter-spacing: -2px;
    text-transform: uppercase;
}

.education-line {
    width: 75px;
    height: 5px;
    background: #e63946;
    margin-top: 12px;
}

.education-heading p {
    color: #999;
    margin-top: 12px;
    font-size: 15px;
}

.education-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
}

.education-card {
    overflow: hidden;
    background: #1b1b1b;
    border: 1px solid #333;
    border-radius: 10px;
    transition: 0.3s ease;
}

.education-card:hover {
    transform: translateY(-6px);
    border-color: #e63946;
}

/* FOTO SEKOLAH */

.education-photo {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.education-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.6s ease;
}

.education-card:hover .education-photo img {
    transform: scale(1.06);
}

.education-photo::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0) 50%, rgba(0,0,0,0.65) 100%);
    pointer-events: none;
}

.education-level {
    position: absolute;
    top: 14px;
    left: 14px;
    z-index: 2;
    padding: 6px 14px;
    background: #e63946;
    color: white;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
    border-radius: 30px;
}

/* ISI KARTU */

.education-body {
    padding: 22px 24px 26px;
}

.education-body h3 {
    color: white;
    font-size: 20px;
    font-weight: 850;
    line-height: 1.3;
    margin-bottom: 6px;
}

.education-major {
    color: #bbb;
    font-size: 14px;
    margin-bottom: 16px;
}

.education-meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.education-period {
    color: #e63946;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.5px;
}

.education-badge {
    padding: 4px 10px;
    background: #303030;
    color: #ddd;
    border-radius: 3px;
    font-size: 11px;
}

@media (max-width: 700px) {
    .education-grid {
        grid-template-columns: 1fr;
    }

    .education-photo {
        height: 200px;
    }
}

/* =========================================
   HOBBY SECTION
========================================= */

.hobby-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, 310px);
    justify-content: center;
    gap: 25px;
    margin: 40px auto;
    width: 100%;
}

.hobby-card {
    position: relative;
    width: 100%;
    height: 460px;
    overflow: hidden;
    border-radius: 12px;
    isolation: isolate;
    background: #111;
    transition: transform 0.4s ease;
}

.hobby-card:hover {
    transform: translateY(-7px);
}

/* DARK GRADIENT OVERLAY */

.hobby-overlay {
    position: absolute;
    inset: 0;
    z-index: 1;
    pointer-events: none;
    background: linear-gradient(
        to bottom,
        rgba(0,0,0,0) 0%,
        rgba(0,0,0,0) 35%,
        rgba(0,0,0,0.70) 68%,
        rgba(0,0,0,0.95) 100%
    );
}

/* SLIDER */

.hobby-slider {
    position: absolute;
    inset: 0;
    z-index: 0;
    overflow: hidden;
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
}

/* FOTO UTAMA */

.hobby-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.6s ease;
}

/* JUDUL HOBI */

.hobby-card:hover .hobby-slide img {
    transform: scale(1.05);
}


/* TEKS DI ATAS FOTO */

.hobby-content {
    position: absolute;
    left: 20px;
    right: 20px;
    bottom: 50px;
    z-index: 3;
    text-align: center;
    color: white;
}

.hobby-content .hobby-subtitle {
    display: block;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 3px;
    color: #ffb6a0;
    margin-bottom: 8px;
}

.hobby-content h3 {
    color: white;
    font-size: 28px;
    font-weight: 900;
    letter-spacing: 1px;
    line-height: 1.1;
    margin-bottom: 10px;
    text-shadow: 0 2px 12px rgba(0,0,0,0.6);
}

.hobby-description {
    color: rgba(255,255,255,0.9);
    font-size: 13px;
    line-height: 1.5;
    font-weight: 500;
    margin-bottom: 18px;
    text-shadow: 0 1px 8px rgba(0,0,0,0.6);
}

.hobby-cta {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 12px 30px;
    border: 1px solid rgba(255,255,255,0.55);
    border-radius: 40px;
    background: transparent;
    color: white;
    font-size: 14px;
    font-weight: 700;
    transition: 0.3s ease;
}

.hobby-card:hover .hobby-cta {
    background: white;
    border-color: white;
    color: #111;
}

.hobby-arrow { font-size: 16px; }

/* SLIDER DOTS */

.slider-dots {
    position: absolute;
    bottom: 16px;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    gap: 7px;
    z-index: 3;
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
        grid-template-columns: repeat(auto-fit, minmax(260px, 310px));
    }

    .hobby-card {
        height: 440px;
        max-width: 100%;
    }
}

@media (max-width: 480px) {
    .hobby-content h3 { font-size: 20px; }
    .hobby-cta { padding: 12px 20px; font-size: 12px; }
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

    /* ===== TAMBAHAN FOTO PROFIL ===== */
    .profile-wrapper {
        flex-direction: column-reverse;
        align-items: center;
    }

    .profile-card {
        width: 100%;
    }

    .profile-photo img {
        width: 100%;
        max-width: 320px;
        height: auto;
        aspect-ratio: 4 / 5;
    }

}


</style>




</style>


<body>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>