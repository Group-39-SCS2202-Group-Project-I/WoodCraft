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
            <div class="content-manage-order">
                <p>Order</p>
                <p>Total Cost:</p>
                <p>Order Date:</p>
            </div>

            <div class="content-manage-detail">
                <!-- <p>Order Items</p> -->
                <!-- <?php foreach ($data['order_items'] as $item) : ?> -->
                    <div class="order-item">
                        <img src="">
                        <p>Name:</p>
                        <p>Cost:</p>
                        <p>Quantity:</p>
                    </div>
                <!-- <?php endforeach; ?> -->
            </div>

            <div class="content-manage-payment">
                <div class="content-mng-payment">
                    <p>Shipping Address</p>
                    <!-- <p><?php echo $data['order_details']['shipping_address']; ?></p> -->
                </div>
                <div class="content-mng">
                    <p>Total Summary</p>
                    <p>Subtotal:</p>
                    <p>Delivery Fee:</p>
                    <p>Total:</p>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
