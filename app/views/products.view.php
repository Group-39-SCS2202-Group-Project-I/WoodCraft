<?php $this->view('includes/header', $data) ?>

  <div class="overlay" data-overlay></div>
    <?php $this->view('webstore/notification-toast', $data) ?>

    <!--
    - HEADER
    -->

  <header>
    <?php $this->view('includes/nav', $data) ?>
    <?php $this->view('webstore/header-section', $data) ?>
  </header>



  <!--
    - MAIN
  -->

  <main>
    <!--
      - PRODUCT
    -->

    <div class="product-container">
        <div class="container-outer">
            <h2 class="page-title">-Our Products</h2>
                <div class="container">
                    <?php $this->view('webstore/sidebar', $data) ?>


      <div class="product-box">

        
          <!--
            - PRODUCT GRID
          -->

          <?php

            $url = ROOT . "/fetch/product";
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            // show($data);

            $url2 = ROOT . "/fetch/product_images";
            $response = file_get_contents($url2);
            $images = json_decode($response, true);
            // show($images);

            $grouped_images = [];
            foreach ($images as $image) {
                $grouped_images[$image['product_id']][] = $image;
            }
            // show($grouped_images);

            foreach ($data['products'] as $key => $product) {
                if (array_key_exists($product['product_id'], $grouped_images)) {
                    $data['products'][$key]['images'] = $grouped_images[$product['product_id']];
                } else {
                    $data['products'][$key]['images'] = [];
                }
            }

            $listed_products = [];
            foreach ($data['products'] as $product) {
                if ($product['listed'] == 1) {
                    $listed_products[] = $product;
                }
            }
            // show($listed_products);

            foreach ($listed_products as $item) :?>

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

      </div>

      </div>

    </div>

  </main>
 