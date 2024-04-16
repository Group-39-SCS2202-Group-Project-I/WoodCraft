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
        $cart = new cartM();
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
          <h2 id="subtotal">Subtotal<span>$<?php echo $subtotal ?></span></h2>
          <h2 id="discount">Discount(-20%)<span>-$<?php echo $discount ?></span></h2>
          <h2 id="delivery">Delivery<span>-$<?php echo $delivery ?></span></h2>
          <hr />
          <h2 id="total">Total<span>$<?php echo $total ?></span></h2>
        </div>
      </div>
    </div>
  </div>

<?php $this->view('includes/footer', $data) ?>

<!-- Your JavaScript code goes here -->

</body>
</html>

  <style>
   .containercheckout {
  display: flex;
  flex-direction: column; /* Align divs vertically */
  align-items: center; /* Center align divs horizontally */
  border-radius: 2rem;
}

.changeaddress {
  border: 1px solid #ccc;
  padding: 10px 20px; /* Adjust left and right padding */
  margin-bottom: 20px;
  border-radius: 5px;
}

.contentcheckout {
  width: 100%; /* Take full width of the container */
}

.cartitems {
  width: 100%; /* Take full width of the container */
}

    .contentcheckout{
      display: flex;
    flex-direction: column;
    border-radius: 2rem;
    justify-content: space-evenly;
    }
    .changeaddress {
  border: 1px solid #ccc; /* Add border */
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 5px; /* Add border radius for rounded corners */
}
 .cartitems{
 
    display: flex;
    flex-direction: row;
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
.cart{
  width: 55%;
    border: 1px solid #bdbdbd;
    border-radius: .5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-content: center;
    margin-left: 5%;
    margin-bottom: 5%;
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

/* Summary styles */

.summary {
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
  
 .promo{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
 }
  
 
  
  .button {
   
    background-color:#000;
    color: #fff;
    padding: 8px 30px;
   
    cursor: pointer;
    margin-bottom: 15px;
    border-radius: 15rem;
    margin-top: }

  </style>
</body>
</html>