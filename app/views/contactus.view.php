<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="bootstrap.css"> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>Contact Us Form In Php</title>
</head>
<body>
        <div class="wrapper">
            <div class="form_img">
                <!-- <img src="../../inc/images/background_2.png" alt="background2"> -->
                <img src="<?php echo ROOT; ?>/assets/images/background_2.png" alt="background2" />
            </div>
            <div class="contact_form">
                <header>Send us a Message</header>
                <form action="message.php" method="post">
                    <div class="dbl-field">
                        <div class="field">
                            <input type="text" name="name" placeholder="Enter your name">
                            <i class='fas fa-user'></i>
                        </div>
                        <div class="field">
                            <input type="text" name="email" placeholder="Enter your email">
                            <i class='fas fa-envelope'></i>
                            </div>
                        </div>
                    <div class="dbl-field">
                        <div class="field">
                            <input type="text" name="phone" placeholder="Enter your phone">
                            <i class='fas fa-phone-alt'></i>
                        </div>
                    </div>
                    <div class="message">
                        <textarea placeholder="Write your message" name="message"></textarea>
                        <i class="material-icons">message</i>
                    </div>
                    <div>
                        <?php 
                            $Msg = "";
                            if(isset($_GET['error1']))
                            {
                                $Msg = "Sorry, Internal server error!";
                                echo '<div class="alert alert-danger">'.$Msg.'</div>';
                            }
                            if(isset($_GET['error2']))
                            {
                                $Msg = "Enter a valid email address!";
                                echo '<div class="alert alert-danger">'.$Msg.'</div>';
                            }
                            if(isset($_GET['error3']))
                            {
                                $Msg = "Email and message field is required!";
                                echo '<div class="alert alert-danger">'.$Msg.'</div>';
                            }
    
                            if(isset($_GET['success']))
                            {
                                $Msg = " Your Message Has Been Sent ";
                                echo '<div class="alert alert-success">'.$Msg.'</div>';
                            }
                        ?>
                    </div>
                    <div class="button-area">
                        <button type="submit" name="btn-send">Send Message</button>
                        <span></span>
                    </div>
                    
    
                </form>
            </div>
        </div>
    </body>
</html>