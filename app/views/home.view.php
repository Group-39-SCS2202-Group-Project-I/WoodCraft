<?php $this->view('includes/header', $data) ?>

  <div class="overlay" data-overlay></div>
    <?php $this->view('webstore/modal', $data) ?>
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
    <?php $this->view('webstore/banner', $data) ?>
    <!--
      - PRODUCT
    -->

    <div class="product-container">
      
      <div class="container">
        <?php $this->view('webstore/sidebar', $data) ?>


      <div class="product-box">
        
        <?php $this->view('webstore/product-grid', $data) ?>
        <?php $this->view('webstore/product-featured', $data) ?>

        </div>

      </div>

    </div>

  </main>

  <?php $this->view('includes/footer', $data) ?>