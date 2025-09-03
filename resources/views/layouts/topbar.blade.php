  <!-- header style two start -->
    <header class="header-style-two header-four bg-primary-header header-primary-sticky header--fft">
        <div class="header-top-area bg_primary">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bwtween-area-header-top header-top-style-four">
                            <div class="hader-top-menu"> 
                                <a href="mailto:sales@bazar-mart.in"><i class ="fa fa-envelope"></i> sales@bazar-mart.in</a>
                                <a href="tel:+918148015576"><i class ="fa fa-phone"></i> +91 81480 15576</a>
                                <a href="#">Order Tracking</a>
                            </div>
                            <p>Welcome to Bazart Mart!</p>
                            <div class="follow-us-social">
                                <span>Follow Us:</span>
                                <div class="social">
                                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                                    <a href="#"><i class="fa-regular fa-basketball"></i></a>
                                    <a href="#"><i class="fa-brands fa-skype"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="search-header-area-main bg_white without-category">
            <div class="container">
                <div class="row">
                     <div class="col-lg-1">
                     </div>
                    <div class="col-lg-2">
                        
                        <div class="logo-search-category-wrapper">
                            <a href="{{ route('home') }}" class="logo-area">
                                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo-main" class="logo" style="height: 70px;">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9">
                          <div class="rts-header-nav-area-one  header-four header--sticky">
                        <div class="nav-and-btn-wrapper">
                            <div class="nav-area-bottom-left-header-four">
                                <div class="category-btn category-hover-header">
                                    
                                    <span>All Categories</span>
                                     <ul class="category-sub-menu" id="category-active-four">
                                        @foreach($categories as $category)
                                        <li>
                                            <a href="#">{{ $category->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                 <div class="nav-area">
                                    <nav>
                                         <ul class="parent-nav">
                                            <li class="parent"><a href="{{ route('home') }}">Home</a></li>
                                            <li class="parent"><a href="{{ route('shopnow') }}">Shop Now</a></li>
                                            <li class="parent"><a href="#">About</a></li>
                                            <li class="parent"><a href="{{ route('contact') }}">Contact</a></li>
                                         </ul>
                                    </nav>
                                </div>
                                <div class="right-btn-area">
                                <button class="rts-btn btn-primary" style="background-color: #cd9043;">
                                    Get 30% Discount Now
                                    <span>Sale</span>
                                </button>
                            </div>
                        </div>
                    </div>
                          </div>
                </div>
            </div>
        </div>

    </header>