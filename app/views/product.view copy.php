<!DOCTYPE html>
<html>

<head>
    <title>WoodCraft</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
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
    <?php
    // show($data);
    $products = $data['product'];
    // show($products);

    ?>
    <div class="container">
        <h2>Product page of woodcraft furniture</h2>
        <hr>

        <!-- No need to require database.php and instantiate Database class here -->



        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                    <div id="result"></div>
                </div>
                <center><img src="<?php echo ROOT . '/assets/images/loader.gif'; ?>" id="loader"></center>
            </div>

            <?php
            // Check if $products array exists and is not empty
            if (isset($data['product']) && !empty($data['product'])) {
                foreach ($data['product'] as $product) {
                    // show($product);
                } // End foreach loop
            } else {
                echo "No products found."; // Output an error message if $products is empty or not set
            }
            ?>

            <?php foreach ($data['product'] as $product) :
                //  show($product);
                
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
                                    <strong> <span style="font-size: 18px;">&#x20b9;</span><?php echo number_format($product->price, 2); ?></strong>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <button id="cartBtn_<?php echo $product->product_id; ?>" class="btn btn-success" onclick="addToCart(<?php echo $product->id; ?>, this.id)" role="button">ADD TO CART</button>
                                </div>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <!-- <div class="row">
            <div class="col-md-12 text-right">
                <a href="<?php echo ROOT; ?>/cart.view.php" class="btn btn-success">cart view <span class="glyphicon glyphicon-play"></span></a>
            </div>
        </div> -->
    </div>

    <div style="position: fixed; bottom: 10px; right: 10px; color: green;">
        <!-- Additional content can be added here if needed -->
    </div>

    <?php
    // Inspect the contents of $products using var_dump() or print_r()
    // var_dump($products);
    ?>
</body>
<script type = "text/javascript">
    function addToCart(pid){
        $.ajax({
            url:"",
            data :"pid" + pid + "$action= add",
            method ="POST",

        }).done(function(response){
            $('#result').html(response);
        })
    }

</html>