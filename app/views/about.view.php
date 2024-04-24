<!DOCTYPE html>
<html lang="en">

<?php $this->view('includes/header', $data) ?>

<head>
    <?php $this->view('includes/nav', $data) ?>
    <!-- <?php $this->view('webstore/header-section', $data) ?> -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/about.css">
    <!-- <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"> -->

    <title>About Us | <?=APP_NAME?></title>
</head>

<body>
    <main id="main" class="main">

            <div class="team">
                <div class="team-title">
                    <h2>BOARD OF DIRECTORS</h2>
                </div>
                <div class="team-container">

                    <div class="team-member">
                        <img src="<?php echo ROOT; ?>/assets/images/group-members/Ranahewa.jpg" alt="Team Member 1">
                        <h3>Lasith Ranahewa</h3>
                    </div>
                    <div class="team-member">
                        <img src="<?php echo ROOT; ?>/assets/images/group-members/Premaratne.jpg" alt="Team Member 2">
                        <h3>Sasanka Premaratne</h3>
                    </div>
                    <div class="team-member">
                        <img src="<?php echo ROOT; ?>/assets/images/group-members/Ganegoda.jpeg" alt="Team Member 3">
                        <h3>Piumi Ganegoda</h3>
                    </div>
                    <div class="team-member">
                        <img src="<?php echo ROOT; ?>/assets/images/group-members/Anuththara.jpg" alt="Team Member 4">
                        <h3>Isini Anuththara</h3>
                    </div>
                </div>
            </div>

            <div class="tab-logo-container">
                <div class="tab-container">
                    <h1>What do we do...?</h1>
                    <p>With our well-experienced craftsmen, talented designers, and years of professional experience, 
                        we create interiors that are stimulating and sophisticated. Our portfolio features a range of designs, 
                        and we stay updated with current design trends to provide fresh creations for our customers.</p>

                    <br><h2>Our Vision</h2>
                    <p>We aim to be the best in providing total solutions in furniture and interiors, enhancing our clients' 
                        perceptions of functional and innovative design. Our designs elevate living and working environments uniquely.</p>

                    <br><h2>Our Mission</h2>
                    <p>WoodCraft is on a mission to recognize clients' needs and fulfill them with dedication and hard work. 
                        We insist on delivering quality and strive to build strong relationships with clients and industry partners.</p>
                </div>

                <div class="logo-container">
                    <img src="<?php echo ROOT; ?>/assets/images/about.jpg" alt="about">
                </div>
            </div>
    </main>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>