<!-- Navbar -->
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
  <nav id="navbar" class="navbar navbar-expand-lg fixed-top shadow-sm bg-snow-storm1">
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
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : ''; ?>"
              href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'product.php' ? 'active' : ''; ?>"
              href="products.php">All Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>"
              href="about.php">About Us</a>
          </li>
        </ul>

        <!-- Search bar (centered) -->
        <form class="d-flex flex-grow-1 my-auto" role="search"
          style="max-width: 40%; height: 38px; margin-right: 20px;">
          <input class="form-control me-2 w-100" type="search" placeholder="Search..." aria-label="Search" />
          <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>

      <!-- Right icons -->
      <div class="d-flex align-items-center" style="margin-right: 20px;">
        <!-- Shopping cart icon -->
        <a class="nav-link me-3" href="shopping-cart.php">
          <i class="fas fa-shopping-cart"></i>
        </a>


        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
          <!-- Show user dropdown -->
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="fa-solid fa-user"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="profile.php">My profile</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </div>
        <?php else: ?>
          <!-- Show login button -->
           <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="fa-solid fa-user"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="login.php">Login</a></li>
            </ul>
        <?php endif; ?>
      </div>
    </div>
  </nav>
</header>