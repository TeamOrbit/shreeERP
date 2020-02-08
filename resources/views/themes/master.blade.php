<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('theme/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('theme/img/favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>ShreeERP</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/css/light-bootstrap-dashboard.css?v=2.0.0') }} " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('theme/css/demo.css') }}" rel="stylesheet" />

</head>

<body>

   <div class="wrapper">
        <div class="sidebar" data-image="{{ asset('theme/img/sidebar-5.jpg') }}">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
        <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="http://www.creative-tim.com" class="simple-text">
                        Shree ERP
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item {{ (request()->is('reports')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('reports') }}">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('sales')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('sales') }}">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Sales</p>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('purchases')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('purchases') }}">
                            <i class="nc-icon nc-notes"></i>
                            <p>Purchase</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">

                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"> Dashboard </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="no-icon">Master</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('cities') }}">City</a>
                                    <a class="dropdown-item" href="{{ route('categories') }}">Category</a>
                                    <a class="dropdown-item" href="{{ route('items') }}">Items</a>
                                    <a class="dropdown-item" href="{{ route('units') }}">Units</a>
                                    <a class="dropdown-item" href="{{ route('customers') }}">Customer</a>
                                    <a class="dropdown-item" href="{{ route('suppliers') }}">Supplier</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <span class="no-icon">Log out</span>
                                </a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
           
            </nav>
            <!-- End Navbar -->
            @yield('content')
            
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>

   <!--   Core JS Files   -->
    <script src="{{ asset('theme/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('theme/js/plugins/bootstrap-switch.js') }}"></script>
    <!--  Chartist Plugin  -->
    <script src="{{ asset('theme/js/plugins/chartist.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('theme/js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
    <script src="{{ asset('theme/js/light-bootstrap-dashboard.js?v=2.0.0') }}" type="text/javascript"></script>
    <!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('theme/js/demo.js') }}"></script>

</body>



</html>