<?php $this->view('customer/acc-header', $data) ?>
<br><br>
<?php $this->view('customer/acc-sidebar', $data) ?>

<div class="main-container"> 

    <!-- points -->
    <div class="container">
        <div class="title">
            <h2>Order Details</h2>
        </div>

        <!-- <div class="content-manage-orders">
            <div class="content-manage-order">
                <p>Order <?php echo $data['order']['order_id']; ?></p>
                <p>Total Cost: <?php echo $data['order']['total']; ?></p>
                <p>Order Date: <?php echo $data['order']['created_at']; ?></p>
            </div>

            <div class="content-manage-detail">
                <p>Order Items</p>
                <?php foreach ($data['order_items'] as $item) : ?>
                    <div class="order-item">
                        <img src="<?php echo $item['product_image']; ?>" alt="Product Image">
                        <p>Name: <?php echo $item['product_name']; ?></p>
                        <p>Cost: <?php echo $item['product_price']; ?></p>
                        <p>Quantity: <?php echo $item['quantity']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="content-manage-payment">
                <div class="content-mng-payment">
                    <p>Shipping Address</p>
                    <p><?php echo $data['order']['address_line_1']; ?>, <?php echo $data['order']['address_line_2']; ?>, <?php echo $data['order']['city']; ?> <?php echo $data['order']['zip_code']; ?></p>
                </div>
                <div class="content-mng">
                    <p>Total Summary</p>
                    <p>Subtotal: <?php echo $data['order']['total']; ?></p>
                    <p>Delivery Fee: <?php echo $data['order']['delivery_fee']; ?></p>
                    <p>Total: <?php echo $data['order']['total']; ?></p>
                </div>
            </div>
        </div> -->
    </div>
</div>
</main>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
