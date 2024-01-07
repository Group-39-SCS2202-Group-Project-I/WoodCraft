
    <nav>
        <div class="logo"><img src="<?php echo ROOT ?>/assets/images/Logo_green.png"></div>
        <div class="nav-item">
            <li><a href="#">Home</a></li>
            <li><a href="#">Shop</a></li>
            <!-- <li><a href="#">Discounts</a></li> -->
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
        </div>
        <div class="nav-items-right">
            <form class="search-form" action="#">
                <div class="search-hidden">
                    <span class="search-icon-hidden fas fa-search"></span>
                </div>
                <div class="search">
                    <span class="search-icon fas fa-search"></span>
                    <input type="search" class="search-item" placeholder="Search for products.." required>
                </div>
            </form> 
            <li>
                <a href="#">
                  <span class="fas fa-shopping-cart"></span>
                  <span class="cart-badge">0</span>
                </a>
                <ul class="dropdown-menu hidden">
                  <li class="empty">Your cart is empty.</li>
                </ul>
            </li>
            <li>
                <a href="#">
                  <span class="fas fa-user"></span>
                  <span>Profile</span>
                </a>
                <ul class="dropdown-menu hidden">
                  <li><a href="#">My Account</a></li>
                  <li><a href="#">Orders</a></li>
                  <li><a href="#">Wishlist</a></li>
                  <li>
                    <button>Logout</button>
                  </li>
                  <hr>
                  <li>
                    <span>not registered yet?</span>
                    <button>Signup</button>
                  </li>
                </ul>
            </li>
            
        </div>
        
    </nav>

    <script src="<?php echo ROOT ?>/assets/js/header.js"></script>
