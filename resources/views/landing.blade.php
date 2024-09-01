<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('template/assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('template/assets/images/favicon.png')}}" type="image/x-icon">
    <title>Cuba - Premium Admin Template</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template//assets/css/vendors/icofont.css')}}">
    <link rel="icon" href="{{asset('template/assets/svg/landing-icons.svg')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/animate.css')}}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/style.css')}}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/responsive.css')}}">
  </head>
  <body class="landing-page">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="landing-page">
        <!-- Page Body Start            -->
        <div class="landing-home">
          <div class="container-fluid">
            <div class="sticky-header">
              <header>
                <nav class="navbar navbar-b navbar-dark navbar-trans navbar-expand-xl fixed-top nav-padding" id="sidebar-menu">
                    <div class="container-fluid"> <!-- Container added for the breadcrumb -->
                        <a class="navbar-brand p-0" href="#"><img class="img-fluid" src="../assets/images/landing/landing_logo.png" alt=""></a>
                        <button class="navbar-toggler navabr_btn-set custom_nav" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation"><span></span><span></span><span></span></button>
                        <div class="navbar-collapse justify-content-center collapse hidenav" id="navbarDefault">
                            <ul class="navbar-nav navbar_nav_modify" id="scroll-spy">
                                <li class="nav-item"><a class="nav-link" href="#layout">Layouts</a></li>
                                <li class="nav-item"><a class="nav-link" href="#frameworks">Frameworks</a></li>
                                <li class="nav-item"><a class="nav-link" href="#components">Components</a></li>
                                <li class="nav-item"><a class="nav-link" href="#applications">Applications</a></li>
                                <li class="nav-item"><a class="nav-link" href="#documentation">Documentation</a></li>
                                <li class="nav-item"><a class="nav-link" href="#landings">Landings</a></li>
                                <li class="nav-item"><a class="nav-link" href="#faq">Faq</a></li>
                            </ul>
                        </div>
                        {{-- <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Language
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                                <li><a class="dropdown-item" href="#">English</a></li>
                                <li><a class="dropdown-item" href="#">Spanish</a></li>
                                <li><a class="dropdown-item" href="#">French</a></li>
                                <!-- Add more language options as needed -->
                            </ul>
                        </div> --}}
                        <!-- Login/Register buttons -->

                        <div class="d-flex align-items-center">
                            @if (Route::has('login'))
                            <div class="buy-btn rounded-pill me-3">
                                @auth
                                    <a class="nav-link js-scroll" href="{{ url('/dashboard') }}">Dashboard</a>
                                @else
                                    <a class="nav-link js-scroll" href="{{ route('login') }}">Login</a>
                                @endauth
                            </div>
                        @endif

                        @if (Route::has('register') && !auth()->check())
                        <span>/</span>
                            <div class="buy-btn rounded-pill">

                                <a class="nav-link js-scroll" href="{{ route('register') }}">Register</a>
                            </div>
                        @endif
                        </div>





                        {{-- <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                            @if (Route::has('login'))
                                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-800 hover:text-gray-900 dark:text-gray-600 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif

                    </div> --}}



              </header>
            </div>
            <div class="row justify-content-center">
              <div class="col-lg-8 col-sm-10">
                <div class="content text-center">
                  <div>
                    <h6 class="content-title"><img class="arrow-decore" src="{{asset('template/assets/images/landing/decore/arrow.svg')}}" alt=""><span class="sub-title">Introducing </span></h6>
                    <h1 class="wow fadeIn">Scalable Admin template with <span>trending </span> designs</h1>
                    <p class="mt-3 wow fadeIn">Welcome to Cuba - the leading landing page templates, built with React, Angular, flask & Vue. No jQuery!</p>
                    <div class="btn-grp mt-4"><a class="wow pulse" href="index.html" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="HTML"> <img src="{{asset('template/assets/images/landing/icon/html/html.png')}}" alt=""></a><a class="wow pulse" href="https://angular.pixelstrap.com/cuba/" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="Angular 16"> <img src="{{asset('template')}}/assets/images/landing/icon/angular/angular.png" alt=""></a><a class="wow pulse" href="https://vue.pixelstrap.com/cuba/dashboard/default" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="Vue 3"> <img src="{{asset('template')}}/assets/images/landing/icon/vue/vue.png" alt=""></a><a class="wow pulse" href="https://laravel.pixelstrap.com/cuba/dashboard/index" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="Laravel 10"> <img src="{{asset('template')}}/assets/images/landing/icon/laravel/laravel.png" alt=""></a><a class="wow pulse" href="https://cubadjango.pixelstrap.com/" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="Django 4.0.4"> <img src="{{asset('template')}}/assets/images/landing/icon/django/django.png" alt=""></a><a class="wow pulse" href="http://cubaflask.pixelstrap.com/" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="Flask 2.2.2"> <img src="{{asset('template')}}/assets/images/landing/stroke-icon/7.svg" alt=""></a><a class="wow pulse" href="https://react.pixelstrap.com/cuba-context/" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="React Context"><img src="{{asset('template')}}/assets/images/landing/icon/react/react.png" alt=""></a><a class="wow pulse" href="https://php.pixelstrap.com/cuba/dubai.php" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="PHP"> <img src="{{asset('template')}}/assets/images/landing/stroke-icon/8.svg" alt=""></a><a class="wow pulse" href="https://codeigniter.pixelstrap.com/cuba/public/" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="Codeigniter"> <img src="{{asset('template')}}/assets/images/landing/icon/codeigniter/codeigniter-icon.png" alt=""></a><a class="wow pulse" href="https://cuba-nodejs-pixelstrap.herokuapp.com/" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="Node"> <img src="{{asset('template')}}/assets/images/landing/stroke-icon/10.svg" alt=""></a><a class="wow pulse" href="javascript:void(0)" data-bs-placement="top" data-bs-toggle="tooltip" title="Coming soon"> <img src="{{asset('template')}}/assets/images/landing/stroke-icon/12.svg" alt=""></a><a class="wow pulse" href="https://cuba-nuxt.vercel.app/" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="Nuxt"> <img src="{{asset('template')}}/assets/images/landing/stroke-icon/14.svg" alt=""></a><a class="wow pulse" href="http://cubanet.pixelstrap.com/Dashboard/Index?id=dubai" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title=".Net Core 7"> <img src="{{asset('template')}}/assets/images/landing/stroke-icon/13.svg" alt=""></a><a class="wow pulse" href="https://cuba-nextjs.vercel.app/dashboard/default?layout=dubai" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="Next js"> <img src="{{asset('template')}}/assets/images/landing/stroke-icon/15.svg" alt=""></a><a class="wow pulse" href="https://cuba-svelte.vercel.app/dashboard/default?layout=Dubai" target="_blank" data-bs-placement="top" data-bs-toggle="tooltip" title="Svelte"> <img src="{{asset('template/assets/images/landing/stroke-icon/16.png')}}" alt=""></a></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-7 col-lg-8 col-md-10">               <img class="screen1 img-fluid" src="{{asset('template/assets/images/landing/screen1.png')}}" alt=""></div>
            </div>
          </div>
        </div>
        <section class="section-space premium-wrap">
          <div class="container">
            <ul class="decoration">
              <li class="flower-gif">
                <div class="mesh-loader">
                  <div class="set-one">
                    <div class="circle"></div>
                    <div class="circle"></div>
                  </div>
                  <div class="set-two">
                    <div class="circle"></div>
                    <div class="circle"></div>
                  </div>
                </div>
              </li>
              <li class="wavy-gif">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 251 38">
                  <path fill="none" stroke-width="10" stroke-miterlimit="10" d="M0,9C17.93,9,17.93,29,35.85,29S53.78,9,71.71,9s17.92,20,35.85,20S125.49,9,143.42,9s17.93,20,35.86,20S197.21,9,215.14,9,233.07,29,251,29"></path>
                </svg>
              </li>
            </ul>
            <div class="row justify-content-center">
              <div class="col-sm-12">
                <div class="landing-title">
                  <h5 class="sub-title">Faster, Lighter & Dev. Friendly</h5>
                  <h2> <span class="gradient-1">Benefits </span> of cuba</h2>
                  <p>Cuba admin template is a premium and clean admin template. it is a complete platform for base apps or dashboards, with many pre-built screens included. </p>
                </div>
                <div class="vector-image"> <img src="{{asset('template/assets/images/landing/vectors/1.svg')}}" alt=""></div>
              </div>
              <div class="col-xxl-8">
                <div class="row g-lg-5 g-3">
                  <div class="col-md-3 col-6">
                    <div class="benefit-box pink">
                      <svg>
                        <use href="{{asset('template/assets/svg/landing-icons.svg#tag')}}"></use>
                      </svg>
                      <h2 class="mb-0">4,620</h2>
                      <h6 class="mb-0">Sales</h6>
                    </div>
                  </div>
                  <div class="col-md-3 col-6">
                    <div class="benefit-box purple">
                      <svg>
                        <use href="{{asset('template/assets/svg/landing-icons.svg#ratings')}}"></use>
                      </svg>
                      <h2 class="mb-0">4,088</h2>
                      <h6 class="mb-0">5 Stars Ratings</h6>
                    </div>
                  </div>
                  <div class="col-md-3 col-6">
                    <div class="benefit-box red">
                      <svg>
                        <use href="{{asset('template/assets/svg/landing-icons.svg#user_circle')}}"></use>
                      </svg>
                      <h2 class="mb-0">3K</h2>
                      <h6 class="mb-0">End Users</h6>
                    </div>
                  </div>
                  <div class="col-md-3 col-6">
                    <div class="benefit-box warning">
                      <svg>
                        <use href="{{asset('template/assets/svg/landing-icons.svg#gear')}}"></use>
                      </svg>
                      <h2 class="mb-0">6 Years</h2>
                      <h6 class="mb-0">Development</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <!-- latest jquery-->
    <script src="{{asset('template/assets/js/jquery-3.5.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('template/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('template/assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('template/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('template/assets/js/tooltip-init.js')}}"></script>
    <script src="{{asset('template/assets/js/animation/wow/wow.min.js')}}"></script>
    <script src="{{asset('template/assets/js/landing_sticky.js')}}"></script>
    <script src="{{asset('template/assets/js/landing.js')}}"></script>
    <script src="{{asset('template/assets/js/jarallax_libs/libs.min.js')}}"></script>
    <script src="{{asset('template/assets/js/slick/slick.min.js')}}"></script>
    <script src="{{asset('template/assets/js/slick/slick.js')}}"></script>
    <script src="{{asset('template/assets/js/landing-slick.js')}}"></script>
    <!-- Plugins JS Ends-->
  </body>
</html>
