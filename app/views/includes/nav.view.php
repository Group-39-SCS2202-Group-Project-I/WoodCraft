
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

            <?php if(!Auth::logged_in()):?>
              <li><a id="tologin">Login</a></li>
              <li><a id="toregister">SignUp</a></li>
            <?php else:?>
              <li class="dropdown"><a href="#"><span>Hi! <?=Auth::getCustomerName()?></span></a>
                <ul class="dropdown-menu hidden">
                  <li><a href="<?=ROOT?>/customer/index/<?= Auth::getCustomerId()?>">Manage My Account</a></li>
                  <li><a href="<?=ROOT?>/customer/orders/<?= Auth::getCustomerId()?>">My Orders</a></li>
                  <!-- <li><a href="<?=ROOT?>/customer/wishlist/<?= Auth::getCustomerId()?>">My Wishlist</a></li>
                  <li><a id="toreviews"><span>My Reviews</span></a></li>
                  <li><a id="toreturns"><span>My Returns & Cancellations</span></a></li> -->
                  <li><a href="<?=ROOT?>/login"><span>LogOut</span></a></li>
                </ul>
              </li>
            <?php endif;?>

            <!-- <li>
                <a href="<?=ROOT?>">
                  <span class="fas fa-user"></span>
                  <span>Profile</span>
                </a>

                <ul class="dropdown-menu hidden">
                  <li><a href="<?=ROOT?>/manage/profile"><span>My Account</span></a></li>
                  <li><a href="<?=ROOT?>"><span>My Orders</span></a></li>
                  <li><a href="<?=ROOT?>"><span>My Wishlist</span></a></li>
                  <li><a href="<?=ROOT?>"><span>My Reviews</span></a></li>
                  <li><a href="<?=ROOT?>"><span>My Returns & Cancellations</span></a></li>

                  <li><a href="<?=ROOT?>"><span></span></a></li>
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
            </li> -->
            
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
            case 'tomanage-acc':
            window.location.href = '<?= ROOT ?>/customer/<?= Auth::getCustomerID() ?>';
              break;
            case 'toregister':
            window.location.href = '<?= ROOT ?>/signup';
              break;
            case 'tologin':
            window.location.href = '<?= ROOT ?>/login';
              break;
            case 'toorders':
            window.location.href = '<?= ROOT ?>/customer/orders';
              break;
            case 'towishlist':
            window.location.href = '<?= ROOT ?>/customer/wishlist';
              break;
            case 'toreviews':
            window.location.href = '<?= ROOT ?>/customer/reviews';
              break;
            case 'toreturns':
            window.location.href = '<?= ROOT ?>/customer/returns';
              break;
            default:
              break;
          }
        });
      </script>

        
    </nav>



    <script src="<?php echo ROOT ?>/assets/js/header.js"></script>