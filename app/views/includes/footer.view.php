<?php
$minimized = false;

if (isset($_POST['minimize_footer'])) {
    $minimized = $_POST['minimize_footer'] == 'true';
}

function toggleFooter() {
    if ($GLOBALS['minimized']) {
        $GLOBALS['minimized'] = false;
    } else {
        $GLOBALS['minimized'] = true;
    }
}
?>


    <style>
        .toggle-button {
            background-color: var(--coal_black);
            /* border: 0.5px solid var(--light); */
            /* border-radius: 20px; */
            padding: 2px 15px;
            cursor: pointer;
            margin: 0px 40px;
            float: right;
            color: var(--light);
        }

        .arrow-icon {
            font-size: 14px;
            vertical-align: middle;
        }

        .footer-nav-container,
        .footer-info,
        .footer-socialmedia,
        .footer-logo,
        .h-line {
            display: <?php echo $minimized ? 'none' : 'block'; ?>;
        }

         .footer-nav-container {
            display: <?php echo $minimized ? 'none' : 'flex'; ?>;
            flex-wrap: wrap;
        }   
    </style>

<!DOCTYPE html>
<html>
<head>
    <title>Your Page Title</title>  
</head>
<body>
  <form method="post">
    <button type="submit" name="minimize_footer" value="<?php echo $minimized ? 'false' : 'true'; ?>" class="toggle-button">
      <?php echo $minimized ? '<ion-icon class="arrow-icon" name="arrow-up-outline"></ion-icon>' : '<ion-icon class="arrow-icon" name="arrow-down-outline"></ion-icon>'; ?>
      <!-- <?php echo $minimized ? 'Show Full Footer' : 'Show Minimized Footer'; ?> -->
    </button>
  </form>
    
    <footer>
        <div class="footer-container">
            <div class="footer-subcontainer">
                <div class="footer-info">
                    <div class="footer-description">
                        <div class="footer-logo">
                            <img src="<?php echo ROOT ?>/assets/images/Logo_green.png" alt="WoodCraft Logo">
                        </div>
                        <p>
                            We offer furniture that complements your style and makes you proud to have in your home. From living room to bedroom, we've got you covered.
                        </p>
                    </div>
                    <div class="footer-socialmedia">
                        <img src="<?php echo ROOT ?>/assets/images/1.png" alt="twitter">
                        <img src="<?php echo ROOT ?>/assets/images/2.png" alt="facebook">
                        <img src="<?php echo ROOT ?>/assets/images/3.png" alt="instagram">
                    </div>
                </div>
                <div class="footer-nav-container">
                    <div class="footer-nav">
                      <h2>COMPANY</h2>
                      <ul>
                        <li><a href="<?= ROOT ?>/about">About Us</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="<?= ROOT ?>/profile">Account</a></li>
                        <li><a href="<?= ROOT ?>/contact">Contact Us</a></li>
                      </ul>
                    </div>
                    <!-- <div class="footer-nav">
                      <h2>SHOP</h2>
                      <ul>
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Imported</a></li>
                        <li><a href="#">Manage Deliveries</a></li>
                        <li><a href="#">Payment Options</a></li>
                      </ul>
                    </div> -->
                    <div class="footer-nav">
                      <h2>FAQ</h2>
                      <ul>
                        <li><a href="<?= ROOT ?>/profile">Account</a></li>
                        <li><a href="<?= ROOT ?>/orders">Orders</a></li>
                        <li><a href="<?= ROOT ?>/orders/bulkOrders">Bulk Orders</a></li>
                        <li><a href="<?= ROOT ?>/review">Reviews</a></li>
                      </ul>
                    </div> 
                    <div class="footer-nav">
                      <h2>SUPPORT</h2>
                      <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Most Rated</a></li>
                        <li><a href="#">Payments</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                      </ul>
                    </div>
                </div>
            </div>

            <?php if (!$minimized) { ?>
            <hr class="h-line">
            <?php } ?>
            
            <div class="footer-copyright" <?php if ($minimized) echo 'style="display: inline-block;"'; ?>>
                <p>&copy; WoodCraft 2023, All Rights Reserved</p>
                <div class="terms">
                    <a href="#">Terms and Conditions</a> <p>|</p> <a href="#">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?php echo ROOT ?>/assets/js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
