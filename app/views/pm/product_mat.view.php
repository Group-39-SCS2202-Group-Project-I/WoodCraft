<?php include "inc/header.view.php"; ?>
<!-- <?php show($data) ?> -->


<?php
$product_id = $data['id'];
$url = ROOT . "/fetch/product/$product_id";
$response = file_get_contents($url);
$product = json_decode($response, true);
// show($product);

//fetch and load product measurement
$url = ROOT . "/fetch/product_measurement/" . $product['product_measurement_id'];
$response = file_get_contents($url);
$measurement = json_decode($response, true);

$product['measurement'] = $measurement;

?>

<div class="list-section">
    <div class="flex-half">
        <div class="product-details">
            <div class="product-details__info">
                <h1 class="product-details__title"><?php echo $product['name'] ?></h1>
                <p class="product-details__description"><?php echo $product['description'] ?></p>
                <p class="product-details__price"><strong>Price:</strong> $<?php echo $product['price'] ?></p>
                <p class="product-details__category"><strong>Category:</strong> <?php echo $product['category_name'] ?></p>
                <p class="product-details__quantity"><strong>Stocks Available:</strong> <?php echo $product['quantity'] ?></p>
                <br>
                <p class="product-details__measurement"><strong>Measurement</strong><br>
                <div style="margin-left:20px">
                    <?php
                    foreach ($product['measurement'] as $key => $value) {
                        if ($key == 'weight') {
                            echo "<span class='product-details__measurement-label'>Weight:</span> $value kg<br>";
                        } elseif ($key == 'measurement_id' || $key == 'product_measurement_id' || $key == 'product_id') {
                            continue;
                        } else {
                            echo "<span class='product-details__measurement-label'>" . ucfirst($key) . ":</span> $value cm<br>";
                        }
                    }
                    ?>
                    </p>
                </div>

            </div>
        </div>
    </div>
    <div class="flex-half">
    </div>

</div>

<style>
    .product-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
    }

    

    .product-details__title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 10px;
        /* color: #333; */
    }

    .product-details__description {
        margin-bottom: 10px;
        /* color: #666; */
    }

    .product-details__price,
    .product-details__category,
    .product-details__quantity,
    .product-details__measurement {
        margin-bottom: 5px;
        /* color: #999; */
    }

    .product-details__measurement-label {
        font-weight: bold;
    }
</style>







<?php include "inc/footer.view.php"; ?>