@extends('layouts.landing')

@section('title', 'FasTrack | Pelaporan Fasilitas Kampus')

@section('content')
    @include('partials.landing.hero')
    @include('partials.landing.about')
    @include('partials.landing.features')
    @include('partials.landing.flow')
    @include('partials.landing.faq')
    @include('partials.landing.cta')
@endsection
