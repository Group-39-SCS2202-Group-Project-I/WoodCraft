<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Your CSS styles go here */

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

        /* Updated CSS for modern toggle */
        .delivery-option {
            display: flex;
            align-items: center;
            width: 200px; /* Adjust width as needed */
            height: 40px; /* Adjust height as needed */
            border-radius: 20px; /* Make it round */
            overflow: hidden;
            background-color: #ccc; /* Default background color */
        }

        .delivery-option-input {
            display: none; /* Hide the radio buttons */
        }

        .delivery-option-label {
            flex: 1;
            text-align: center;
            line-height: 40px; /* Center vertically */
            cursor: pointer;
            transition: color 0.3s, background-color 0.3s;
        }

        .delivery-option-input:checked + .delivery-option-label {
            color: #fff; /* Change text color when selected */
            background-color: #2196f3; /* Change background color when selected */
        }

        .toggle {
            width: 50%; /* Half of the container width */
            height: 100%;
            background-color: #fff; /* Background color of the toggle */
            border-radius: 20px; /* Match container's border-radius */
            transition: transform 0.3s;
        }

        .delivery-option-input:checked + .delivery-option-label:last-of-type ~ .toggle {
            transform: translateX(100%); /* Move toggle to the right for delivery */
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

        /* CSS for form buttons */
.form-buttons {
    margin-top: 20px;
}

.form-buttons button {
    padding: 8px 16px;
    margin-right: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    flex-direction: column;
}

.form-buttons button[type="submit"] {
    background-color: #4CAF50; /* Green */
    color: white;
}

.form-buttons button[type="submit"]:hover {
    background-color: #45a049;
}

.form-buttons button[type="button"] {
    background-color: #f44336; /* Red */
    color: white;
}

.form-buttons button[type="button"]:hover {
    background-color: #da190b;
}
.modal-content {
            display: none;
        }
    </style>
</head>
<body>
    <?php $this->view('includes/header', $data) ?>
    <header>
        <?php $this->view('includes/nav', $data) ?>
        <?php $this->view('webstore/header-section', $data) ?>
    </header>

    <div class="contentcheckout">
        <div class="cartitems">
            <div class="containercheckout">
                <div class="changeaddress">
                    <h2 onclick="openModal()"><i class="far fa-circle-plus"></i> Change Your Address</h2>
                     <p><?php echo $customerAddress->address_line_1; ?></p>
                 <p><?php echo $customerAddress->address_line_2; ?></p>
                  <p><?php echo $customerAddress->city; ?></p>
                   <p><?php echo $customerAddress->zip_code; ?></p>
                </div>
                <!-- Modal for Change Address Form -->
                <div id="changeAddressModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <!-- Change Address Form -->
                        <div class="change-address-form" id="changeAddressForm">
                            <h2>Change Address</h2>
                            <form action="#" method="post" class="address-form">
                                <!-- Form fields go here -->
                                <label for="fullName">Full Name</label>
                            <input type="text" id="fullName" name="fullName" required>
                            
                            <label for="mobileNumber">Mobile Number</label>
                            <input type="text" id="mobileNumber" name="mobileNumber" required>
                            
                            <label for="province">Province</label>
                            <select id="province" name="province" required>
                                <option value="" disabled selected>Please choose your province</option>
                                <!-- Add options for provinces -->
                            </select>
                            
                            <label for="city">City</label>
                            <select id="city" name="city" required>
                                <option value="" disabled selected>Please choose your city/municipality</option>
                                <!-- Add options for cities -->
                            </select>
                            
                            <label for="area">Area</label>
                            <select id="area" name="area" required>
                                <option value="" disabled selected>Please choose your area</option>
                                <!-- Add options for areas -->
                            </select>
                            
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" required>
                            
                            <label for="landmark">Landmark (Optional)</label>
                            <input type="text" id="landmark" name="landmark">
                            
                            <label for="deliveryLabel">Select a label for effective delivery:</label>
                            <select id="deliveryLabel" name="deliveryLabel">
                                <option value="home">Home</option>
                                <option value="office">Office</option>
                                <option value="default">Default Address</option>
                            </select>
                            
                            <label for="defaultDelivery">Default delivery address</label>
                            <input type="checkbox" id="defaultDelivery" name="defaultDelivery">
                            
                            <label for="defaultBilling">Default billing address</label>
                            <input type="checkbox" id="defaultBilling" name="defaultBilling">
                            
                            <p>Your existing default address setting will be replaced if you make some changes here.</p>
                                <!-- Add more form fields as needed -->
                                
                                <div class="form-buttons">
                                    <button type="submit">Save</button>
                                    <button type="button" onclick="closeModal()">Cancel</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
            <!-- End of Modal -->
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
              <input type="radio" id="pickup" name="delivery-option" class="delivery-option-input" checked>
              <label for="pickup" class="delivery-option-label">Pickup</label>
              <input type="radio" id="delivery" name="delivery-option" class="delivery-option-input">
              <label for="delivery" class="delivery-option-label">Delivery</label>
              <div class="toggle"></div>
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
            </div>
        </div>
    </div>

    <?php $this->view('includes/footer', $data) ?>

    <script>
    function showChangeAddressForm() {
        var form = document.getElementById('changeAddressForm');
        form.style.display = 'block';
    }

    // Function to open the modal
    function openModal() {
        var modal = document.getElementById('changeAddressModal');
        modal.style.display = 'block';
    }

    // Function to close the modal
    function closeModal() {
        var modal = document.getElementById('changeAddressModal');
        modal.style.display = 'none';
    }

    // Close the modal when clicking outside of it
    window.onclick = function(event) {
        var modal = document.getElementById('changeAddressModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

</body>
</html>