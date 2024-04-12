<?php $this->view('includes/header', $data) ?>

<header>
  <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/cart.css">
  <?php $this->view('includes/nav', $data) ?>
  <?php $this->view('webstore/header-section', $data) ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</header>

<body>

  <div class="container-cart">
    <div class="cart">
        
      <div class="top">
        <h2>Your Cart</h2>
      </div> 
      
      <?php

        $subtotal = 0;
        $discount = 0;
        $total = 0;
        $delivery = 15;
        $cart = new cartM();
        $data['cart'] = $cart->findAll();
        $tables = ['product'];
        $columns = ['*'];
        $condition = ['product.product_id = cart.product_id'];
        $cartItem = $cart->join($tables, $columns, $condition, );

        if (isset($cartItem) && !empty($cartItem)) {
          foreach ($cartItem as $cartItems) {
            ?>
            <td>
              <div class="smallcart">
                <div class="product">
                  <div class="imag-box">
                    <img class="img" src="img1/<?php echo $cartItems->product_image; ?>" width="80vw" height="80vw" alt="<?php echo $cartItems->product_name; ?>">
                  </div>
                  <div class="details">
                    <div class="pdetails">
                      <div class="product-details">
                        <p><?php echo  $cartItems->name ?></p>
                        <p class="unit-price"><?php echo  $cartItems->price ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="Qdetails">
                    <div class="remove">
                      <button type="submit" name="remove" class="remove-button" style="border: none; background: none;">
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
                    <div class="quantity">
                      <button type="button" class="decrease"><i class="fas fa-minus"></i></button>
                      <input type="text" value="1" class="form-control">
                      <button type="button" class="increase"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <?php

            $subtotal += $cartItems->price; // Accumulate subtotal
          }
          $discount = 0.2 * $subtotal; // 20% discount
          $total = $subtotal - $discount + $delivery;
        } else {
          echo "<h5>Cart Is Empty</h5>";
        }
      ?>
    </div>

    <div class="summary">
      <div class="top">
        <h2>Order Summary</h2>
      </div>
      <div class="detail">
        <h2 id="subtotal">Subtotal<span>$<?php echo $subtotal ?></span></h2>
        <h2 id="discount">Discount(-20%)<span>-$<?php echo $discount ?></span></h2>
        <h2 id="delivery">Delivery<span>-$<?php echo $delivery ?></span></h2>
        <hr />
        <h2 id="total">Total<span>$<?php echo $total ?></span></h2>
      </div>
      <div class="promo">
        <div class="promocode">
          <input class="promocode" type="text" placeholder="Add the promocode " id="promoCode" />
        </div>
        <button class="cart-first-btn" id="promo" onclick="promo()">Apply</button>
      </div>
      <div style="padding: 0 10px; margin-bottom: 20px">
        <button class="checkout">Check Out</button>
      </div>
    </div>
  </div>

  <?php $this->view('includes/footer', $data) ?>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const decreaseButtons = document.querySelectorAll(".decrease");
      const increaseButtons = document.querySelectorAll(".increase");
      const quantityInputs = document.querySelectorAll(".quantity input");
      const unitPrices = document.querySelectorAll(".unit-price");
      const subtotalElement = document.getElementById("subtotal");
      const discountElement = document.getElementById("discount");
      const deliveryElement = document.getElementById("delivery");
      const totalElement = document.getElementById("total");

      function updateTotal() {
        let newSubtotal = 0;
        quantityInputs.forEach(function (input, index) {
          const quantity = parseInt(input.value, 10);
          const unitPrice = parseFloat(unitPrices[index].innerText); // Retrieve unit price from innerText
          newSubtotal += quantity * unitPrice;
        });

        const newDiscount = 0.2 * newSubtotal;
        const newTotal = newSubtotal - newDiscount + <?php echo $delivery; ?>;

        subtotalElement.innerText = "Subtotal: $" + newSubtotal.toFixed(2);
        discountElement.innerText = "Discount(-20%): -$" + newDiscount.toFixed(2);
        deliveryElement.innerText = "Delivery: -$<?php echo $delivery; ?>";
        totalElement.innerText = "Total: $" + newTotal.toFixed(2);
      }

      decreaseButtons.forEach(function (button) {
        button.addEventListener("click", function () {
          const input = button.nextElementSibling;
          const currentValue = parseInt(input.value, 10);
          if (currentValue > 1) {
            input.value = currentValue - 1;
            updateTotal();
          }
        });
      });

      increaseButtons.forEach(function (button) {
        button.addEventListener("click", function () {
          const input = button.previousElementSibling;
          const currentValue = parseInt(input.value, 10);
          input.value = currentValue + 1;
          updateTotal();
        });
      });

      quantityInputs.forEach(function (input) {
        input.addEventListener("input", updateTotal);
      });

      // Initial update
      updateTotal();
    });
  </script>
</body>
</html>
