<style>
    /* To Review Tab */
    .content-to-review {
        margin-top: 20px;
    }

    .review-item {
        padding: 20px;
        border-radius: 10px;
        background-color: yellowgreen;
        margin-bottom: 20px;
    }

    .to-review-item {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 10px;
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .review-date small {
        color: gray;
        font-size: 12px;
    }

    .to-review-item img {
        width: 150px;
        height: 150px;
        margin-right: 50px;
    }

    .to-review-item p {
        flex-grow: 1; /* Allow the text to take up remaining space */
    }

    .review-button {
        cursor: pointer;
        text-align: center;
        width: 100px;
        font-size: 1em;
        background-color: var(--green1);
        color: var(--white);
        border: none;
        border-radius: 10px;
        padding: 8px 12px;
        transition: background-color 0.3s;
        margin-right: 25px;
    }

    .review-button:hover {
        background-color: black;
    }

     /* History Tab */
     .content-history {
        margin-top: 20px;
    }

    .review-date {
        margin-bottom: 10px;
    }

    .review-date small {
        color: gray;
        font-size: 12px;
    }

    .history-item {
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        background-color: yellowgreen;
    }

    .history-item img {
        width: 150px;
        height: 150px;
        margin-right: 50px;
    }

    .history-item p {
        margin: 0;
        flex-grow: 1;
    }

    .history-to-review-item {
        padding: 10px;
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .rating {
        flex: 1;
    }
</style>

<?php $this->view('customers/acc-header', $data) ?>
<br><br>
<?php $this->view('customers/acc-sidebar', $data) ?> 

        <div class="main-container"> 

            <!-- my Reviews -->
            <div class="container">
                <div class="title">
                    <h2>My Reviews</h2>
                </div>

                <!-- To Review Tab -->
                <div id="to-review" class="content-review">
                    <?php if (!empty($toReviewProducts)) : ?>
                        <div class="content-to-review">
                            <?php foreach ($toReviewProducts as $product) : ?>
                                <div class="review-item">
                                    <div class="review-date">
                                        <small>Placed on <?= $product['created_at']; ?></small>
                                    </div>
                                    <div class="to-review-item">
                                        <img src="<?= $product['product_image']; ?>" alt="<?= $product['product_name']; ?>">
                                        <p><?= $product['product_name']; ?></p>

                                        <button class="review-button" onclick="window.location.href = 'add-review.php';">Review</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p>No products to review.</p>
                    <?php endif; ?>
                </div>

                <!-- History Tab -->
                <div id="history" class="content-review">
                    <?php if (!empty($reviewedProducts)): ?>
                        <div class="content-history">
                            <?php foreach ($reviewedProducts as $product) : ?>
                                <div class="history-item">
                                    <div class="review-date">
                                        <small>Placed on <?= $product['created_at']; ?></small>
                                    </div>
                                    <div class="to-review-item">
                                        <img src="<?= $product['product_image']; ?>" alt="<?= $product['product_name']; ?>">
                                        <p><?= $product['product_name']; ?></p>
                                    </div>
                                    <div class="history-to-review-item">
                                        <div class="rating">Rating: <?= $product['rating']; ?><br>Review: <?= $product['review']; ?></div>
                                        <button class="review-button" onclick="window.location.href = 'edit-review.php';">Edit</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>No review history available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <script src="<?php echo ROOT; ?>/assets/js/manage-account.js"></script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></div>