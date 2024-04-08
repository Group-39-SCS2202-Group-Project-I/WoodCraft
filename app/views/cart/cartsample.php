<?php 


// function cartElement($product_name,$product_price,$product_image,$product_type,$product_color,$product_id)
// {
//     $element = <<<HTML
//     <form action="cart.php?action=remove&id=$product_id" method="post" class="cart-items">
//         <tr>
//             <td>
//                 <div class="smallcart">
//                     <div class="product">
//                         <div class="imag-box">
                        
//                             <img class="img" src="ROOT/assets/" width="80vw" height="80vw" alt="$product_name">
//                          </div>
//                          <div class="details">
//                             <div class="pdetails">
//                                 <div class="product-details">
//                                     <p class="title">$product_name</p>
//                                     <p>Type: $product_type</p>
//                                     <p>Color: $product_color</p>
//                                     <p>$$product_price</p>

//                                 </div>
//                             </div>
//                             </div>

//                             <div class="Qdetails">
//                                 <div class="remove">
//                                 <button type="submit" name="remove" class="remove-button" style="border: none; background: none;">
//                                  <i class="fas fa-trash"></i>
//                                   </button>
//                                 </div>
//                                 <div class="quantity">
//                                     <button type="button" class="decrease"><i class="fas fa-minus"></i></button>
//                                     <input type="text" value="1" class="form-control">
//                                     <button type="button" class="increase"><i class="fas fa-plus"></i></button>
//                                 </div>
                                
//                             </div>
                       
//                     </div>
//                 </div>
//             </td>
//         </tr>
        
//     </form>
    
// HTML;

//     echo $element;
// }

// session_start();
// // require_once("createdb.php");

// $db = new Createdb("localhost","root","","shopping","producttb");
// if(isset($_POST['remove'])){
//   if($_GET['action']=='remove'){
//      foreach($_SESSION['cart']as $key=>$value){
     
//         if ($value['product_id'] == $_GET['id']) {

//         unset($_SESSION['cart'][$key]);
//         echo "<script>alert('product has been removed')</script>";
//         echo "<script>window.location='cart.php'</script>";
//       }
//      }
//   }
// }

// Retrieve products data from the controller


 ?>

<?php $this->view('includes/header', $data) ?>

<header>
      
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/cart.css ">
    <?php $this->view('includes/nav', $data) ?>
    <?php $this->view('webstore/header-section', $data) ?>
  </header>



  <body>
    

    
     <div class="container-cart">
      <div class="cart">
      
          <h2>YOUR CART</h2>
          
          <?php
            $cart  = new cartM();
            $data['cart'] = $cart->findAll();
            $tables = ['product'];
                       $columns = ['*'];
                       $condition= ['product.product_id = cart.product_id'];
                       $cartItem =$cart->join($tables, $columns,$condition,);
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
               



                // echo "Customer ID: " . $cartItem->customer_id . "<br>";
                echo "Product ID: " . $cartItems->product_id . "<br>";
                echo "Quantity: " . $cartItems->quantity . "<br>";
                echo "name: " . $cartItems->name. "<br>";
                echo "price"  .$cartItems->price."<br>";

               // echo "price: " . $cartItems->price. "<br>";
               
             
                echo "<hr>";
            }
        } else {
            echo "Your Cart is Empty";
        }
        




    

       
        // // Check if cart items with product details are set and not empty
     
    
        


        // ?>

      
          
        //     <!-- if(isset($_SESSION['cart'])){
        //         $product_id = array_column($_SESSION['cart'],'product_id');
        //         $result = $db->getdata();

        //         while ($row = mysqli_fetch_assoc($result)) {
        //             foreach($product_id as $id) {
        //                 if($row['id'] == $id) {
        //                     cartElement($row['product_name'], $row['product_price'], $row['product_image'], $row['product_type'],$row['product_color'], $row['id']);
        //                     $subtotal = $subtotal + (int)$row['product_price'];
        //                     $discount = 0.2 * $subtotal; // 20% discount
        //                     $total = $subtotal - $discount +$delivery;
        //                 }
        //             }
        //         }
        //     } else {
        //         echo "<h5>Cart Is Empty</h5>";
        //     }
        //    -->

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
            
          </script>
        
      </div>
  

       <div class="summary">
        <div class="top">
          <h2>Order Summary</h2>
        </div> 
        <div class="detail">
          <h2 id="subtotal">Subtotal<span>$<?php echo  $subtotal?></h2>
        </span></h2>
          <h2 id="discount">Discount(-20%)<span>-$<?php echo $discount ?></span></h2>
          <h2 id="delivery">Delivery<span>-$<?php echo $delivery ?></span></h2>
          
          <hr />
          <h2 id="total">Total<span>$<?php echo $total?></span></h2>
        </div>

      
        <div class="promo">
          <div class="promocode">
          <input class="promocode"   type="text" placeholder="Add the promocode " id="promoCode" />
        </div>
         
          <button class="cart-first-btn" id="promo" onclick="promo()">Apply</button>
      
        </div>


        <!-- 
        if(isset($_SESSION['cart'])){
            $count = count($_SESSION['cart']);
            echo"<h6>Price ($count items)</h6>";
        }else {
            echo"<h6>Price (0 items)</h6>";
        }
        ?> -->
        <div style="padding: 0 10px; margin-bottom: 20px">
          <button class="checkout">Check Out</button>
        </div>
      </div>
   
    </div>

  </body>
  <?php $this->view('includes/footer', $data) ?>

  

</html>






