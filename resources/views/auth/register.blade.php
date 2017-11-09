<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Agrimarket</title>
    <!-- Core CSS - Include with every page -->
    <link href="{{asset('assets/plugins/bootstrap/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/main-style.css')}}" rel="stylesheet" />

</head>

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Register New Admin</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="{{url('register')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Name" name="name" type="text" 
                                    value="{{old('name')}}" required 
                                    autofocus>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="email" type="email" 
                                    value="{{old('email')}}" required >
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone" name="phone" type="phone"
                                     value="{{old('phone')}}"required >
                                </div>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div>
                                        <input id="password" type="password" class="form-control" name="password" 
                                            placeholder="Password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password confirmation" required>
                                    </div>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Register" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
