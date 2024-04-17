<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .order {
            border: 1px solid #ddd;
            margin: 20px;
            padding: 10px;
            width: 100%;
            position: relative; 
        }
        .order::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #ddd;
        }
        .status {
            background-color: #ddd;
            color: black;
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 14px;
        }
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .order-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .order-info p {
            margin: 0;
        }
        .order-details {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .order-details p {
            margin: 0;
        }
        .order-info small {
            font-size: 14px;
        }
        .product-details {
            width: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            overflow: hidden;
        }
        .product-details img {
            width: 100%;
            height: auto;
            margin-bottom: 5px;
        }
    </style>

    <?php $this->view('customer/acc-header', $data) ?>
    <br><br>
    <?php $this->view('customer/acc-sidebar', $data) ?>
        
        <div class="main-container"> 

        <!-- points -->
        <div class="container">
            <div class="title">
                <h2>My Orders</h2>
            </div>

            <div class="content-order">
                <div class="content-show">
                    <label for="row-count">Show:</label>
                    <select id="display-options">
                        <option value="last-5">Last 5 orders</option>
                        <option value="last-30-days">Last 30 days</option>
                        <option value="all-orders">All orders</option>
                        <option value="retail-orders">Retail orders</option>
                        <option value="bulk-orders">Bulk orders</option>
                    </select>
                </div>

                <div class="content-orders">
                <?php if (!empty($orders)) : ?>
                        <?php foreach ($orders as $order) : ?>
                            <div class="order">
                                <div class="order-header">
                                    <div class="order-info">
                                        <p> order  <strong style="color: blue;"><?= $order['order_details_id'] ?></strong></p>
                                        <p><small>Placed on <?= $order['created_at'] ?></small></p>
                                    </div>
                                    <a href="<?= ROOT ?>/customer/orders/<?= $order['order_details_id'] ?>">Manage</a>
                                </div>
                                <!-- <div class="status"><?= $order['status'] ?></div> -->
                                <div class="order-details">
                                    <div class="product-details">
                                        <img src="<?= $order['product_image_url'] ?>" alt="Product Image" width="100" height="100">
                                        <p><?= $order['product_name'] ?></p>
                                    </div>
                                    <!-- <img src="path/to/your/image.jpg" alt="Order Item Image" width="100" height="100"> -->
                                    <p>Qty: <?= $order['quantity'] ?></p>
                                    <div class="status"><?= $order['status'] ?></div>
                                    <!-- <p> <?= $order['status'] ?></p> -->
                                    <p><small>Updated on  <?= $order['created_at'] ?></small></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No orders found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <script>
    // Get the select element
    var selectDisplayOptions = document.getElementById("display-options");

    // Add event listener to handle selection change
    selectDisplayOptions.addEventListener("change", function() {
        // Get the selected value
        var selectedValue = this.value;

        // Get all rows in the table body
        var tableRows = document.querySelectorAll(".content-orders table tr");

        // Loop through each row
        for (var i = 1; i < tableRows.length; i++) {
            // Show or hide rows based on the selected value
            switch (selectedValue) {
                case "last-5":
                    // Loop through each row starting from the last row
                    for (var i = tableRows.length - 1; i >= 0; i--) {
                        // Calculate the index of the row relative to the end of the table
                        var reverseIndex = tableRows.length - 1 - i;

                        // Show or hide rows based on their position relative to the end of the table
                        if (reverseIndex < 5) {
                            tableRows[i].style.display = "table-row";
                        } else {
                            tableRows[i].style.display = "none";
                        }
                    }
                    break;
                case "all-orders":
                    // Show all rows
                    tableRows[i].style.display = "table-row";
                    break;
                default:
                    break;
            }
        }
    });
</script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></diV>
