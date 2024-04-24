<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <style>
        /* Your CSS styles go here */
        .containercheckout {
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 0.5rem;
            width: 70%;
            margin: auto;
            padding-left: 10px;
            /* Add padding to the left side */
        }

        .changeaddress {
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px 20px;
            margin-bottom: 20px;
            border-radius: 0.5rem;
            margin-left: 20px;
            /* Add small left padding */
            margin-right: 20px;
            /* Add small right padding */
            cursor: pointer;
            /* Add cursor pointer for clickability */
        }

        .contentcheckout {
            width: 100%;
        }

        .cartitems {
            width: 100%;
            display: flex;
            align-items: flex-start;
            /* Align items at the top */
        }

        .summary {
            width: 30%;
            border: 1px solid #bdbdbd;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 0.5rem;
            margin-left: 10px;
            /* Add small left padding */
            padding-right: 10px;
            /* Add padding to the left side */
        }

        /* Updated CSS for modern toggle */
       /* Styles for Delivery Options */
.delivery-option {
    display: inline-block;
    margin-right: 10px;
}

.delivery-option-label-custom {
    cursor: pointer;
    display: inline-block;
    vertical-align: middle;
    margin-right: 5px;
}

.material-icons, .fa {
    font-size: 18px; /* Adjust icon size as needed */
    vertical-align: middle;
}


        .delivery-option-input:checked+.delivery-option-label {
            color: #fff;
            /* Change text color when selected */
            background-color: #2196f3;
            /* Change background color when selected */
        }

        .toggle {
            width: 50%;
            /* Half of the container width */
            height: 100%;
            background-color: #fff;
            /* Background color of the toggle */
            border-radius: 20px;
            /* Match container's border-radius */
            transition: transform 0.3s;
        }

        .delivery-option-input:checked+.delivery-option-label:last-of-type~.toggle {
            transform: translateX(100%);
            /* Move toggle to the right for delivery */
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
            display: flex;
            flex-direction: row;
            justify-content: space-between;
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
            background-color: #000;
            /* Green */
            color: white;
        }

        .form-buttons button[type="submit"]:hover {
            background-color:hsl(152, 51%, 52%);
        }

        .form-buttons button[type="button"] {
            background-color: #000;
            /* Red */
            color: white;
        }

        .form-buttons button[type="button"]:hover {
            background-color: hsl(152, 51%, 52%);
        }

        .change-address-form {
    display: none;
    width: 100%;
    border: 1px solid #EEEEEE;
    padding: 10px 20px;
    margin-bottom: 20px;
    border-radius: 0.5rem;
    margin-left: 20px;
    margin-right: 20px;
    /* Hide the form initially */
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
                <div class="changeaddress" onclick="toggleAddressForm()">
                <h2><i class="material-icons">add_circle_outline</i> Change Your Address</h2>
                    <p><?php echo $data['customerAddress']->address_line_1; ?></p>
                    <p><?php echo $data['customerAddress']->address_line_2; ?></p>
                    <p><?php echo $data['customerAddress']->city; ?></p>
                    <p><?php echo $data['customerAddress']->province; ?></p>
                    <p><?php echo $data['customerAddress']->zip_code; ?></p>

                    <!-- <?php show($data['customerAddress']); ?> -->
                </div>
                <!-- Modal for Change Address Form -->

                <div class="change-address-form">
                    <h2> Change Your Address</h2>

                    <form action="#" method="post" class="address-form" onsubmit="saveAddress(); return false;">
                        <?php if (!empty($errors['address_line_1'])): ?>
                            <p class="validate-mzg "><?= $errors['address_line_1'] ?></p>
                        <?php endif; ?>
                        <input value="<?= set_value('address_line_1') ?>" type="text" name="address_line_1"
                            placeholder="Address Line 1">

                        <?php if (!empty($errors['address_line_2'])): ?>
                            <p class="validate-mzg "><?= $errors['address_line_2'] ?></p>
                        <?php endif; ?>
                        <input value="<?= set_value('address_line_2') ?>" type="text" name="address_line_2"
                            placeholder="Address Line 2">

                        <?php if (!empty($errors['city'])): ?>
                            <p class="validate-mzg "><?= $errors['city'] ?></p>
                        <?php endif; ?>
                        <input value="<?= set_value('city') ?>" type="text" name="city" placeholder="City">

                        <?php if (!empty($errors['province'])): ?>
                            <p class="validate-mzg "><?= $errors['province'] ?></p>
                        <?php endif; ?>
                        <select name="province" id="province">
                            <!-- <option value="" style="color:#757575;">Province</option> -->
                            <option value="Western" selected>Western Province</option>
                            <option value="Central">Central Province</option>
                            <option value="Eastern">Eastern Province</option>
                            <option value="North Central">North Central Province</option>
                            <option value="Northern">Northern Province</option>
                            <option value="North Western">North Western Province</option>
                            <option value="Sabaragamuwa">Sabaragamuwa Province</option>
                            <option value="Southern">Southern Province</option>
                            <option value="Uva">Uva Province</option>
                        </select>

                        <?php if (!empty($errors['zip_code'])): ?>
                            <p class="validate-mzg "><?= $errors['zip_code'] ?></p>
                        <?php endif; ?>
                        <input value="<?= set_value('zip_code') ?>" type="text" name="zip_code" placeholder="Zip Code">

                        <p>Your existing default address setting will be replaced if you make some changes here.</p>
                        <div class="form-buttons">
                            <button type="submit">Save Address</button>
                            <button type="button" onclick="cancelAddressForm()">Cancel</button>
                        </div>
                    </form>

                </div>
                <!-- End of Modal -->
                <div class="cart">


                    <?php
                    $subtotal = 0;
                    $discount = 0;
                    $total = 0;
                    $delivery = 0;

                    $cart = $data['cart'];
                    // show($cart);
                    
                    $subtotal = $cart[0]->sub_total;
                    $discount = 0;
                    $total = $cart[0]->total;
                    $delivery = 0;



                    $checkoutProducts = $data['checkout_products'];
                    // show($checkoutProducts);
                    
                    if (isset($checkoutProducts) && !empty($checkoutProducts)) {
                        foreach ($checkoutProducts as $checkoutProduct) {
                            ?>
                            <div class="smallcart">
                                <div class="product">
                                    <div class="imag-box">
                                        <img class="img" src="<?php echo ROOT . '/' . $checkoutProduct['image_url'] ?>"
                                            width="80vw" height="80vw" alt="<?php echo $checkoutProduct['name']; ?>">
                                    </div>
                                    <div class="details">
                                        <div class="pdetails">
                                            <div class="product-details">
                                                <p><?php echo $checkoutProduct['name'] ?></p>
                                                <p class="unit-price"><?php echo $checkoutProduct['price'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Qdetails">
                                        <div class="quantity">
                                            <p><?php echo $checkoutProduct['quantity'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            // $subtotal += $checkoutProduct->price; // Accumulate subtotal
                        }
                        // $discount = 0.2 * $subtotal; // 20% discount
                        // $total = $subtotal - $discount + $delivery;
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
                   <!-- Google Material Symbols Outlined Font -->
                   <div class="delivery-option">
                <!-- Pickup Option -->
                <input type="radio" id="pickup" name="delivery-option" class="delivery-option-input" checked>
                <label for="pickup" class="delivery-option-label-custom">
                    <i class="material-icons">store</i> 
                </label>
                <span class="delivery-option-title">PickUp</span>
            
                <!-- Delivery Option -->
                <input type="radio" id="delivery" name="delivery-option" class="delivery-option-input-custom">
                <label for="delivery" class="delivery-option-label-custom">
                    <i class="material-icons">local_shipping</i> 
                </label>
                <span class="delivery-option-title">Delivery</span>
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
    function handleDeliveryOption() {
        var isPickupSelected = document.getElementById('pickup').checked;
        var changeAddressSection = document.querySelector('.changeaddress');
        var addressForm = document.querySelector('.change-address-form');

        if (isPickupSelected) {
            // If Pickup option is selected, hide the address form
            addressForm.style.display = 'none';
            
            changeAddressSection.style.backgroundColor = '#EEEEEE';
           
        } else {
            
            changeAddressSection.style.backgroundColor = '';
        }
    }

    // Function to toggle the address form visibility when "Change Your Address" section is clicked
    function toggleAddressForm() {
        var form = document.querySelector('.change-address-form');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    // Function to handle cancellation of address form
    function cancelAddressForm() {
        var form = document.querySelector('.change-address-form');
        form.style.display = 'none';
    }

    // Function to handle saving of address
   // Function to handle saving of address
function saveAddress() {
    var formData = new FormData(document.querySelector('.address-form'));
    // Send the form data to the saveAddress method in the Checkout controller
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'checkout/saveAddress', true); // Adjust the URL as needed
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Handle success response, if needed
            console.log(xhr.responseText);
            // Display an alert message
            alert('Delivery address changed successfully!');
            // Auto cancel the form after saving data
            cancelAddressForm(); // Call cancelAddressForm here to hide the form after saving
        } else {
            // Handle error response, if needed
            console.error('Error:', xhr.statusText);
        }
    };
    xhr.send(formData);
    console.log("Form submitted!");
}


    // Attach event listeners to the radio buttons for delivery options
   // Attach event listeners to the radio buttons for delivery options
document.getElementById('pickup').addEventListener('change', handleDeliveryOption);
document.getElementById('delivery').addEventListener('change', handleDeliveryOption);

// Initially handle the selected delivery option
handleDeliveryOption();


    // Initially handle the selected delivery option
  
</script>


</body>

</html>