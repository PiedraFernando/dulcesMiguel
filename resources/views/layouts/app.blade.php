<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"  ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" defer></script>
    @stack('scripts')
    <script src="dist/js/adminlte.js"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app">
        <div class="wrapper">

            
            <!-- /.navbar -->
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
            </nav>

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ url('/') }}" class="brand-link">
                    <img src="{{asset('dist/img/AdminLTELogo.png  ') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">Dulces Miguel</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src=" {{asset('dist/img/user2-160x160.jpg ') }}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">
                                @guest
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                                @else
                                {{ Auth::user()->name }}
                                <a class="dropdown-item btn btn-outline-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                    Cerrar Sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>

                                @endguest
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="/totalventas"
                                   class="{{ Request::path() === 'totalventas' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon  fas fa-money-bill"></i>
                                    <p>
                                        Total ventas

                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{url('usuarios') }} "
                                    class="{{ Request::path() === 'usuarios' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Usuarios
                                        <?php use App\User; $users_count = User::all()->count(); ?>
                                        <span class="right badge badge-danger">{{ $users_count ?? '0' }}</span>
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{url('producto') }}"
                                    class="{{ Request::path() === 'productos' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-barcode"></i>
                                    <p>
                                        Productos
                                        <?php use App\Producto; $productos_cont = Producto::all()->count(); ?>
                                        <span class="right badge badge-danger">{{ $productos_cont ?? '0' }}</span>

                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{url('categorias') }}"
                                   class="{{ Request::path() === 'categorias' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-sitemap"></i>
                                    <p>
                                        Categorias
                                        <?php use App\Categoria; $categorias_count = Categoria::all()->count(); ?>
                                        <span class="right badge badge-danger">{{ $categorias_count ?? '0' }}</span>
                                    </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{url('ventas') }}"
                                   class="{{ Request::path() === 'ventas' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fa fa-shopping-cart"></i>
                                    <p>
                                        Ventas
                                        <?php use App\Ventas;
                                        $dia =  date("d/m/Y");
                                        $ventas_cont = Ventas::where("fecha","=",$dia)->get()->count(); ?>
                                        <span class="right badge badge-danger">{{ $ventas_cont ?? '0' }}</span>

                                    </p>
                                </a>
                            </li>

                            

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">

                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">


            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
    </div>
</body>

</html>
