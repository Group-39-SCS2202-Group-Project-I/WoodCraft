<?php include "inc/header.view.php"; ?>

<!-- fetch and display data -->
<?php
$url = ROOT . "/fetch/product/" . $data['x'];
$response = file_get_contents($url);
$data = json_decode($response, true);
// show($data);


$reviews = isset($data['reviews']) ? $data['reviews'] : [];
// show($reviews);
$reviews_count = count($reviews);
// // $reviews_count = 2;
// show($reviews_count);
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

    .product-review-item {
        background-color: var(--light);
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 0.5rem;
    }

    .pc-lable {
        font-weight: 500;
        margin-right: 0.5rem;
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
        <div class="product-review-item">
            <div class="product-container-item">
                <p class="pc-lable">Product ID :&nbsp</p>
                <p><?php echo sprintf('PRD-%03d', $data['product_id']); ?></p>
            </div>
            <div class="product-container-d">
                <p class="pc-lable">Product Description :&nbsp</p>
                <p style="margin:5px 20px 10px 20px"><?php echo $data['description']; ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable"> Category :&nbsp</p>
                <p><?php echo $data['category_name'] ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Quantity Available :&nbsp</p>
                <p><?php echo $data['quantity'] ?></p>
            </div>
        </div>


        <h1 class="product-container-title" style="margin-top: 2rem;">Weight & measurements</h1>
        <div class="product-review-item">
            <div class="product-container-item">
                <p class="pc-lable">Height :&nbsp</p>
                <p><?php echo $data['height'] ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Width :&nbsp</p>
                <p><?php echo $data['width'] ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Length :&nbsp</p>
                <p><?php echo $data['length'] ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Weight :&nbsp</p>
                <p><?php echo $data['weight'] ?></p>
            </div>
        </div>
    </div>


    <!--  -->

    <div class="product-container">
        <h1 class="product-container-title">Product Images</h1>
    </div>

</div>

<div class="dashboard2" style="padding-top:0px" id="pwc-table">
    <div class="product-container">
        <h1 class="product-container-title" style=" text-align: left">Product Reviews</h1>

        <?php if ($reviews_count == 0) : ?>
            <div class="mzg-box col-danger">
            <div class="messege"> <?= "No reviews added to this product" ?> </div>
            </div>
           
        <?php endif; ?>

        <?php foreach ($reviews as $review) : ?>
            <div class="product-review-item">

                <div class="product-container-item">
                    <p class="pc-lable">Review ID :&nbsp</p>
                    <p><?php echo sprintf('RVW-%03d', $review['review_id']); ?></p>
                </div>
                <div class="product-container-item">
                    <p class="pc-lable">Customer Name :&nbsp</p>
                    <p><?php echo $review['customer_name'] ?></p>
                </div>
                <div class="product-container-item">
                    <p class="pc-lable">Rating :&nbsp</p>
                    <p><?php echo $review['rating'] ?></p>
                </div>
                <div class="product-container-item">
                    <p class="pc-lable">Review :&nbsp</p>
                    <p><?php echo $review['review'] ?></p>
                </div>
                <div class="product-container-item" style="font-size: smaller;">
                    <!-- <p>Created At :&nbsp</p> -->
                    <p><?php echo $review['created_at'] ?></p>
                </div>
                <!-- <div class="product-container-item">
                    <p>Updated At :&nbsp</p>
                    <p><?php echo $review['updated_at'] ?></p>
                </div> -->
            </div>
            <?php if ($reviews_count > 1) : ?>
                <hr style="margin: 0.3rem; width: 5%; margin-left: auto; margin-right: auto;">
            <?php endif; ?>
        <?php endforeach; ?>

    </div>

</div>


<?php include "inc/footer.view.php"; ?>