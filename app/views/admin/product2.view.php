<?php include "inc/header.view.php"; ?>

<!-- fetch and display data -->
<?php
$url = ROOT . "/fetch/product/" . $data['x'];
$response = file_get_contents($url);
$data = json_decode($response, true);
// show($data);
?>

<style>
    .product-container {
        background-color: white;
        border-radius: 10px;
        padding: 10px;
    }

    .product-container-title {
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .product-container-item {
        display: flex;
        /* justify-content:first baseline; */
        /* justify-items: center; */
        margin-bottom: 0.5rem;
    }

    .product-container-d {
        /* display: flex;  */
        /* justify-content:first baseline;
        /* justify-items: center; */
        margin-bottom: 0.5rem;
    }
</style>



<?php if (message()) : ?>
    <div class="message-box">
        <div class="message"><?= message('', true) ?></div>
    </div>
<?php endif; ?>

<div class="table-section" style=" padding-bottom:0">
    <h2 class="table-section__title" style=" margin-bottom:0"><?= $data['name'] ?></h2>
</div>

<div class="dashboard2" id="pwc-table">
    <div class="product-container">
        <h1 class="product-container-title">Product Details</h1>
        <div class="product-container-item">
            <p>Product ID :&nbsp</p>
            <p><?php echo `\t` . sprintf('PRD-%03d', $data['product_id']); ?></p>
        </div>
        <div class="product-container-d">
            <p>Product Description :&nbsp</p>
            <p><?php echo $data['description']; ?></p>
        </div>
        <div class="product-container-item">
            <p>Category :&nbsp</p>
            <p><?php echo $data['category_name'] ?></p>
        </div>
        <div class="product-container-item">
            <p>Quantity Available :&nbsp</p>
            <p><?php echo $data['quantity'] ?></p>
        </div>

        <h1 class="product-container-title">Weight & measurements</h1>
        <div class="product-container-item">
            <p>Height :&nbsp</p>
            <p><?php echo $data['height'] ?></p>
        </div>
        <div class="product-container-item">
            <p>Width :&nbsp</p>
            <p><?php echo $data['width'] ?></p>
        </div>
        <div class="product-container-item">
            <p>Length :&nbsp</p>
            <p><?php echo $data['length'] ?></p>
        </div>
        <div class="product-container-item">
            <p>Weight :&nbsp</p>
            <p><?php echo $data['weight'] ?></p>
        </div>
    </div>


    <!--  -->

    <div class="product-container">
        <h1 class="product-container-title">Product Images</h1>
    </div>

</div>


<?php include "inc/footer.view.php"; ?>