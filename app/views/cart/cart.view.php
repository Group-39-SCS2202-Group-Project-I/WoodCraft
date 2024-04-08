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
  
 
.container-cart {
    display: flex;
    margin: 100px 150px 0 150px;
    flex-direction: row;
    padding-bottom: 1rem;
   }
 .head-img {
    text-align: left;
    padding-left: 7px;
  }
  
  .input {
    border: none;
    outline: none;
    width: 100%;
    height: 40px;
    margin: 5px 0;
    padding: 7px;
  }
  
  .cart {
    width: 55%;
    border: 1px solid #bdbdbd;
     display:flex;
      
    border-radius: .5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-content: center;
  }
  
 
.fa-trash{
    color:red;
}
 .fa-trash:hover{
    color: #688272;
 }  
 .quantity{
  display: flex;
  align-items: center;
 }
 .quantity input{
  width: 30px;
  text-align: center;
 }
 


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
  
  
  .detail {
    display: flex;
    flex-direction: column;
    align-items: flex-end; 
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
    color:red;
  }
  
  
  .detail hr {
    width: 100%;
    border: 1px solid #ddd; 
    margin: 10px 0; 
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
    margin-top: 2rem;
  }
  .remove {
   
    border: none;
  }
  
  .checkout {
    width: 100%;
    background-color:#000;
    color: #fff;
    border-radius: 15rem;
    margin-top: 1rem;
    height: 2.5rem;
  }
  .promocode input[type="text"] {
    border: 1px solid #ccc; /* Add a border */
    border-radius: 15rem;
    height: 2rem;
    
  }
  .first-btn{
    width: 20%;
    height: 2.5rem;
    background-color:#000;
    color: #fff;
    border-radius: 15rem;
   
  }
  
  button:hover,
  .checkout:hover {
    background-color:  #688272;
  }

  .product {
    display: flex;
    flex-direction: row;
   
     padding: 10px;
    width: 100%;
    justify-content: space-around;
   
  }
  
  .product-info {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .product-details {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items:start;
  }
  .product-details p {
    line-height: 1.5; 
    margin-bottom: 5px; 
    display:block;
    font-size: 1vw;
    font-weight: lighter;
    color: #333;
    
  }
  .product-details .title{
    line-height: 1.5; 
    margin-bottom: 5px; 
    display:block;
    font-size: 1vw;
    font-weight:bolder;
    color: #000;
    
  }
  hr {
    margin: 5px 0;
    border: 1px solid #ddd;
  }
  
  .quantity {
    display: flex;
    border-radius: 2rem;
    

  }
  
  
  
 




  
</style>
</html>