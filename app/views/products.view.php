<?php $this->view('includes/nav2', $data) ?>
<?php
if (Auth::logged_in()) {
  $this->view('includes/chat', $data);
}
?>

<div class="sidebar">
  <div class="sidebar-title-div">
    <h2 class="side_title">Categories</h2>
  </div>

  <ul class="sidebar__list">
    <!-- <li class="sidebar__item"></li>
        <p style="display: none;" id="category_id"></p> -->
  </ul>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const url = '<?= ROOT ?>/fetch/product_categories';
    fetch(url)
      .then(response => response.json())
      .then(data => {
        console.log(data);

        const sidebarList = document.querySelector('.sidebar__list');
        const category_id = document.getElementById('category_id');

        data.forEach(category => {
          const li = document.createElement('li');
          li.classList.add('sidebar__item');
          li.textContent = category.category_name;

          // hidden input to store category id
          const hiddenCategoryId = document.createElement('input');
          hiddenCategoryId.type = 'hidden';
          hiddenCategoryId.classList.add('hiddenCategoryId');
          hiddenCategoryId.value = category.product_category_id;

          // li.addEventListener('click', () => {
          //     category_id.textContent = category.id;
          //     fetchProducts();
          // });
          sidebarList.appendChild(li);
        });
      });
  });
</script>

<div class="products-section">
  <h2 class="page-title">Products</h2>
  <div class="cont2">
    <input type="text" id="" placeholder="Search Products..." class="searchbar">
  </div>

  <div class="dashboard">
    <!-- <a style="text-decoration:none"> -->
    <!-- <div class="product_card">
        <div class="card_cont">
          <div class="swiper">
            
            <div class="swiper-wrapper"> -->
    <!-- Slides -->
    <!-- <div class="swiper-slide"><img src="./assets/img/1.avif" alt="1"></div>
              <div class="swiper-slide"><img src="./assets/img/2.avif" alt="2"></div>
              <div class="swiper-slide"><img src="./assets/img/3.avif" alt="3"></div> -->
    <!-- </div> -->
    <!-- If we need pagination -->
    <!-- <div class="swiper-pagination"></div> -->

    <!-- If we need navigation buttons -->
    <!-- <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div> -->

    <!-- If we need scrollbar -->
    <!-- <div class="swiper-scrollbar"></div> -->
    <!-- </div>
          <p class="card_name">Nordic Chair</p>
          <h4 class="card_price">$65.00</h4>
        </div>
        <button class="card_btn">View</button>
      </div> -->
    <!-- </a> -->
  </div>
</div>
<script>
  const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    // scrollbar: {
    //     el: '.swiper-scrollbar',
    // },
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const url = '<?= ROOT ?>/fetch/product';
    fetch(url)
      .then(response => response.json())
      .then(data => {
        console.log(data);


        var products = data.products;
        products = products.filter(product => product.listed == 1);
        const dashboard = document.querySelector('.dashboard');

        products.forEach(product => {
          const product_id = product.product_id;
          const product_name = product.name;
          const product_price = product.price;
          const product_category_id = product.product_category_id;
          const product_images = product.images;

          const productCard = document.createElement('div');
          productCard.classList.add('product_card');

          const cardCont = document.createElement('div');
          cardCont.classList.add('card_cont');

          const swiper = document.createElement('div');
          swiper.classList.add('swiper');

          const swiperWrapper = document.createElement('div');
          swiperWrapper.classList.add('swiper-wrapper');

          product_images.forEach(image => {
            const swiperSlide = document.createElement('div');
            swiperSlide.classList.add('swiper-slide');

            const img = document.createElement('img');
            img.src = `<?= ROOT ?>/${image.image_url}`;
            img.alt = product_name;

            swiperSlide.appendChild(img);
            swiperWrapper.appendChild(swiperSlide);
          });

          const swiperPagination = document.createElement('div');
          swiperPagination.classList.add('swiper-pagination');

          swiper.appendChild(swiperWrapper);
          swiper.appendChild(swiperPagination);

          const cardName = document.createElement('p');
          cardName.classList.add('card_name');
          cardName.textContent = product_name;

          const hiddenProductId = document.createElement('p');
          hiddenProductId.type = 'hidden';
          hiddenProductId.textContent = product_id;

          const hiddenCategoryId = document.createElement('p');
          hiddenCategoryId.type = 'hidden';
          hiddenCategoryId.textContent = product_category_id;

          const cardPrice = document.createElement('h4');
          cardPrice.classList.add('card_price');
          cardPrice.textContent = product_price;

          cardCont.appendChild(swiper);
          cardCont.appendChild(cardName);
          cardCont.appendChild(cardPrice);

          productCard.appendChild(cardCont);

          const cardBtn = document.createElement('button');
          cardBtn.classList.add('card_btn');
          cardBtn.textContent = 'View';

          productCard.appendChild(cardBtn);

          dashboard.appendChild(productCard);

          atag = document.createElement('a');
          atag.href = `<?= ROOT ?>/products/${product_id}`;
          atag.style.textDecoration = 'none';
          atag.appendChild(productCard);
          dashboard.appendChild(atag);

        });
      });
  });


  const searchbar = document.querySelector('.searchbar');
  searchbar.addEventListener('keyup', function() {
    const search = searchbar.value.toLowerCase();
    const productCards = document.querySelectorAll('.product_card');

    productCards.forEach(card => {
      const name = card.querySelector('.card_name').textContent.toLowerCase();
      if (name.includes(search)) {
        // card.style.display = 'block';
        x = card.parentElement;
        x.style.display = 'block';
      } else {
        // card.style.display = 'none';
        x = card.parentElement;
        x.style.display = 'none';
      }
    });
  });



</script>


<?php $this->view('includes/footer2', $data) ?>