<style>
  body {
    padding-top: 60px;
  }

  #navbar {
    transition: transform 0.3s ease;
    font-weight: 400;
    color: black;
    height: 60px;
  }

  #navbar.hide {
    transform: translateY(-100%);
  }

  #navbar .nav-link:hover {
    text-decoration: underline;
  }

  #navbar .nav-link.active {
    text-decoration: underline;
    font-weight: 500;
  }
</style>

<header>
  <nav id="navbar" class="navbar navbar-expand-lg fixed-top shadow-sm text-dark bg-snow-storm1">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapsible content -->
      <div class="collapse navbar-collapse align-items-center" id="navbarSupportedContent">
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="{{ route('products') }}">All Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled {{ request()->is('about') ? 'active' : '' }}" href="#">About Us</a>
          </li>
        </ul>

        <!-- Search bar (centered) -->
        <form class="d-flex flex-grow-1 my-auto" role="search" style="max-width: 40%; height: 38px; margin-right: 20px;">
          <input class="form-control me-2 w-100" type="search" placeholder="Search..." aria-label="Search" />
          <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>

      <!-- Right icons -->
      <div class="d-flex align-items-center" style="margin-right: 20px;">
        <!-- Shopping cart icon -->
        <a class="nav-link me-3" href="{{ route('cart') }}">
          <i class="fas fa-shopping-cart"></i>
        </a>

        @auth
          <!-- Logged-in user dropdown -->
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="fa-solid fa-user"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ route('profile') }}">My profile</a></li>
              <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
            </ul>
          </div>
        @else
          <!-- Guest dropdown -->
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa-solid fa-user"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
          </ul>
        @endauth
      </div>
    </div>
  </nav>
</header>
