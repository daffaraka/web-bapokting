  <header id="header" class="header d-flex align-items-center fixed-top ">
      <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

          <a href="/" class="logo d-flex align-items-center">
              <!-- Uncomment the line below if you also wish to use an image logo -->
              <img src="{{ asset('assets/img/logo-bapokting.png') }}" style="min-height: 50px;" alt="">
              <h1 class="sitename">Bapokting</h1>
          </a>

          <nav id="navmenu" class="navmenu">
              <ul>
                  <li><a href="{{ route('frontpage') }}" class="{{ Route::is('frontpage') ? 'active' : '' }}">Home</a>
                  </li>

                  <li><a href="{{ route('profil-bapokting') }}"
                          class="{{ Route::is('profil-bapokting') ? 'active' : '' }}">Profil</a></li>

                  {{-- <li><a href="blog.html">Blog</a></li> --}}
                  <li class="dropdown"><a href="#"><span>Komoditas</span> <i
                              class="bi bi-chevron-down toggle-dropdown"></i></a>
                      <ul>
                          <li><a href="">Harga HET</a></li>
                          <li><a href="{{ route('barang-pokok') }}">Barang Pokok</a></li>
                          <li><a href="{{ route('barang-penting') }}">Barang Penting</a></li>
                          <li><a href="{{ route('harga-per-pasar') }}">Perbandingan Harga Bapok</a></li>

                      </ul>
                  </li>
                  <li class="dropdown"><a href="#"><span>Distributor</span> <i
                              class="bi bi-chevron-down toggle-dropdown"></i></a>
                      <ul>
                          <li><a href="">Distributor Barang Pokok</a></li>
                          <li><a href="">Distributor Barang Penting</a></li>
                      </ul>
                  </li>
                  @if (Route::has('login'))
                      @auth
                          <li><a href="{{ url('/dashboard') }}"
                                  class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a></li>
                      @else
                          <li><a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                                  in</a></li>
                      @endauth
                  @endif
                  {{-- <li><a href="#contact">Contact</a></li> --}}
              </ul>
              <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
          </nav>

      </div>
  </header>
