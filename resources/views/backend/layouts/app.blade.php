<!DOCTYPE html>
<html lang="en">
    @php
        $setting = DB::table('settings')->first();
    @endphp
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title> {{$setting->sitename}} | Dashboard</title>

    <!-- Bootstrap -->
    <link href="{{ asset('backend/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('backend/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('backend/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('backend/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('backend/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('backend/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('backend/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('backend/build/css/custom.min.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title text-center" style="border: 0;">
                        <a href="{{ route('home') }}" class="site_title">
                            <span>{{ $setting->sitename }}</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ asset('uploads/img.jpg') }}" alt="{{ Auth::user()->name }}"
                                class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{{ Auth::user()->name }}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <hr>
                            <h3>General</h3>
                            <hr>
                            <ul class="nav side-menu">
                                <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                                <li><a><i class="fa fa-list"></i> Product Categories<span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('category.index') }}">Categories</a></li>
                                        <li><a href="{{ route('subcategory.index') }}">Sub categories</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-product-hunt"></i>Our Products <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('product.index') }}">All Products</a></li>
                                        <li><a href={{ route('product.create') }}>Add new Product</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-industry"></i>Our Vendors <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('vendors.index') }}">Our vendors</a></li>
                                        <li><a href="{{ route('vendors.create') }}">Register new vendor</a></li>
                                    </ul>
                                </li>
                                {{-- <li><a href="{{route('order.index')}}"><i class="fa fa-exchange"></i>Our Orders</a></li> --}}
                                <li><a><i class="fa fa-exchange"></i>Our Orders <span
                                    class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('order.index') }}">All Orders</a></li>
                                        <li><a href="{{ route('cartproduct.index') }}">User Carts</a></li>
                                        <li><a href="{{ route('wishlistproduct.index') }}">User Wishlists</a></li>
                                        <li><a href="{{ route('requestorder.index') }}">All Request Orders</a></li>
                                        <li><a href="{{ route('cancelledproduct.index') }}">Cancelled Orders</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-rss-square"></i>Blogs <span
                                    class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('blogcategory.index') }}">Blog Categories</a></li>
                                        <li><a href="{{ route('blog.index') }}">Our Blogs</a></li>

                                    </ul>
                                </li>
                                    <li><a href="{{route('onlyusers')}}"><i class="fa fa-user"></i>Our Customers</a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3>Additional</h3>
                            <hr>
                            <ul class="nav side-menu">

                                <li><a><i class="fa fa-users"></i> Users (Dashboard) <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('user.index') }}">View Users</a></li>
                                        <li><a href="{{ route('user.create') }}">Create User</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-cog"></i> Settings <span
                                    class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('setting.index') }}">General</a></li>
                                        <li><a href="{{ route('slider.index') }}">Slider Settings</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-ban"></i> Roles and Permission <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('permission.index') }}">View Permissions</a></li>
                                        <li><a href="{{ route('role.index') }}">View Roles</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('review') }}"><i class="fa fa-star"></i> Reviews</a></li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                            <li role="presentation" class="nav-item dropdown open">

                                @php
                                    $neworder = DB::table('notifications')->where('type','App\Notifications\NewOrderNotification')->where('is_read', 0)->count();
                                    $newuser = DB::table('notifications')->where('type','App\Notifications\NewUserNotification')->where('is_read', 0)->count();
                                    $newrequest = DB::table('notifications')->where('type','App\Notifications\RequestOrderNotification')->where('is_read', 0)->count();
                               @endphp
                                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    @if ($neworder == 0 && $newuser == 0 && $newrequest == 0)
                                        <span class="badge bg-green">0</span>
                                    @elseif($neworder == 0 && $newuser == 0 && $newrequest == 1)
                                        <span class="badge bg-green">1</span>
                                    @elseif($neworder == 0 && $newuser == 1 && $newrequest == 0)
                                        <span class="badge bg-green">1</span>
                                    @elseif($neworder == 0 && $newuser == 1 && $newrequest == 1)
                                        <span class="badge bg-green">2</span>
                                    @elseif($neworder == 1 && $newuser == 0 && $newrequest == 0)
                                        <span class="badge bg-green">1</span>
                                    @elseif($neworder == 1 && $newuser == 0 && $newrequest == 1)
                                        <span class="badge bg-green">2</span>
                                    @elseif($neworder == 1 && $newuser == 1 && $newrequest == 0)
                                        <span class="badge bg-green">2</span>
                                    @else
                                        <span class="badge bg-green">3</span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu list-unstyled msg_list" role="menu"
                                    aria-labelledby="navbarDropdown1">
                                    @if ($neworder > 0)
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{route('order.index')}}">
                                                <span>
                                                    <i class="fa fa-exchange"></i><span style="font-size: 15px;"> &nbsp;<b>{{$neworder}}</b> new order has just arrived.</span>
                                                </span>
                                            </a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <div class="text-center">
                                                <a class="dropdown-item" href="{{route('notificationsread')}}">
                                                    <strong>Mark all as read.</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li> --}}
                                    @endif
                                    @if ($newuser > 0)
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{route('user.index')}}">
                                                <span>
                                                    <i class="fa fa-user"></i><span style="font-size: 15px;"> &nbsp;<b>{{$newuser}}</b> new user has just registerd.</span>
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($newrequest > 0)
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{route('requestorder.index')}}">
                                                <span>
                                                    <i class="fa fa-user"></i><span style="font-size: 15px;"> &nbsp;<b>{{$newrequest}}</b> new product request available.</span>
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($neworder > 0 || $newuser > 0 || $newrequest > 0)
                                        <li class="nav-item">
                                            <div class="text-center">
                                                <a class="dropdown-item" href="{{route('notificationsread')}}">
                                                    <strong>Mark all as read.</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <div class="text-center">
                                                <a class="dropdown-item">
                                                    <strong>No new notifications</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            @yield('content')
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('backend/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('backend/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('backend/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('backend/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('backend/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('backend/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('backend/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('backend/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('backend/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('backend/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('backend/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('backend/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('backend//vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('backend/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('backend/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('backend/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('backend/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('backend/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('backend/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('backend/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('backend/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('backend/build/js/custom.min.js') }}"></script>
    <script>
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

    </script>
    @stack('scripts')

</body>

</html>
