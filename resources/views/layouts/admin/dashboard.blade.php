@extends('layouts.admin.plane')
@section('body')
        <!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">
</head>
<body>
<section class="dashboard-page">
    <div class="container-fluid">
        <div class="d-sm-block d-md-block d-block d-lg-none">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn">&times;</a>
                <div class="menu-wrap ">

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ (Request::is('*admin') ?  'active' : '') }}" href="{{url('admin')}}">
                                <img class="blck" src="{{asset('assets/admin/images/black/dash.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/dash.png')}}"/>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" {{ (Request::is('*admin/user') ? 'active' : '') }} href="{{url('admin/user')}}">
                                <img class="blck" src="{{asset('assets/admin/images/black/manage.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/manage.png')}}"/>
                                <span>Manage Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/merchant.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/merchant.png')}}"/>
                                <span>Manage Merchants</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/algorithm.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/algorithm.png')}}"/>
                                <span>Manage Step Algorithhms</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/marketing.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/marketing.png')}}"/>
                                <span>Email Marketing</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/admin.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/admin.png')}}"/>
                                <span>Manage Admin Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/support.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/support.png')}}"/>
                                <span>Messaging Support</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/target.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/target.png')}}"/>
                                <span>Set Target</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/additional.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/additional.png')}}"/>
                                <span>Additional Pages</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="side-nav-menu row no-gutters">
                <div class="col">
                    <span class="openbtn" style="font-size:30px;cursor:pointer">&#9776; </span>
                </div>

                <div class="col text-right">
                    <div class="logo-wrap-side">
                        <img src="{{asset('assets/admin/images/steps.png')}}" class="logo-img img-fluid">
                    </div>
                </div>
            </div>
        </div>


        <div class="row no-gutters">
            <div class="col-lg-2 d-none d-lg-block">
                <div class="menu-wrap ">
                    <div class="logo-wrap mb-4">
                        <img src="{{asset('assets/admin/images/steps.png')}}" class="logo-img img-fluid">
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link  {{ (\Request::is('*admin') ? 'active' : '') }}" href="{{url('admin')}}">
                                <img class="blck" src="{{asset('assets/admin/images/black/dash.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/dash.png')}}"/>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" {{ (\Request::is('*admin/user') ? 'active' : '') }} href="{{url('admin/user')}}">
                                <img class="blck" src="{{asset('assets/admin/images/black/manage.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/manage.png')}}"/>
                                <span>Manage Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/merchant.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/merchant.png')}}"/>
                                <span>Manage Merchants</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/algorithm.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/algorithm.png')}}"/>
                                <span>Manage Step Algorithhms</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/marketing.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/marketing.png')}}"/>
                                <span>Email Marketing</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/admin.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/admin.png')}}"/>
                                <span>Manage Admin Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/support.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/support.png')}}"/>
                                <span>Messaging Support</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/target.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/target.png')}}"/>
                                <span>Set Target</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="blck" src="{{asset('assets/admin/images/black/additional.png')}}"/>
                                <img class="whte" src="{{asset('assets/admin/images/white/additional.png')}}"/>
                                <span>Additional Pages</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="admin-wrap">
                    <div class="top-bar mb-4">
                        <div class="row no-gutters">
                            <div class="col">
                                <div class="heading-wrap">
                                    <h2>Dashboard</h2>
                                </div>
                            </div>
                            <div class="col text-right">
                                <div class="dashtop row no-gutters">
                                    <div class="col">
                                        <div class="dropdown notif">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <img src="{{asset('assets/images/notification.png')}}">
                                                <span class="count">2</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Link 1</a>
                                                <a class="dropdown-item" href="#">Link 2</a>
                                                <a class="dropdown-item" href="#">Link 3</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="dropdown admin">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <span class="name">Admin Name</span><img src="{{asset('assets/images/admin.png')}}"
                                                                                         class="img-fluid">
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Link 1</a>
                                                <a class="dropdown-item" href="#">Link 2</a>
                                                <a class="dropdown-item" href="#">Link 3</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @yield('section')

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

