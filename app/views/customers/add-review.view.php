<style>
    .content-add-review{
        padding: 10px;
        margin: 20px;
    }

    .review-product, .rating, .update, 
        .written-review, .button-review {
        border-radius: 10px;
        background-color: var(--light);
        width: 100%;
        margin-bottom: 20px;
        padding: 30px;
    }

    .review-product {
        display: flex;
        align-items: center;
    }

    .review-product img {
        width: 100px;
        height: auto;
        margin-right: 50px;
    }

    .review-product p {
        font-weight: bold;
    }

    /* .rating-star {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .rating input[type="radio"] {
        display: none;
    }

    .rating label {
        cursor: pointer;
    } */

    /* .rating label::before {
        content: "☆";
        font-size: 24px;
        color: #999;
    }

    .rating input[type="radio"]:checked + label::before {
        color: gold;
    }

    .update p {
        color: green;
    } */

    .written-review label {
        font-weight: bold;
    }

    .written-review textarea {
        border: 1px solid var(--bg2);
        border-radius: 10px;
        padding: 10px;
        margin-top: 20px;
        font-size: 14px;
        width: 90%;
    }

    .written-review textarea:hover {
        border: 1px solid var(--green2);
    }

    .review-buttons {
        text-align: center;
    }

    .review-buttons button {
        background-color: var(--coal_black);
        color: var(--white);
        padding: 8px 12px;
        width: 250px;
        border: none;
        border-radius: 10px;
        display: inline;
        cursor: pointer;
    }

    .review-buttons button:hover {
        background-color: var(--green1);
    }

    .written-review span {
        padding: 10px 0px 0px 85%;
        font-size: 12px;
        color: var(--bg1);
    }

    .rating {
        margin-bottom: 20px;
    }

    .rating-label {
        font-weight: bold;
    }

    .stars {
        margin: 20px 0px 10px 0px;
        text-align: center;
    }

    .star {
        cursor: pointer;
        color: gold;
        font-size: 25px;
    }

    .tag {
        display: none;
        font-size: 14px;
        margin-left: 47%;
    }

    .bottom-page {
        display: flex;
        flex-direction: column;
        align-items:flex-start; 
        margin-bottom: 10px;
    }

    .back-orders {
        background-color: var(--light);
        border: none;
        border-radius: 20px;
        padding: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 20px;
    }

    .back-orders:hover {
        background-color: var(--green1);
    }
</style>

<?php $this->view('customers/acc-header', $data) ?>

<div class="main-container"> 

    <!-- side bar -->
    <?php
    // Define the isCurrentPage function
    function isCurrentPage($pageName) {
        // Get the path part of the URL
        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Check if the current path starts with the given page name
        return strncmp($currentPath, $pageName, strlen($pageName)) === 0;
    }
    ?>

    <div class="side-bar-customer">
        <ul class="customer-sidebar-list">
            <li class="customer-sidebar-list-item main-title <?= isCurrentPage('profile') ? 'selected' : '' ?>" id="profile-nav">
                <a href="<?=ROOT?>/profile"><span style="margin-left: 5px;">My Profile</span></a>
            </li>
            <li class="customer-sidebar-list-item main-title <?= isCurrentPage('orders') ? 'selected' : '' ?>" id="orders-nav">
                <a href="<?=ROOT?>/orders"><span style="margin-left: 5px;">My Orders</span></a>
            </li>
            <li class="customer-sidebar-list-item main-title <?= isCurrentPage('bulkOrders') ? 'selected' : '' ?>" id="bulk-nav">
                <a href="<?=ROOT?>/orders/bulk"><span style="margin-left: 5px;">My Bulk Orders</span></a>
            </li>
            <li class="customer-sidebar-list-item main-title selected <?= isCurrentPage('review') ? 'selected' : '' ?>" id="review-nav">
                <a href="<?=ROOT?>/review"><span style="margin-left: 5px;">My Reviews</span></a>
            </li>
        </ul>
    </div>

    <!-- Add Reviews -->
    <div class="container">
        <div class="title">
            <h2>My Reviews</h2>
        </div>
        
        
        <div class="content-add-review">
            <div class="bottom-page">
                <a href="<?=ROOT?>/review" class="back-orders"><i class="material-icons">arrow_back</i></a>
            </div>

           
            <form action="<?=ROOT?>/review/add" method="post">
                    <!-- <?php show($product); ?> -->
                    <input type="hidden" name="product_id" value="<?=$product['product_id'];?>">

                    <div class="review-product">
                        <img src="<?= $product['image_url']; ?>" alt="<?= $product['product_name']; ?>">
                        <p><?= $product['product_name']; ?></p>
                    </div>

                    <div class="rating">
                        <div class="rating-label">Select Product Rating</div>
                        <!-- <form id="ratingForm" action="<?=ROOT?>/review/addReview" method="post"> -->
                            <div class="stars" data-rating="0">
                                <span class="material-icons star" data-value="1">star_border</span>
                                <span class="material-icons star" data-value="2">star_border</span>
                                <span class="material-icons star" data-value="3">star_border</span>
                                <span class="material-icons star" data-value="4">star_border</span>
                                <span class="material-icons star" data-value="5">star_border</span>
                            </div>
                            <input type="hidden" name="rating" id="ratingInput" value="0">
                        <!-- </form> -->
                        <div id="tagContainer">
                            <span id="tag1" class="tag">Terrible</span>
                            <span id="tag2" class="tag">Poor</span>
                            <span id="tag3" class="tag">Fair</span>
                            <span id="tag4" class="tag">Good</span>
                            <span id="tag5" class="tag">Excellent</span>
                        </div>
                    </div>

                    <script>
                       document.addEventListener('DOMContentLoaded', function() {
                        const stars = document.querySelectorAll('.star');
                        const ratingInput = document.getElementById('ratingInput');
                        const tagContainer = document.getElementById('tagContainer');

                        stars.forEach(star => {
                            star.addEventListener('click', function() {
                                const value = parseInt(this.getAttribute('data-value'));
                                ratingInput.value = value;
                                updateStars(value);
                                displayTag(value);
                            });
                        });

                        function updateStars(value) {
                            stars.forEach(star => {
                                const starValue = parseInt(star.getAttribute('data-value'));
                                if (starValue <= value) {
                                    star.textContent = 'star';
                                    star.classList.add('filled');
                                } else {
                                    star.textContent = 'star_border';
                                    star.classList.remove('filled');
                                }
                            });
                        }

                        function displayTag(value) {
                            const tags = document.querySelectorAll('.tag');
                            tags.forEach(tag => {
                                const tagValue = parseInt(tag.id.replace('tag', ''));
                                if (tagValue === value) {
                                    tag.style.display = 'inline-block';
                                } else {
                                    tag.style.display = 'none';
                                }
                            });
                        }
                        });
                    </script>


                    <div class="written-review">
                        <label for="review">Add Written Review</label><br>
                        <textarea name="review" id="review" rows="5" placeholder="How's the quality of the product? Is it worth it's price?" oninput="updateLetterCount()"></textarea>
                        <span id="letter-count">0/500</span>
                    </div>

                    <script>
                        function updateLetterCount() {
                            // Get the textarea value
                            var text = document.getElementById('review').value;
                            
                            // Get the length of the text
                            var letterCount = text.length;

                            // Update the letter count span
                            var letterCountSpan = document.getElementById('letter-count');
                            letterCountSpan.textContent = letterCount + '/500';
                        }
                    </script>

                    <div class="review-buttons">
                        <button type="submit">SUBMIT REVIEW</button>
                    </div>
            </form>
            
        </div>
    </div>
</main>

<script src="<?php echo ROOT; ?>/assets/js/manage-account.js"></script>
</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></div>