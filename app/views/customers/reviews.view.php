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
        color: var(--green2);
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
        background-color: var(--light);
        margin-bottom: 30px;
        transition: box-shadow 0.3s;
    }

    .review-item:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .to-review-item {
        border: 1px solid var(--bg2);
        border-radius: 10px;
        padding: 20px;
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .review-date small {
        color: var(--bg1);
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
        background-color: var(--coal_black);
        color: var(--white);
        border: none;
        border-radius: 10px;
        padding: 8px 12px;
        transition: background-color 0.3s;
        margin-right: 25px;
    }

    .review-button:hover {
        background-color: var(--green1);
    }

     /* History Tab */
     .content-history {
        margin-top: 20px;
    }

    .review-date {
        margin-bottom: 10px;
    }

    .review-date small {
        color: var(--bg1);
        font-size: 12px;
    }

    .history-item {
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        background-color: var(--light);
        transition: box-shadow 0.3s;
    }

    .history-item:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
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

    .star-icon {
        color: gold;
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
                            <!-- <li class="customer-sidebar-list-item sub-title <?= isCurrentPage('editProfile') ? 'selected' : '' ?>" id="editp-nav">
                                <a href="<?=ROOT?>/profile/editProfile">Edit Profile<span style="margin-left: 35px;"></span></a>
                            </li>
                            <li class="customer-sidebar-list-item sub-title <?= isCurrentPage('editAddress') ? 'selected' : '' ?>" id="edita-nav">
                                <a href="<?=ROOT?>/profile/editAddress">Edit Address<span style="margin-left: 35px;"></span></a>
                            </li>
                            <li class="customer-sidebar-list-item sub-title <?= isCurrentPage('password') ? 'selected' : '' ?>" id="password-nav">
                                <a href="<?=ROOT?>/profile/password">Change Password<span style="margin-left: 35px;"></span></a>
                            </li> -->
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

            <!-- my Reviews -->
            <div class="container">
                <div class="title">
                    <h2>My Reviews</h2>
                </div>

                <div class="tab-header">
                    <div class="tab-title" data-tab="to-review" onclick="showTab('to-review')">To Review</div>
                    <div class="tab-title index" data-tab="history" onclick="showTab('history')">History</div>
                </div>

                <div class="tab-content">
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

                                            <a href="<?=ROOT?>/review/<?= $product['review_id']; ?>"><button type="button" class="review-button">REVIEW</button></a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <div class="no-detail">
                                <p>No products to review.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- History Tab -->
                    <?php
                    function displayStarIcons($number) {
                        // Validate input
                        if ($number < 0 || $number > 5) {
                            echo "Rating should be between 0 and 5.";
                            return;
                        }

                        // Display filled star icons
                        for ($i = 0; $i < $number; $i++) {
                            echo '<span class="material-icons star-icon">star</span>';
                        }

                        // Display not filled star icons
                        for ($i = $number; $i < 5; $i++) {
                            echo '<span class="material-icons star-icon">star_border</span>';
                        }
                    }
                    ?>

                    <div id="history" class="content-review active">
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
                                            <?php displayStarIcons($product['rating']); ?><br>
                                            <?= $product['review']; ?>
                                        </div>
                                        <a href="<?=ROOT?>/review/<?= $product['review_id']; ?>"><button type="button" class="review-button">EDIT</button></a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="no-detail">
                                <p>No review history available.</p>
                            </div>
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

            const overviewTabTitle = document.querySelector('.tab-title[data-tab="history"]');
            overviewTabTitle.classList.add('active');

            const saveChangesBtn = document.getElementById('saveChangesBtn');
            saveChangesBtn.addEventListener('click', function () {

                showTab('history');
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