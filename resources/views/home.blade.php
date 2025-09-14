@extends('layouts.main')

@section('content')
   <!-- rts categorya area start -->
    <div class="rts-category-area rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cover-card-main-over">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="title-area-between">
                                    <h2 class="title-left mb--0">
                                        Product Categories
                                    </h2>
                                    <div class="next-prev-swiper-wrapper">
                                        <div class="swiper-button-prev"><i class="fa-regular fa-chevron-left"></i></div>
                                        <div class="swiper-button-next"><i class="fa-regular fa-chevron-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- rts category area satart -->
                                <div class="rts-caregory-area-one ">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="category-area-main-wrapper-one">
                                                <div class="swiper mySwiper-category-1 swiper-data" data-swiper='{
                                                    "spaceBetween":15,
                                                    "slidesPerView":8,
                                                    "loop": true,
                                                    "speed": 1000,
                                                    "navigation":{
                                                        "nextEl":".swiper-button-next",
                                                        "prevEl":".swiper-button-prev"
                                                        },
                                                    "breakpoints":{
                                                        "0":{
                                                            "slidesPerView":1,
                                                            "spaceBetween": 15},
                                                        "340":{
                                                            "slidesPerView":2,
                                                            "spaceBetween":15},
                                                        "480":{
                                                            "slidesPerView":3,
                                                            "spaceBetween":15},
                                                        "640":{
                                                            "slidesPerView":4,
                                                            "spaceBetween":15},
                                                        "840":{
                                                            "slidesPerView":4,
                                                            "spaceBetween":15},
                                                        "1140":{
                                                            "slidesPerView":6,
                                                            "spaceBetween":15},
                                                        "1740":{
                                                            "slidesPerView":8,
                                                            "spaceBetween":15}
                                                        }
                                                }'>
                                                    <div class="swiper-wrapper">
                                                        <!-- single swiper start -->
                                                         @foreach($categories as $category)
                                                        <div class="swiper-slide">
                                                            <div class="single-category-one height-180">
                                                                <a href="shop-grid-sidebar.html">
                                                                <img src="{{ asset('assets/images/category/' . $category->image) }}" alt="category">
                                                                <p>{{ $category->name }}</p>
                                                               
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        <!-- single swiper start -->
                                                                                                          </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- rts category area end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- rts banenr area start -->
    <div class="rts-banner-area rts-section-gap banner-bg_4 bg_image  d-flex align-items-center">
        <!--<div class="transparent-person">
            <img src="assets/images/banner/transparent/01.png" alt="banenr">
        </div>-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- banner inner content area start -->
                    <div class="banner-area-start-4">
                        <span class="pre">Enjoy premium quality, vibrant colors, and safe fireworks delivered free across India</span>
                        <h1 class="title">Maximum Discount for all products</h1>
                        <p>Shop with confidence at Bazar Mart and make your festival memorable!</p>
                        <div class="rts-btn-banner-area">
                            <a href="{{ route('shopnow') }}" class="rts-btn btn-primary radious-sm with-icon">
                                <div class="btn-text">
                                    Shop Now
                                </div>
                                <div class="arrow-icon">
                                    <i class="fa-light fa-arrow-right"></i>
                                </div>
                                <div class="arrow-icon">
                                    <i class="fa-light fa-arrow-right"></i>
                                </div>
                            </a>                          
                        </div>
                    </div>
                    <!-- banner inner content area end -->
                </div>
            </div>
        </div>
    </div>
    <!-- rts banenr area ends -->


@include('policy')


@endsection