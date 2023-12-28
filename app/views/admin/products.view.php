<?php include "inc/header.view.php"; ?>

<!-- button to navigate categories -->


<!-- <h1>Products</h1> -->
<div class="table-section">

    <h2 class="table-section__title">Products</h2>

    <div class="table-section__add">
        <a href="<?php echo ROOT ?>/admin/products/categories" class="table-section__add-link">Product Categories</a>
        <a href="<?php echo ROOT ?>/admin/products/add" class="table-section__add-link">Add New Product</a>
    </div>

    <div class="table-section__search">
        <input type="text" id="searchProducts" placeholder="Search Products..." class="table-section__search-input">
    </div>

    <!-- fetch and display products in a table -->


    <table class="table-section__table" id="products_table">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Category</th>
                <th>Stocks Available</th>
                <th>Product Measurement</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>

        </thead>
        <tbody>
            <?php
            $url = ROOT . "/fetch/product";
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            $products = $data['products'];
            // show($products);



            foreach ($products as $item) :
            ?>
                <tr>
                    <td><?php echo $item['product_id']; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['description']; ?></td>
                    <td><?php echo $item['category_name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php
                        foreach ($item['measurement'] as $key => $value) {
                            if ($key == 'weight') {
                                echo ucfirst($key) . ' : ' . $value . ' kg<br>';
                            } else {
                                echo ucfirst($key) . ' : ' . $value . ' cm<br>';
                            }
                        }
                        ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td>
                        <!-- view -->
                        <a href="<?php echo ROOT ?>/admin/products/<?php echo $item['product_id'] ?>" class="table-section__button">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>










<?php include "inc/footer.view.php"; ?>