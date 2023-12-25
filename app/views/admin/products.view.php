<?php include "inc/header.view.php"; ?>

<!-- button to navigate categories -->
<a href="<?php echo ROOT ?>/admin/products/categories" class="btn btn-primary">Product Categories</a>

<h1>Products</h1>

<!-- fetch and display products in a table -->


<table class="table-section__table" id="products_table">
    <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Product Category</th>
            <th>Product Inventory</th>
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
        show($products);



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
                        echo $key . ': ' . $value . '<br>';
                    }
                    ?></td>
                <td><?php echo $item['price']; ?></td>
                <td>
                    <!-- view -->
                    <a href="<?php echo ROOT ?>/admin/products/<?php echo $item['product_id'] ?>" class="btn btn-primary">View</a>
                    <a href="<?php echo ROOT ?>/admin/products/delete/<?php echo $item['product_id'] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>










<?php include "inc/footer.view.php"; ?>