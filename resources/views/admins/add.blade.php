@extends('layouts.master')

@section('title', 'Register New Admin')
@section('styles')
    <link href="{{asset('assets/plugins/bootstrap/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/main-style.css')}}" rel="stylesheet" />
@endsection
@section('content')
 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Admins</h1>
        </div>
    </div>      
    <div class="row">
        <div class="col-md-12">
            <div class="login-panel panel panel-default" style="margin:0px">                  
                <div class="panel-heading">
                    <h3 class="panel-title">Register New Admin</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="{{url('admins/create')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="name" type="text" 
                                value="{{old('name')}}" required 
                                autofocus>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong style="color:red">{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                            <div class="form-group">
                                <input class="form-control" placeholder="Email" name="email" type="email" 
                                value="{{old('email')}}" required >
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong style="color:red">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                            <div class="form-group">
                                <input class="form-control" placeholder="Phone" name="phone" type="phone"
                                 value="{{old('phone')}}"required >
                            </div>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong style="color:red">{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif

                            <div class="form-group">
                                <div>
                                    <input id="password" type="password" class="form-control" name="password" 
                                        placeholder="Password" value="{{old('password')}}" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password confirmation" required>
                                </div>
                            </div>

                            <!-- Change this to a button or input when using this as a form -->
                           
                        </fieldset>
                        <div class="col-md-2 pull-right" style="padding:0px">
                            <input type="submit" class="btn btn-success btn-block" style="margin-right: 0px" value="Register" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
