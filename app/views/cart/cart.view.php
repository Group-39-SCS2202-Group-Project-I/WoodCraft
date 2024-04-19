<?php $this->view('includes/header', $data) ?>

<head>
  <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/cart.css">
  <?php $this->view('includes/nav', $data) ?>
  <?php $this->view('webstore/header-section', $data) ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

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
      // $cartProdcts = new cartProduct();
      // $data['cart_products'] = $cartProdcts->findAll();
      $cartProdcts = $data['cart_products'];
      show($cartProdcts);

      // $cart = new CartDetails();
      // $data['cart'] = $cart->findAll();
      $cart = $data['cart'];
      show($cart);

      // $tables = ['product'];
      // $columns = ['*'];
      // $condition = ['product.product_id = cart_products.product_id'];
      // $cartItem = $cartProducts->join($tables, $columns, $condition,);
      ?>

      

      <?php
      if (isset($cartItem) && !empty($cartItem)) {
        foreach ($cartItem as $cartItems) {
          show($cartItems);
      ?>
          <td>
            <div class="smallcart">
              <div class="product">
                <div class="checkboxe">
                  <input type="checkbox" class="select-checkbox" data-product-id="<?php echo $cartItems->product_id; ?>" <?php echo ($cartItems->selected == 1) ? 'checked' : ''; ?>>


                </div>
                <div class="imag-box">
                  <!-- check this -->
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
                    <button type="button" class="remove-button" data-product-id="<?php echo $cartItems->product_id; ?>">
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>



                  <div class="quantity">
                    <button type="button" class="decrease" data-product-id="<?php echo $cartItems->product_id; ?>"><i class="fas fa-minus"></i></button>
                    <input type="text" value="<?php echo $cartItems->quantity; ?>" class="form-control">
                    <button type="button" class="increase" data-product-id="<?php echo $cartItems->product_id; ?>"><i class="fas fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </td>
      <?php

          if ($cartItems->selected === 'true') {
            // Only consider selected items for calculation
            $subtotal += $cartItems->price; // Accumulate subtotal
            $selectedItemsCount++; // Increment the selected items counter
          }
          // Accumulate subtotal
        }
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
        <button class="checkout" onclick="redirectToCheckout()">Check Out</button>
      </div>

    </div>
  </div>
  <?php $this->view('includes/footer', $data) ?>

  <script>
    function redirectToCheckout() {

      var checkoutURL = "<?php echo ROOT . '/checkout'; ?>";

      window.location.href = checkoutURL;
    }


    document.addEventListener("DOMContentLoaded", function() {
      const decreaseButtons = document.querySelectorAll(".decrease");
      const increaseButtons = document.querySelectorAll(".increase");
      const quantityInputs = document.querySelectorAll(".quantity input");
      const unitPrices = document.querySelectorAll(".unit-price");
      const selectCheckboxes = document.querySelectorAll(".select-checkbox");
      const subtotalElement = document.getElementById("subtotal");
      const discountElement = document.getElementById("discount");
      const deliveryElement = document.getElementById("delivery");
      const totalElement = document.getElementById("total");
      const delivery = <?php echo $delivery; ?>;


    //////////////////////////////////

    
      function updateTotal() {
        let newSubtotal = 0;

        // Loop through each product
        quantityInputs.forEach(function(input, index) {
          const quantity = parseInt(input.value, 10);
          const unitPrice = parseFloat(unitPrices[index].innerText);

          // Check if the checkbox is checked
          if (selectCheckboxes[index].checked) {
            newSubtotal += quantity * unitPrice;
          }
        });

        const newDiscount = 0.2 * newSubtotal;
        const newTotal = newSubtotal - newDiscount + delivery;

        subtotalElement.innerText = "Subtotal: $" + newSubtotal.toFixed(2);
        discountElement.innerText = "Discount(-20%): -$" + newDiscount.toFixed(2);
        deliveryElement.innerText = "Delivery: -$" + delivery.toFixed(2);
        totalElement.innerText = "Total: $" + newTotal.toFixed(2);
      }


      /////////////////////////////////////////////////////////


      decreaseButtons.forEach(function(button) {
        button.addEventListener("click", function() {
          const input = button.nextElementSibling;
          const currentValue = parseInt(input.value, 10);
          const productId = button.dataset.productId;
          if (currentValue > 1) {
            input.value = currentValue - 1;
            updateTotal();
            updateCart(productId, input.value); // Update cart with new quantity
          }
        });
      });

      increaseButtons.forEach(function(button) {
        button.addEventListener("click", function() {
          const input = button.previousElementSibling;
          const currentValue = parseInt(input.value, 10);
          const productId = button.dataset.productId;
          input.value = currentValue + 1;
          updateTotal();
          updateCart(productId, input.value); // Update cart with new quantity
        });
      });

      quantityInputs.forEach(function(input) {
        input.addEventListener("input", function() {
          const productId = input.dataset.productId;
          updateTotal();
          updateCart(productId, input.value); // Update cart with new quantity
        });
      });

      selectCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener("change", updateTotal); // Update total whenever a checkbox is checked or unchecked
      });

      // Initial update
      updateTotal();

      // AJAX function to update the cart
      function updateCart(pid, quantity) {
        const ROOT = "http://localhost/wcf/"; // Update with your server URL
        $.ajax({
          url: ROOT + 'Cart', // Endpoint to handle updating the cart
          data: {
            pid: pid,
            quantity: quantity,
            action: 'update'
          }, // Include the updated quantity and action
          method: "POST",
        }).done(function(response) {
          console.log(response);
          $('#loader').hide();
          $('.alert').show();
          $('#result').html(response);
          // You may need to parse the response JSON and update the table accordingly
        });
      }

      // Function to handle the click event of the "Remove" button
      document.querySelectorAll('.remove-button').forEach(button => {
        button.addEventListener('click', function(event) {
          const productId = button.dataset.productId; // Get the product ID from the button's data attribute
          // console.log(productId);
          removeFromCart(productId); // Call the removeFromCart function
        });
      });

      function removeFromCart(productId) {
        const ROOT = "http://localhost/wcf/"; // Make sure ROOT includes the trailing slash
        $.ajax({
          url: ROOT + 'Cart', // Endpoint to handle removing the item from the cart
          data: {
            productId: productId,
            action: 'remove'
          }, // Data to be sent in the AJAX request
          method: "POST", // Method of the AJAX request
        }).done(function(response) {
          // Handle the response here (if needed)
          console.log(response);
        });
      }
    });
    // Function to handle the "Check Out" button click event
    // Function to handle the "Check Out" button click event
    // Function to handle checkbox change event
    function handleCheckboxChange(checkbox) {
      const productId = checkbox.dataset.productId;
      const selected = checkbox.checked ? 1:0;
      // console.log(productId, selected);
      updateSelectedItems(productId, selected); // Call the function to update selected items
    }

    // Function to update selected items in the database
    function updateSelectedItems(productId, selected) {
      const ROOT = "http://localhost/wcf/";
      $.ajax({
        url: ROOT + 'Cart', // Endpoint to handle updating selected items
        method: 'POST',
        data: {
          productId: productId,
          selected: selected,
          action: 'updateSelectedItems'
        }, // Include the action parameter
        success: function(response) {
          console.log(response); // Log the response for debugging
        },
        error: function(xhr, status, error) {
          console.error(error); // Log any errors for debugging
        }
      });
    }

    // Add event listeners to checkboxes
    document.querySelectorAll('.select-checkbox').forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        handleCheckboxChange(checkbox); // Call the function to handle checkbox change
      });
    });
  </script>


</body>

</html>