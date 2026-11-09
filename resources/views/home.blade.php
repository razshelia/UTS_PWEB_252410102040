@extends('layouts.app')

@section('title', 'Dashboard Loreberry: Fakta Ilmiah Manis di Setiap Loker')
@section('description', 'Buka loker pink Loreberry dan temukan fakta ilmiah unik tentang buah, serangga, dan tumbuhan, lengkap dengan pesan manis dari Orby si guinea pig.')
@section('robots', 'noindex, nofollow')

@section('content')
<main id="konten" tabindex="-1">
    @include('sections.dashboard')
    @include('sections.pengelolaan')
    @include('sections.profile')
</main>

<x-orby-kecil />
<x-kejutan :kejutan="$kejutan" />
@endsection