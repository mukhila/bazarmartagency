@extends('layouts.main')

@section('content')
<div class="rts-navigation-area-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="navigator-breadcrumb-wrapper">
                    <a href="{{ route('home') }}">Home</a>
                    <i class="fa-regular fa-chevron-right"></i>
                    <a class="current" href="{{ route('products') }}">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section-seperator">
    <div class="container">
        <hr class="section-seperator">
    </div>
</div>
<div class="container-fluid py-4">
  <div id="app"></div>
</div>
@endsection
     @viteReactRefresh
  @vite(['resources/css/app.css', 'resources/js/app.jsx'])