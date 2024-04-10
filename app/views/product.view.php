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
<?php
if (Auth::logged_in()) {
  $this->view('includes/chat', $data);
}
?>

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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item"><a href="#">Chairs</a></li>
                    <li class="breadcrumb-item"><a href="#">Living Room Chairs</a></li>
                </ol>
            </nav>
        </div>

        <div class="product-info">
            <div class="product-images">
            <div class="product-image-grid">
                <img id="product-image-1" class="selected-image" src="<?php echo ROOT . '/' . $images[0]['image_url'] ?>" alt="<?php echo $data['name'] . '1'; ?>">
                <img id="product-image-2" src="<?php echo ROOT . '/' . $images[1]['image_url'] ?>" alt="<?php echo $data['name'] . '2'; ?>">
                <img id="product-image-3" src="<?php echo ROOT . '/' . $images[2]['image_url'] ?>" alt="<?php echo $data['name'] . '3'; ?>">
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

    <script>
    // Function to switch main product image and show border on selected image
    function switchMainImage(imageElement) {
        var mainImage = document.querySelector('.product-image img');

        // Remove 'selected-image' class from all images in grid
        var gridImages = document.querySelectorAll('.product-image-grid img');
        gridImages.forEach(function(img) {
            img.classList.remove('selected-image');
        });

        // Apply 'selected-image' class to the clicked image
        imageElement.classList.add('selected-image');

        // Update main product image with the clicked image
        mainImage.src = imageElement.src;
    }

    // Add click event listeners to grid images
    document.querySelectorAll('.product-image-grid img').forEach(function(img) {
        img.addEventListener('click', function() {
            switchMainImage(this);
        });
    });
</script>

 
    </body>

    <?php $this->view('includes/footer', $data) ?>