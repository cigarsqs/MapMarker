

@extends('app')

@section('css')
    <link href="{{ asset('/css/map.css')  }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">
@endsection
@section('navbar')
    <nav class="navbar navbar-default navbar-fixed-top ">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/user/map') }}">My MapMaker</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">Login</a></li>
                        <li><a href="{{ url('/auth/register') }}">Register</a></li>
                    @else

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->username}}<b class="caret"></b></a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/map/save') }}">Save Map</a> </li>
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><span class="visible-sm visible-xs">Settings<span class="fui-gear"></span></span><span class="visible-md visible-lg"><span class="fui-gear"></span></span></a></li>
                    @endif
                </ul>

                <form class="navbar-form navbar-right" action="#" role="search">
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control" id="navbarSearchInput" type="search" placeholder="Search">
                <span class="input-group-btn">
                  <button type="submit" class="btn"><span class="fui-search"></span></button>
                </span>
                        </div>
                    </div>
                    <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
                </form>
            </div>
        </div>
    </nav>
@endsection
@section('content')
        <div style="padding-top: 50px">
            {!! $mapDetail->title !!}
            <span class="button-group btn-group-xs">
                <a class="btn btn-primary active"  style="float: right">
                    <span class="glyphicon glyphicon-edit" onclick="setMapEditable()"></span>
                </a>
            </span>
            <!-- Main component for a primary marketing message or call to action -->
            <div class="row row-offcanvas row-offcanvas-right">
                <div  class="col-xs-12 col-sm-12" id ="allmap">
                </div>
            </div>
        </div>


@endsection

@section('script')
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=HZfqDHAQFBg7tLMsVSE1VuOH"></script>
    <script src="{{asset('/js/drawingManager.js')}}"></script>
    <!--加载鼠标绘制工具-->
    <script type='text/javascript' src="{{asset('/js/DrawingManager.js')}}"></script>
    <link rel='stylesheet' href="{{asset('/css/DrawingManager_min.css')}}"/>
    <!--加载检索信息窗口-->
    <script type='text/javascript' src="{{asset('/js/SearchInfoWindow_min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/css/SearchInfoWindow_min.css')}}" />
    <script src="{{asset('/js/MapHome.js')}}"></script>
@endsection
