<link rel="stylesheet" href="..\fontawesome\css\fontawesome.min.css">
<style>
    #nav-hover {
        text-decoration: none;
        position: relative;
        transition: 0.4s;
    }

    #nav-hover:hover {
        transform: scale(1.05);
    }

    #nav-hover::before {
        content: "";
        position: absolute;
        width: 0;
        height: 4px;
        bottom: 0;
        left: 50%;
        background-color:rgb(255, 255, 255);
        transition: all 0.4s;
    }

    #nav-hover:hover::before {
        width: 100%;
        left: 0;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark warna1">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li id="nav-hover" class="nav-item me-4">
                    <a class="nav-link text-white" href="../userpanel/">Home</a>
                </li>
                <li id="nav-hover" class="nav-item me-4">
                    <a class="nav-link text-white" href="product.php">All Product</a>
                </li>
                <li id="nav-hover" class="nav-item me-4">
                    <a class="nav-link text-white" href="about.php">About Us</a>
                </li>
            </ul>
            <div>
                <input type="text" class="form-control" placeholder="Find Items" aria-describedby="basic-addon2"
                    name="keyword">
            </div>
            <div>
                <button type="submit" class="btn warna2 text-white">Search</button>
            </div>
            <div>
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>
    </div>
</nav>