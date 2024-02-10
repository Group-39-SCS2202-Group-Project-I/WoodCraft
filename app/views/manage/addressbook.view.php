<!DOCTYPE html>
<html lang="en">

<?php $this->view('includes/header', $data) ?>

<head>
    <?php $this->view('includes/nav', $data) ?>
    <!-- <?php $this->view('webstore/header-section', $data) ?> -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/manage-account.css">
    <!-- <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"> -->

    <title>Manage My Account | Wood Craft</title>
</head>

<body>
    <main id="main" class="main">
        <!-- address book -->
        <div class="container">
            <div class="title">
                <h2>Address Book</h2>
                <div class="new-address">
                    <a href="##.html" class="add-address-link"><span class="highlight-plus">+</span> Add New Address</a>
                </div>
            </div>

            <div class="content-addressbook">
                <div class="address-box">
                    <div class="edit-option">
                        <a href="#">EDIT</a>
                    </div>
        
                    <!-- Address information -->
                    <div class="address-info">
                        <div class="info-value">John Doe</div>
                        <div class="info-value">0712345678</div>
                        <div class="info-value">123 Main Street, City</div>
        
                        <div class="addotional-addressbook">
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
