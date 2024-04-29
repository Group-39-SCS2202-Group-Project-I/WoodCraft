    <?php $this->view('customers/acc-header', $data) ?>
    <br><br>
    <?php $this->view('customers/acc-sidebar', $data) ?>
        
        <div class="main-container"> 
        
        <!-- address book -->
        <div class="container">
            <div class="title">
                <h2>Address Book</h2>
                <div class="new-address">
                    <a href="<?=ROOT?>/profile/addaddress/<?= Auth::getCustomerId()?>" class="add-address-link"><span class="highlight-plus">+</span> Add New Address</a>
                </div>
            </div>

            <div class="content-addressbook">
                <div class="address-box">
                    <div class="edit-option">
                        <a href="<?=ROOT?>/profile/address/<?= Auth::getCustomerId()?>">EDIT</a>
                    </div>
        
                    <!-- Address information -->
                    <div class="address-info">
                        <div class="info-value"><?= $data['first_name'] ?> <?= $data['last_name'] ?></div>
                        <div class="info-value"><?= $data['telephone'] ?></div>
                        <div class="info-value"><?= $data['address_line_1'] ?> <?= $data['address_line_2'] ?></div>
        
                        <div class="additional-addressbook">
                            <div class="address-type">Home Address</div>
                            <div class="additional-info">Default Delivery Address</div>
                            <div class="additional-info">Default Billing Address</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></diV>
