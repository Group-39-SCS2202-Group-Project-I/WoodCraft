<?php

$product_id = $data['id'];

$url = ROOT . "/fetch/product/$product_id";
$response = file_get_contents($url);
$data = json_decode($response, true);

$url2 = ROOT . "/fetch/product_images/" . $product_id;
$response = file_get_contents($url2);
$images = json_decode($response, true);

// show($data);
// show($images);

?>

<?php $this->view('includes/header', $data) ?>

    <!--
    - HEADER
    -->

  <header>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/product.css">
    <?php $this->view('includes/nav', $data) ?>
    <?php $this->view('webstore/header-section', $data) ?>
  </header>

    <body>
        <div class="product-page">
        <div class="breadcrumbs">
            <a href="#">Home</a>
            <span class="separator">></span>
            <a href="#">Shop</a>
            <span class="separator">></span>
            <a href="#">Chairs</a>
            <span class="separator">></span>
            <a href="#">Living Room Chairs</a>
        </div>
        <div class="product-info">
            <div class="product-images">
            <div class="product-image-grid">
                <img src="<?php echo ROOT . '/' . $images[0]['image_url'] ?>" alt="<?php echo $item['name']; ?>" alt="<?php echo $data['name'] . '1'; ?>">
                <img src="<?php echo ROOT . '/' . $images[1]['image_url'] ?>" alt="<?php echo $item['name']; ?>" alt="<?php echo $data['name'] . '2'; ?>">
                <img src="<?php echo ROOT . '/' . $images[2]['image_url'] ?>" alt="<?php echo $item['name']; ?>" alt="<?php echo $data['name'] . '3'; ?>">
            </div>
            <div class="product-image">
                <img src="<?php echo ROOT . '/' . $images[0]['image_url'] ?>" alt="<?php echo $data['name'] . '1'; ?>">
            </div>
            </div>
            <div class="product-overview">
            <div class="product-info-basic">
                <h2 class="product-name"><?php echo $data['name']; ?></h2>
                <div class="star-rating">
                    <?php echo createStarRating($data['avarage_rating']); ?>
                <span class="rating-text">&nbsp;<?php echo $data['avarage_rating']; ?>/5 (<?php echo sizeof($data['reviews'])?> Reviews)</span>
                </div>
                <div class="price-discount">
                <span class="original-price"><?php echo $data['price'] ?></span>
                <span class="sale-price">$260</span>
                <span class="discount">-40% off</span>
                </div>
                <p class="product-description"><?php echo $data['description'] ?></p>
            </div>
            <div class="product-info-selections">
                <div class="color-selector">
                <span class="label">Select Color:</span>

                <button class="color-option" style="background-color: #f0e8d9"></button>
                <button class="color-option" style="background-color: #d3c7b4"></button>
                <button class="color-option" style="background-color: #a69c88"></button>
                </div>
                <div class="amount-selector">
                <button class="amount_button minus"><i class="fa fa-minus" aria-hidden="true"></i></button>
                <input class="amount-selector-input" type="number" min="1" value="1">
                <button class="amount_button plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
                <button class="add-to-cart">Add to Cart</button>
                </div>
            </div>
            </div>
        </div>
        <div class="product-details">
            <h3>Product Details</h3>
            <p><?php echo $data['description'] ?></p>
            <h3>Rating & Reviews</h3>
            <div class="reviews">
                <?php for ($i = sizeof($data['reviews']); $i > 0; $i--) :?>
                    <div class="review">
                        <div class="star-rating">
                            <?php echo createStarRating($data['reviews'][sizeof($data['reviews'])-$i]['rating']); ?>
                        </div>
                        <p><?php echo $data['reviews'][sizeof($data['reviews'])-$i]['review']; ?></p>
                        <p><?php echo $data['reviews'][sizeof($data['reviews'])-$i]['customer_name']; ?></p>
                        <span>Posted on <?php echo $data['reviews'][sizeof($data['reviews'])-$i]['updated_at']; ?></span>
                    </div>
                <?php endfor; ?>
            </div>
            <h3>FAQs</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </div>

    <script src="<?php echo ROOT ?>/assets/js/product.js"></script>
    </body>

    <?php $this->view('includes/footer', $data) ?>
<!-- 
    <!-- function to add cart items -->
  <!-- <script type ="text/javascript">
    function addToCart(product_Id){
      $.ajax({
        url:cartaction.php
        data: "Id=" + Id +"&action=add",
        method:"post"
      }).done(function(response){
        $('#result').html(response);
      })
    }
    </script> --> 