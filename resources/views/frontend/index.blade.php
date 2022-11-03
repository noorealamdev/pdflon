@extends('frontend.layouts.master')
@section('content')

<header class="main-header-three clearfix">
    <nav class="main-menu main-menu-two main-menu-three clearfix">
        <div class="main-menu-three-wrapper clearfix">
            <div class="container clearfix">
                <div class="main-menu-three-wrapper__inner">
                    <div class="main-menu-three-wrapper__left">
                        <div class="main-menu-three-wrapper__logo">
                            <a href="{{ route('home') }}"><img src="{{asset('frontend/assets/images/logo-front.png')}}" alt=""></a>
                        </div>
                        <div class="main-menu-three-wrapper__main-menu">
                            <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                            <ul class="main-menu__list">
                                <li class="dropdown current">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Banner One Start -->
<section class="banner-two banner-three">
    <div class="banner-bg-slide"
         data-options='{ "delay": 5000, "slides": [ { "src": "assets/images/backgrounds/main-slider-3-1.jpg" }, { "src": "assets/images/backgrounds/main-slider-3-2.jpg" }, { "src": "assets/images/backgrounds/main-slider-3-3.jpg" } ], "transition": "fade", "timer": false, "align": "top" }'>
    </div><!-- /.banner-bg-slide -->
    <div class="banner-bg-slide-overly-3"></div>
    <div class="container">
        <div class="banner-three__content">
            <p class="banner-three__text">All the tools you’ll need to build and design and work smarter with documents.</p>
            <h2 class="banner-three__title">We make PDF design easy</h2>
        </div>
    </div>
</section>
<!--Banner One End-->


<!--Explore Machine Start-->
<section class="explore-machine">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="section-title__title">Templates</h2>
        </div>
        <div class="row">

            @foreach($templates as $template)
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                    <!--Explore Machine Single-->
                    <div class="explore-machine__single">
                        <div class="explore-machine__img">
                            <img src="{{ $template->image }}" alt="">
                        </div>
                        <div class="explore-machine__content">
                            <h3 class="explore-machine__title">
                                @if($template->name)
                                    {{ $template->name }}
                                @else
                                    No Name
                                @endif
                            </h3>
                            <ul class="list-unstyled explore-machine__details">
                                <li><a class="font-13" href="{{ route('template.edit', $template->id) }}">Use this template</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            @endforeach


        </div>
    </div>
</section>
<!--Explore Machine End-->

@endsection


@section('style')

    <style>
        .explore-machine {
            position: relative;
            display: block;
            padding-top: 90px;
        }
        .explore-machine__details {
            position: relative;
            display: inline-block;
            overflow: hidden;
            border-radius: 5px;
            margin-top: 23px;
            width: 100%;
        }
        .explore-machine__details li {
            position: relative;
            width: 100%;
        }
        .explore-machine__details li a {
            font-size: 15px;
            font-weight: 500;
            padding: 2px 10px;
            display: inline-block;
            transition: all 500ms ease;
            background: aquamarine;
            color: #656060;
            width: 100%;
            text-align: center;
        }
        .explore-machine__single {
            position: relative;
            display: block;
            margin-bottom: 30px;
            border: 2px solid #d7dce4;
            border-radius: 10px;
        }

    </style>

@endsection
