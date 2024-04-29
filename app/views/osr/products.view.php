<?php include "inc/header.view.php"; ?>
<div class="table-section">
    <h2 class="table-section__title">Products</h2>

    <div class="table-section__search">
        <input type="text" id="searchProducts" placeholder="Search Products..." class="table-section__search-input">
    </div>

    <div id="scrollable_sec">
        <table class="table-section__table" id="products_table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <!-- <th>Product Description</th> -->
                    <th>Category</th>
                    <th>Stocks Available</th>
                    <th>Product Measurement</th>
                    <th>Price</th>
                    <th>Listed</th>
                    <th>Minimum Bulk Qty</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>

            <tbody>
                <?php
                $url = ROOT . "/fetch/product";
                $response = file_get_contents($url);
                $data = json_decode($response, true);

                $products = $data['products'];
                // show($products);

                foreach ($products as $product) :
                ?>
                    <tr>
                        <td><?php echo sprintf('PRD-%03d', $product['product_id']) ?></td>
                        <td><?php echo $product['name'] ?></td>
                        <!-- <td><?php echo $product['description'] ?></td> -->
                        <td><?php echo $product['category_name'] ?></td>
                        <td><?php echo $product['quantity'] ?></td>
                        <td><?php
                            foreach ($product['measurement'] as $key => $value) {
                                if ($key == 'weight') {
                                    echo ucfirst($key) . ' : ' . $value . ' kg<br>';
                                } else {
                                    echo ucfirst($key) . ' : ' . $value . ' cm<br>';
                                }
                            }
                            ?></td>
                        <td><?php echo $product['price'] ?></td>
                        <?php
                        if ($product['listed'] == 1) {
                            $x = 'Yes';
                        } else {
                            $x = 'No';
                        }
                        ?>
                        <td>
                            <?php if ($product['listed'] == 1) : ?>
                                <a class="  table-section__button-available">Yes</a>
                            <?php else : ?>
                                <a class="table-section__button-unavailable">No</a>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $product['bulkmin'] ?></td>
                        <!-- <td>
                        <a href="<?php echo ROOT ?>/admin/products/update/<?= $product['product_id'] ?>" class="table-section__link">Update</a>
                        <a href="<?php echo ROOT ?>/admin/products/delete/<?= $product['product_id'] ?>" class="table-section__link">Delete</a>
                    </td> -->
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>




<?php include "inc/footer.view.php"; ?>