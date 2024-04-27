<?php 
// Retrieve products data from the controller
$products = $data['products'];
$cartItem = $data['cart'];
?>

<?php $this->view('includes/header', $data) ?>

<header>
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/cart.css ">
    <?php $this->view('includes/nav', $data) ?>
    <?php $this->view('webstore/header-section', $data) ?>
</header>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    function addToCart(pid) {
        $('#loader').show();
        var ROOT = "http://localhost/wcf/"; // Make sure ROOT includes the trailing slash
        $.ajax({
            url: ROOT + 'Cart', // Endpoint to handle the cart addition
            data: { pid: pid, action: 'add' },
            method: "POST",
        }).done(function(response) {
            $('#loader').hide();
            $('.alert').show();
            $('#result').html(response); // Display the response
            // Here you can handle the cart item data returned in the response
            // Example: $('#cartTable').html(response.cart_data);
        });
    }
</script>

<style type="text/css">
    .alert,
    #loader {
        display: none;
    }

    .glyphicon,
    #itemCount {
        font-size: 18px;
    }
</style>

<body>

<div class="container">
    <hr>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                <div id="result"></div>
            </div>
        </div>
        
        <?php
if (isset($cartProducts) && !empty($cartProducts)) {
    foreach ($cartProducts as $cartProduct) {
        $outOfStockClass = isset($errors[$cartProduct['product_id']]) ? 'out-of-stock' : ''; // Check if product is out of stock
        $exceedStockClass = isset($errors[$cartProduct['product_id']]['msg']) && $errors[$cartProduct['product_id']]['msg'] == 'exceeds stock' ? 'exceeds-stock' : ''; // Check if quantity exceeds available stock
        $availableQuantity = isset($errors[$cartProduct['product_id']]['available_quantity']) ? $errors[$cartProduct['product_id']]['available_quantity'] : ''; // Get available quantity
?>
        <div class="smallcart"> <!-- Wrap each product in its own container -->
            <div class="product <?php echo $outOfStockClass; ?> <?php echo $exceedStockClass; ?>"> <!-- Add the classes here -->
                <div class="checkboxe">
                    <input type="checkbox" class="select-checkbox" data-product-id="<?php echo $cartProduct['product_id']; ?>"
                        <?php echo ($cartProduct['selected'] == 1 && empty($outOfStockClass)) ? 'checked' : ''; ?>>
                </div>
                <div class="imag-box">
                    <img class="img" src="<?php echo ROOT . '/' . $cartProduct['image_url'] ?>"
                        alt="<?php echo $cartProduct['name'] . '1'; ?>" width="80vw" height="80vw">
                </div>
                <div class="details">
                    <div class="pdetails">
                        <div class="product-details">
                            <p><?php echo $cartProduct['name'] ?></p>
                            <p class="unit-price"><?php echo $cartProduct['price'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="Qdetails">
                    <div class="remove">
                        <button type="button" class="remove-button" data-product-id="<?php echo $cartProduct['product_id']; ?>">
                            <i><span class="material-symbols-outlined">delete</span></i>
                        </button>
                    </div>
                    <div class="quantity">
                        <button type="button" class="decrease"
                            data-product-id="<?php echo $cartProduct['product_id']; ?>"><i><span
                                class="material-symbols-outlined">remove</span></i></button>
                        <input type="text" data-product-id="<?php echo $cartProduct['product_id']; ?>"
                            value="<?php echo $cartProduct['quantity']; ?>" class="form-control">
                        <button type="button" class="increase <?php echo $exceedStockClass; ?>"
                            data-product-id="<?php echo $cartProduct['product_id']; ?>"
                            data-available-quantity="<?php echo $availableQuantity; ?>"><i><span
                                class="material-symbols-outlined">add</span></i></button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "<h5>Cart Is Empty</h5>";
}
?>

    </div>

    <div class="row">
        <div class="col-md-12 text-right">
            <a href="<?= ROOT . '/cart' ?>" class="btn btn-success">cart view <span class="glyphicon glyphicon-play"></span></a>
        </div>
    </div>

    <!-- Display cart items if available -->
    <div class="row">
        <div class="col-md-12">
            
        </div>
    </div>
</div>

<div style="position: fixed; bottom: 10px; right: 10px; color: green;">

</div>
