<?php
// show($data)
?>

<?php if (message()) : ?>
    <div class="mzg-box">
        <div class="messege"><?= message('', true) ?></div>
    </div>
<?php endif; ?>

<div class="products_grid">

    <?php foreach ($data as $item) : ?>
        <a href="<?= ROOT ?>/bulk/<?= $item['product_id'] ?>">
            <div class="product-card">
                <div class="product-info">
                    <h2><?= $item['name'] ?></h2>
                    <p><?= $item['description'] ?></p>
                </div>
                <!-- <button class="product-button">Buy Now</button> -->
            </div>
        </a>
    <?php endforeach; ?>


</div>