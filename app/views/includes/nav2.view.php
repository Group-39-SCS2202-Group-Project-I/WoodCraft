<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/webstyles.css">
    <link rel="shortcut icon" href="<?php echo ROOT ?>/assets/logo/favicon.ico" type="image/x-icon">

    <title>WoodCraft Furnitures</title>
</head>

<body>
    <!--=============== HEADER ===============-->
    <header2 class="header2" id="header2">
        <nav class="navi container">

            <div class="navl-cont">
                <a href="<?= ROOT ?>" class="naiv_logo material-icons-outlined" style="font-size: 30px; font-weight: 400; color: var(--primary);"> living </a> <a class="navi_logo" style="padding-left: 5px ;color: var(--primary);"> WoodCraft Furnitures </a>
            </div>




            <div class="navi__menu" id="navi-menu">
                <ul class="navi__list">
                    <li class="navi__item">
                        <a href="<?= ROOT ?>" class="navi__link active-link homelink">
                            <span class="material-symbols-outlined navi__icon">
                                home
                            </span>
                            <span class="navi__name">Home</span>
                        </a>
                    </li>

                    <li class="navi__item">
                        <a href="<?= ROOT ?>/products" class="navi__link">
                            <span class="material-symbols-outlined navi__icon">
                                chair
                            </span>
                            <span class="navi__name">Products</span>
                        </a>
                    </li>



                    <li class="navi__item">
                        <a href="<?= ROOT ?>/orders" class="navi__link">
                            <span class="material-symbols-outlined navi__icon">
                                package
                            </span>

                            <span class="navi__name">Orders</span>
                        </a>
                    </li>

                    <?php if (Auth::logged_in()) : ?>
                        <li class="navi__item">
                            <a href="<?= ROOT ?>/cart" class="navi__link">
                                <span class="material-symbols-outlined navi__icon">
                                    shopping_cart
                                </span>
                                <span class="navi__name">Cart</span>
                            </a>
                        </li>
                    <?php endif; ?>


                    <?php if (Auth::logged_in()) : ?>
                        <li class="navi__item">
                            <a href="<?= ROOT ?>/profile" class="navi__link">
                                <span class="material-symbols-outlined navi__icon">
                                    account_circle
                                </span>
                                <span class="navi__name">Profile</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (!Auth::logged_in()) : ?>
                        <li class="navi__item">
                            <a href="<?= ROOT ?>/login" class="navi__link">
                                <span class="material-symbols-outlined navi__icon">
                                    login
                                </span>

                                <span class="navi__name">Log In</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (!Auth::logged_in()) : ?>
                        <li class="navi__item">
                            <a href="<?= ROOT ?>/signup" class="navi__link">
                                <span class="material-symbols-outlined navi__icon">
                                    person_add
                                </span>

                                <span class="navi__name">Sign Up</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (Auth::logged_in()) : ?>

                        <li class="navi__item">
                            <a href="<?= ROOT ?>/logout" class="navi__link">
                                <span class="material-symbols-outlined navi__icon">
                                    logout
                                </span>

                                <span class="navi__name">Log Out</span>
                            </a>
                        </li>
                    <?php endif; ?>


                </ul>
            </div>

            <!-- <img src="assets/img/prof.png" alt="" class="nav__img"> -->
        </nav>
    </header2>
    <main>

        <script>
            function toggleNavIcons() {
                var navIcons = document.querySelectorAll('.navi__icon');
                if (window.innerWidth > 768) {
                    navIcons.forEach(icon => {
                        icon.style.display = 'none';
                    });
                } else {
                    navIcons.forEach(icon => {
                        icon.style.display = 'block';
                    });
                }
            }

            window.addEventListener('load', toggleNavIcons);
            window.addEventListener('resize', toggleNavIcons);
        </script>


        <script>
            const navLinks = document.querySelectorAll('.navi__link');
            navLinks.forEach(link => {
                link.classList.remove('active-link');
            });

            const currentPath = window.location.pathname;
            let activeLink;

            if (currentPath.startsWith('/wcf/products')) {
                activeLink = document.querySelector('.navi__link[href*="products"]');
            } else if (currentPath.startsWith('/wcf/orders')) {
                activeLink = document.querySelector('.navi__link[href*="orders"]');
            } else if (currentPath.startsWith('/wcf/profile')) {
                activeLink = document.querySelector('.navi__link[href*="profile"]');
            } else if (currentPath.startsWith('/wcf/cart')) {
                activeLink = document.querySelector('.navi__link[href*="cart"]');
            } else {
                activeLink = document.getElementsByClassName('homelink')[0];
            }

            navLinks.forEach(link => {
                link.classList.remove('active-link');
            });
            if (activeLink) {
                activeLink.classList.add('active-link');
            }
            else {
                document.getElementsByClassName('homelink')[0].classList.add('active-link');
            }
        </script>