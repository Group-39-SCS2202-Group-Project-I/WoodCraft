<?php
?>
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

    <title>WoodCraft</title>
</head>

<body>
    <!--=============== HEADER ===============-->
    <header2 class="header2" id="header2">
        <nav class="nav container">

            <div class="navl-cont">
                <a href="<?=ROOT?>" class="nav__logo material-icons-outlined" style="font-size: 30px; font-weight: 400; color: var(--primary);"> living </a> <a class="nav__logo" style="padding-left: 5px ;color: var(--primary);"> WoodCraft Furnitures </a>
            </div>




            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="<?=ROOT?>"class="nav__link active-link">
                            <span class="material-symbols-outlined nav__icon">
                                home
                            </span>
                            <span class="nav__name">Home</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="<?=ROOT?>/products"class="nav__link">
                            <span class="material-symbols-outlined nav__icon">
                                chair
                            </span>
                            <span class="nav__name">Products</span>
                        </a>
                    </li>



                    <li class="nav__item">
                        <a href="<?=ROOT?>/orders" class="nav__link">
                            <span class="material-symbols-outlined nav__icon">
                                package
                            </span>

                            <span class="nav__name">Orders</span>
                        </a>
                    </li>


                    <?php if (Auth::logged_in()) : ?>
                        <li class="nav__item">
                            <a href="<?=ROOT?>/profile" class="nav__link">
                                <span class="material-symbols-outlined nav__icon">
                                    account_circle
                                </span>
                                <span class="nav__name">Profile</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (!Auth::logged_in()) : ?>
                        <li class="nav__item">
                            <a href="<?=ROOT?>/login" class="nav__link">
                                <span class="material-symbols-outlined nav__icon">
                                    login
                                </span>

                                <span class="nav__name">Log In</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (!Auth::logged_in()) : ?>
                        <li class="nav__item">
                            <a href="<?=ROOT?>/signup" class="nav__link">
                                <span class="material-symbols-outlined nav__icon">
                                    person_add
                                </span>

                                <span class="nav__name">Sign Up</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (Auth::logged_in()) : ?>

                        <li class="nav__item">
                            <a href="<?=ROOT?>/logout" class="nav__link">
                                <span class="material-symbols-outlined nav__icon">
                                    logout
                                </span>

                                <span class="nav__name">Log Out</span>
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
                var navIcons = document.querySelectorAll('.nav__icon');
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