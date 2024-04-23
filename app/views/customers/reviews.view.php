<style>
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
    }

    .content-review {
        display: none;
    }
    
    .content-review.active {
        display: block;
    }

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

                <div class="tab-header">
                    <div class="tab-title index" data-tab="to-review" onclick="showTab('to-review')">To Review</div>
                    <div class="tab-title" data-tab="history" onclick="showTab('history')">History</div>
                </div>

                <div class="tab-content">
                    <!-- To Review Tab -->
                    <div id="to-review" class="content-review active">
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
                                            <div class="rating">
                                                Rating: <?= $product['rating']; ?><br>
                                                <?= $product['review']; ?></div>
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
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabTitles = document.querySelectorAll('.tab-title');

            tabTitles.forEach(title => {
                title.addEventListener('click', function () {
                    const tabId = this.getAttribute('data-tab');
                    showTab(tabId);
                });
            });

            const overviewTabTitle = document.querySelector('.tab-title[data-tab="to-review"]');
            overviewTabTitle.classList.add('active');

            const saveChangesBtn = document.getElementById('saveChangesBtn');
            saveChangesBtn.addEventListener('click', function () {

                showTab('to-review');
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

    <script src="<?php echo ROOT; ?>/assets/js/manage-account.js"></script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></div>