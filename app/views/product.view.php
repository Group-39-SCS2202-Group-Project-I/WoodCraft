<?php

$product_id = $data['id'];

$url = ROOT . "/fetch/product/$product_id";
$response = file_get_contents($url);
$data = json_decode($response, true);

$url2 = ROOT . "/fetch/product_images/" . $product_id;
$response = file_get_contents($url2);
$images = json_decode($response, true);

show($data);
show($images);
?>

<?php $this->view('includes/header', $data) ?>

    <!--
    - HEADER
    -->

  <header>
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
                <img src="inc/images/nevada-chair.png" alt="Nevada Chair">
                <img src="inc/images/nevada-chair-2.png" alt="Nevada Chair">
                <img src="inc/images/nevada-chair-3.png" alt="Nevada Chair">
            </div>
            <div class="product-image">
                <img src="inc/images/nevada-chair.png" alt="Nevada Chair">
            </div>
            </div>
            <div class="product-overview">
            <div class="product-info-basic">
                <h2 class="product-name"><?php echo $data['name']; ?></h2>
                <div class="star-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <span class="rating-text">5.0/5 (20 Reviews)</span>
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
            <div class="review">
                <p>Absolutely thrilled with this chair! Incredibly comfortable, stylish, and well-constructed. The color and design are even more beautiful in person. My only suggestion for improvement would be to offer more cushion options.</p>
                <p>Samantha D.</p>
                <span>Posted on August 14, 2023</span>
            </div>
            <div class="review">
                <p>Impressed with the artistry! The chair is solid and well-made, and its design is cute and comfy. My only suggestion would be to offer a wider range of colors.</p>
                <p>Alex M.</p>
                <span>Posted on August 10, 2023</span>
            </div>
            <div class="review">
                <p>This chair is #cozy for the price. It's not the most comfortable, but it serves its purpose. The assembly was straightforward. It's quickly become my favorite spot for relaxation. Highly recommend!</p>
                <p>Ethan R.</p>
                <span>Posted on August 16, 2023</span>
            </div>
            </div>
            <h3>FAQs</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </div>

    <script src="pages/product_page/script.js"></script>
    </body>

    <?php $this->view('includes/footer', $data) ?>