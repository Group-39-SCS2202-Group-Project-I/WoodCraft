    <!--
      - BANNER
    -->

    <div class="banner">

      <div class="container">

        <div class="slider-container">

          <div class="slider-item">

            <img src="<?php echo ROOT; ?>/assets/images/banner-1.jpg" alt="women's latest fashion sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Home Harmony</p>

              <h2 class="banner-title">Find Your Perfect Piece</h2>

              <p class="banner-text">
                starting at &dollar; <b>20</b>.00
              </p>

              <a href="#" class="banner-btn">Shop now</a>

            </div>

          </div>

          <div class="slider-item">

            <img src="<?php echo ROOT; ?>/assets/images/banner-2.jpg" alt="modern sunglasses" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Modern Classics</p>

              <h2 class="banner-title">Discover Woodcraft's Timeless Designs</h2>

              <p class="banner-text">
                starting at &dollar; <b>15</b>.00
              </p>

              <a href="#" class="banner-btn">Shop now</a>

            </div>

          </div>

          <div class="slider-item">

            <img src="<?php echo ROOT; ?>/assets/images/banner-3.jpg" alt="new fashion summer sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Crafted Comfort</p>

              <h2 class="banner-title">Explore Our Latest Collection</h2>

              <p class="banner-text">
                starting at &dollar; <b>29</b>.99
              </p>

              <a href="#" class="banner-btn">Shop now</a>

            </div>

          </div>

        </div>

      </div>

    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        var sliderContainer = document.querySelector(".slider-container");
        var sliderItems = document.querySelectorAll(".slider-item");
        var currentIndex = 0;
        var interval = 5000;

        function nextSlide() {
          currentIndex = (currentIndex + 1) % sliderItems.length;
          updateSlider();
        }

        function updateSlider() {
          var translateValue = -currentIndex * 100 + "%";
          sliderItems.forEach(function (item) {
            item.style.transform = "translateX(" + translateValue + ")";
          });
        }

        var sliderInterval = setInterval(nextSlide, interval);

        sliderContainer.addEventListener("mouseenter", function () {
          clearInterval(sliderInterval);
        });

        sliderContainer.addEventListener("mouseleave", function () {
          sliderInterval = setInterval(nextSlide, interval);
        });
      });
    </script>
