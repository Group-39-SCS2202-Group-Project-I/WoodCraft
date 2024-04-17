<?php $this->view('customer/acc-header', $data) ?>
<br><br>
<?php $this->view('customer/acc-sidebar', $data) ?>

<div class="main-container"> 

    <!-- points -->
    <div class="container">
        <div class="title">
            <h2>Order Details</h2>
        </div>

        <div class="content-manage-orders">
            <?php foreach ($data['order_details'] as $details) : ?>
                <div class="content-manage-order">
                    <p>Order <?= $details['order_details_id']; ?></p>
                    <p>Placed on <?= $details['created_at']; ?></p>
                    <p>Total: Rs. <?= $details['total']; ?></p>
                </div>

                <div class="content-manage-detail">
                    <?php foreach ($data['order_items'] as $item) : ?>
                        <p>Updated on <?= $details['updated_at']; ?></p>
                        <p>Your package has been <?= $details['status']?>.</p>
                        <p>Thank you for shopping with WOODCRAFT.</p>

                            <div class="order-item">
                                <img src="<?= $item['product_image_url']; ?>" alt="Product Image">
                                <p><?= $item['product_name']; ?></p>
                                <p>Rs. <?= $item['price']; ?></p>
                                <p>Qty: <?= $item['quantity']; ?></p>
                            </div>
                    <?php endforeach; ?>
                </div>

                <div class="content-manage-payment">
                    <div class="content-mng-payment">
                        <h4>Shipping Address</h4><br>
                        <p><?= $details['first_name']; ?> <?= $details['last_name']; ?></p> 
                        <p><?= $details['city']; ?></p>
                        <p><?= $details['address_line_1']; ?>, <?= $details['address_line_2']; ?></p>
                        <p><?= $details['telephone']; ?></p> 
                    </div>

                    <div class="content-mng">
                        <h3>Total Summary</h3>
                        <p>Subtotal <?= $data['total_subtotal']; ?></p>
                        <p>Delivery Fee <?= $details['delivery_cost']; ?></p>
                        <p>Total: <?= $details['total']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</main>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
