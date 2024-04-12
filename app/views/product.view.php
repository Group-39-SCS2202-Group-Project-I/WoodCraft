<?php

$product_id = $data['id'];

$url = ROOT . "/fetch/product/$product_id";
$response1 = file_get_contents($url);
$data = json_decode($response1, true);

$url2 = ROOT . "/fetch/product_images/" . $product_id;
$response2 = file_get_contents($url2);
$images = json_decode($response2, true);

$url3 = ROOT . "/fetch/product_rating/$product_id";
$response3 = file_get_contents($url3);
$product_ratings = json_decode($response3, true);


// show($images);
show($data);
show($product_ratings);

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
                    <?php echo createStarRating($product_ratings['avg_rating']); ?>
                <span class="rating-text">&nbsp;<?php echo $product_ratings['avg_rating']; ?>/5 (<?php echo $product_ratings['total_ratings']?> Reviews)</span>
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
                
            <div class="review-analyzer-container">
                <div class="review-analyzer">
                    <div class="left-side">
                        <h3>Average Rating</h3>
                        <div class="average-info">
                            <div class="average-rating">
                                <span class="average-value"><?php echo $product_ratings['avg_rating']; ?></span>
                            </div>
                            <div class="average-count">Based on <?php echo $product_ratings['total_ratings']?> reviews</div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="right-side">
                        <h3>Individual Ratings</h3>
                        <div class="star-ratings">
                            <div class="rating">
                                <span class="stars">5 Stars</span>
                                <div class="rating-bar bar-5"></div>
                            </div>
                            <div class="rating">
                                <span class="stars">4 Stars</span>
                                <div class="rating-bar bar-4"></div>
                            </div>
                            <div class="rating">
                                <span class="stars">3 Stars</span>
                                <div class="rating-bar bar-3"></div>
                            </div>
                            <div class="rating">
                                <span class="stars">2 Stars</span>
                                <div class="rating-bar bar-2"></div>
                            </div>
                            <div class="rating">
                                <span class="stars">1 Star</span>
                                <div class="rating-bar bar-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

<script>
    // Sample ratings data (you can replace this with your actual data)
    const ratings = {
        '5': <?php echo $product_ratings['rating_5star'] ?? 0; ?>,
        '4': <?php echo $product_ratings['rating_4star'] ?? 0; ?>,
        '3': <?php echo $product_ratings['rating_3star'] ?? 0; ?>,
        '2': <?php echo $product_ratings['rating_2star'] ?? 0; ?>,
        '1': <?php echo $product_ratings['rating_1star'] ?? 0; ?>,
        'average': <?php echo $product_ratings['avg_rating']; ?> // Average rating value
    };

    // Function to update the review analyzer section
    function updateReviewAnalyzer() {
        const totalReviews = Object.values(ratings).reduce((acc, val) => acc + val, 0);

        // Update star ratings bars
        Object.keys(ratings).forEach(key => {
            if (key !== 'average') {
                const percentage = (ratings[key] / totalReviews) * 100;
                const ratingBar = document.querySelector(`.bar-${key}`);
                ratingBar.style.width = `${percentage}%`;
            }
        });

        // Update average rating bar and display average value
        const averagePercentage = (ratings.average / 5) * 100;
        const averageBar = document.querySelector('.average-rating .average-value');
        averageBar.style.width = `${averagePercentage}%`;

        const averageValue = document.querySelector('.average-value');
        averageValue.textContent = ratings.average.toFixed(1); // Display average rating with one decimal place
    }

    // Call the function to update the review analyzer on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateReviewAnalyzer();
    });
</script>



 
    </body>
    <?php $this->view('includes/footer', $data) ?>