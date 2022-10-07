
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title')</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/logo.svg') }}" />

        <!-- ====================================== start css vito files ========================== -->
        <link href="{{asset('assets/plugins/vito/ar/css/bootstrap.min.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/ar/css/typography.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/ar/css/style.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/ar/css/responsive.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/ar/css/custom-lang.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <!-- ====================================== end css vito files ============================ -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <style>
            body{
                direction: rtl;
            }
        </style>
    </head>
    <body style="overflow-x: hidden;">
        <section class="sign-in-page">
            <div class="container bg-white mt-5 p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        @yield('content')
                    </div>
                    <div class="col-sm-6 text-center">
                        <div class="sign-in-detail text-white" style="padding: 20px 100px;">
                            <a class="sign-in-logo mb-3" href="#">
                                <img  src="{{ asset('assets/images/logo.svg') }}" style="height: 90px" class="img-fluid" alt="logo">
                            </a>
                            <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                <div class="item">
                                    <img src="{{asset('assets/plugins/vito/images/login/1.png')}}" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                                <div class="item">
                                    <img src="{{asset('assets/plugins/vito/images/login/1.png')}}" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                                <div class="item">
                                    <img src="{{asset('assets/plugins/vito/images/login/1.png')}}" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ===============================  start vito js files =============================== -->
        <script src="{{asset('assets/plugins/vito/ar/js/jquery-3.3.1.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/ar/js/bootstrap.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/ar/js/owl.carousel.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/ar/js/jquery.magnific-popup.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/ar/js/custom.js?v=8.0.3')}}"></script>
        @yield('scripts')
        <!-- ===============================  end vito js files ================================= -->
    </body>
</html>
