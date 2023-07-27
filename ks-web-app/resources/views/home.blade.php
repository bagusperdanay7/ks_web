@extends('layouts.main')

@section('container')
    <div class="row hero-landing-page">
        <div class="col align-self-center">
            <h1 class="hero-welcome">WELCOME TO KPOP SOULMATE WEB</h1>
            <h2 class="hero-h2">KPOP LINE DISTRIBUTION & MORE</h2>
            <p class="hero-welcome-text">Hello, Welcome to Our Website it’s Good to see you here. Explore the video & Enjoy
                Your Journey on Our Website
            </p>
            <a href="/gallery" class="btn btn-main btn-lg">EXPLORE</a>
        </div>
        <div class="col">
            <div id="carouselHeroAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/hero_img1.jpg" class="hero-pict rounded d-block w-100" alt="hero image">
                    </div>
                    <div class="carousel-item">
                        <img src="img/hero_img2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/hero_img3.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselHeroAutoplaying"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselHeroAutoplaying"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            {{-- <img src="img/hero_img1.jpg" class="hero-pict rounded mx-auto d-block" alt="hero image" width="641px"> --}}
        </div>
    </div>
    <div class="row socmed-landing-page text-center">
        <div class="col">
            <a href="https://www.youtube.com/@KpopSoulmate" target="_blank">
                <box-icon type='logo' name='youtube' size='48px' color='#FF0000'></box-icon>
                <p class="socmed-home-text">SUBSCRIBE</p>
            </a>
        </div>
        <div class="col">
            <a href="">
                <box-icon type='logo' name='paypal' size='48px' color='#009CDE'></box-icon>
                <p class="socmed-home-text">SUPPORT</p>
            </a>
        </div>
        <div class="col">
            <a href="">
                <box-icon type='logo' name='discord' size='48px' color="#8A9CFE"></box-icon>
                <p class="socmed-home-text">JOIN US</p>
            </a>
        </div>

    </div>
@endsection
