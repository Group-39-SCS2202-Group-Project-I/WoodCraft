
    <nav class="nav-main">
        <div class="logo"><img src="<?php echo ROOT ?>/assets/images/Logo_green.png"></div>
        <div class="nav-item">
            <li><a id="tohome">Home</a></li>
            <li><a id="toproducts">Shop</a></li>
            <li><a id="toabout">About Us</a></li>
            <li><a id="tocontact">Contact Us</a></li>
        </div>
        <div class="nav-items-right">
        <form class="search-form" action="#">
                <div class="search-hidden">
                <span class="search-icon-hidden material-symbols-outlined">search</span>
                </div>
                <div class="search">
                    <span class="search-icon material-symbols-outlined">search</span>
                    <input type="search" class="search-item" placeholder="Search for products.." required>
                </div>
            </form> 
            <li>
                <a id="tocart">
                <span class="material-symbols-outlined">shopping_cart</span>
                  <span id="tocart" class="cart-badge">0</span>
                </a>
                <!-- <ul class="dropdown-menu hidden">
                  <li class="empty">Your cart is empty.</li>
                </ul> -->
            </li>
            <li>
                <a href="#">
                <span class="material-symbols-outlined">account_circle</span>
                  <span>Profile</span>
                </a>
                <ul class="dropdown-menu hidden">
                  <li id="toprofile"><a>My Account</a></li>
                  <li><a href="#">Orders</a></li>
                  <li><a href="#">Wishlist</a></li>
                  <li>
                    <button id="tologin">Login</button>
                  </li>
                  <li id="logout">
                    <button>Logout</button>
                  </li>
                  <hr>
                  <li>
                    <span>not registered yet?</span>
                    <button id="toregister">Signup</button>
                  </li>
                </ul>
            </li>
            
        </div>

        <script>
  // Add event listener to the parent element
  document.querySelector('.nav-main').addEventListener('click', (event) => {
    const target = event.target;
    const id = target.id;

    // Handle different menu items based on their IDs
    switch (id) {
      case 'tohome':
        window.location.href = '<?= ROOT ?>';
        break;
      case 'toproducts':
        window.location.href = '<?= ROOT ?>/products';
        break;
      case 'toabout':
        window.location.href = '<?= ROOT ?>/about';
        break;
      case 'tocontact':
        window.location.href = '<?= ROOT ?>/contact';
        break;
      case 'tocart':
        window.location.href = '<?= ROOT ?>/cart';
        break;
      case 'toprofile':
        window.location.href = '<?= ROOT ?>/profile';
        break;
      case 'toregister':
        window.location.href = '<?= ROOT ?>/signup';
        break;
      case 'tologin':
        window.location.href = '<?= ROOT ?>/login';
        break;
      default:
        break;
    }
  });
</script>

        
    </nav>



    <script src="<?php echo ROOT ?>/assets/js/header.js"></script>