<link href="{{ asset('/css/login.css')  }}" rel="stylesheet">

@extends('app')
@section('content')
    <div class="container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="login">
            <div class="login-screen">
                <div class="login-icon">
                    <img src={{asset("/img/Map.png")}} alt="Welcome to Map Marker" />
                    <h4>Welcome to <small>Map Marker</small></h4>
                </div>
                <!--{!!  Form::open(array('url'=>'auth/login','class'=>'login-form')) !!}-->
                <form class="login-form" role="form" method="POST" action="{{ url('/auth/login') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <!-- {!! Form::text('username',null,array('class'=>'form-control login-field','placeholder'=>'Enter your name','name'=>'login-name')) !!} -->
                        <input type="text" class="form-control login-field" placeholder="Enter your name" name="username" value="{{ old('username') }}">
                        <label class="login-field-icon fui-user" for="login-name">	</label>
                    </div>

                    <div class="form-group">
                        <!--{!!  Form::text('password',null,array('class'=>'form-control login-field','placeholder'=>'Password','name'=>'login-pass'))    !!}-->
                        <input type="password" class="form-control login-field" placeholder="Password" name="password">
                        <label class="login-field-icon fui-lock" for="login-pass"></label>
                    </div>
                    <!-- {!!  Form::submit('login',array('class'=>'btn btn-primary btn-lg btn-block','name'=>'submit'))   !!}-->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Login
                    </button>
                    <a class="login-link" href="#">Lost your password?</a>
                <!-- {!!  Form::close()   !!}-->
                </form>
            </div>
        </div>
    </div>
@endsection
