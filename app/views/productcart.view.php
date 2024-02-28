<!DOCTYPE html>
<html>

<head>
    <title>WoodCraft</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
    
        function addToCart(pid) {
            $('#loader').show();
           
         var ROOT = "http://localhost/woodcraft_furniture_ShoppingCart/public/"; // Make sure ROOT includes the trailing slash
          $.ajax({
         url: ROOT + 'cart_item', // Concatenate ROOT with 'cart_item'
         data: { pid: pid, action: 'add' },
         method: "POST",
        }).done(function(response) {
        $('#loader').hide();
        $('.alert').show();
        $('#result').html(response);
    });
    // var data = JSON.parse(response);
	// 		$('#loader').hide();
	// 		$('.alert').show();
	// 		if(data.status == 0) {
	// 			$('.alert').addClass('alert-danger');
	// 			$('#result').html(data.msg);
	// 		} else {
	// 			$('.alert').addClass('alert-success');
	// 			$('#result').html(data.msg);
    
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
</head>

<body>
<?php

$products = $data['product'];




?>
<div class="container">
    <h2>Product page of woodcraft furniture</h2>
    <hr>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                <div id="result"></div>
            </div>
            <center><img src="<?php echo ROOT . '/assets/images/loader.gif'; ?>" id="loader"></center>
        </div>
        <?php
        
        // Check if customer data is set and not null
        if ($data['customer'] && $data['customer']->id !== null) {
            $_SESSION['customer_id'] = $data['customer']->id;
        }
        
        // Check if the products data is set and not empty
        if (isset($data['product']) && !empty($data['product'])) {
            foreach ($data['product'] as $product) {
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
                                    <button id="cartBtn_<?php echo $product->product_id; ?>" class="btn btn-success" onclick="addToCart(<?php echo $product->product_id; ?>, this.id)" role="button">ADD TO CART</button>
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
            <a href="<?= ROOT . '/cart' ?>" class="btn btn-success">cart view <span class="glyphicon glyphicon-play"></span></a>
        </div>
    </div>
</div>

<div style="position: fixed; bottom: 10px; right: 10px; color: green;">

</div>
