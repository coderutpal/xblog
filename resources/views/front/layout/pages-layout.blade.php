<!doctype html>
<html lang="en" class="no-js">

<head>
    <title>@yield('pageTitle')</title>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/images/site/{{ isset(settings()->site_favicon) ? settings()->site_favicon : '' }}"
        type="image/x-icon">
    <link rel="shortcut icon" href="/images/site/{{ isset(settings()->site_favicon) ? settings()->site_favicon : '' }}"
        type="image/x-icon">

    <link rel="stylesheet" href="/front/css/modernmag-assets.min.css">
    <link rel="stylesheet" type="text/css" href="/front/css/style.css">
    @stack('stylesheets')
</head>

<body>
    <!-- Container -->
    <div id="container">
        <!-- Header
  ================================================== -->
        <header class="clearfix style-2">

            <div class="top-line">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-9">
                            <ul class="info-list">
                                <li>
                                    <span class="live-time"><i class="fa fa-calendar-o"></i>10 Jannuary 2017</span>
                                </li>
                                <li>
                                    <a href="about.html">About Us</a>
                                </li>
                                <li>
                                    <a href="contact.html">Contact Us</a>
                                </li>
                                <li>
                                    <a href="forums.html">Forum</a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#loginModal">Login</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-3">
                            <ul class="social-icons">
                                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="google" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#!">About</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link travel" href="#">Travel <i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                            </li>

                            {!! navigations() !!}

                            <li class="nav-item">
                                <a class="nav-link" href="#!">Contact</a>
                            </li>

                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search for..."
                                aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit"><i
                                    class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </nav>

            <div class="header-banner-place">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="/images/site/{{ isset(settings()->site_logo) ? settings()->site_logo : '' }}"
                            alt="{{ isset(settings()->site_title) ? settings()->site_title : '' }}">
                        <p>Laravel 11 Blog Newspaper & Magazine</p>
                    </a>
                </div>
            </div>

        </header>
        <!-- End Header -->

        <!-- content-section
   ================================================== -->
        <section id="content-section">
            <div class="container">
                @yield('content')
            </div>
        </section>
        <!-- End content section -->

        <!-- footer
   ================================================== -->
        <footer>
            <div class="container">

                <div class="up-footer">
                    <div class="row">

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget text-widget">
                                <h1><a href="/"><img
                                            src="/images/site/{{ isset(settings()->site_footer_logo) ? settings()->site_footer_logo : '' }}"
                                            alt="{{ isset(settings()->site_title) ? settings()->site_title : '' }}"></a>
                                </h1>
                                <p>{{ isset(settings()->site_meta_description) ? settings()->site_meta_description : '' }}
                                </p>
                                <ul class="social-icons">
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="google" href="#"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                    <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget popular-widget">
                                <h1>Popular News</h1>
                                <ul class="small-posts">
                                    <li>
                                        <a href="single-post.html">
                                            <img src="/front/upload/blog/th3.jpg" alt="">
                                        </a>
                                        <div class="post-cont">
                                            <h2><a href="single-post.html">New alternatives are more productive</a>
                                            </h2>
                                            <ul class="post-tags">
                                                <li><i class="lnr lnr-user"></i>by <a href="#">Author</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="single-post.html">
                                            <img src="/front/upload/blog/th4.jpg" alt="">
                                        </a>
                                        <div class="post-cont">
                                            <h2><a href="single-post.html">Vue js new javascript Framework</a></h2>
                                            <ul class="post-tags">
                                                <li><i class="lnr lnr-user"></i>by <a href="#">Besim Dauti</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="single-post.html">
                                            <img src="/front/upload/blog/th5.jpg" alt="">
                                        </a>
                                        <div class="post-cont">
                                            <h2><a href="single-post.html">Eating traditional food is more healthy</a>
                                            </h2>
                                            <ul class="post-tags">
                                                <li><i class="lnr lnr-user"></i>by <a href="#">Admin Mag</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="single-post.html">
                                            <img src="/front/upload/blog/th6.jpg" alt="">
                                        </a>
                                        <div class="post-cont">
                                            <h2><a href="single-post.html">Visiting antic countries is John Doe
                                                    hobby.</a></h2>
                                            <ul class="post-tags">
                                                <li><i class="lnr lnr-user"></i>by <a href="#">Helena Doe</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget featured-widget">
                                <h1>Featured Posts</h1>
                                <div class="news-post standart-post">
                                    <div class="post-image">
                                        <a href="single-post">
                                            <img src="/front/upload/blog/s28.jpg" alt="">
                                        </a>
                                        <a href="#" class="category category-travel">Travel</a>
                                    </div>
                                    <h2><a href="single-post.html">Visiting antic countries is John Doe hobby.</a>
                                    </h2>
                                    <ul class="post-tags">
                                        <li><i class="lnr lnr-user"></i>by <a href="#">John Doe</a></li>
                                        <li><a href="#"><i class="lnr lnr-book"></i><span>23
                                                    comments</span></a></li>
                                    </ul>
                                </div>

                                <ul class="list-news">
                                    <li>
                                        <h2><a href="single-post.html">Technology Remote Jobs</a></h2>
                                    </li>
                                    <li>
                                        <h2><a href="single-post.html">New alternatives are productive</a></h2>
                                    </li>
                                    <li>
                                        <h2><a href="single-post.html">United States celebrate</a></h2>
                                    </li>
                                    <li>
                                        <h2><a href="single-post.html">Fruits and Vegetables</a></h2>
                                    </li>
                                </ul>

                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget tags-widget">
                                <h1>Tags</h1>
                                <ul class="tags-list">
                                    <li><a href="#">Food</a></li>
                                    <li><a href="#">Sport</a></li>
                                    <li><a href="#">Lifestyle</a></li>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">World</a></li>
                                    <li><a href="#">Politic</a></li>
                                    <li><a href="#">Travel</a></li>
                                    <li><a href="#">Tech</a></li>
                                    <li><a href="#">Music</a></li>
                                    <li><a href="#">Economy</a></li>
                                    <li><a href="#">Business</a></li>
                                    <li><a href="#">Photos</a></li>
                                    <li><a href="#">Company</a></li>
                                    <li><a href="#">Traditional</a></li>
                                    <li><a href="#">New</a></li>
                                    <li><a href="#">Future</a></li>
                                    <li><a href="#">Culture</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="down-footer">
                    <ul class="list-footer">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="privacy-policy.html">Privacy policy</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                    <p>&copy; Copyright By Nunforest 2017<a href="#" class="go-top"><i class="fa fa-caret-up"
                                aria-hidden="true"></i></a></p>
                </div>

            </div>
        </footer>
        <!-- End footer -->

    </div>
    <!-- End Container -->

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="title-section">
                        <h1>Login</h1>
                    </div>
                    <form id="login-form">
                        <p>Welcome! Login to your account.</p>
                        <label for="username">Username or Email Address*</label>
                        <input id="username" name="username" type="text">
                        <label for="password">Password*</label>
                        <input id="password" name="password" type="password">
                        <button type="submit" id="submit-register">
                            <i class="fa fa-paper-plane"></i> Login
                        </button>
                    </form>
                    <p>Don't have account? <a href="register.html">Register Here</a></p>

                </div>
            </div>
        </div>
    </div>
    <!-- End Login Modal -->

    <script src="/front/js/modernmag-plugins.min.js"></script>
    <script src="/front/js/popper.js"></script>
    <script src="/front/js/bootstrap.min.js"></script>
    <script
        src="http://maps.google.com/maps/api/js?key=AIzaSyCiqrIen8rWQrvJsu-7f4rOta0fmI5r2SI&amp;sensor=false&amp;language=en">
    </script>
    <script src="/front/js/gmap3.min.js"></script>
    <script src="/front/js/script.js"></script>
    @stack('scripts')
</body>

</html>
