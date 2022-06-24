<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <base href="{{\URL::to('/')}}">
 <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="{{App\Models\Settings::value('favicon')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="btn btn-sm btn-dark mr-1" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('sales.create')}}" class=" btn btn-sm btn-dark"><i class=" fas fa-shopping-cart"></i> Point de vente</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block ml-2">
        <a href="{{route('inventory.stats')}}" class=" btn btn-sm btn-dark">état du stock</a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
         <li class="nav-item dropdown">

                                    <a id="navbarDropdown" class="btn btn-sm btn-dark " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                         <div class="float-right d-none d-sm-inline">
                                          <p> <i class="fas fa-bars"></i> {{Auth()->user()->name}}  </p>
                                        </div>
                                    </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('se déconnecter') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                </div>



                            </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{App\Models\Settings::value('logo')}}"  class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">JnanateWood</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->


      <!-- SidebarSearch Form -->
      <div class="form-inline ">
        <div class="input-group mt-5" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link">
                        <i class="fas fa-globe nav-icon"></i>
                        <p>Tableau de bord</p>
                        </a>
            </li>
            <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link">
                    <i class="fas fa-clone nav-icon"></i>
                    <p>categories
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('categories.index')}}" class="nav-link">
                        <i class="fas fa-bars nav-icon"></i>
                        <p>toute les categories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('categories.create')}}" class="nav-link">
                        <i class="fas fa-plus nav-icon"></i>
                        <p>ajouter category</p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                    <a href="{{route('products.index')}}" class="nav-link">
                    <i class="fas fa-dice-d6  nav-icon"></i>
                    <p>produits
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('products.index')}}" class="nav-link">
                        <i class="fas fa-bars nav-icon"></i>
                        <p>toute les produits</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('products.create')}}" class="nav-link">
                        <i class="fas fa-plus nav-icon"></i>
                        <p>ajouter produit</p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                    <a href="{{route('customers.index')}}" class="nav-link">
                    <i class="fas fa-users-cog nav-icon"></i>
                    <p>clients
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('customers.index')}}" class="nav-link">
                        <i class="fas fa-bars nav-icon"></i>
                        <p>toute les clients</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('customers.create')}}" class="nav-link">
                        <i class="fas fa-plus nav-icon"></i>
                        <p>ajouter client</p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                    <a href="{{route('transactions.index')}}" class="nav-link">
                    <i class="fas fa-money-bill-alt nav-icon"></i>
                    <p> financières
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('transactions.type', ['type' => 'expense'])  }}" class="nav-link">
                        <i class="fas fa-arrow-left nav-icon"></i>
                        <p>Frais et dépenses</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transactions.type', ['type' => 'income'])  }}" class="nav-link">
                        <i class="fas fa-arrow-right nav-icon"></i>
                        <p>Recette et revenue</p>
                        </a>
                    </li>

                     <li class="nav-item">
                        <a href="{{ route('methods.index') }}" class="nav-link">
                        <i class="fas fa-credit-card  nav-icon"></i>
                        <p>mode de paiment</p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="fas fa-chart-bar nav-icon"></i>
                    <p>statistiques
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('inventory.stats')}}" class="nav-link">
                        <i class="fas fa-suitcase nav-icon"></i>
                        <p>inventaire</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('stats')}}" class="nav-link">
                        <i class="fas fa-money-bill-alt nav-icon"></i>
                        <p>finance</p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                    <a href="{{route('sales.index')}}" class="nav-link">
                    <i class="fas fa-shopping-cart nav-icon"></i>
                    <p>ventes
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('sales.index')}}" class="nav-link">
                        <i class="fas fa-bars nav-icon"></i>
                        <p>toutes les ventes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('sales.create')}}" class="nav-link">
                        <i class="fas fa-plus nav-icon"></i>
                        <p>ajouter vente</p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                    <a href="{{route('settings.index')}}" class="nav-link">
                    <i class="fas fa-cog nav-icon"></i>
                    <p>Réglage
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('settings.index')}}" class="nav-link">
                        <i class="fas fa-cog nav-icon"></i>
                        <p>paramétres</p>
                        </a>
                    </li>


                </ul>
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


    <!-- Main content -->
    <div class="content">
      @yield('content')
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <footer class="main-footer" style="background-color: rgba(255, 255, 255, 0.74)">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      contactez-nous!
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022 <a href="#">hraoui mohamed</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
  {{-- <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script> --}} <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
        <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
        <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!-- Chart JS -->
        {{-- <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script> --}}
        <!--  Notifications Plugin    -->
        <script src="{{ asset('assets') }}/js/plugins/bootstrap-notify.js"></script>

        <script src="{{ asset('assets') }}/js/white-dashboard.min.js?v=1.0.0"></script>
        <script src="{{ asset('assets') }}/js/theme.js"></script>
        <script>
            $(document).ready(function() {
                $().ready(function() {
                    $sidebar = $('.sidebar');
                    $navbar = $('.navbar');
                    $main_panel = $('.main-panel');

                    $full_page = $('.full-page');

                    $sidebar_responsive = $('body > .navbar-collapse');
                    sidebar_mini_active = true;
                    white_color = false;

                    window_width = $(window).width();

                    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                    $('.fixed-plugin a').click(function(event) {
                        if ($(this).hasClass('switch-trigger')) {
                            if (event.stopPropagation) {
                                event.stopPropagation();
                            } else if (window.event) {
                                window.event.cancelBubble = true;
                            }
                        }
                    });

                    $('.fixed-plugin .background-color span').click(function() {
                        $(this).siblings().removeClass('active');
                        $(this).addClass('active');

                        var new_color = $(this).data('color');

                        if ($sidebar.length != 0) {
                            $sidebar.attr('data', new_color);
                        }

                        if ($main_panel.length != 0) {
                            $main_panel.attr('data', new_color);
                        }

                        if ($full_page.length != 0) {
                            $full_page.attr('filter-color', new_color);
                        }

                        if ($sidebar_responsive.length != 0) {
                            $sidebar_responsive.attr('data', new_color);
                        }
                    });

                    $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                        var $btn = $(this);

                        if (sidebar_mini_active == true) {
                            $('body').removeClass('sidebar-mini');
                            sidebar_mini_active = false;
                            whiteDashboard.showSidebarMessage('Sidebar mini deactivated...');
                        } else {
                            $('body').addClass('sidebar-mini');
                            sidebar_mini_active = true;
                            whiteDashboard.showSidebarMessage('Sidebar mini activated...');
                        }

                        // we simulate the window Resize so the charts will get updated in realtime.
                        var simulateWindowResize = setInterval(function() {
                            window.dispatchEvent(new Event('resize'));
                        }, 180);

                        // we stop the simulation of Window Resize after the animations are completed
                        setTimeout(function() {
                            clearInterval(simulateWindowResize);
                        }, 1000);
                    });

                    $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
                            var $btn = $(this);

                            if (white_color == true) {
                                $('body').addClass('change-background');
                                setTimeout(function() {
                                    $('body').removeClass('change-background');
                                    $('body').removeClass('white-content');
                                }, 900);
                                white_color = false;
                            } else {
                                $('body').addClass('change-background');
                                setTimeout(function() {
                                    $('body').removeClass('change-background');
                                    $('body').addClass('white-content');
                                }, 900);

                                white_color = true;
                            }
                    });

                    $('.light-badge').click(function() {
                        $('body').addClass('white-content');
                    });

                    $('.dark-badge').click(function() {
                        $('body').removeClass('white-content');
                    });
                });
            });
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.23.0/slimselect.min.js"></script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
@yield('scripts')
@stack('javascript-internal')

</body>
</html>
