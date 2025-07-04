<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ __('HB-SHOP') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/images/favicon.png') }}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/venobox.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/helper.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/components/loader.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/responsive.css') }}">

    <!-- Plugin CSS (e.g. File Upload) -->
    <link href="{{ asset('admin/assets/vendor/@pqina/pintura/pintura.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/filepond/dist/filepond.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.min.css') }}" rel="stylesheet">

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/v1wvkm3nr87bqq8scwj77v5decfhzbqjrk1hko8t0rq75uty/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#haibui-text-editor'
        });
    </script>

    <!-- Modernizr -->
    <script src="{{ asset('frontend/assets/vendor/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    @stack('css')
</head>

<body>
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser.</p>
    <![endif]-->

    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">
        @yield('body')
    </div>
    <!-- Body Wrapper End -->

    <!-- Core JS -->
    <script src="{{ asset('frontend/assets/vendor/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/bootstrap.min.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('frontend/assets/vendor/js/ajax-mail.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/jquery.mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/venobox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/scrollUp.min.js') }}"></script>

    <!-- Custom Scripts -->
    <script src="{{ asset('admin/assets/js/shop/notify.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/main.js') }}"></script>
    <script src="{{ asset('admin/assets/js/layout/app.js') }}" type="module"></script>

    <!-- Inline Scripts (like Owl Carousel init) -->
    @stack('js')

</body>
</html>
