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

          li.addEventListener('click', () => {
            filter_by_cat_id(category.product_category_id);
            const sidebarItems = document.querySelectorAll('.sidebar__item');
            // remove styles from all sidebar items
            sidebarItems.forEach(item => {
              item.style.backgroundColor = ' #ebf1f1';
              item.style.color = 'black';
            });
            // add styles to clicked sidebar item
            li.style.backgroundColor = 'black';
            li.style.color = 'white';
          });


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

          const swiper2 = document.createElement('div');
          swiper2.classList.add('swiper');

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

          swiper2.appendChild(swiperWrapper);
          swiper2.appendChild(swiperPagination);

          const cardName = document.createElement('p');
          cardName.classList.add('card_name');
          cardName.textContent = product_name;

          const productQty = document.createElement('p');
          productQty.classList.add('product_qty');

          if(product.quantity == null){
            product.quantity = 0;
          }
          if(product.quantity < 3){
            productQty.style.color = 'red';
          }
          else{
            productQty.style.color = 'green';
          }
          const QtyText = product.quantity == 0 ? 'Out of Stock' : product.quantity + ' in stock';


          productQty.textContent = QtyText;

          const hiddenProductId = document.createElement('p');
          hiddenProductId.classList.add('hiddenProductId');
          hiddenProductId.style.display = 'none';
          hiddenProductId.textContent = product_id;
          cardCont.appendChild(hiddenProductId);

          const cardPrice = document.createElement('h4');
          cardPrice.classList.add('card_price');
          cardPrice.textContent =  product_price + ' Rs';

          const categoryID = document.createElement('p');
          categoryID.classList.add('category_id');
          categoryID.textContent = product_category_id;
          categoryID.style.display = 'none';


          cardCont.appendChild(swiper2);
          cardCont.appendChild(cardName);
          cardCont.appendChild(cardPrice);
          cardCont.appendChild(productQty);

          cardCont.appendChild(categoryID);

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




  // document.addEventListener('click', function(e) {
  //   if (!e.target.closest('.sidebar') && !e.target.closest('.sidebar-toggle')) {
  //     const sidebar = document.querySelector('.sidebar');

  //     const sidebarItems = document.querySelectorAll('.sidebar__item');
  //     sidebarItems.forEach(item => {
  //       item.style.backgroundColor = '#ebf1f1';
  //       item.style.color = 'black';
  //     });
  //   }
  // });


  const searchbar = document.querySelector('.searchbar');
  searchbar.addEventListener('keyup', function() {
    const search = searchbar.value.toLowerCase();
    const productCards = document.querySelectorAll('.product_card');

    // remove styles from sidebar items
    const sidebarItems = document.querySelectorAll('.sidebar__item');
    sidebarItems.forEach(item => {
      item.style.backgroundColor = '#ebf1f1'
      item.style.color = 'black';
    })


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

  function filter_by_cat_id(cat_id) {
    category_id = cat_id;

    const productCards = document.querySelectorAll('.product_card');
    productCards.forEach(card => {
      const categoryID = card.querySelector('.category_id').textContent;
      if (categoryID == category_id) {
        x = card.parentElement;
        x.style.display = 'block';
      } else {
        x = card.parentElement;
        x.style.display = 'none';
      }
    });

  }
</script>

<script>
  const sidebar = document.querySelector('.sidebar');
  const productsSection = document.querySelector('.products-section');

  function handleResize() {
    if (window.innerWidth < 768) {
      sidebar.style.display = 'none';
      productsSection.style.paddingLeft = '50px';
    } else {
      sidebar.style.display = 'block';
      productsSection.style.paddingLeft = '350px';
    }
  }
  handleResize();

  window.addEventListener('resize', handleResize);
  window.addEventListener('load', handleResize);
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
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
    });
  });
</script>




<?php $this->view('includes/footer2', $data) ?>