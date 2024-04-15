<?php $this->view('includes/header', $data) ?>

<header>
 
  <?php $this->view('includes/nav', $data) ?>
  <?php $this->view('webstore/header-section', $data) ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</header>

<body>

 
    <!-- <div class="cart">
    
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
                   



<script>
    // Function to handle the click event of the "Remove" button
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.remove-button').forEach(button => {
            button.addEventListener('click', function(event) {
                const productId = button.dataset.productId; // Get the product ID from the button's data attribute
                removeFromCart(productId); // Call the removeFromCart function
            });
        });
    });

    // Function to send an AJAX request to remove the item from the cart
   
    // Function to send an AJAX request to remove the item from the cart
    function removeFromCart(productId) {
        const ROOT = "http://localhost/wcf/"; // Make sure ROOT includes the trailing slash
        $.ajax({
            url: ROOT + 'CartC', // Endpoint to handle removing the item from the cart
            data: { productId: productId, action: 'remove' }, // Data to be sent in the AJAX request
            method: "POST", // Method of the AJAX request
        }).done(function(response) {
            // Handle the response here (if needed)
            console.log(response);
        });
    }
</script>

</script>




                    <div class="quantity">
                   
                   
                    <p><?php echo  $cartItems->quantity ?></p>
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
  </script> -->
  <div class="containercheckout">
    <div class="contentcheckout">
      <div class="changeaddress">
        <h2>change your address</h2>
      </div>
      <div class="cartitems">
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
                 




      </div>
    </div>
    <div class="summerycheckout">
    
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
    </div>
  </div>
  <style>
    .containercheckout{
      display: flex;
    flex-direction: row;
    border-radius: 2rem;
    justify-content: space-evenly;
    }
    
    .contentcheckout{
      display: flex;
    flex-direction: column;
    border-radius: 2rem;
    justify-content: space-evenly;
    }
    
    .summerycheckout {
    width: 45%;
    border: 1px solid #bdbdbd;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 2rem;
    margin-left: 10%;
    height: 50%;
    
}
  
  .top {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    margin: 20px 0;
  }
  
  
  .detail h2 {
    display: flex;
    justify-content: space-between;
    width: 100%;
    margin: 5px 0; 
    font-size: 1vw;
    color: #333;
    font-weight: lighter;
  }
  
  .detail h2 span {
    color: #333;
  }
  
  .detail h2#discount span {
    color: red;
  }
  
  .detail h2::after {
    content: '';
    flex-grow: 1;
  }
  
  .detail h2 span {
    margin-left: 10px; /* Adjust as needed */
  }
  </style>
</body>
</html>