<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">

    <meta name="csrf-token" content="{{ csrf_token() }}" />



    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/tool-frontend/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/app-assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/assets/plugins/color-picker/light.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/assets/plugins/font-picker/jquery.fontselect.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/assets/plugins/toastr/toastr.min.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/assets/css/default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/tool-frontend/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <title>PDFlon - Edit</title>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="designTron horizontal-layout horizontal-menu navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">

<input type="hidden" id="jsonID" value="{{ $template->json }}">
<input type="hidden" id="templateID" value="{{ $template->id }}">

<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
    <div class="left-menu">
        <li class="justify-content-center d-flex">
            <a href="/">
                <div class="padding-15 mr-1">
                    <strong class="font-17">< Home</strong>
                </div>
            </a>
        </li>
        <li class="justify-content-center d-flex">
            <a href="{{route('tool.index')}}">
                <div class="padding-15 btn btn-outline-dark mr-1 waves-effect waves-float waves-light">
                    <strong>Create New</strong>
                </div>
            </a>
        </li>
    </div>
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a class="navbar-brand" href="../../../html/ltr/horizontal-menu-template-dark/index.html">
                    <span class="brand-logo">
                    </span>
                    <h2 class="brand-text mb-0">PDFlon</h2>
                </a></li>
        </ul>
    </div>
    <div class="navbar-container d-flex content">
        <ul class="nav navbar-nav align-items-center ml-auto">
            @if(Auth::user())
            @if($template->user_id == $user->id)
            <li class="dropdown dropdown-notification">
                <div class="btn btn-outline-success mr-1 waves-effect waves-float waves-light" data-toggle="dropdown">
                    <strong>Update</strong>
                    <i data-feather="check" class="download-btn-icon"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right" style="margin-right: 15px">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header">
                            <input type="text" class="form-control" id="updateFileName" value="{{ $template->name }}" placeholder="File Name">
                            <button id="updateBtn" type="button" style="width: 100%" class="mt-1 justify-content-center btn btn-primary waves-effect waves-float waves-light">Update</button>
                        </div>
                    </li>
                </ul>
            </li>
            @endif
            @endif
            <li class="dropdown dropdown-notification">
                <div class="btn btn-primary btn-lg waves-effect waves-float waves-light" data-toggle="dropdown">
                    <strong>Download</strong>
                    <i data-feather="download" class="download-btn-icon"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header">
                            <input type="text" class="form-control" id="fileName" placeholder="File Name">
                            <button id="downloadBtn" type="button" style="width: 100%" class="mt-1 justify-content-center btn btn-primary waves-effect waves-float waves-light">Download</button>
                        </div>
                    </li>
                </ul>
            </li>

            @if(Auth::user())
                <li class="nav-item dropdown dropdown-user ml-2">
                    <a class="nav-link dropdown-toggle dropdown-user-link"
                       id="dropdown-user" href="javascript:void(0);"
                       data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder">{{ Auth::user()->name }}</span>
                            <span class="user-status">Site User</span>
                        </div>
                        <span class="avatar">
                        @if(Auth::user()->profile_photo_path != null)
                                <img class="round" src="{{ asset('uploads/'.Auth::user()->profile_photo_path) }}"
                                     alt="avatar" height="40" width="40">
                            @else
                                <img class="round" src="{{ asset('admin/assets/user.png') }}" alt="avatar" height="40"
                                     width="40">
                            @endif
                        <span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="mr-50"
                                                                                    data-feather="file"></i>
                            My PDF</a>
                        <a class="dropdown-item" href="{{ route('profile.edit', Auth::user()->id) }}"><i class="mr-50"
                                                                                                         data-feather="user"></i>
                            Profile</a>
                        <a class="dropdown-item" href="{{ route('profile.change_password_edit') }}"><i class="mr-50"
                                                                                                       data-feather="unlock"></i>
                            Change Password</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item"><i class="mr-50" data-feather="power"></i> Logout</button>
                        </form>

                    </div>
                </li>
            @endif

        </ul>
    </div>
</nav>
<!-- END: Header-->


<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">

        <section id="basic-vertical-layouts">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="card asset-sidebar-wrapper" style="border-radius: 0">
                        <div class="card-header asset-wrapper">
                            <div class="asset-buttons-wrapper d-flex">

                                <ul class="nav">
                                    <li class="active">
                                        <a href="#templates" data-toggle="tab">
                                            <div class="asset-btn asset-btn-templates">
                                                <div class="btn-icon text-center">
                                                    <svg class="icon-templates" enable-background="new 0 0 512 512"
                                                         height="512"
                                                         viewBox="0 0 512 512" width="512"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <g>
                                                            <path
                                                                d="m467 0h-422c-24.813 0-45 20.187-45 45v422c0 24.813 20.187 45 45 45h422c24.813 0 45-20.187 45-45v-422c0-24.813-20.187-45-45-45zm-422 30h422c8.271 0 15 6.729 15 15v75h-452v-75c0-8.271 6.729-15 15-15zm422 452h-422c-8.271 0-15-6.729-15-15v-317h452v317c0 8.271-6.729 15-15 15z"/>
                                                            <circle cx="106" cy="75" r="15"/>
                                                            <circle cx="166" cy="75" r="15"/>
                                                            <circle cx="226" cy="75" r="15"/>
                                                            <path
                                                                d="m407 180h-301c-8.284 0-15 6.716-15 15v91c0 8.284 6.716 15 15 15h301c8.284 0 15-6.716 15-15v-91c0-8.284-6.716-15-15-15zm-15 91h-271v-61h271z"/>
                                                            <path
                                                                d="m256 331h-150c-8.284 0-15 6.716-15 15v91c0 8.284 6.716 15 15 15h150c8.284 0 15-6.716 15-15v-91c0-8.284-6.716-15-15-15zm-15 91h-120v-61h120z"/>
                                                            <path
                                                                d="m407 331h-91c-8.284 0-15 6.716-15 15v91c0 8.284 6.716 15 15 15h91c8.284 0 15-6.716 15-15v-91c0-8.284-6.716-15-15-15zm-15 91h-61v-61h61z"/>
                                                        </g>
                                                    </svg>

                                                </div>
                                                <div id="templateBtn" class="btn-text text-center">
                                                    <span class="">Templates</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#icons" data-toggle="tab">
                                            <div class="asset-btn asset-btn-icons">
                                                <div class="btn-icon text-center">
                                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                         viewBox="0 0 34.443 34.443"
                                                         style="enable-background:new 0 0 34.443 34.443;"
                                                         xml:space="preserve">
<g>
    <path d="M20.986,20.595v2.621c3.542-1.477,6.033-4.969,6.033-9.047c0-5.41-4.387-9.797-9.797-9.797
		c-5.411,0-9.798,4.387-9.798,9.797c0,4.018,2.42,7.467,5.879,8.979V20.5c-2.118-1.314-3.533-3.652-3.533-6.33
		c0-4.115,3.336-7.451,7.453-7.451c4.116,0,7.452,3.336,7.452,7.451C24.674,16.91,23.19,19.3,20.986,20.595z"/>
    <path d="M17.221,0C9.396,0,3.052,6.346,3.052,14.169c0,6.465,4.333,11.907,10.25,13.609v-1.992
		c-4.85-1.637-8.348-6.215-8.348-11.617c0-6.775,5.492-12.268,12.268-12.268c6.775,0,12.268,5.492,12.268,12.268
		c0,5.463-3.57,10.084-8.503,11.674v1.973c5.995-1.65,10.404-7.126,10.404-13.646C31.39,6.346,25.047,0,17.221,0z"/>
    <path d="M18.969,31.165c0-0.814,0-14.473,0-14.623c0.686-0.526,1.134-1.346,1.134-2.279c0-1.591-1.291-2.881-2.882-2.881
		c-1.593,0-2.883,1.29-2.883,2.881c0,0.929,0.445,1.746,1.125,2.273l0,0c0,0,0,13.753,0,14.629c0,2.486-2.316,3.278-2.316,3.278
		h8.667C21.814,34.443,18.969,33.539,18.969,31.165z"/>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
</g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
</svg>


                                                </div>
                                                <div class="btn-text text-center">
                                                    <span class="">Icons</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#shapes" data-toggle="tab">
                                            <div class="asset-btn asset-btn-icons">
                                                <div class="btn-icon text-center">
                                                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M46.3,-70.2C55.9,-56.8,56.5,-37.7,55.9,-22.3C55.2,-6.8,53.3,4.9,49.9,16.5C46.6,28.2,41.9,39.7,33.3,46.9C24.8,54.1,12.4,57,-3.3,61.6C-19,66.1,-38.1,72.4,-47.2,65.4C-56.4,58.3,-55.6,38.1,-60.4,20.3C-65.2,2.6,-75.6,-12.7,-73,-24.7C-70.5,-36.8,-55.1,-45.7,-40.7,-57.4C-26.4,-69.2,-13.2,-83.9,2.6,-87.4C18.4,-91,36.8,-83.5,46.3,-70.2Z"
                                                            transform="translate(100 100)" fill=""></path>
                                                    </svg>


                                                </div>
                                                <div class="btn-text text-center">
                                                    <span class="">Shapes</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>


                            </div>
                        </div>

                        <div class="clear-both"></div>

                        {{--Search Box--}}
                        {{--                        <div class="row">--}}
                        {{--                            <div class="col-md-12">--}}
                        {{--                                <div id="elementsIcon" class="input-group input-group-merge">--}}
                        {{--                                    <div class="input-group-prepend">--}}
                        {{--                                        <span class="input-group-text">--}}
                        {{--                                            <i class="ficon" data-feather="search"></i>--}}
                        {{--                                        </span>--}}
                        {{--                                    </div>--}}
                        {{--                                    <input type="text" name="search" class="form-control search-input" placeholder="Search Icons">--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="card-body asset-body">
                            <div class="tab-content">
                                <div id="templates" class="template-body tab-pane active">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="template-items-wrapper">
                                                @foreach($templates as $template)
                                                    <div class="template-item">
                                                        <div class="template-image">
                                                            <a href="{{ route('template.edit', $template->id) }}">
                                                                <img src="{{$template->image}}"
                                                                     alt="{{ $template->id }}"/>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="icons" class="icons-body tab-pane icons-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="icons-items-wrapper">
                                                @foreach($icons as $icon)
                                                    <div class="icons-item">
                                                        <div class="icons-svg">
                                                            {!! $icon->svg !!}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div id="shapes" class="icons-body tab-pane icons-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="icons-items-wrapper">
                                                @foreach($shapes as $shape)
                                                    <div class="icons-item">
                                                        <div class="icons-svg">
                                                            {!! $shape->svg !!}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-md-9 col-9">
                    <div class="upper-tools-wrapper d-flex float-right">
                        <div id="toolBackObject" class="upper-tool-btn upper-tool-back-object">
                            <div class="upper-tool-icon text-center">
                                <i class="ficon font-large-1" data-feather="skip-back"></i>
                                <div class="upper-tool-text text-center">
                                    <span class="">Backward</span>
                                </div>
                            </div>
                        </div>
                        <div id="toolFrontObject" class="upper-tool-btn upper-tool-front-object mr-2">
                            <div class="upper-tool-icon text-center">
                                <i class="ficon font-large-1" data-feather="skip-forward"></i>
                                <div class="upper-tool-text text-center">
                                    <span class="">Forward</span>
                                </div>
                            </div>
                        </div>
                        <div id="toolZoomOut" class="upper-tool-btn upper-tool-copy zoomout">
                            <div class="upper-tool-icon text-center">
                                <i class="ficon font-large-1" data-feather="zoom-out"></i>
                                <div class="upper-tool-text text-center">
                                    <span class="">Zoom Out</span>
                                </div>
                            </div>
                        </div>
                        <select id="zoomInOutSize" class="form-control" onchange="handleChange()"
                                style="width: 85px; margin-top: 3px">
                            <option value=0.5>50%</option>
                            <option value=0.75>75%</option>
                            <option value=0.85>85%</option>
                            <option value=0.9>90%</option>
                            <option value=1 selected>100%</option>
                            <option value=1.2>120%</option>
                            <option value=1.5>150%</option>
                            <option value=1>reset</option>
                        </select>
                        <div id="toolZoomIn" class="upper-tool-btn upper-tool-copy mr-1 zoomin">
                            <div class="upper-tool-icon text-center">
                                <i class="ficon font-large-1" data-feather="zoom-in"></i>
                                <div class="upper-tool-text text-center">
                                    <span class="">Zoom In</span>
                                </div>
                            </div>
                        </div>

                        <div id="toolCopy" class="upper-tool-btn upper-tool-copy">
                            <div class="upper-tool-icon text-center">
                                <i class="ficon font-large-1" data-feather="copy"></i>
                            </div>
                            <div class="upper-tool-text text-center">
                                <span class="">Copy</span>
                            </div>
                        </div>

                        <div id="toolUndo" class="upper-tool-btn upper-tool-undo">
                            <div class="upper-tool-icon text-center">
                                <i class="ficon font-large-1" data-feather="corner-up-left"></i>

                            </div>
                            <div class="upper-tool-text text-center">
                                <span class="">Undo</span>
                            </div>
                        </div>

                        <div id="toolRedo" class="upper-tool-btn upper-tool-redo">
                            <div class="upper-tool-icon text-center">
                                <i class="ficon font-large-1" data-feather="corner-up-right"></i>

                            </div>
                            <div class="upper-tool-text text-center">
                                <span class="">Redo</span>
                            </div>
                        </div>

                        <div id="toolRemoveAll" class="upper-tool-btn upper-tool-remove-all">
                            <div class="upper-tool-icon text-center">
                                <i class="ficon font-large-1" data-feather="trash-2"></i>

                            </div>
                            <div class="upper-tool-text text-center">
                                <span class="">Clear</span>
                            </div>
                        </div>
                    </div>
                    <div id="toolsWrapper" class="tools-wrapper">
                        <div class="tools-buttons-wrapper d-flex">
                            <div class="tools-left d-flex">
                                <div id="toolSelect" class="main-tool-btn tool-select" data-toggle="tooltip"
                                     data-placement="top" title="Select">
                                    <i class="ficon font-large-1" data-feather="mouse-pointer"></i>
                                </div>
                                <div id="toolPen" class="main-tool-btn tool-pen" data-toggle="tooltip"
                                     data-placement="top"
                                     title="Pen">
                                    <i class="ficon font-large-1" data-feather="edit-2"></i>
                                </div>
                                <div id="toolText" class="main-tool-btn tool-text" data-toggle="tooltip"
                                     data-placement="top"
                                     title="Text">
                                    <i class="ficon font-large-1" data-feather="type"></i>
                                </div>
                                <div id="toolImage" class="main-tool-btn tool-image" data-toggle="tooltip"
                                     data-placement="top" title="Image">
                                    <input type="file" accept="image/*" id="imageUpload" class="imageUpload"
                                           style="display:none"/>
                                    <i class="ficon font-large-1" data-feather="image"></i>
                                </div>
                                <div class="toolbar-border"></div>
                            </div>

                            <div class="tools-middle d-flex">

                                <div id="penToolbar" class="pen-toolbar d-flex hasRemove">
                                    <div id="penFreeHand" class="tool-btn tool-free-hand" data-toggle="tooltip"
                                         data-placement="top" title="Free Hand">
                                        <svg class="icon-pen-freehand" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000"
                                             xml:space="preserve">
<metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon</metadata>
                                            <g>
                                                <g transform="translate(0.000000,511.000000) scale(0.100000,-0.100000)">
                                                    <path
                                                        d="M3301.5,3733.2c-393.2-126.6-742.3-481.5-1043.5-1055c-241.7-466.1-445-654.1-728.9-675.2c-295.4-23-573.5,197.6-815.2,648.4c-120.8,224.4-178.4,274.3-324.2,274.3c-184.2-1.9-289.7-111.3-289.7-301.2c0-95.9,13.4-138.1,90.2-287.7c324.2-627.3,842.1-986,1365.8-947.6c310.8,23,552.5,142,819.1,406.7c189.9,189.9,255.1,282,431.6,606.2c63.3,120.8,153.5,270.5,199.5,333.8c117,165,297.3,329.9,423.9,387.5c143.9,65.2,316.5,57.5,470-24.9c138.1-72.9,425.8-364.5,535.2-540.9c48-78.6,163-259,257-402.8c358.7-548.6,742.3-826.8,1145.2-828.7c448.9-1.9,855.5,312.7,1271.8,980.2c132.4,212.9,239.8,328,349.1,374.1c101.7,42.2,270.5,34.5,381.7-19.2c115.1-55.6,188-128.5,306.9-318.4c487.2-767.3,1300.5-727,1680.4,84.4c49.9,105.5,57.5,145.8,49.9,216.8c-15.3,149.6-124.7,255.1-276.2,268.5c-145.8,11.5-226.3-46-326.1-234c-94-172.6-140-226.3-218.7-259c-120.9-51.8-249.4,40.3-425.8,303.1c-266.6,399-598.5,598.5-991.7,598.5c-180.3,0-331.9-38.4-500.7-126.6c-212.9-111.3-339.5-243.6-567.8-590.8c-216.8-329.9-414.3-550.5-556.3-623.4c-103.6-51.8-232.1-51.8-335.7,0c-120.8,61.4-335.7,295.4-475.7,512.2c-412.4,650.3-516,780.7-757.7,976.4C4084.1,3758.2,3673.6,3852.2,3301.5,3733.2z"/>
                                                    <path
                                                        d="M3150,556.7C2476.7,499.1,1703.6,109.7,873-586.6c-299.2-249.4-686.7-627.3-723.2-704C34.8-1534.2,251.5-1800.8,502.8-1726c44.1,13.4,107.4,57.5,157.3,109.3c138.1,147.7,533.3,506.4,734.7,669.5c546.7,439.3,1150.9,759.6,1630.5,867c356.8,78.6,878.5,13.4,1500-188c529.4-170.7,895.8-320.3,1847.2-750c1325.5-598.5,1640.1-705.9,2071.7-705.9c230.2,0,406.7,30.7,606.2,105.5c385.6,145.8,824.8,556.3,847.9,796.1c17.3,182.2-94,308.8-282,322.3c-142,7.7-207.2-34.5-316.5-203.3c-46-72.9-117-159.2-157.3-193.8c-251.3-207.2-640.7-270.5-1033.9-165c-260.9,69-688.7,241.7-1448.3,585C5565,19.5,5058.6,224.8,4588.6,362.9C4038.1,526,3543.2,591.2,3150,556.7z"/>
                                                    <path
                                                        d="M378.1-2969c-94-23-157.3-76.7-201.4-163c-65.2-136.2-40.3-257,74.8-366.4l61.4-57.5l4674.7-5.8c4525.1-3.8,4676.6-3.8,4741.8,30.7c201.4,109.3,197.6,423.9-5.7,537.1c-57.5,30.7-335.7,32.6-4674.7,36.5C2511.2-2957.5,408.8-2961.4,378.1-2969z"/>
                                                </g>
                                            </g>
</svg>
                                    </div>
                                    <div id="penRect" class="tool-btn tool-rect" data-toggle="tooltip"
                                         data-placement="top" title="Rectangle">
                                        <i class="ficon font-large-1" data-feather="square"></i>
                                    </div>
                                    <div id="penEllipse" class="tool-btn tool-ellipse" data-toggle="tooltip"
                                         data-placement="top" title="Ellipse">
                                        <i class="ficon font-large-1" data-feather="circle"></i>
                                    </div>
                                    <div id="penLine" class="tool-btn tool-line" data-toggle="tooltip"
                                         data-placement="top" title="Line">
                                        <i class="ficon font-large-1" data-feather="minus"></i>
                                    </div>
                                    <div id="penArrow" class="tool-btn tool-arrow" data-toggle="tooltip"
                                         data-placement="top" title="Arrow">
                                        <i class="ficon font-large-1" data-feather="arrow-right"></i>
                                    </div>
                                    <div id="penColor" class="tool-btn tool-pen-color" data-toggle="tooltip"
                                         data-placement="top" title="Pen Color">
                                        <div class="colorpicker-circle-anchor__color" data-color></div>
                                    </div>
                                    <div id="strokeColor" class="tool-btn tool-stroke-color" style="display: none"
                                         data-toggle="tooltip" data-placement="top" title="Stroke Color">
                                        <div class="colorpicker-circle-anchor__color" data-color></div>
                                    </div>

                                    <div id="fillColor" class="tool-btn tool-fill-color" style="display: none"
                                         data-toggle="tooltip" data-placement="top" title="Fill Color">
                                        <div class="colorpicker-circle-anchor__color" data-color></div>
                                    </div>

                                    <div class="penSizeRange ml-1 mr-1 d-flex" data-toggle="tooltip"
                                         data-placement="top" title="Pen Size">
                                        <input type="range" id="penSize" class="mr-1 d-flex" value="5" min="0"
                                               max="100">
                                        <div id="penSizeValueEl" class="m-auto d-flex"></div>
                                    </div>
                                </div>

                                <div id="textToolbar" class="text-toolbar d-flex hasRemove">

                                    <div id="textAlignJustify" class="tool-btn tool-text-justify" data-toggle="tooltip"
                                         data-placement="top" title="Align Justify">
                                        <i class="ficon font-large-1" data-feather="align-justify"></i>
                                    </div>

                                    <div id="textAlignLeft" class="tool-btn tool-text-left" data-toggle="tooltip"
                                         data-placement="top" title="Align Left">
                                        <i class="ficon font-large-1" data-feather="align-left"></i>
                                    </div>
                                    <div id="textAlignCenter" class="tool-btn tool-text-center" data-toggle="tooltip"
                                         data-placement="top" title="Align Center">
                                        <i class="ficon font-large-1" data-feather="align-center"></i>
                                    </div>
                                    <div id="textAlignRight" class="tool-btn tool-text-right" data-toggle="tooltip"
                                         data-placement="top" title="Align Right">
                                        <i class="ficon font-large-1" data-feather="align-right"></i>
                                    </div>
                                    <div id="textBold" class="tool-btn tool-text-bold" data-toggle="tooltip"
                                         data-placement="top" title="Text Bold">
                                        <i class="ficon font-large-1" data-feather="bold"></i>
                                    </div>
                                    <div id="textItalic" class="tool-btn tool-text-italic" data-toggle="tooltip"
                                         data-placement="top" title="Text Italic">
                                        <i class="ficon font-large-1" data-feather="italic"></i>
                                    </div>
                                    <div id="textUnderline" class="tool-btn tool-text-underline" data-toggle="tooltip"
                                         data-placement="top" title="Text Underline">
                                        <i class="ficon font-large-1" data-feather="underline"></i>
                                    </div>
                                    <div id="textColor" class="tool-btn tool-pen-color" data-toggle="tooltip"
                                         data-placement="top" title="Text Color">
                                        <div class="colorpicker-circle-anchor__color" data-color></div>
                                    </div>

                                    <div class="penSizeSelect">
                                        <select class="custom-select text-size ficon" id="textSize"
                                                style="cursor: pointer" data-toggle="tooltip"
                                                data-placement="top" title="Text Size">
                                            <option value="40" selected="">Text Size</option>
                                            <option value="70">Extra Large</option>
                                            <option value="60">Large</option>
                                            <option value="50">Medium</option>
                                            <option value="30">Small</option>
                                            <option value="20">Extra Small</option>
                                            <option value="16">Paragraph</option>
                                        </select>
                                    </div>

                                    <div id="textFont" class="tool-btn tool-font"
                                         style="width: 200px; margin-left: 10px;" data-toggle="tooltip"
                                         data-placement="top" title="Font">
                                        <input class="form-control" id="textFontFamily" type="text">
                                    </div>

                                </div>

                                <div id="imageToolbar" class="image-toolbar d-flex hasRemove">

                                    <div class="penSizeRange ml-1 mr-1 d-flex" data-toggle="tooltip"
                                         data-placement="top" title="Image Opacity">
                                        <input type="range" id="imageOpacity" class="d-flex" value="1.0" max="1"
                                               min="0.1" step="0.1">
                                        <div id="imageOpacityValue" class="m-auto d-flex"></div>
                                    </div>

                                </div>

                                <div id="svgToolbar" class="svg-toolbar d-flex">
                                    <div id="svgColor" class="tool-btn tool-pen-color" data-toggle="tooltip"
                                         data-placement="top" title="Icon Color">
                                        <div class="colorpicker-circle-anchor__color" data-color></div>
                                    </div>
                                </div>

                                <!--Remove Active Object Button-->
                                <div id="removeObject" class="tool-btn tool-delete" data-toggle="tooltip"
                                     data-placement="top" title="Remove">
                                    <i class="ficon font-large-1" data-feather="trash-2"></i>
                                </div>


                            </div>

                        </div>
                    </div>
                    <div id="canvas-container" class="canvas-container-wrapper">
                        <canvas id="canvas"></canvas>
                    </div>

                </div>
            </div>
        </section>


    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="{{ asset('/tool-frontend/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('/tool-frontend/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('/tool-frontend/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('/tool-frontend/app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('/tool-frontend/assets/js/fabric.min.js') }}"></script>
<script src="{{ asset('/tool-frontend/assets/plugins/jspdf/jspdf.umd.min.js') }}"></script>
<script src="{{ asset('/tool-frontend/assets/plugins/color-picker/default-picker.min.js') }}"></script>
<script src="{{ asset('/tool-frontend/assets/plugins/font-picker/jquery.fontselect.min.js') }}"></script>
<script src="{{ asset('/tool-frontend/assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('/tool-frontend/assets/js/fabric-script.js') }}"></script>
<script src="{{ asset('/tool-frontend/assets/js/custom-scripts.js') }}"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>

{{--Zoom In Zoom Out Div--}}
<script>

    let zoomArr = [0.5,0.75,0.85,0.9,1,1.2,1.5];
    var element = document.querySelector('.canvas-container');
    let value = element.getBoundingClientRect().width / element.offsetWidth;

    let indexofArr = 4;
    handleChange = ()=>{
        let val = document.getElementById('zoomInOutSize').value;
        val = Number(val)
        //console.log('handle change selected value ',val);
        indexofArr = zoomArr.indexOf(val);
        //console.log('Handle changes',indexofArr)
        element.style['transform'] = `scale(${val})`;
        element.style['height'] = 'auto';
    }


    document.getElementById('toolZoomIn').addEventListener('click',()=>{
        //console.log('value of index zoomin is',indexofArr)
        if(indexofArr < zoomArr.length-1){
            indexofArr += 1;
            value = zoomArr[indexofArr];
            document.getElementById('zoomInOutSize').value = value
            // console.log('current value is',value)
            // console.log('scale value is',value)
            element.style['transform'] = `scale(${value})`;
            element.style['height'] = 'auto';
        }
    })

    document.getElementById('toolZoomOut').addEventListener('click',()=>{
        //console.log('value of index  zoom out is',indexofArr)
        if(indexofArr >0){
            indexofArr -= 1;
            value = zoomArr[indexofArr];
            document.getElementById('zoomInOutSize').value = value
            // console.log('scale value is',value)
            element.style['transform'] = `scale(${value})`;
            element.style['height'] = 'auto';
        }
    })
</script>


</body>
<!-- END: Body-->

</html>
