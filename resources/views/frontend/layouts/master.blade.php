<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>PDFlon - Home</title>
    <link rel="apple-touch-icon" href="{{ asset('admin/assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/assets/images/ico/favicon.ico') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/vendors/swiper/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/vendors/entox-icons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/entox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/entox-responsive.css') }}">

    @livewireStyles

    @yield('style')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">

<!-- BEGIN: Header-->
<!-- END: Header-->


<!-- BEGIN: Content-->
<div class="page-wrapper">
        @yield('content')
</div>
<!-- END: Content-->


<!-- BEGIN: Footer-->


<!-- END: Footer-->


<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('frontend/assets/vendors/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/entox.js') }}"></script>


<script>
    $(window).on('load', function () {

    })

</script>


@livewireScripts

@yield('script')

</body>
</html>
