<?php
// show($data)
?>

<!-- header -->
<?php $this->view('includes/header', $data) ?>

<!-- search -->

<!--  -->

<style>
    /* CSS */

    .products_grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 20px;
        box-sizing: border-box;
        /* background-color: #f8f8f8; */
    }



   

    .prd-btn {
        background-color: blue;
        color: #fff;
        padding: 0.5rem 1rem;
        border: none;
        /* border-radius: 10px; */
        cursor: pointer;
        transition: opacity 0.3s ease-in;
        width: 100%;
        border-radius: 0 0 10px 10px;
    }

    .prd-btn:hover {
        /* background-color: var(--primary); */
        background-color: red;
    }

</style>

<div class="products_grid">

<?php foreach ($data as $item) : ?>

<div class="product-main">

  <div class="product-grid">

    <div class="showcase">

      <div class="showcase-banner">

        <img src="<?php echo ROOT . '/' . $item['images'][0]['image_url'] ?>" alt="<?php echo $item['name']; ?>" width="300" class="product-img default">
        <img src="<?php echo ROOT . '/' . $item['images'][1]['image_url'] ?>" alt="<?php echo $item['name']; ?>" width="300" class="product-img hover">

        <p class="showcase-badge">15%</p>

        <div class="showcase-actions">

          <button class="btn-action">
            <ion-icon name="heart-outline"></ion-icon>
          </button>

          <button class="btn-action">
            <ion-icon name="eye-outline"></ion-icon>
          </button>

          <button class="btn-action">
            <ion-icon name="repeat-outline"></ion-icon>
          </button>

          <button class="btn-action">
            <ion-icon name="bag-add-outline"></ion-icon>
          </button>

        </div>

      </div>

      <div class="showcase-content">

        <a href="#" class="showcase-category"><?php echo $item['category_name']; ?></a>

        <a href="#">
          <h3 class="showcase-title"><?php echo $item['name']; ?></h3>
        </a>

        <div class="showcase-rating">
          <?php echo createStarRating($item['avarage_rating']); ?>
        </div>

        <div class="price-box">
          <p class="price"><?php echo $item['price']; ?></p>
          <del><?php echo $item['price']; ?></del>
        </div>

      </div>

    </div>

  </div>

</div>

<?php endforeach; ?>
</div>

<script>
    // JavaScript
    let index = 0;
    const items = document.querySelectorAll('.carousel-item');
    const totalItems = items.length;

    setInterval(() => {
        items[index].style.opacity = 0;
        index = (index + 1) % totalItems;
        items[index].style.opacity = 1;
    }, 2000);
</script>

<!-- footer -->