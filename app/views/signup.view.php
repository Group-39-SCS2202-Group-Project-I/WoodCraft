<!DOCTYPE html5>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <title>WoodCraft Furnitures</title>
    <link rel="shortcut icon" href="<?php echo ROOT ?>/assets/logo/favicon.ico" type="image/x-icon">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    body,
    h1,
    h2,
    h3,
    h4,
    p,
    figure,
    blockquote,
    dl,
    dd {
        margin: 0;
    }

    ul,
    ol {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    figure,
    blockquote,
    dl,
    dd {
        padding: 0;
    }

    body {
        min-height: 100vh;
        scroll-behavior: smooth;
        text-rendering: optimizeSpeed;
        line-height: 1.5;
    }

    ul,
    ol {
        list-style: none;
    }

    a:not([class]) {
        text-decoration-skip-ink: auto;
    }

    img {
        max-width: 100%;
        display: block;
    }

    article>*+* {
        margin-top: 1em;
    }

    input,
    button,
    textarea,
    select {
        font: inherit;
    }

    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
            scroll-behavior: auto !important;
        }
    }

    /* Variables */
    :root {
        --primary: #6D9886;
        --secondary: #D9CAB3;
        --blk: #212121;
        --light: #F6F6F6;

        --danger: #DD4A48;
    }

    /* Base */
    html {
        font-family: 'Montserrat', sans-serif;
        font-size: 16px;
        color: var(--blk);
    }

    body {
        background-color: var(--primary);
        justify-content: center;
        /* to horizontally center the container */
        align-items: center;
        margin: 0;
        padding: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: var(--blk);
        font-weight: 600;
    }



    .auth-page {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .auth-container {
        /* float: right; */
        max-width: 700px;
        font-size: 1rem;
        /* margin: 5% 10%; */
        /* height: 95vh; */
        width: 60%;
        background-color: #fff;
        padding: 50px 50px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        margin-top: 0%;
        font-size: 1.5rem;
        color: #262626;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="tel"] {
        padding: 15px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        background-color: var(--light);
        font-size: 1rem;
        /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); */
    }

    input:focus {
        outline: none;
        border: 2px solid var(--primary);
    }

    select {
        padding: 15px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        background-color: var(--light);
        font-size: 1rem;
        width: 100%;
    }

    select:focus {
        outline: none;
        border: 2px solid var(--primary);
    }

    select::placeholder {
        color: red;
    }

    button {
        padding: 15px 20px;
        background-color: var(--blk);
        color: var(--light);
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 1rem;
        width: 100%;
        margin: 0.5rem 0;
    }

    .auth-container input[type="checkbox"] {
        width: 15px;
        height: 15px;
    }

    .auth-container input[type="checkbox"]:checked {
        accent-color: var(--primary);
    }

    button:hover {
        background-color: var(--primary);
    }

    a {
        text-decoration: none;
        color: var(--primary);
        margin: 2% 0%;
    }

    .remember-me,
    .default-address {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .links {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .forgot-password {
        float: right;
    }

    label {
        margin-left: 10px;
        color: var(--blk);
    }

    #initialSection {
        display: flex;
        flex-direction: column;
    }

    #initialSection input[type="text"],
    #initialSection input[type="email"],
    #initialSection input[type="password"] {
        width: 100%;
    }

    #initialSection button {
        align-self: flex-end;
    }

    #contactSection {
        display: flex;
        flex-direction: column;
    }

    #contactSection input[type="tel"],
    #contactSection input[type="text"] {
        width: 100%;
    }

    #contactSection button {
        width: 49%;
    }

    .validate-mzg {
        color: var(--danger);
        font-size: 0.8rem;
        margin: 0;
        padding: 0;
        /* display: none; */
    }

    .hidden {
        display: none;
    }

    /* .border-validate {
        border: 2px solid var(--danger);
    } */


    @media (max-width: 760px) {
        .container {
            float: none;
            width: auto;
            margin: 0;
            border-radius: 0;
            box-shadow: none;
            /* padding: 50px 50px; */
            height: 100vh;
            width: 100vh;
            scroll-behavior: unset;
        }
    }

    .navl-cont {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .nav__logo {
        font-size: 2rem;
        font-weight: 600;
        color: var(--first-color);
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoodCraft</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
</head>

<body>
    <div class="auth-page">
        <div class="auth-container">
            <div class="navl-cont">
                <a class="nav__logo material-icons-outlined" style="font-size: 60px; font-weight: 500; color: var(--primary);"> living </a> <a class="nav__logo" style="padding-left: 5px ;color: var(--primary);"> WoodCraft Furnitures </a>
            </div>
            <h2>Sign Up</h2>
            <form method="post" id="signupForm">
                <div id="initialSection">
                    <!-- <p class="validate-mzg">this is validate mzg</p> -->
                    <?php if (!empty($errors['first_name'])) : ?>
                        <p class="validate-mzg "><?= $errors['first_name'] ?></p>
                    <?php endif; ?>
                    <input value="<?= set_value('first_name') ?>" type="text" name="first_name" placeholder="First Name">

                    <?php if (!empty($errors['last_name'])) : ?>
                        <p class="validate-mzg "><?= $errors['last_name'] ?></p>
                    <?php endif; ?>
                    <input value="<?= set_value('last_name') ?>" type="text" name="last_name" placeholder="Last Name" required1>

                    <?php if (!empty($errors['email'])) : ?>
                        <p class="validate-mzg "><?= $errors['email'] ?></p>
                    <?php endif; ?>
                    <input value="<?= set_value('email') ?>" type="text" name="email" placeholder="Email" required1>

                    <?php if (!empty($errors['password'])) : ?>
                        <p class="validate-mzg "><?= $errors['password'] ?></p>
                    <?php endif; ?>
                    <input value="<?= set_value('password') ?>" type="password" name="password" placeholder="Password" required1>

                    <?php if (!empty($errors['confirm_password'])) : ?>
                        <p class="validate-mzg "><?= $errors['confirm_password'] ?></p>
                    <?php endif; ?>
                    <input value="<?= set_value('confirm_password') ?>" type="password" name="confirm_password" placeholder="Confirm Password" required1>
                    <button type="button" id="nextButton">Next</button>

                </div>
                <div id="contactSection" style="display: none;">
                    <?php if (!empty($errors['telephone'])) : ?>
                        <p class="validate-mzg "><?= $errors['telephone'] ?></p>
                    <?php endif; ?>
                    <input value="<?= set_value('telephone') ?>" type="tel" name="telephone" placeholder="Contact Number">


                    <section>
                        <?php if (!empty($errors['address_line_1'])) : ?>
                            <p class="validate-mzg "><?= $errors['address_line_1'] ?></p>
                        <?php endif; ?>
                        <input value="<?= set_value('address_line_1') ?>" type="text" name="address_line_1" placeholder="Address Line 1">
                        <?php if (!empty($errors['address_line_2'])) : ?>
                            <p class="validate-mzg "><?= $errors['address_line_2'] ?></p>
                        <?php endif; ?>
                        <input value="<?= set_value('address_line_2') ?>" type="text" name="address_line_2" placeholder="Address Line 2">
                        <?php if (!empty($errors['city'])) : ?>
                            <p class="validate-mzg "><?= $errors['city'] ?></p>
                        <?php endif; ?>
                        <input value="<?= set_value('city') ?>" type="text" name="city" placeholder="City">

                        <?php if (!empty($errors['province'])) : ?>
                            <p class="validate-mzg "><?= $errors['province'] ?></p>
                        <?php endif; ?>
                        <!-- 'Central','Eastern','North Central','Northern','North Western','Sabaragamuwa','Southern','Uva','Western' -->
                        <select name="province" id="province">
                            <!-- <option value="" style="color:#757575;">Province</option> -->
                            <option value="Western" selected>Western Province</option>
                            <option value="Central">Central Province</option>
                            <option value="Eastern">Eastern Province</option>
                            <option value="North Central">North Central Province</option>
                            <option value="Northern">Northern Province</option>
                            <option value="North Western">North Western Province</option>
                            <option value="Sabaragamuwa">Sabaragamuwa Province</option>
                            <option value="Southern">Southern Province</option>
                            <option value="Uva">Uva Province</option>
                        </select>
                        <?php if (!empty($errors['zip_code'])) : ?>
                            <p class="validate-mzg "><?= $errors['zip_code'] ?></p>
                        <?php endif; ?>
                        <input value="<?= set_value('zip_code') ?>" type="text" name="zip_code" placeholder="Zip Code">
                        <!-- <div class="default-address">
                            <input type="checkbox" id="shipping">
                            <label for="shipping">Set as default shipping address</label>
                        </div> -->
                    </section>
                    <p>By creating an account you agree with our <a>Terms of Service, Privacy
                            Policy.</a></p>
                    <div style="width: 100%;">
                        <button type="button" id="backButton" style="float: left; width: 29%;">Back</button>
                        <button type="submit" style="float: right; width: 70%" id="signupButton">Sign Up</button>


                    </div>
                </div>
                <p>Do you have an account? <a href="<?php echo ROOT ?>/login">Log In</a></p>
            </form>
        </div>
    </div>

    </div>
    </div>


    <script>
        const initialSection = document.getElementById("initialSection");
        const contactSection = document.getElementById("contactSection");
        const nextButton = document.getElementById("nextButton");
        const backButton = document.getElementById("backButton");

        nextButton.addEventListener("click", () => {
            initialSection.style.display = "none";
            contactSection.style.display = "block";
        });

        backButton.addEventListener("click", () => {
            initialSection.style.display = "block";
            contactSection.style.display = "none";
        });
    </script>
</body>

</html>