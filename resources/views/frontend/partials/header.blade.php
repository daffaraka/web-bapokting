  <header id="header" class="header d-flex align-items-center fixed-top {{ Route::currentRouteName() != 'frontpage' ? 'sticky-top' : ''}} ">
      <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

          <a href="/" class="logo d-flex align-items-center">
              <!-- Uncomment the line below if you also wish to use an image logo -->
              <img src="{{asset('assets/img/logo-bapokting.jpeg')}}" style="min-height: 50px;" alt="">
              <h1 class="sitename">Bapokting</h1>
          </a>

          <nav id="navmenu" class="navmenu">
              <ul>
                  <li><a href="{{ route('frontpage') }}" class="{{ Route::is('frontpage') ? 'active' : ''}}">Home</a></li>

                  <li><a href="{{ route('profil-bapokting') }}" class="{{ Route::is('profil-bapokting') ? 'active' : ''}}">Profil</a></li>

                  {{-- <li><a href="blog.html">Blog</a></li> --}}
                  <li class="dropdown"><a href="#"><span>Komoditas</span> <i
                              class="bi bi-chevron-down toggle-dropdown"></i></a>
                      <ul>
                          <li><a href="">Harga HET</a></li>
                          <li><a href="">Barang Pokok</a></li>
                          <li><a href="">Barang Penting</a></li>

                      </ul>
                  </li>
                  <li class="dropdown"><a href="#"><span>Distributor</span> <i
                              class="bi bi-chevron-down toggle-dropdown"></i></a>
                      <ul>
                          <li><a href="">Distributor Barang Pokok</a></li>
                          <li><a href="">Distributor Barang Penting</a></li>
                      </ul>
                  </li>
                  {{-- <li><a href="#contact">Contact</a></li> --}}
              </ul>
              <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
          </nav>

      </div>
  </header>
