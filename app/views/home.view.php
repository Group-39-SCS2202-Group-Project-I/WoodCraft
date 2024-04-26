<?php $this->view('includes/nav2', $data) ?>

<?php
if (Auth::logged_in()) {
  $this->view('includes/chat', $data);
}
?>

<style>
  /* .swiper {
    margin: 100px auto;
    width: 320px;
    height: 240px; 
  } */

  .swiper-slide {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    font-weight: bold;
    color: #fff;
  }

  .swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .swi-cont {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 0, 0, 0.5);
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 20px;
    font-weight: bold;
    color: #fff;
  }
</style>



<div>
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="<?= ROOT ?>/assets/images/banner-1.jpg" alt="image 1">
        <div class="swi-cont">Hello</div>
      </div>
      <div class="swiper-slide"><img src="<?= ROOT ?>/assets/images/banner-2.jpg" alt="image 1">
        <div class="swi-cont">Hello</div>
      </div>
      <div class="swiper-slide"><img src="<?= ROOT ?>/assets/images/banner-3.jpg" alt="image 1">
        <div class="swi-cont">Hello</div>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    speed: 2000,
    loop: true,
    autoplay: {
      delay: 10000,
      disableOnInteraction: false,
    },
    grabCursor: true,
    effect: "creative",
    creativeEffect: {
      prev: {
        shadow: true,
        translate: [0, 0, -400],
      },
      next: {
        translate: ["100%", 0, 0],
      },
    },
  });
</script>

<div class="products-section2">
<h2 class="page-title" style="width: 100%; background-color:var(--webback) ; border-radius:10px">Top Selling Furnitures</h2>

  <div class="dash4" >
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const url = '<?= ROOT ?>/fetch/top_selling_products';
        fetch(url)
          .then(response => response.json())
          .then(data => {
            console.log(data);


            var products = data;
            products = products.filter(product => product.listed == 1);
            const dashboard = document.querySelector('.dash4');

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
                img.src = `<?= ROOT ?>/${image}`;
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

              if (product.quantity == null) {
                product.quantity = 0;
              }
              if (product.quantity < 3) {
                productQty.style.color = 'red';
              } else {
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
              cardPrice.textContent = product_price + ' Rs';

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
    </script>
  </div>
</div>

<div class="products-section2" >
  <h2 class="page-title" style="width: 100%; background-color:var(--webback) ; border-radius:10px;">New Arrivals</h2>

  <div class="dash4" id="new_arrivals">
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const url = '<?= ROOT ?>/fetch/new_arrivals';
        fetch(url)
          .then(response => response.json())
          .then(data => {
            console.log(data);
            var products = data;
            products = products.filter(product => product.listed == 1);
            const dashboard = document.getElementById('new_arrivals');

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
                img.src = `<?= ROOT ?>/${image}`;
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

              if (product.quantity == null) {
                product.quantity = 0;
              }
              if (product.quantity < 3) {
                productQty.style.color = 'red';
              } else {
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
              cardPrice.textContent = product_price + ' Rs';

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
    </script>
  </div>
</div>





<?php $this->view('includes/footer2', $data) ?>