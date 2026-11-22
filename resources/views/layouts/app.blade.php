<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

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
    position: sticky;                     /* header menempel di atas saat scroll */
    top: 0;
    z-index: 1000;
    background: rgba(16, 16, 16, 0.55);   /* semi transparan */
    -webkit-backdrop-filter: blur(14px);  /* Safari */
    backdrop-filter: blur(14px);          /* konten di belakang header jadi blur */
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
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

/* FOTO PROFIL (SLIDESHOW 4 FOTO) */

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

a.hobby-cta {
    text-decoration: none;
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
   GAMES PAGE
========================================= */

.games-section {
    width: 100%;
}

.games-back {
    display: inline-block;
    margin-bottom: 25px;
    color: #999;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: 0.3s;
}

.games-back:hover { color: #e63946; }

.games-title {
    color: white;
    font-size: clamp(38px, 6vw, 64px);
    font-weight: 800;
    letter-spacing: -2px;
}

.games-subtitle {
    color: #999;
    margin-top: 8px;
}

/* BARISAN KARTU (full lebar layar, looping) */

.games-row {
    position: relative;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    width: 100vw;
    margin-top: 40px;
    margin-left: calc(50% - 50vw);   /* keluar dari batas kontainer sampai tepi layar */
    padding: 60px 0 60px;
    overflow-x: auto;
    scrollbar-width: none;
}

.games-row::-webkit-scrollbar { display: none; }

/* KARTU JAJAR GENJANG (gambar lurus, hanya bentuknya dipotong) */

.game-card {
    position: relative;
    flex: 0 0 280px;
    height: 520px;
    overflow: hidden;
    background: #111;
    clip-path: polygon(7% 0, 100% 0, 93% 100%, 0 100%);
    filter: brightness(0.8);
    transform: scale(1);
    transition: transform 0.35s ease, filter 0.35s ease;
}

/* selang-seling naik turun seperti contoh */
.game-card:nth-child(even) {
    margin-top: 28px;
}

/* KARTU DI TENGAH = POINT OF VIEW */
.game-card.is-center {
    transform: scale(1.08);
    filter: brightness(1);
    z-index: 2;
}

.game-card:hover {
    filter: brightness(1);
}

.game-card img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.6s ease;
}

.game-card:hover img {
    transform: scale(1.05);
}

/* gradasi gelap di bawah supaya nama terbaca */
.game-card::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.85) 100%);
    pointer-events: none;
}

.game-info {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 22px;
    z-index: 2;
    padding: 0 22px;
    text-align: center;
}

.game-info h3 {
    color: white;
    font-size: 20px;
    font-weight: 800;
    text-shadow: 0 2px 10px rgba(0,0,0,0.7);
}

.game-info span {
    color: #e63946;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
}

@media (max-width: 700px) {
    .game-card {
        flex-basis: 210px;
        height: 400px;
    }
}

/* =========================================
   MUSIC PAGE
========================================= */

.music-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
    margin-top: 45px;
    max-width: 1000px;
}

.music-card {
    padding: 22px;
    background: #1b1b1b;
    border: 1px solid #333;
    border-radius: 12px;
    transition: 0.3s ease;
}

.music-card:hover {
    border-color: #e63946;
}

.music-card-title {
    color: white;
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 16px;
}

.music-card iframe {
    display: block;
    border-radius: 12px;
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

    .profile-wrapper {
        flex-direction: column-reverse;
        align-items: center;
    }

    .profile-card {
        width: 100%;
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

    .profile-photo {
        width: 100%;
        max-width: 320px;
        height: auto;
        aspect-ratio: 4 / 5;
    }

}


</style>

<link rel="stylesheet" href="{{ asset('css/theme.css') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">

<style>
:root{--font-pixel:'Silkscreen','Pixelify Sans','Courier New',monospace}

/* Judul, menu, tombol, dan label memakai font pixel */
h1,h2,h3,h4,
.brand-logo,.footer-logo,
.nav-menu a,.footer-links a,
.subtitle,.page-title,
.hero-button,.login-btn,.hobby-cta,.back-to-top,.games-back,
.education-level,.journey-category,.game-info span,
.hx-btn,.hx-badge,.hx-theme,.bgm-play,.bgm-pop small{
    font-family:var(--font-pixel) !important;
}

/* Judul lama memakai jarak huruf rapat (minus), tidak cocok untuk font pixel */
h1,h2,.page-title,.brand-logo,.footer-logo{letter-spacing:.02em !important}

/* Font pixel lebih lebar, jadi judul besar diperkecil sedikit */
.hero h1,.page-title{font-size:clamp(30px,5.5vw,60px) !important;line-height:1.15 !important}

body{font-family:var(--font-pixel) !important}
</style>

</head>

<body>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

        <div id="after-main">@yield('after_content')</div>

    @include('partials.footer')



    {{-- <audio id="bgm" preload="auto"></audio>

    <button id="bgm-toggle" type="button" aria-label="Putar atau jeda musik">♪</button>

        <script>
    (function () {
        const audio = document.getElementById('bgm');
const btn = document.getElementById('bgm-toggle');
audio.volume = 0.4;

// ===== DAFTAR LAGU: sesuaikan dengan file di public/audio =====
const TRACKS = [
    "{{ asset('audio/music.mp3') }}",
    "{{ asset('audio/music2.mp3') }}",
    "{{ asset('audio/music3.mp3') }}",
];

let userPaused = sessionStorage.getItem('bgmPaused') === '1';
let resumeTime = parseFloat(sessionStorage.getItem('bgmTime') || '0');
let errorCount = 0;

// pilih lagu acak yang berbeda dari lagu sebelumnya
function randomIndex(except) {
    if (TRACKS.length < 2) return 0;
    let i;
    do { i = Math.floor(Math.random() * TRACKS.length); } while (i === except);
    return i;
}

// lanjutkan lagu terakhir kalau ada, kalau tidak pilih acak
let current = parseInt(sessionStorage.getItem('bgmTrack'), 10);
if (isNaN(current) || current < 0 || current >= TRACKS.length) {
    current = randomIndex(-1);
    resumeTime = 0;
}
sessionStorage.setItem('bgmTrack', current);
audio.src = TRACKS[current];

audio.addEventListener('loadedmetadata', function () {
    if (resumeTime && resumeTime < audio.duration) audio.currentTime = resumeTime;
    resumeTime = 0;
});

// lagu selesai -> mulai lagu acak lain
function playRandom() {
    current = randomIndex(current);
    sessionStorage.setItem('bgmTrack', current);
    sessionStorage.setItem('bgmTime', 0);
    audio.src = TRACKS[current];
    audio.play().then(updateButton).catch(function () {});
}

audio.addEventListener('ended', playRandom);
audio.addEventListener('playing', function () { errorCount = 0; });

// kalau satu file gagal dimuat (nama salah), lompat ke lagu lain
audio.addEventListener('error', function () {
    if (++errorCount < TRACKS.length) playRandom();
});

        function updateButton() {
            btn.classList.toggle('is-playing', !audio.paused);
        }

        function tryPlay() {
            return audio.play().then(updateButton).catch(function () {
                const events = ['click', 'keydown', 'touchend'];
                function unlock() {
                    if (!userPaused) audio.play().then(updateButton).catch(function () {});
                    events.forEach(function (e) { document.removeEventListener(e, unlock); });
                }
                events.forEach(function (e) { document.addEventListener(e, unlock); });
            });
        }

        if (!userPaused) tryPlay();

        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            if (audio.paused) {
                userPaused = false;
                sessionStorage.setItem('bgmPaused', '0');
                audio.play().then(updateButton);
            } else {
                userPaused = true;
                sessionStorage.setItem('bgmPaused', '1');
                audio.pause();
                updateButton();
            }
        });

        setInterval(function () {
            if (!audio.paused) sessionStorage.setItem('bgmTime', audio.currentTime);
        }, 1000);
        window.addEventListener('beforeunload', function () {
            sessionStorage.setItem('bgmTime', audio.currentTime);
        });

        /* ===== PINDAH HALAMAN TANPA PUTUS MUSIK ===== */

        async function loadPage(url, push) {
            try {
                const res = await fetch(url, { headers: { 'X-Requested-With': 'fetch' } });
                if (!res.ok) throw new Error('bad response');
                const html = await res.text();
                const doc = new DOMParser().parseFromString(html, 'text/html');

                const newMain = doc.querySelector('main');
                const oldMain = document.querySelector('main');
                if (!newMain || !oldMain) throw new Error('no main');

                if (window.__stopGames) { window.__stopGames(); window.__stopGames = null; }

                oldMain.innerHTML = newMain.innerHTML;
                document.title = doc.title;

                // jalankan ulang script milik halaman (slider, auto-scroll, dll.)
                oldMain.querySelectorAll('script').forEach(function (old) {
                    const s = document.createElement('script');
                    s.textContent = old.textContent;
                    old.replaceWith(s);
                });

                if (push) history.pushState({}, '', url);
                window.scrollTo(0, 0);
            } catch (err) {
                window.location.href = url;   // cadangan: reload biasa
            }
        }

        document.addEventListener('click', function (e) {
            const a = e.target.closest('a');
            if (!a) return;
            if (e.defaultPrevented || e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;
            if (a.target === '_blank' || a.hasAttribute('download')) return;
            if (a.origin !== location.origin) return;                 // link luar
            if (a.protocol === 'mailto:' || a.protocol === 'tel:') return;
            const href = a.getAttribute('href');
            if (!href || href.startsWith('#')) return;                // anchor di halaman sama

            e.preventDefault();
            loadPage(a.href, true);
        });

        window.addEventListener('popstate', function () {
            loadPage(location.href, false);   // tombol back/forward
        });
    })();
    </script> --}}

        <style>
    /* ===== POP UP MUSIK ===== */
    .bgm-pop{position:fixed;right:20px;bottom:84px;z-index:9992;width:280px;padding:16px 18px;display:none;color:#fff;
        background:linear-gradient(160deg,#030c2b,#061a4d);border:2px solid #1e4fb8;box-shadow:5px 5px 0 rgba(30,79,184,.55)}
    .bgm-pop.open{display:block}
    .bgm-pop small{color:#22d3ee;font-weight:700}
    .bgm-title{margin:4px 0 14px;font-weight:800;font-size:1.05rem;line-height:1.3;overflow-wrap:anywhere}
    .bgm-bar{height:10px;background:#0a2466;border:2px solid #1e4fb8}
    .bgm-bar i{display:block;height:100%;width:0;background:var(--accent,#f9a825)}
    .bgm-time{display:flex;justify-content:space-between;margin:8px 0 14px;font-size:.85rem;color:#b9c8f0;
        font-family:ui-monospace,Consolas,monospace}
    .bgm-play{cursor:pointer;font:inherit;font-weight:800;padding:8px 20px;color:#061a4d;
        background:var(--accent,#f9a825);border:2px solid var(--accent,#f9a825);box-shadow:4px 4px 0 var(--accent2,#ff8a00);
        transition:transform .15s,box-shadow .15s}
    .bgm-play:hover,.bgm-play:focus-visible{transform:translate(2px,2px);box-shadow:2px 2px 0 var(--accent2,#ff8a00);outline:none}
    @media (max-width:400px){.bgm-pop{width:calc(100vw - 40px)}}
    </style>

    <audio id="bgm" preload="auto"></audio>

    <div class="bgm-pop" id="bgm-pop" role="dialog" aria-label="Pemutar musik">
        <small>Sedang diputar</small>
        <div class="bgm-title" id="bgm-title">-</div>
        <div class="bgm-bar"><i id="bgm-fill"></i></div>
        <div class="bgm-time"><span id="bgm-cur">0:00</span><span id="bgm-dur">--:--</span></div>
        <button type="button" class="bgm-play" id="bgm-play">Play</button>
    </div>

    <button id="bgm-toggle" type="button" aria-label="Buka pemutar musik" aria-expanded="false" aria-controls="bgm-pop">♪</button>

    <script>
    (function () {
        const audio = document.getElementById('bgm');
        const btn = document.getElementById('bgm-toggle');
        const pop = document.getElementById('bgm-pop');
        const titleEl = document.getElementById('bgm-title');
        const fill = document.getElementById('bgm-fill');
        const curEl = document.getElementById('bgm-cur');
        const durEl = document.getElementById('bgm-dur');
        const playBtn = document.getElementById('bgm-play');
        audio.volume = 0.4;

        // ===== DAFTAR LAGU: sesuaikan file dan judulnya =====
        const TRACKS = [
            { src: "{{ asset('audio/music.mp3') }}",  title: 'Steve Lacy - oh yeah ' },
            { src: "{{ asset('audio/music2.mp3') }}", title: 'Rex Orange County - Hannah Montana' },
            { src: "{{ asset('audio/music3.mp3') }}", title: 'A Sorrowful Reunion - Reality Club' },
            { src: "{{ asset('audio/music4.mp3') }}", title: 'Thief - Ookay' },
            { src: "{{ asset('audio/music5.mp3') }}", title: 'Porter Robinson & Madeon - Shelter' },
            { src: "{{ asset('audio/music6.mp3') }}", title: 'MGMT - Kids' },
            { src: "{{ asset('audio/music7.mp3') }}", title: 'Ombak Banyu Asmara - The Panturas' },
        ];

        let userPaused = sessionStorage.getItem('bgmPaused') === '1';
        let resumeTime = parseFloat(sessionStorage.getItem('bgmTime') || '0');
        let errorCount = 0;

        function fmt(s) {
            if (!isFinite(s)) return '--:--';
            s = Math.floor(s);
            return Math.floor(s / 60) + ':' + ('0' + (s % 60)).slice(-2);
        }

        // pilih lagu acak yang berbeda dari lagu sebelumnya
        function randomIndex(except) {
            if (TRACKS.length < 2) return 0;
            let i;
            do { i = Math.floor(Math.random() * TRACKS.length); } while (i === except);
            return i;
        }

        // lanjutkan lagu terakhir kalau ada, kalau tidak pilih acak
        let current = parseInt(sessionStorage.getItem('bgmTrack'), 10);
        if (isNaN(current) || current < 0 || current >= TRACKS.length) {
            current = randomIndex(-1);
            resumeTime = 0;
        }
        sessionStorage.setItem('bgmTrack', current);
        audio.src = TRACKS[current].src;
        titleEl.textContent = TRACKS[current].title;

        audio.addEventListener('loadedmetadata', function () {
            if (resumeTime && resumeTime < audio.duration) audio.currentTime = resumeTime;
            resumeTime = 0;
        });

        // durasi dan progress di pop up
        audio.addEventListener('loadedmetadata', function () { durEl.textContent = fmt(audio.duration); });
        audio.addEventListener('timeupdate', function () {
            curEl.textContent = fmt(audio.currentTime);
            fill.style.width = (audio.duration ? audio.currentTime / audio.duration * 100 : 0) + '%';
        });

        // lagu selesai -> mulai lagu acak lain
        function playRandom() {
            current = randomIndex(current);
            sessionStorage.setItem('bgmTrack', current);
            sessionStorage.setItem('bgmTime', 0);
            audio.src = TRACKS[current].src;
            titleEl.textContent = TRACKS[current].title;
            curEl.textContent = '0:00';
            durEl.textContent = '--:--';
            fill.style.width = '0%';
            audio.play().then(updateButton).catch(function () {});
        }

        audio.addEventListener('ended', playRandom);
        audio.addEventListener('playing', function () { errorCount = 0; });

        // kalau satu file gagal dimuat (nama salah), lompat ke lagu lain
        audio.addEventListener('error', function () {
            if (++errorCount < TRACKS.length) playRandom();
        });

        function updateButton() {
            btn.classList.toggle('is-playing', !audio.paused);
            playBtn.textContent = audio.paused ? 'Play' : 'Stop';
        }
        audio.addEventListener('play', updateButton);
        audio.addEventListener('pause', updateButton);

        function tryPlay() {
            return audio.play().then(updateButton).catch(function () {
                const events = ['click', 'keydown', 'touchend'];
                function unlock() {
                    if (!userPaused) audio.play().then(updateButton).catch(function () {});
                    events.forEach(function (e) { document.removeEventListener(e, unlock); });
                }
                events.forEach(function (e) { document.addEventListener(e, unlock); });
            });
        }

        if (!userPaused) tryPlay();
        updateButton();

        // ===== POP UP: tombol ♪ membuka / menutup =====
        function setOpen(open) {
            pop.classList.toggle('open', open);
            btn.setAttribute('aria-expanded', open);
        }
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            setOpen(!pop.classList.contains('open'));
        });
        document.addEventListener('click', function (e) {
            if (!pop.contains(e.target) && e.target !== btn) setOpen(false);
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') setOpen(false);
        });

        // tombol Play / Stop di dalam pop up
        playBtn.addEventListener('click', function () {
            if (audio.paused) {
                userPaused = false;
                sessionStorage.setItem('bgmPaused', '0');
                audio.play().then(updateButton).catch(function () {});
            } else {
                userPaused = true;
                sessionStorage.setItem('bgmPaused', '1');
                audio.pause();
                updateButton();
            }
        });

        setInterval(function () {
            if (!audio.paused) sessionStorage.setItem('bgmTime', audio.currentTime);
        }, 1000);
        window.addEventListener('beforeunload', function () {
            sessionStorage.setItem('bgmTime', audio.currentTime);
        });

        /* ===== PINDAH HALAMAN TANPA PUTUS MUSIK ===== */

        async function loadPage(url, push) {
            try {
                const res = await fetch(url, { headers: { 'X-Requested-With': 'fetch' } });
                if (!res.ok) throw new Error('bad response');
                const html = await res.text();
                const doc = new DOMParser().parseFromString(html, 'text/html');

                const newMain = doc.querySelector('main');
                const oldMain = document.querySelector('main');
                if (!newMain || !oldMain) throw new Error('no main');

                if (window.__stopGames) { window.__stopGames(); window.__stopGames = null; }

                oldMain.innerHTML = newMain.innerHTML;
                const newAfter = doc.getElementById('after-main');
                const oldAfter = document.getElementById('after-main');
                if (newAfter && oldAfter) oldAfter.innerHTML = newAfter.innerHTML;

                document.title = doc.title;

                // jalankan ulang script milik halaman (slider, auto-scroll, dll.)
                document.querySelectorAll('main script, #after-main script').forEach(function (old) {
                    const s = document.createElement('script');
                    s.textContent = old.textContent;
                    old.replaceWith(s);
                });

                if (push) history.pushState({}, '', url);
                window.scrollTo(0, 0);
            } catch (err) {
                window.location.href = url;   // cadangan: reload biasa
            }
        }

        document.addEventListener('click', function (e) {
            const a = e.target.closest('a');
            if (!a) return;
            if (e.defaultPrevented || e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;
            if (a.target === '_blank' || a.hasAttribute('download')) return;
            if (a.origin !== location.origin) return;                 // link luar
            if (a.protocol === 'mailto:' || a.protocol === 'tel:') return;
            const href = a.getAttribute('href');
            if (!href || href.startsWith('#')) return;                // anchor di halaman sama

            e.preventDefault();
            loadPage(a.href, true);
        });

        window.addEventListener('popstate', function () {
            loadPage(location.href, false);   // tombol back/forward
        });
    })();
    </script>


    <script src="{{ asset('js/search.js') }}"></script>

    @include('partials.pixel-trail')
    @include('partials.theme-fx')

    <div class="egg-layer" id="eggLayer" aria-hidden="true"></div>

<style>
  .egg-layer {
    position: fixed;
    inset: 0;
    overflow: hidden;
    pointer-events: none;   /* tidak bisa diinteraksi */
    z-index: -1;            /* di belakang konten, di atas warna background */
    will-change: transform;
  }
  .egg {
    position: absolute;
    image-rendering: pixelated;
    opacity: 0;
    animation: eggFloat var(--dur, 10s) ease-in-out forwards;
  }
  .egg svg { display: block; width: 100%; height: 100%; shape-rendering: crispEdges; }

  @keyframes eggFloat {
    0%   { opacity: 0;   transform: translate(0, 0) rotate(0deg); }
    15%  { opacity: .55; }
    50%  { transform: translate(var(--dx, 40px), var(--dy, -60px)) rotate(var(--rot, 6deg)); }
    85%  { opacity: .55; }
    100% { opacity: 0;   transform: translate(calc(var(--dx, 40px) * 2), calc(var(--dy, -60px) * 2)) rotate(0deg); }
  }

  @media (prefers-reduced-motion: reduce) {
    .egg-layer { display: none; }
  }
</style>

<script>
(function () {
  const layer = document.getElementById('eggLayer');
  if (!layer || matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  // Sprite pixel: tiap karakter = grid teks, huruf = warna
  const P = { o:'#ffa41b', p:'#c084fc', c:'#22d3ee', r:'#fb7185', w:'#ffffff', k:'#0a1a4a', g:'#4ade80' };
  const SPRITES = [
    [ // hantu
      '..oooo..',
      '.oooooo.',
      'owwoowwo',
      'owkoowko',
      'oooooooo',
      'oooooooo',
      'oo.oo.oo' ],
    [ // alien
      '..p..p..',
      '...pp...',
      '..pppp..',
      '.pp pp p.'.replace(/ /g,''),
      'pppppppp',
      'p.pppp.p',
      'p.p..p.p' ],
    [ // hati
      '.rr..rr.',
      'rrrrrrrr',
      'rrrrrrrr',
      '.rrrrrr.',
      '..rrrr..',
      '...rr...' ],
    [ // bintang
      '...cc...',
      '...cc...',
      'cccccccc',
      '.cccccc.',
      '..cccc..',
      '.cc..cc.' ],
    [ // slime
      '........',
      '..gggg..',
      '.gggggg.',
      'gwkggwkg',
      'gggggggg',
      'gggggggg' ]
  ];

  function toSVG(rows) {
    const h = rows.length, w = rows[0].length;
    let rects = '';
    rows.forEach((row, y) => [...row].forEach((ch, x) => {
      if (P[ch]) rects += `<rect x="${x}" y="${y}" width="1" height="1" fill="${P[ch]}"/>`;
    }));
    return `<svg viewBox="0 0 ${w} ${h}" xmlns="http://www.w3.org/2000/svg">${rects}</svg>`;
  }

  const rand = (a, b) => Math.random() * (b - a) + a;

  function spawn() {
    if (layer.children.length >= 6) return;           // batasi jumlah
    const el = document.createElement('div');
    el.className = 'egg';
    const size = Math.round(rand(2, 4)) * 12;          // 24 / 36 / 48 px
    el.style.width = size + 'px';
    el.style.height = size + 'px';
    el.style.left = rand(2, 95) + 'vw';
    el.style.top = rand(8, 90) + 'vh';
    el.style.setProperty('--dx', rand(-120, 120) + 'px');
    el.style.setProperty('--dy', rand(-120, 60) + 'px');
    el.style.setProperty('--rot', rand(-12, 12) + 'deg');
    el.style.setProperty('--dur', rand(8, 14) + 's');
    el.innerHTML = toSVG(SPRITES[Math.floor(Math.random() * SPRITES.length)]);
    el.addEventListener('animationend', () => el.remove());
    layer.appendChild(el);
  }

  // muncul tiap 2-4 detik
  (function loop() { spawn(); setTimeout(loop, rand(2000, 4000)); })();

  // parallax saat scroll: background ikut bergerak
  let ticking = false;
  addEventListener('scroll', () => {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => {
      layer.style.transform = `translateY(${-scrollY * 0.25}px)`;
      ticking = false;
    });
  }, { passive: true });
})();
</script>

<style>
  /* ===== Ikon vinyl pixel ===== */
  .vinyl-btn svg { width: 100%; height: 100%; display: block; shape-rendering: crispEdges; image-rendering: pixelated; }
  .vinyl-btn .vinyl-spin { width: 100%; height: 100%; }
  .vinyl-btn.playing .vinyl-spin { animation: vinylSpin 1.6s steps(8) infinite; }
  @keyframes vinylSpin { to { transform: rotate(360deg); } }

  /* ===== Lirik di dalam popup ===== */
  .lyrics-box {
    position: relative;
    margin-top: 16px;
    padding: 12px;
    max-height: 150px;
    overflow-y: auto;
    background: rgba(5, 12, 45, .8);
    border: 2px solid #1e4fd8;
    font-size: 12px;
    line-height: 1.8;
    letter-spacing: .08em;
    text-transform: uppercase;
    scroll-behavior: smooth;
  }
  .lyrics-box::-webkit-scrollbar { width: 6px; }
  .lyrics-box::-webkit-scrollbar-thumb { background: #ffa41b; }
  .lyric-line { color: rgba(255,255,255,.35); transition: color .25s, transform .25s; }
  .lyric-line.active { color: #22d3ee; transform: translateX(4px); }
  .lyric-line.active::before { content: "▶ "; color: #ffa41b; }
</style>

<script>
(function () {
  const btn   = document.getElementById('bgm-toggle');
  const popup = document.getElementById('bgm-pop');
  const audio = document.getElementById('bgm');
  if (!btn || !audio) return;

  /* ---------- 1. Ikon vinyl pixel ---------- */
  const N = 14, C = (N - 1) / 2;
  let rects = '';
  for (let y = 0; y < N; y++) {
    for (let x = 0; x < N; x++) {
      const d = Math.hypot(x - C, y - C);
      if (d > 7) continue;
      let fill = '#0a0a14';
      if ((d > 4.3 && d < 5) || (d > 5.7 && d < 6.3)) fill = '#2b2f4a';
      if (d <= 3) fill = '#ffa41b';
      if (d <= 1.2) fill = '#0a1a4a';
      if (x < C && y < C && d > 5 && d < 6.6 && (x + y) % 3 === 0) fill = '#6b7bb8';
      rects += `<rect x="${x}" y="${y}" width="1" height="1" fill="${fill}"/>`;
    }
  }
  btn.classList.add('vinyl-btn');
  btn.innerHTML = `<div class="vinyl-spin"><svg viewBox="0 0 ${N} ${N}" xmlns="http://www.w3.org/2000/svg">${rects}</svg></div>`;

  const syncSpin = () => btn.classList.toggle('playing', !audio.paused);
  ['play', 'pause', 'playing', 'ended'].forEach(e => audio.addEventListener(e, syncSpin));
  syncSpin();

  /* ---------- 2. Lirik otomatis dari LRCLIB ---------- */
  if (!popup) return;
  const box = document.createElement('div');
  box.className = 'lyrics-box';
  box.style.display = 'none';
  popup.appendChild(box);

  const titleEl = document.getElementById('bgm-title');
  const cache = {};
  let lines = [], current = -1, shownTitle = null;

  function parseLRC(lrc) {
    const out = [];
    lrc.split('\n').forEach(row => {
      const m = row.match(/^\[(\d+):(\d+(?:\.\d+)?)\]\s*(.*)$/);
      if (m && m[3].trim()) out.push({ t: +m[1] * 60 + parseFloat(m[2]), text: m[3].trim() });
    });
    return out;
  }

  async function getLyrics(title) {
    if (title in cache) return cache[title];
    try {
      const res = await fetch('https://lrclib.net/api/search?q=' + encodeURIComponent(title));
      const data = await res.json();
      const hit = data.find(d => d.syncedLyrics);
      cache[title] = hit ? parseLRC(hit.syncedLyrics) : [];
    } catch (e) {
      cache[title] = [];
    }
    return cache[title];
  }

  async function renderLyrics() {
    const title = titleEl.textContent.trim();
    if (!title || title === '-' || title === shownTitle) return;
    shownTitle = title;
    current = -1;
    lines = [];
    box.innerHTML = '';
    box.style.display = 'none';

    const result = await getLyrics(title);
    if (title !== shownTitle) return;
    lines = result;
    if (!lines.length) return;

    box.style.display = '';
    lines.forEach(l => {
      const p = document.createElement('div');
      p.className = 'lyric-line';
      p.textContent = l.text;
      box.appendChild(p);
    });
  }

  audio.addEventListener('timeupdate', () => {
    renderLyrics();
    if (!lines.length) return;
    let idx = -1;
    for (let i = 0; i < lines.length; i++) if (audio.currentTime >= lines[i].t) idx = i;
    if (idx === current) return;
    current = idx;
    [...box.children].forEach((el, i) => el.classList.toggle('active', i === idx));
    if (idx >= 0) {
    const el = box.children[idx];
    const boxRect = box.getBoundingClientRect();
    const elRect  = el.getBoundingClientRect();
    const offset  = elRect.top - boxRect.top + box.scrollTop;
    box.scrollTop = offset - box.clientHeight / 2 + el.clientHeight / 2;
    }
  });
  renderLyrics();
})();
</script>

</body>
</html>