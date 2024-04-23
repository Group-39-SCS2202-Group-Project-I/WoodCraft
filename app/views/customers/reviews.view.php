<?php $this->view('customers/acc-header', $data) ?>
<br><br>
<?php $this->view('customers/acc-sidebar', $data) ?> 

<div class="main-container"> 

    <!-- my Reviews -->
    <div class="container">
        <div class="title">
            <h2>My Reviews</h2>
        </div>

        <?php foreach ($products as $product) {
    echo "Product Name: " . $product['product_name'] . "<br>";
    echo "Review ID: " . $product['review_id'] . "<br>";
    // Other product details...
} ?>


        <!-- Tab Navigation -->
        <ul class="tab-navigation">
            <li class="active"><a href="#" onclick="switchTab(event, 'to-review')">To Review</a></li>
            <li><a href="#" onclick="switchTab(event, 'history')">History</a></li>
        </ul>

        <!-- To Review Tab -->
        <div id="to-review" class="content active">
            <?php if (!empty($to_review_items)): ?>
                <?php foreach ($to_review_items as $item): ?>
                    <div class="review-item">
                        <div class="item-details">
                            <img src="<?php echo $item['product_image']; ?>" alt="Product Image">
                            <div class="product-info">
                                <span class="order-date"><?php echo $item['order_date']; ?></span>
                                <h3><?php echo $item['product_name']; ?></h3>
                            </div>
                        </div>
                        <a href="<?php echo ROOT; ?>/add_review?product_id=<?php echo $item['product_id']; ?>" class="review-button">Review</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No items to review.</p>
            <?php endif; ?>
        </div>

        <!-- History Tab -->
        <div id="history" class="content">
            <?php if (!empty($history_items)): ?>
                <?php foreach ($history_items as $item): ?>
                    <div class="review-item">
                        <div class="item-details">
                            <img src="<?php echo $item['product_image']; ?>" alt="Product Image">
                            <div class="product-info">
                                <span class="order-date"><?php echo $item['order_date']; ?></span>
                                <h3><?php echo $item['product_name']; ?></h3>
                                <div class="rating-stars" style="width: <?php echo $item['rating'] * 20; ?>%"></div>
                                <span class="review-text"><?php echo $item['review']; ?></span>
                            </div>
                        </div>
                        <a href="<?php echo ROOT; ?>/edit_review?product_id=<?php echo $item['product_id']; ?>" class="edit-button">Edit</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No review history available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function switchTab(event, tabName) {
        event.preventDefault();
        var contents = document.getElementsByClassName("content");
        for (var i = 0; i < contents.length; i++) {
            contents[i].classList.remove("active");
        }
        document.getElementById(tabName).classList.add("active");
        var tabs = document.getElementsByClassName("tab-navigation")[0].getElementsByTagName("a");
        for (var i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove("active");
        }
        event.target.classList.add("active");
    }
</script>
    </main>

    <script src="<?php echo ROOT; ?>/assets/js/manage-account.js"></script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></div>