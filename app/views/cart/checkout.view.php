<?php $this->view('includes/header', $data) ?>

<?php $this->view('includes/header', $data) ?>

<header>
 
  <?php $this->view('includes/nav', $data) ?>
  <?php $this->view('webstore/header-section', $data) ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</header>

<body>


  <div class="contentcheckout">
   
    <div class="cartitems">
    <div class="containercheckout">
      
      <div class="changeaddress">
      <h2>Change Your Address</h2>
    </div>
    <div class="cart">
        <?php
        $subtotal = 0;
        $discount = 0;
        $total = 0;
        $delivery = 15;
        $cart = new cart();
        $data['cart'] = $cart->findAll();
        $tables = ['product'];
        $columns = ['*'];
        $condition = ['product.product_id = cart.product_id'];
        $cartItem = $cart->join($tables, $columns, $condition);

        if (isset($cartItem) && !empty($cartItem)) {
          foreach ($cartItem as $cartItems) {
            ?>
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
                  <div class="quantity">
                    <p><?php echo  $cartItems->quantity ?></p>
                  </div>
                </div>
              </div>
            </div>
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
    </div>
    <div class="summary">
  <div class="top">
    <h2>Order Summary</h2>
  </div>
  <div class="detail">
  <div class="delivery-option">
  <label for="delivery-toggle">Do you want delivery?</label>
  <input type="checkbox" id="delivery-toggle">
  <div class="toggle-container">
    <i class="fas fa-toggle-off toggle-icon unchecked"></i>
   
  </div>
</div>
    <h2 id="subtotal">Subtotal<span>$<?php echo $subtotal ?></span></h2>
    <h2 id="discount">Discount(-20%)<span>-$<?php echo $discount ?></span></h2>
    <h2 id="delivery">Delivery<span>-$<?php echo $delivery ?></span></h2>
    <hr />
    <h2 id="total">Total<span>$<?php echo $total ?></span></h2>
  </div>
  <div class="confirm-button">
    <button class="button">Confirm Order</button>
  </div>
</div>

  </div>

<?php $this->view('includes/footer', $data) ?>

<!-- Your JavaScript code goes here -->


<!-- JavaScript code -->
<script>
  // Function to handle toggle switch
  document.getElementById('delivery-toggle').addEventListener('change', function() {
    const toggleContainer = document.querySelector('.toggle-container');
    if (this.checked) {
      toggleContainer.classList.remove('unchecked');
      toggleContainer.classList.add('checked');
    } else {
      toggleContainer.classList.remove('checked');
      toggleContainer.classList.add('unchecked');
    }
  });
</script>
  <style>
 .containercheckout {
  display: flex;
  flex-direction: column;
  align-items: center;
  border-radius: 0.5rem;
  width: 70%;
  margin: auto;
  padding-left: 10px; /* Add padding to the left side */
}


.changeaddress {
  width: 100%;
  border: 1px solid #ccc;
  padding: 10px 20px;
  margin-bottom: 20px;
  border-radius: 0.5rem;
  margin-left: 20px; /* Add small left padding */
  margin-right: 20px; /* Add small right padding */
}

.contentcheckout {
  width: 100%;
}

.cartitems {
  width: 100%;
  display: flex;
  align-items: flex-start; /* Align items at the top */
}

.summary {
  width: 30%;
  border: 1px solid #bdbdbd;
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 0.5rem;
  margin-left: 10px; /* Add small left padding */
  padding-right: 10px; /* Add padding to the left side */
}

/* Hide the checkbox */
/* Hide the checkbox */
input[type="checkbox"] {
  display: none;
}

/* CSS styling for toggle switch */

/* Adjust the size of the toggle container */
.toggle-container {
  display: inline-block;
  position: relative;
  width: 40px; /* Adjust width as needed */
  height: 20px; /* Adjust height as needed */
  background-color: #ccc; /* Background color of the toggle */
  border-radius: 10px; /* Roundness of the toggle */
  cursor: pointer;
}

/* Adjust the size and position of the toggle icons */
.toggle-icon {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  color: #fff; /* Color of the toggle icons */
  transition: transform 0.3s ease; /* Smooth transition effect */
  font-size: 12px; /* Adjust the size of the icons */
}

/* Styling for the "on" state of the toggle */
.checked {
  left: calc(100% - 20px); /* Adjust left position for the "on" state */
}

/* Styling for the "off" state of the toggle */
.unchecked {
  left: 0; /* Adjust left position for the "off" state */
}

/* Change background color and icon color when checkbox is checked */
input[type="checkbox"]:checked + .toggle-container {
  background-color: #28a745; /* Color when toggled on */
}

input[type="checkbox"]:checked + .toggle-container .unchecked {
  transform: translateX(-100%);
}

input[type="checkbox"]:checked + .toggle-container .checked {
  transform: translateX(0%);
}

/* Change color of toggle icons when checkbox is unchecked */
input[type="checkbox"]:not(:checked) + .toggle-container .unchecked {
  transform: translateX(0%);
}

input[type="checkbox"]:not(:checked) + .toggle-container .checked {
  transform: translateX(100%);
}

.delivery-option input[type="checkbox"] {
    display: none;
  }

.cart {
  width: 100%;
    border: 1px solid #ccc;
    padding: 10px 20px;
    margin-bottom: 20px;
    border-radius: 0.5rem;
    margin-left: 20px;
    margin-right: 20px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-content: center;
  /* Add small left padding */
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
  margin-left: 10px;
}

.smallcart {
  display: flex;
  flex-direction: row;
}

.product {
  display: flex;
  flex-direction: row;
  padding: 10px;
  width: 100%;
  justify-content: space-around;
  margin-bottom: 5%;
}

.details {
  flex-direction: column;
}

.pdetails {
  flex-direction: row;
}

.product-details {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: start;
}

.product-details p {
  line-height: 1.5;
  margin-bottom: 5px;
  display: block;
  font-size: 1vw;
  font-weight: lighter;
  color: #333;
}

.product-details .title {
  line-height: 1.5;
  margin-bottom: 5px;
  display: block;
  font-size: 1vw;
  font-weight: bolder;
  color: #000;
}

hr {
  margin: 5px 0;
  border: 1px solid #ddd;
}

.promo {
  display: flex;
  flex-direction: row;
}

.button {
  background-color: #000;
  color: #fff;
  padding: 8px 30px;
  cursor: pointer;
  margin-bottom: 15px;
  border-radius: 0.5rem;
}

  </style>
</body>
</html>