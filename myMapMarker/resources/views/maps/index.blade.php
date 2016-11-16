@extends('app')

@section('navbar')
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/user/'.Auth::user()->id.'/maps') }}">My MapMaker</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/map/user/'.Auth::user()->id) }}">Home</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">Login</a></li>
                        <li><a href="{{ url('/auth/register') }}">Register</a></li>
                    @else

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->username}}<b class="caret"></b></a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/map/create') }}">add Map</a></li>
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><span class="visible-sm visible-xs">Settings<span class="fui-gear"></span></span><span class="visible-md visible-lg"><span class="fui-gear"></span></span></a></li>
                    @endif
                </ul>


            </div>
        </div>
    </nav>
@endsection
@section('content')
    <div class="col-lg-3">
        <form action="#" type="get">

            <select data-toggle="select" class="form-control select select-sm select-primary mrs mbm" >
                <option value="0">User</option>
                <option value="1">Map</option>
            </select>

            <div class="input-group">

                <input class="form-control" id="SearchInput" type="search" placeholder="Search">

                <span class="input-group-btn">
                    <button type="submit" class="btn"><span class="fui-search"></span></button>
                </span>
            </div>

        </form>

        <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
    </div>
    <div class="col-lg-9">

        <table class="table table-hover table-responsive" >
            <thead class="lead">
                <td >Title</td>
                <td>Context</td>
                <td>Created_at</td>
                <td>Created_by</td>
                <td>Tag</td>
                <td>is_Public</td>
                <td>操作</td>
            </thead>
            @if(!is_null($maps))
                    @foreach($maps as $map)
                        <tr>
                            <td><a href="{{url('/map/'.$map->id)}}">{{$map->title}}</a></td>
                            <td>{{$map->context}}</td>
                            <td>{{$map->created_at}}</td>
                            <td>{{$map->belongToUser->username}}</td>
                            <td>
                                <div class="tagsinput-primary col-lg-10">
                                    @foreach($map->belongsToManyTags as $tag)
                                        <label class="tag label label-info">{{$tag->tag}}</label>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                @if( $map->is_public == 1)
                                    {!! Form::checkbox('custom-switch-05',null,true,array('disabled','data-toggle'=>'switch','data-on-color'=>'success','data-off-color'=>'primary')) !!}
                                @else
                                    {!! Form::checkbox('custom-switch-05',null,false,array('disabled','data-toggle'=>'switch','data-on-color'=>'success','data-off-color'=>'primary')) !!}
                                @endif
                            </td>
                            <td><a class="btn btn-sm btn-primary" href="{{url('map/edit/'.$map->id)}}">Edit</a></td>
                        </tr>
                    @endforeach
            @endif
        </table>
        <div class="pagination">
            <ul>
                <li class="previous">
                    <a href="#" class="fui-arrow-left"></a>
                </li>

                <!-- Make dropdown appear above pagination -->
                <li class="pagination-dropdown dropup">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fui-triangle-up"></i>
                    </a>
                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">10-20</a>
                        </li>
                    </ul>
                </li>

                <li class="next">
                    <a href="#" class="fui-arrow-right"></a>
                </li>
            </ul>
        </div>
    </div>
@endsection

