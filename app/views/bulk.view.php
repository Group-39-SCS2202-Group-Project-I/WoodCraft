<?php
show($data)
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

    /* CSS */
    .product-card {
        position: relative;
        width: 300px;
        border: 1px solid #ccc;
        margin: 10px;
        overflow: hidden;
    }

    .carousel {
        width: 100%;
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .carousel-item {
        width: 100%;
        height: 100%;
        position: absolute;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    .carousel-item:first-child {
        opacity: 1;
    }

    /* CSS */
    .carousel-control {
        position: absolute;
        top: 50%;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
    }

    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }
</style>

<div class="products_grid">

    <?php foreach ($data as $item) : ?>
        <div class="product-card">
            <div class="carousel">
                <?php foreach ($item['images'] as $image) : ?>
                    <img src="<?php echo ROOT . '/' . $image['image_url'] ?>" alt="<?php echo $item['name']; ?>" width="300" class="carousel-item">
                <?php endforeach; ?>
                <button class="carousel-control prev">Prev</button>
                <button class="carousel-control next">Next</button>
            </div>
            <div class="product-info">
                <h2>Product Name</h2>
                <p>Product Description</p>
            </div>
            <!-- <button class="product-button">Buy Now</button> -->
        </div>
    <?php endforeach; ?>


</div>

<script>
    // JavaScript
    let index = 0;
    const items = document.querySelectorAll('.carousel-item');
    const totalItems = items.length;

    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');

    prevButton.addEventListener('click', () => {
        items[index].style.opacity = 0;
        index = (index - 1 + totalItems) % totalItems;
        items[index].style.opacity = 1;
    });

    nextButton.addEventListener('click', () => {
        items[index].style.opacity = 0;
        index = (index + 1) % totalItems;
        items[index].style.opacity = 1;
    });
</script>



<!-- footer -->