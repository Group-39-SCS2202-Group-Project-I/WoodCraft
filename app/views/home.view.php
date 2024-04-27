<?php $this->view('includes/header', $data) ?>


<?php
if (Auth::logged_in()) {
  $this->view('includes/chat', $data);
}
?>

<!--
    - HEADER
    -->
<header>
      <link rel="stylesheet" href="<?= ROOT ?>/assets/css/webstyles.css">
</header>


<?php $this->view('includes/nav2', $data) ?>

<?php $this->view('webstore/banner', $data) ?>


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