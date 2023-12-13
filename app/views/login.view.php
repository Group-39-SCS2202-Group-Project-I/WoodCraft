<!DOCTYPE html5>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoodCraft</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
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
        font-size: 2.5rem;
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

    .message {
        color: var(--blk);
        font-size: 1rem;
        margin: 0;
        padding: 1rem;
        /* padding-bottom: 2rem; */
        /* center */
        text-align: center;
    }

    .mzg-box {
        background-color: var(--primary);
        border-radius: 5px;
        margin-bottom: 1rem;
    }

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
</style>

<body>
    <div class="auth-page">
        <div class="auth-container">


            <?php if (message()) : ?>
                <div class="mzg-box">
                    <div class="messege"><?= message('', true) ?></div>
                </div>
            <?php endif; ?>
            <h2>Sign In</h2>

            <form method="post" id="loginForm">
                <!-- <p class="validate-mzg">this is a validate mzg</p> -->
                <input type="email" name="email" placeholder="Email">

                <!-- <p class="validate-mzg">this is a validate mzg</p> -->
                <input type="password" name="password" placeholder="Password">
                <!-- <div class="remember-me">
                <input type="checkbox" id="remember">
                <label for="remember">Remember me</label>
            </div> -->

                <?php if (!empty($errors['email'])) : ?>
                    <p class="validate-mzg"><?= $errors['email'] ?></p>
                <?php endif; ?>
                <button type="submit" id="loginButton">Log In</button>

                <p>Don't have an account? <a href="<?php echo ROOT ?>/signup">Sign Up</a></p>

                <!-- <div class="links">
                    <p>Don't have an account? <br><a href="<?php echo ROOT ?>/signup">Sign Up</a></p>
                    <a class="forgot-password" href="#">Forgot Password?</a>
                </div> -->

            </form>

            <!-- <script>
                const loginButton = document.getElementById("loginButton");
                const loginForm = document.getElementById("loginForm");

                loginButton.addEventListener("click", () => {
                    // Retrieve form data
                    const formData = new FormData(loginForm);
                    const formValues = Object.fromEntries(formData.entries());

                    // Display form details
                    console.log(formValues);
                    // You can replace the console.log with your desired logic to display the form details
                });
            </script> -->
        </div>
    </div>
</body>

</html>