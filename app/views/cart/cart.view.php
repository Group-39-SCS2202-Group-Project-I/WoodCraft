<?php
$this->view('includes/header', $data) ?>

<header>

  <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/cart.css ">
  <?php $this->view('includes/nav', $data) ?>
  <?php $this->view('webstore/header-section', $data) ?>
</header>



<body>



  <div class="container-cart">
    <div class="cart">

      <h2>YOUR CART</h2>
      <div class="cartimage">
         

      </div>
     
      <div class="cartdetails">
      <?php
      $cart = new cartM();
      $data['cart'] = $cart->findAll();
      $tables = ['product'];
      $columns = ['*'];
      $condition = ['product.product_id = cart.product_id'];
      $cartItem = $cart->join($tables, $columns, $condition, );
      // $cartItem = $data['cart'];
      
      $subtotal = 0;
      $discount = 0;
      $total = 0;
      $delivery = 15;

      // Check if the products data is set and not empty
    
      // Check if cart items are set and not empty
      if (isset($cartItem) && !empty($cartItem)) {
        foreach ($cartItem as $cartItems) {
          // show($cartItem);
          if (isset($productid)) {

            $cart->quantity += $quantity;
          }




        
          echo "Quantity: " . $cartItems->quantity . "<br>";
          echo "name: " . $cartItems->name . "<br>";
          echo "price" . $cartItems->price . "<br>";

          // echo "price: " . $cartItems->price. "<br>";
      

          echo "<hr>";
        }
      } else {
        echo "Your Cart is Empty";
      }

      ?>
      </div>



<!-- 
      <script>
        document.addEventListener("DOMContentLoaded", function () {
          const decreaseButtons = document.querySelectorAll(".decrease");
          const increaseButtons = document.querySelectorAll(".increase");

          decreaseButtons.forEach(function (button) {
            button.addEventListener("click", function () {
              const input = button.nextElementSibling;
              const currentValue = parseInt(input.value, 10);
              if (currentValue > 1) {
                input.value = currentValue - 1;
              }
            });
          });

          increaseButtons.forEach(function (button) {
            button.addEventListener("click", function () {
              const input = button.previousElementSibling;
              const currentValue = parseInt(input.value, 10);
              input.value = currentValue + 1;
            });
          });
        });

      </script> -->

    </div>


    <div class="summary">
      <div class="top">
        <h2>Order Summary</h2>
      </div>
      <div class="detail">
        <h2 id="subtotal">Subtotal<span>$
            <?php echo $subtotal ?>
        </h2>
        </span></h2>
        <h2 id="discount">Discount(-20%)<span>-$
            <?php echo $discount ?>
          </span></h2>
        <h2 id="delivery">Delivery<span>-$
            <?php echo $delivery ?>
          </span></h2>

        <hr />
        <h2 id="total">Total<span>$
            <?php echo $total ?>
          </span></h2>
      </div>


      <div class="promo">
        <div class="promocode">
          <input class="promocode" type="text" placeholder="Add the promocode " id="promoCode" />
        </div>

        <button class="cart-first-btn" id="promo" onclick="promo()">Apply</button>

      </div>



      ?> 
      <div style="padding: 0 10px; margin-bottom: 20px">
        <button class="checkout">Check Out</button>
      </div>
    </div>

  </div>

</body>
<?php $this->view('includes/footer', $data) ?>
<style>
  .cart{
    display: flexbox;
    flex-direction: columns;
  }
  .cartimage{
    display: flexbox;
    border-radius: 1rem;
    background-color: aqua;
  }
  .cartdetails{
    display: flexbox;
    
  }
  
</style>
</html>