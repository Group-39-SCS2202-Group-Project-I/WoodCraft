<?php 
$cartItemCount = 0;// logic to get the count of items in the cart;
$cartItemCount = $_SESSION['cart']->cart_item_count;
?>

  <style>
    .nav {
      height: var(--header-height);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .nav__img {
      width: 32px;
      border-radius: 50%;
    }

    .nav__logo {
      color: var(--title-color);
      font-weight: 600;
      cursor: pointer;
      /* font-size: 24px; */
    }

    @media screen and (max-width: 767px) {
      .nav {
        justify-content: center;
      }
      .nav__menu {
        position: fixed;
        bottom: 0;
        left: 0;
        background-color: var(--container-color);
        box-shadow: 0 -1px 12px hsla(var(--hue), var(--sat), 15%, 0.15);
        width: 100%;
        height: 4rem;
        padding: 0 1rem;
        display: grid;
        align-content: center;
        border-radius: 1.25rem 1.25rem 0 0;
        transition: .4s;
      }
    }

    .nav__list,
    .nav__link {
      display: flex;
    }

    .nav__link {
      flex-direction: column;
      align-items: center;
      row-gap: 4px;
      color: var(--title-color);
      font-weight: 500;
    }

    .nav__list {
      justify-content: space-around;
    }

    .nav__name {
      font-size: var(--tiny-font-size);
      /* display: none;*/
      /* Minimalist design, hidden labels */
    }

    .nav__icon {
      font-size: 1.5rem;
    }

    /*Active link*/
    .active-link {
      position: relative;
      color: var(--first-color);
      transition: .3s;
    }

    /* Minimalist design, active link */
    /* .active-link::before{
      content: '';
      position: absolute;
      bottom: -.5rem;
      width: 4px;
      height: 4px;
      background-color: var(--first-color);
      border-radius: 50%;
    } */

    /* Change background header */
    .scroll-header {
      box-shadow: 0 1px 12px hsla(var(--hue), var(--sat), 15%, 0.15);
    }

    /*=============== MEDIA QUERIES ===============*/
    /* For small devices */
    /* Remove if you choose, the minimalist design */
    @media screen and (max-width: 320px) {
      .nav__name {
        display: none;
      }

      .nav__logo {
        display: none;
      }

      .nav__logo:first-child {
        /* font-size: 1.5rem; */
        display: block;
      }

      .nav__link:hover {
        color: var(--first-color);
      }
    }

    /* For medium devices */
    @media screen and (min-width: 576px) {
      .nav__list {
        justify-content: center;
        column-gap: 3rem;
      }
    }

    @media screen and (min-width: 767px) {
      body {
        margin: 0;
      }

      .section {
        padding: 7rem 0 2rem;
      }

      .nav {
        height: calc(var(--header-height) + 1.5rem);
        /* 4.5rem */
      }

      .nav__img {
        display: none;
      }

      .nav__icon {
        display: none;
      }

      .nav__name {
        font-size: var(--normal-font-size);
        /* display: block; */
        /* Minimalist design, visible labels */
      }


      /* First design, remove if you choose the minimalist design */
      .active-link::before {
        content: '';
        position: absolute;
        bottom: -.75rem;
        width: 4px;
        height: 4px;
        background-color: var(--first-color);
        border-radius: 50%;
      }

      /* Minimalist design */
      /* .active-link::before{
          bottom: -.75rem;
      } */
    }

    /* For large devices */
    @media screen and (min-width: 1024px) {
      .container {
        margin-left: auto;
        margin-right: auto;
      }

    }

    @media screen and (min-width: 1200px) {
      .container {
        max-width: 1200px;
      }
      
    }

    .navl-cont img {
        max-height: 50px;
        min-height: 30px;
        padding: 10px;
    }

    .navl-cont:hover .nav__logo {
      color: var(--first-color);
    }
  </style>


<header class="header" id="header">
  <nav class="nav container"> 
    <div class="navl-cont">
        <!-- <a class="nav__logo material-icons-outlined" style="font-size: 30px; font-weight: 400; color: var(--primary);"> living </a> <a class="nav__logo" style="padding-left: 5px ;color: var(--primary);"> WoodCraft Furnitures </a> -->
        <img src="<?php echo ROOT ?>/assets/images/Logo_green.png"></div>
    </div>

    <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
            <li class="nav__item">
                <a href="<?php echo ROOT ?>" class="nav__link active-link">
                    <span class="material-symbols-outlined nav__icon">
                        home
                    </span>
                    <span class="nav__name">Home</span>
                </a>
            </li>

            <li class="nav__item">
                <a href="./products.php" class="nav__link">
                    <span class="material-symbols-outlined nav__icon">
                        storefront
                    </span>
                    <span class="nav__name">Shop</span>
                </a>
            </li>



            <li class="nav__item">
                <a href="<?php echo ROOT ?>/about" class="nav__link">
                    <span class="material-symbols-outlined nav__icon">
                        info
                    </span>

                    <span class="nav__name">About Us</span>
                </a>
            </li>



            <li class="nav__item">
                <a href="<?php echo ROOT ?>/contact" class="nav__link">
                    <span class="material-symbols-outlined nav__icon">
                        contact_page
                    </span>
                    <span class="nav__name">Contact Us</span>
                </a>
            </li>

            <!-- <div class="nav-items-right"> -->
                <li class="nav__item">
                    <a href="<?php echo ROOT ?>/cart" class="nav__link">
                    <span class="material-symbols-outlined nav__icon">
                        shopping_cart
                    </span>

                    <span class="nav__name"> cart <?php echo $cartItemCount ?></span>
                    </a>
                </li>

                <?php if(!Auth::logged_in()):?>    
                    <li class="nav__item">
                        <a href="<?php echo ROOT ?>/login" class="nav__link">
                            <span class="material-symbols-outlined nav__icon">
                                login
                            </span>

                            <span class="nav__name">Log In</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="<?php echo ROOT ?>/logout" class="nav__link">
                            <span class="material-symbols-outlined nav__icon">
                                person_add
                            </span>

                            <span class="nav__name">Sign Up</span>
                        </a>
                    </li>

                <?php else:?>
                    <li class="nav__item">
                        <a href="<?php echo ROOT ?>/profile" class="nav__link">
                            <span class="material-symbols-outlined nav__icon">
                                account_circle
                            </span>

                            <span class="nav__name">Hi! <?=Auth::getCustomerName()?></span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="<?php echo ROOT ?>/logout" class="nav__link">
                            <span class="material-symbols-outlined nav__icon">
                                logout
                            </span>

                            <span class="nav__name">Log out</span>
                        </a>
                    </li>
                <?php endif;?>
            <!-- </div> -->
        </ul>
    </div>
  </nav>
</header>

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
                  window.location.href = '<?= ROOT ?>/profile';
                  break;
              case 'toprofile':
                  window.location.href = '<?= ROOT ?>/profile/myProfile';
                  break;
              case 'toregister':
                  window.location.href = '<?= ROOT ?>/signup';
                  break;
              case 'tologin':
                  window.location.href = '<?= ROOT ?>/login';
                  break;
              // case 'tologout':
              //     window.location.href = '<?= ROOT ?>/logout';
              //     break;
              case 'toorders':
                  window.location.href = '<?= ROOT ?>/orders';
                  break;
              case 'tobulk':
                  window.location.href = '<?= ROOT ?>/orders/bulkOrders';
                  break;
              case 'toreviews':
                  window.location.href = '<?= ROOT ?>/review';
                  break;
              // case 'toreturns':
              //     window.location.href = '<?= ROOT ?>/profile/returns';
              //     break;
              default:
                  break;
          }
      });

      document.addEventListener('DOMContentLoaded', function() {
              // Find the logout button
              const logoutButton = document.querySelector('#tologout button');

              // Add a click event listener to the logout button
              logoutButton.addEventListener('click', function() {
                  // Perform a direct navigation to a URL that will trigger logout
                  window.location.href = '<?= ROOT ?>/logout';
              });
          });
</script>

<script src="<?php echo ROOT ?>/assets/js/header.js"></script>