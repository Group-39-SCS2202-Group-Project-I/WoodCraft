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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    function addToCart(pid) {
        $('#loader').show();
        var ROOT = "http://localhost/wcf/"; // Make sure ROOT includes the trailing slash
        $.ajax({
            url: ROOT + 'CartC', // Endpoint to handle the cart addition
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
        // Check if the products data is set and not empty
        if (isset($products) && !empty($products)) {
            foreach ($products as $product) {
        ?>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="<?php echo ROOT . 'assets/images/' . $product->image; ?>" alt="" style="width: 200px; height: 200px;">
                        <div class="caption">
                            <h3><?php echo $product->name; ?></h3>
                            <p><?php echo substr($product->description, 0, 60) . '...'; ?></p>
                            <p>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <strong><span style="font-size: 18px;">&#x20b9;</span><?php echo number_format($product->price, 2); ?></strong>
                                    </div>
                                    <?php 
                                       $disButton = "";
                                      if (is_array($cartItem) && in_array($product->id, array_column($cartItem, 'product_id'))!==false) {
                                      $disButton = "disabled";
                                     }
                                    ?>

                                    <button id="cartBtn_<?php echo $product->product_id; ?>" <?php echo $disButton; ?>class="btn btn-success" onclick="addToCart(<?php echo $product->product_id; ?>)" role="button">ADD TO CART</button>
                                </div> 
                            </p>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "No products found.";
        }
        ?>
    </div>

    <div class="row">
        <div class="col-md-12 text-right">
            <a href="<?= ROOT . '/cartC' ?>" class="btn btn-success">cart view <span class="glyphicon glyphicon-play"></span></a>
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
