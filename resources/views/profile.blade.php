
@extends('layouts.app')

@section('title', 'Data Diri - My Portfolio')

@section('content')

@php
    $experiences = [
        [
            'category' => 'PROFESSIONAL EXPERIENCE',
            'name' => 'Dimensi Muda Kreatif',
            'position' => 'Content Creator',
            'type' => 'Internship',
            'duration' => '4 Months',
            'period' => 'Juli - November 2023',
            'description' => 'Pengalaman magang selama empat bulan sebagai Content Creator.'
        ],
        [
            'category' => 'ORGANIZATIONAL EXPERIENCE',
            'name' => 'HIMPUNAN MAHASISWA INFORMATIKA',
            'position' => 'Divisi HUMAS',
            'type' => 'Organization',
            'duration' => '2025 -2026, 2026 - 2027',
            'period' => 'Semester 1 - Sekarang',
            'description' => 'Bergabung dengan organisasi Himpunan Mahasiswa Informatika.'
        ],
        [
            'category' => 'EVENT COMMITTEE',
            'name' => 'Seminar Nasional Hima IF',
            'position' => 'Sie Publikasi dan Dokumentasi',
            'type' => 'Committee',
            'period' => 'Semester 1',
            'description' => 'Bertugas dalam publikasi dan dokumentasi kegiatan seminar.'
        ],
        [
            'category' => 'EVENT COMMITTEE',
            'name' => 'PARAS ICT XI',
            'position' => 'Sie Publikasi dan Dokumentasi',
            'type' => 'Committee',
            'period' => 'Semester 1',
            'description' => 'Menjadi bagian dari panitia PARAS ICT XI.'
        ],
        [
            'category' => 'EVENT COMMITTEE',
            'name' => 'Buka Bersama HIMA IF',
            'position' => 'Sie Publikasi dan Dokumentasi',
            'type' => 'Committee',
            'period' => 'Semester 1',
            'description' => 'Terlibat dalam publikasi dan dokumentasi kegiatan buka bersama HIMA IF.'
        ],
        [
            'category' => 'EVENT COMMITTEE',
            'name' => 'INSIGHT Event',
            'position' => 'Sie Acara',
            'type' => 'Committee',
            'period' => 'Semester 1',
            'description' => 'Berpartisipasi dalam divisi acara INSIGHT.'
        ],
        [
            'category' => 'EVENT COMMITTEE',
            'name' => 'Concert - Diesteria INSTIKI',
            'position' => 'Sie Publikasi dan Dokumentasi',
            'type' => 'Committee',
            'period' => 'Semester 2',
            'description' => 'Menjadi bagian dari tim publikasi dan dokumentasi konser.'
        ],
    ];
@endphp

{{-- ABOUT ME --}}

<h1 class="page-title">About Me</h1>

<p class="page-description">
    Get to know me better through the following information.
</p>

<div class="profile-wrapper">

    <div class="profile-card">

        @foreach ($dataDiri as $key => $value)
            <div class="profile-row">
                <span class="profile-label">
                    {{ ucfirst($key) }}
                </span>

                <span class="profile-value">
                    {{ $value }}
                </span>
            </div>
        @endforeach

    </div>

    {{-- FOTO PROFIL (SLIDESHOW) --}}
    @php
        $profilePhotos = [
            'images/foto-saya.jpg',
            'images/foto-saya-2.jpg',
            'images/foto-saya-3.jpg',
            'images/foto-saya-4.jpg',
        ];
    @endphp

    <div class="profile-photo">
        @foreach ($profilePhotos as $i => $photo)
            <img src="{{ asset($photo) }}"
                 alt="Putu Justine Eza Satria Darma"
                 style="--i: {{ $i }}">
        @endforeach
    </div>

</div>

{{-- EDUCATION --}}

@php
    $educations = [
        [
            'level'   => 'KAMPUS',
            'nama'    => 'Institut Bisnis dan Teknologi Indonesia (INSTIKI)',
            'jurusan' => 'Informatika (IF)',
            'periode' => '2025 - Sekarang',
            'status'  => 'Sedang menempuh',
            'foto'    => 'images/pendidikan/kampus.jpg',
        ],
        [
            'level'   => 'SMK',
            'nama'    => 'SMK TI BALI GLOBAL DENPASAR',
            'jurusan' => 'Desain Komunikasi Visual (DKV)',
            'periode' => '2022 - 2025',
            'status'  => 'Lulus',
            'foto'    => 'images/pendidikan/smk.jpg',
        ],
    ];
@endphp

<section class="education-section">

    <div class="education-heading">
        <h2>Education</h2>
        <div class="education-line"></div>
        <p>Riwayat pendidikan saya.</p>
    </div>

    <div class="education-grid">

        @foreach ($educations as $edu)
            <div class="education-card">

                <div class="education-photo">
                    <img src="{{ asset($edu['foto']) }}" alt="{{ $edu['nama'] }}">
                    <span class="education-level">{{ $edu['level'] }}</span>
                </div>

                <div class="education-body">
                    <h3>{{ $edu['nama'] }}</h3>
                    <p class="education-major">{{ $edu['jurusan'] }}</p>

                    <div class="education-meta">
                        <span class="education-period">{{ $edu['periode'] }}</span>
                        <span class="education-badge">{{ $edu['status'] }}</span>
                    </div>
                </div>

            </div>
        @endforeach

    </div>

</section>

{{-- MY JOURNEY --}}

<section class="journey-section">

    <div class="journey-heading">

        <h2>MY JOURNEY</h2>

        <div class="journey-line"></div>

        <p>
            My experiences and organizational journey
            from vocational school to university.
        </p>

    </div>


    <div class="journey-container">

        @foreach ($experiences as $experience)

            <div class="journey-item">

                <div class="journey-dot"></div>

                <div class="journey-card">

                    <span class="journey-category">
                        {{ $experience['category'] }}
                    </span>

                    <h3>
                        {{ $experience['name'] }}
                    </h3>

                    <div class="journey-info">

                        <span>
                            {{ $experience['position'] }}
                        </span>

                        <span class="journey-badge">
                            {{ $experience['type'] }}
                        </span>

                        @if ($experience['duration'] ?? null)
                            <span class="journey-badge">
                                {{ $experience['duration'] }}
                            </span>
                        @endif

                    </div>

                    <p>
                        {{ $experience['description'] }}
                    </p>

                    <div class="journey-period">
                        {{ $experience['period'] }}
                    </div>

                </div>

            </div>

        @endforeach

    </div>

</section>

@include('partials.about-extras')

@endsection
