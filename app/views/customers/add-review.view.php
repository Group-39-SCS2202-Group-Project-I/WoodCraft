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

    .rating-star {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .rating input[type="radio"] {
        display: none;
    }

    .rating label {
        cursor: pointer;
    }

    .rating label::before {
        content: "☆";
        font-size: 24px;
        color: #999; /* Unselected star color */
    }

    .rating input[type="radio"]:checked + label::before {
        color: gold; /* Selected star color */
    }

    .update p {
        color: green;
    }

    .written-review label {
        font-weight: bold;
    }

    .written-review textarea {
        border: 1px solid var(--bg2);
        border-radius: 10px;
        padding: 10px;
        margin-top: 20px;
        font-size: 14px;
        width: 80%;
    }

    .written-review textarea:hover {
        border: 1px solid var(--green2);
    }

    .review-buttons {
        text-align: center; /* Center the button */
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
                <a href="<?=ROOT?>/orders/bulkOrders"><span style="margin-left: 5px;">My Bulk Orders</span></a>
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
            <form action="<?=ROOT?>/review/addReview" method="post">
                <?php foreach ($product as $item) : ?>
                    <input type="hidden" name="product_id" value="<?=$item['product_id'];?>">

                    <div class="review-product">
                        <img src="<?= $item['product_image']; ?>" alt="<?= $item['product_name']; ?>">
                        <p><?= $item['product_name']; ?></p>
                    </div>

                    <div class="rating">
                        <div class="rating-star">
                            <label for="rating">Select Product Rating</label><br>
                                <input type="radio" id="rating1" name="rating" value="1">
                                <label for="rating1">1 - Terrible</label><br>
                                <input type="radio" id="rating2" name="rating" value="2">
                                <label for="rating2">2 - Poor</label><br>
                                <input type="radio" id="rating3" name="rating" value="3">
                                <label for="rating3">3 - Fair</label><br>
                                <input type="radio" id="rating4" name="rating" value="4">
                                <label for="rating4">4 - Good</label><br>
                                <input type="radio" id="rating5" name="rating" value="5">
                                <label for="rating5">5 - Excellent</label>
                        </div>

                            <div class="update">
                                <p>Thank you for rating!</p>
                            </div>
                    </div>

                    <div class="written-review">
                        <label for="review">Add Written Review</label><br>
                        <textarea name="review" id="review" rows="5" placeholder="How's the quality of the product? Is it worth it's price?"></textarea><br>
                        <span id="letter-count">0/500</span>
                    </div>

                    <div class="review-buttons">
                        <button type="submit">Submit Review</button>
                    </div>
                <?php endforeach ; ?>
            </form>
            
        </div>
    </div>
</main>

<script src="<?php echo ROOT; ?>/assets/js/manage-account.js"></script>
</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></div>