@extends('layouts.main')

@section('content')
  <div class="rts-contact-main-wrapper-banner bg_image">
        <div class="container">
            <div class="row">
                <div class="co-lg-12">
                    <div class="contact-banner-content">
                        <h1 class="title">
                            Ask Us Question
                        </h1>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
       <div class="rts-contact-form-area rts-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg_light-1 contact-form-wrapper-bg">
                        <div class="row">
                            <div class="col-lg-7 pr--30 pr_md--10 pr_sm--5">
                                <div class="contact-form-wrapper-1">
                                    <h3 class="title mb--50">Fill Up The Form If You Have Any Question</h3>
                                    <form action="{{ route('contact.submit') }}" class="contact-form-1">
                                        <div class="contact-form-wrapper--half-area">
                                            <div class="single">
                                                <input type="text" placeholder="name*">
                                            </div>
                                            <div class="single">
                                                <input type="text" placeholder="Email*">
                                            </div>
                                        </div>
                                        <div class="single-select">
                                            <select>
                                                <option data-display="Subject*">All Categories</option>
                                                @foreach($categories as $category)
                                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <textarea name="message" placeholder="Write Message Here"></textarea>
                                        <button class="rts-btn btn-primary mt--20">Send Message</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-5 mt_md--30 mt_sm--30">
                                <div class="thumbnail-area">
                                    <img src="{{ asset('assets/images/contact/contactpage.jpg') }}" alt="contact_form">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('policy')
@endsection