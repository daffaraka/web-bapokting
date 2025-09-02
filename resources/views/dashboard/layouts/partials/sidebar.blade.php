   <div class="sidebar" data-background-color="dark">
       <div class="sidebar-logo">
           <!-- Logo Header -->
           <div class="logo-header" data-background-color="dark">
               <a href="index.html" class="logo">
                   <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                       height="20" />
               </a>
               <div class="nav-toggle">
                   <button class="btn btn-toggle toggle-sidebar">
                       <i class="gg-menu-right"></i>
                   </button>
                   <button class="btn btn-toggle sidenav-toggler">
                       <i class="gg-menu-left"></i>
                   </button>
               </div>
               <button class="topbar-toggler more">
                   <i class="gg-more-vertical-alt"></i>
               </button>
           </div>
           <!-- End Logo Header -->
       </div>
       <div class="sidebar-wrapper scrollbar scrollbar-inner">
           <div class="sidebar-content">
               <ul class="nav nav-secondary">


                    
                   <li class="nav-section">
                       <span class="sidebar-mini-icon">
                           <i class="fa fa-ellipsis-h"></i>
                       </span>
                       <h4 class="text-section">Dashboard</h4>
                   </li>

                   <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                       <a href="{{ route('dashboard') }}">
                           <i class="fas fa-chart-line"></i>
                           <p>Dashboard </p>
                       </a>
                   </li>

                   @role('admin')
                       <li class="nav-section">
                           <span class="sidebar-mini-icon">
                               <i class="fa fa-ellipsis-h"></i>
                           </span>
                           <h4 class="text-section">Frontpage </h4>
                       </li>
                   @endrole

                   <li class="nav-item {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                       <a href="{{ route('berita.index') }}">
                           <i class="fas fa-newspaper"></i>
                           <p>Berita </p>
                       </a>
                   </li>

                   <li class="nav-section">
                       <span class="sidebar-mini-icon">
                           <i class="fa fa-ellipsis-h"></i>
                       </span>
                       <h4 class="text-section">Data</h4>
                   </li>

                   <li class="nav-item {{ request()->routeIs('harga-monitoring.*') ? 'active' : '' }}">
                       <a href="{{ route('harga-monitoring.index') }}">
                           <i class="fas fa-chart-line"></i>
                           <p>Monitoring </p>
                       </a>
                   </li>

                   <li class="nav-item {{ request()->routeIs('perkembangan-harga.*') ? 'active' : '' }}">
                       <a href="{{ route('perkembangan-harga.index') }}">
                           <i class="fas fa-chart-bar"></i>
                           <p>Perkembangan Harga </p>
                       </a>
                   </li>

                   @can('komoditas-read')
                       <li class="nav-item {{ request()->routeIs('komoditas.*') ? 'active' : '' }}">
                           <a href="{{ route('komoditas.index') }}">
                               <i class="fas fa-box"></i>
                               <p> Komoditas </p>
                           </a>
                       </li>
                   @endcan


                   <li class="nav-item {{ request()->routeIs('jenis-komoditas.*') ? 'active' : '' }}">
                       <a href="{{ route('jenis-komoditas.index') }}">
                           <i class="fas fa-list-ul"></i>
                           <p> Jenis Komoditas </p>
                       </a>
                   </li>
                   <li class="nav-item {{ request()->routeIs('pasar.*') ? 'active' : '' }}">
                       <a href="{{ route('pasar.index') }}">
                           <i class="fas fa-store"></i>
                           <p>Pasar</p>
                       </a>
                   </li>


                   <li class="nav-item {{ request()->routeIs('user-uptd.*') ? 'active' : '' }}">
                       <a href="{{ route('user-uptd.index') }}">
                           <i class="fas fa-building"></i>
                           <p>User & UPTD</p>
                       </a>
                   </li>

               </ul>
           </div>
       </div>
   </div>
