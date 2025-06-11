@extends('layouts.main')

@section('title')

@section('content')
    <div id="carouselExampleSlidesOnly" class="carousel slide h-75 d-inline-block" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active " data-bs-interval="4000">
                <img src="{{ asset('images/oldV2024.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
                <img src="{{ asset('images/someJungle.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
                <img src="{{ asset('images/vilkas.jpg') }}" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>
@endsection
