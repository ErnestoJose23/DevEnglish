<!doctype html>
<html lang="es">
        
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="PINF2019">
    <meta name="robots" content="noindex">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/vendor/sweetalert/css/sweetalert.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="/intranet">
        <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-tachometer-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <li class="nav-item ">
            <a class="nav-link" href="/">
                <i class="fas fa-fw fa-home"></i>
            <span>Inicio</span></a>
        </li>
        @if(Auth::user()->isAdmin())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('topic.index') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Temario</span></a> 
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('resource.index') }}">
                    <i class="fas fa-fw fa-bookmark"></i>
                    <span>Recursos</span></a> 
            </li>

            <li class="nav-item ">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Usuarios</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Usuarios</h6>
                        
                        <a class="collapse-item" href="{{route('user.indexType', 1)}}">Administradores</a>
                        <a class="collapse-item" href="{{route('user.indexType', 2)}}">Profesores</a>
                        <a class="collapse-item" href="{{route('user.indexType', 3)}}">Estudiantes</a>

                        <a class="collapse-item " href={{route('user.index')}}>Administrar Usuarios</a>
                        </div>
                    </div>
                </li>

            <li class="nav-item">
            <a class="nav-link" href="{{ route('post.index') }}">
                <i class="fas fa-comments"></i>
                <span>Foro</span></a> 
            </li>
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-edit"></i>
                    <span>Pruebas</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pruebas</h6>
                    <a class="collapse-item" href="{{route('problem.indexType', 1)}}">Tipo Test</a>
                    <a class="collapse-item" href="{{route('problem.indexType', 2)}}">Listening</a>
                    <a class="collapse-item" href="{{route('problem.indexType', 3)}}">Rellenar huecos</a>
                    <a class="collapse-item" href="{{route('problem.indexType', 4)}}">Encontrar fallo</a>
                    <a class="collapse-item " href={{route('problem.index')}}>Administrar Pruebas</a>
                    </div>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('topic.index') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Chat/Preguntas</span></a> 
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('teachertopic.index') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Temario</span></a> 
            </li>
        @endif

        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
            
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth()->user()->name }}</span>
                    <span class="fa fa-user-circle fa-2x"></span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('usuario.edit', Auth::user())}}">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Opciones
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Salir
                    </a>
                    </div>
                </li> 

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" style="margin-top: 20px;">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session()->get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
            </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                <span>Copyright &copy; DevEnglish</span>
                </div>
            </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/vendor/sweetalert/js/sweetalert.js"></script>
    <script src="/js/admin.js"></script>
    <script src="/js/app.js"></script>
    
    @yield('js')

</body>

</html>
