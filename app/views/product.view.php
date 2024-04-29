    <style>
        .bulk-content {
            border-top: 1px solid var(--bg1);
        }

        .bulk-description {
            font-size: 14px;
            color: var(--bg1);
            font-style: italic;
        }

        .bulk-description:first-child {
            margin-top: 0;
        }

        .bulk-description:last-child {
            margin-bottom: 0;
        }

        .tab-header {
            display: flex;
            position: relative;
        }

        .tab-title {
            cursor: pointer;
            padding: 10px 15px;
            margin-right: 10px;
            position: relative;
        }

        .tab-title.active {
            font-weight: bold;
            color: #008000;
        }

        .content-review {
            display: none;
        }

        .content-review.active {
            display: block;
        }

        .field-edit-profile {
            margin-top: 10px;
            display: flex;
            align-self: center;
        }

        label {
            font-weight: bold;
        }

        .input {
            display: none;
        }

        .input-wrapper {
            width: 100%;
            padding-top: 10px;
            border-radius: 20px;
        }

        .form-control {
            border: 1px solid var(--bg2);
            transition: border-color 0.3s ease;
            border-radius: 20px;
            padding: 10px;
        }

        .form-control:focus {
            border-color: #008000;
            outline: none;
            box-shadow: 0 0 5px #008000;
        }

        .bulk-submit {
            background-color: var(--coal_black);
            color: var(--white);
            padding: 10px 20px;
            margin-left: 10px;
            border: none;
            outline: none;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .bulk-submit:hover {
            background-color: var(--bg1);
        }

        .buttons-profile {
            text-align: center;
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            flex-direction: column;
        }

        .filled-star {
            color: gold;
        }

        .empty-star {
            color: gold;
        }

        .price-discount {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--blk);
        }

        .question h4 {
            margin-left: 10px;
        }
    </style>


    <?php

    $product_id = $data['id'];

    $url = ROOT . "/fetch/product/$product_id";
    $response1 = file_get_contents($url);
    $data = json_decode($response1, true);
    // show($data);

    $url2 = ROOT . "/fetch/product_images/" . $product_id;
    $response2 = file_get_contents($url2);
    $images = json_decode($response2, true);

    $url3 = ROOT . "/fetch/product_rating/$product_id";
    $response3 = file_get_contents($url3);
    $product_ratings = json_decode($response3, true);

    $url4 = ROOT . "/fetch/product_inventory/$product_id";
    $response4 = file_get_contents($url4);
    $product_inventory = json_decode($response4, true);

    $cart_products = $_SESSION['cart_products'];


    $productFound = false;

    foreach ($cart_products as $cart_product) {
        if ($cart_product->product_id == $product_id) {
            $productFound = true;
            break;
        }
    }

    if (!isset($_POST['errors'])) {
        $errors = [];

        unset($_SESSION['errors']);
    }

    // show($images);
    // show($product_inventory);
    // show($data);
    // show($product_ratings);
    // unset($_SESSION['cart']);
    // unset($_SESSION['cart_products']);
    // show($_SESSION);
    // show($productFound);

    ?>

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
        <?php $this->view('includes/nav2', $data) ?>
        <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/footer.css">
    </header>

    <style>
        .white-container {
            background-color: var(--white);
            padding: 1rem;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>


    <div class="product-page" style="margin-top:calc(var(--header2-height) + 2rem);">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= ROOT ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= ROOT ?>/products">Products</a></li>
                    <li class="breadcrumb-item"><a href="<?= ROOT ?>/products/<?= $data['product_id'] ?>"><?= $data['name'] ?></a></li>
                </ol>
            </nav>
        </div>

        <div class="product-info">
            <div class="product-images" style="background-color: var(--white); padding:1rem; border-radius:10px">
                <div class="product-image-grid">
                    <img id="product-image-1" class="selected-image" src="<?php echo ROOT . '/' . $images[0]['image_url'] ?>" alt="<?php echo $data['name'] . '1'; ?>">
                    <img id="product-image-2" src="<?php echo ROOT . '/' . $images[1]['image_url'] ?>" alt="<?php echo $data['name'] . '2'; ?>">
                    <img id="product-image-3" src="<?php echo ROOT . '/' . $images[2]['image_url'] ?>" alt="<?php echo $data['name'] . '3'; ?>">
                </div>

                <div class="product-image">
                    <img src="<?php echo ROOT . '/' . $images[0]['image_url'] ?>" alt="<?php echo $data['name'] . '1'; ?>">
                </div>
            </div>
            <div class="product-overview" style="background-color: var(--white); padding:1rem; border-radius:10px">
                <div class="product-info-basic">
                    <h2 class="product-name"><?php echo $data['name']; ?></h2>
                    <div class="star-rating">
                        <?php if (!empty($product_review_count)) : ?>
                            <?php echo createStarRating($product_review_count[0]['average_rating']); ?>
                            <span class="rating-text">&nbsp;&nbsp;&nbsp;<?php echo $product_review_count[0]['average_rating']; ?>/5 &nbsp;&nbsp;(<?php echo $product_review_count[0]['review_count'] ?> Reviews)</span>
                        <?php else : ?>
                            <span class="rating-text" style="color: var(--bg1); font-size:14px; font-style:italic">No Ratings</span>
                        <?php endif; ?>

                    </div>
                    <div class="price-discount">
                        <span><?php echo "Rs " . $data['price'] ?></span>
                    </div>

                    <div class="price-discount">
                        <?php if ($data['quantity'] > 3) : ?>
                            <span style="color: #008000; font-size:14px"><?php echo $data['quantity'] . " in stock" ?></span>
                        <?php elseif ($data['quantity'] == 0) : ?>
                            <span style="color: red; font-size:14px"><?php echo "No stock available" ?></span>
                        <?php else : ?>
                            <span style="color: red; font-size:14px"><?php echo "Only " . $data['quantity'] . " in stock" ?></span>
                        <?php endif; ?>
                    </div>

                    <p class="product-description"><?php echo $data['description'] ?></p>
                    <p class="product-description">Looking to order in<strong style="color: #008000; font-size: 18px">&nbsp;&nbsp;Bulk&nbsp;?</strong> We've got you covered!</p>

                </div>

                <!-- (A) -->
                <div class="product-info-selections">
                    <div class="tab-header">
                        <div class="tab-title index" data-tab="retail_tab" onclick="showTab('retail_tab')">Retail</div>
                        <div class="tab-title" data-tab="bulk_tab" onclick="showTab('bulk_tab')">Bulk</div>
                    </div>

                    <div class="tab-content">
                        <!-- Bulk Tab -->
                        <div id="bulk_tab" class="content-review">
                            <div class="bulk-content">
                                <!-- <div class="amount-selector"> -->
                                <?php $this->view('bulkprd', $data) ?>
                                <!-- </div> -->
                                <!-- <p class="bulk-description">Please note: The minimum bulk order quantity for a product is 10 units.</p> -->
                            </div>
                        </div>

                        <!-- Reail Tab -->
                        <div id="retail_tab" class="content-review active">
                            <div class="retail-content">
                                <div class="amount-selector">
                                    <button class="amount_button minus"><span class="material-icons-outlined">remove</span></button>
                                    <input id="quantityInput" class="amount-selector-input" type="number" min="1" value="1">
                                    <button class="amount_button plus"><span class="material-icons-outlined">add</span></button>
                                    <?php if ($product_inventory['quantity'] != 0 && $productFound == 0) : ?>
                                        <button class="add-to-cart" onclick="addToCart(<?php echo $product_id; ?>,<?php echo Auth::getCustomerID(); ?>)">Add to Cart</button>
                                    <?php elseif ($product_inventory['quantity'] == 0) : ?>
                                        <button class="add-to-cart grayout">Currently stock is unavailable</button>
                                    <?php elseif ($productFound != 0) : ?>
                                        <button class="add-to-cart grayout" onclick="redirectToCart('cart')">Already this item is in cart</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function redirectToCart() {
                var checkoutURL = "<?php echo ROOT . '/cart'; ?>";
                window.location.href = checkoutURL;
            }
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabTitles = document.querySelectorAll('.tab-title');

                tabTitles.forEach(title => {
                    title.addEventListener('click', function() {
                        const tabId = this.getAttribute('data-tab');
                        showTab(tabId);
                    });
                });

                const overviewTabTitle = document.querySelector('.tab-title[data-tab="retail_tab"]');
                overviewTabTitle.classList.add('active');

                const saveChangesBtn = document.getElementById('saveChangesBtn');
                saveChangesBtn.addEventListener('click', function() {

                    showTab('retail_tab');
                });

                function showTab(tabId) {
                    const tabTitles = document.querySelectorAll('.tab-title');
                    const tabPanes = document.querySelectorAll('.content-review');

                    tabTitles.forEach(title => title.classList.remove('active'));
                    tabPanes.forEach(pane => pane.classList.remove('active'));

                    const selectedTabTitle = document.querySelector(`.tab-title[data-tab="${tabId}"]`);
                    const selectedTabPane = document.getElementById(tabId);

                    selectedTabTitle.classList.add('active');
                    selectedTabPane.classList.add('active');
                }
            });
        </script>

        <div class="white-container">
            <div class="product-details">
                <h3>Product Details</h3>
                <p><?php echo $data['description'] ?></p>
                <div class="product-specifications">
                    <h3>Product Specifications</h3>
                    <ul>
                        <li><strong>Package Dimensions:</strong> 11.06 x 9.21 x 2.56 inches; 5.57 ounces</li>
                        <li><strong>Item model number:</strong> NNTD0056-10001001</li>
                        <li><strong>Department:</strong> Mens</li>
                        <li><strong>Date First Available:</strong> May 16, 2017</li>
                        <li><strong>Manufacturer:</strong> Fifth Sun</li>
                        <li><strong>ASIN:</strong> B06Y2DC9FC</li>
                    </ul>
                </div>
            </div>
        </div>


        <!-- <hr class="section-divider"> -->

        <?php if (!empty($product_review_count)) : ?>
            <div class="white-container">
                <div class="rating-reviews">
                    <h3>Rating & Reviews</h3><br>

                    <div class="review-analyzer-container">
                        <div class="review-analyzer">
                            <div class="left-side">
                                <h3>Average Rating</h3>
                                <div class="average-info">
                                    <div class="average-rating">
                                        <?php echo $product_review_count[0]['average_rating']; ?>
                                        <!-- <span class="average-value"><?php echo $product_review_count[0]['average_rating']; ?></span> -->
                                    </div>
                                    <div class="average-star-rating">
                                        <?php echo createStarRating($product_review_count[0]['average_rating']); ?>
                                    </div>
                                    <div class="average-count">Based on <?php echo $product_review_count[0]['review_count'] ?> reviews</div>
                                </div>
                            </div>

                            <div class="right-side">
                                <div class="star-ratings">
                                    <?php
                                    // Iterate over ratings data
                                    for ($i = 5; $i >= 1; $i--) {
                                        $rating = $i;
                                        $ratingCount = $product_review_count[0]['rating_' . $i . '_count'];
                                        // Calculate the percentage of filled bars
                                        $filledPercentage = $ratingCount / $product_review_count[0]['rating_count'] * 100;
                                        // Generate filled stars HTML
                                        $filledStarsHTML = str_repeat('<span class="filled-star">&#9733;</span>', $rating);
                                        // Generate empty stars HTML
                                        $emptyStarsHTML = str_repeat('<span class="empty-star">&#9734;</span>', 5 - $rating);
                                        // Generate HTML for each rating
                                    ?>
                                        <div class="rating">
                                            <?php echo $filledStarsHTML . $emptyStarsHTML; ?>&nbsp;&nbsp;&nbsp;
                                            <div class="rating-bar bar-<?php echo $rating; ?>" style="width: <?php echo $filledPercentage; ?>%;"></div>
                                            <div class="rating-bar-remaining bar-<?php echo $rating; ?>-remaining" style="width: <?php echo (100 - $filledPercentage); ?>%;"></div>&nbsp;&nbsp;
                                            <span class="rating-count"><?php echo $ratingCount; ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="reviews">
                        <?php for ($i = sizeof($data['reviews']); $i > 0; $i--) : ?>
                            <div class="review">
                                <div class="star-rating">
                                    <?php echo createStarRating($data['reviews'][sizeof($data['reviews']) - $i]['rating']); ?>
                                </div>
                                <p><?php echo $data['reviews'][sizeof($data['reviews']) - $i]['review']; ?></p>
                                <span><?php echo $data['reviews'][sizeof($data['reviews']) - $i]['customer_name']; ?></span><br>
                                <span>Posted on <?php echo $data['reviews'][sizeof($data['reviews']) - $i]['updated_at']; ?></span>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
                <!-- <hr class="section-divider"> -->
            </div>
        <?php endif; ?>



        <div class="white-container">
            <div class="faq-container">
                <h3>FAQs</h3>

                <div class="faq">
                    <div class="question">
                        <span class="material-symbols-outlined">chair</span>
                        <h4>What materials are used in this chair?</h4>
                    </div>
                    <div class="answer">
                        <p>Our chairs are made from high-quality wood and durable fabric upholstery.</p>
                    </div>
                </div>

                <div class="faq">
                    <div class="question">
                        <span class="material-symbols-outlined">local_shipping</span>
                        <h4>How long does shipping take?</h4>
                    </div>
                    <div class="answer">
                        <p>Shipping usually takes 3-5 business days within Sri Lanka.</p>
                    </div>
                </div>

                <div class="faq">
                    <div class="question">
                        <span class="material-symbols-outlined">payment</span>
                        <h4>What payment methods do you accept?</h4>
                    </div>
                    <div class="answer">
                        <p>We accept major credit cards (Visa, Mastercard).</p>
                    </div>
                </div>

                <div class="faq">
                    <div class="question">
                        <span class="material-symbols-outlined">build</span>
                        <h4>Is assembly required?</h4>
                    </div>
                    <div class="answer">
                        <p>Minimal assembly is required. Instructions and tools are included.</p>
                    </div>
                </div>

                <div class="faq">
                    <div class="question">
                        <span class="material-symbols-outlined">local_offer</span>
                        <h4>Do you offer discounts for bulk orders?</h4>
                    </div>
                    <div class="answer">
                        <p>Yes, we provide discounts for bulk orders. Contact our support team for more details.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        console.log(<?php echo $product_id; ?>, <?php echo Auth::getCustomerID(); ?>);

        function addToCart(productId, customerId) {
            var quantity = document.getElementById('quantityInput').value;
            $('#loader').show();

            var ROOT = "http://localhost/wcf/"; // Make sure ROOT includes the trailing slash
            $.ajax({
                url: ROOT + 'cart/edit',
                data: {
                    customer_id: customerId,
                    product_id: productId,
                    quantity: quantity,
                    action: 'add'
                },
                method: "POST",
            }).done(function(response) {
                $('#loader').hide();
                $('.alert').show();
                $('#result').html(response);
                window.location.reload();
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
            'average': <?php echo $product_ratings['avg_rating'] ?? 0;; ?> // Average rating value
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
                    const remainingPercentage = 100 - percentage;
                    const ratingBarRemaining = document.querySelector(`.bar-${key}-remaining`);
                    ratingBarRemaining.style.width = `${remainingPercentage}%`;

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





    <?php $this->view('includes/footer2', $data) ?>