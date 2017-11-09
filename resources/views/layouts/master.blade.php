<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title') -  AgriMarket</title>
        <!-- Core CSS - Include with every page -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/pace/pace-theme-big-counter.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/main-style.css')}}" rel="stylesheet" />
        <!-- Page-Level CSS -->
        <link href="{{asset('assets/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet" />
        @yield('styles')
    </head>
    <body>
        <!--  wrapper -->
        <div id="wrapper">
            <!-- navbar top -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
                <!-- navbar-header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- end navbar-header -->
                <!-- navbar-top-links -->
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-3x"></i>
                        </a>
                        <!-- dropdown user-->
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="{{route('logout')}}"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                            </li>
                        </ul>
                        <!-- end dropdown-user -->
                    </li>
                    <!-- end main dropdown -->
                </ul>
                <!-- end navbar-top-links -->

            </nav>
            <!-- end navbar top -->

            <!-- navbar side -->
            <nav class="navbar-default navbar-static-side" role="navigation">
                <!-- sidebar-collapse -->
                <div class="sidebar-collapse">
                    <!-- side-menu -->
                    <ul class="nav" id="side-menu">
                        <li>
                            <!-- user image section-->
                            <div class="user-section">
                                <div class="user-section-inner">
                                    <img src="{{asset('assets/img/user.jpg')}}" alt="">
                                </div>
                                <div class="user-info">
                                    <div>{{Auth::user()->name}}</div>
                                </div>
                            </div>
                            <!--end user image section-->
                        </li>
                        <li class="sidebar-search">
                        
                        </li>
                        <li class="selected">
                            <a href="{{url('/')}}"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                        </li>

                        <li>
                            <a href="{{url('products')}}"><i class="fa fa-dashboard fa-fw"></i>Products</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('users')}}">App Users</a>
                                </li>                              
                            </ul>
                            <!-- second-level-items -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>Admins<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level" >
                                <li>
                                    <a href="{{url('admins')}}" >Admins</a>
                                </li>
                                <li>
                                    <a href="{{url('admins/add')}}" >Add new admin</a>
                                </li>
                            </ul>
                            <!-- second-level-items -->
                        </li>
                    </ul>
                    <!-- end side-menu -->
                </div>
                <!-- end sidebar-collapse -->
            </nav>
            <!-- end navbar side -->
            <!--  page-wrapper -->
           @yield('content')
            <!-- end page-wrapper -->
        </div>
        <!-- end wrapper -->

        <!-- Core Scripts - Include with every page -->
        <script src="{{asset('assets/plugins/jquery-1.10.2.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
        <script src="{{asset('assets/plugins/pace/pace.js')}}"></script>
        <script src="{{asset('assets/scripts/siminta.js')}}"></script>
        <!-- Page-Level Plugin Scripts-->

        @yield('scripts')
        <script type="text/javascript">
       
        </script>
    </body>

</html>
