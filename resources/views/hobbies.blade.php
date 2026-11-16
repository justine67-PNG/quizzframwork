
@extends('layouts.app')

@section('title', 'My Hobbies')

@section('content')

<h1 class="page-title">My Hobbies</h1>
<p class="page-description">
    Beberapa kegiatan yang saya sukai di waktu luang.
</p>

<div class="hobby-container">

    @foreach ($hobbies as $hobby)

        
<div class="hobby-card">

    <div class="hobby-image-wrapper"
         style="--hobby-bg: url('{{ asset($hobby['foto']) }}')">

        <img src="{{ asset($hobby['foto']) }}"
             alt="{{ $hobby['nama'] }}">

    </div>

    <h3>{{ $hobby['nama'] }}</h3>

</div>


    @endforeach

</div>

@endsection
