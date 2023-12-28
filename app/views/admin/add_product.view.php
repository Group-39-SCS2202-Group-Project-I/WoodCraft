<?php include "inc/header.view.php"; ?>



<style>
    .form-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 20px;
        /* Add some space between form sections */
    }
</style>

<form action="<?php echo ROOT ?>/add/product" method="POST" class="form-section">
    <h2 class="table-section__title">Add Product</h2>
    <div class="form-container">


        <?php if (!empty($errors['name'])) : ?>
            <p class="validate-mzg"><?= $errors['name'] ?></p>
        <?php endif; ?>
        <div class="form-group">
            <label class="page-label" for="name">Product Name:</label>
            <input value="<?php echo $form_data['name'] ?>" class="page-input" type="text" id="name" name="name">
        </div>

        <!-- description -->
        <?php if (!empty($errors['description'])) : ?>
            <p class="validate-mzg"><?= $errors['description'] ?></p>
        <?php endif; ?>
        <div class="form-group">
            <label class="page-label" for="description">Product Description:</label>
            <textarea value="<?php echo $form_data['description'] ?>" class="page-input" name="description" id="description" cols="30" rows="4"></textarea>
        </div>

        <!-- category -->
        <!-- //fetch categories -->
        <?php
        $url_cat = ROOT . "/fetch/product_categories";
        $response_cat = file_get_contents($url_cat);
        $categories = json_decode($response_cat, true);
        // show($categories);
        ?>
        <?php if (!empty($errors['product_category_id'])) : ?>
            <p class="validate-mzg"><?= $errors['product_category_id'] ?></p>
        <?php endif; ?>
        <div class="form-group">
            <label for="product_category_id" class="page-label">Category</label>
            <select id="product_category_id" name="product_category_id" class="page-select">
                <?php
                if (isset($form_data['product_category_id'])) : ?>
                    <option value="<?php echo $form_data['product_category_id'] ?>" selected><?php echo $form_data['product_category_id'] ?></option>
                <?php endif; ?>
                <option value="" selected disabled>Select Category</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['product_category_id'] ?>"><?php echo $category['category_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- price -->
        <?php if (!empty($errors['price'])) : ?>
            <p class="validate-mzg"><?= $errors['price'] ?></p>
        <?php endif; ?>
        <div class="form-group">
            <label class="page-label" for="price">Price:</label>
            <input value="<?php echo $form_data['price'] ?>" class="page-input" type="text" id="price" name="price">
        </div>


        <div class="form-group">
            <!-- height, width, length, weight -->
            <?php if (!empty($errors['price'])) : ?>
                <p class="validate-mzg"><?= $errors['height'] ?></p>
            <?php endif; ?>
            <?php if (!empty($errors['price'])) : ?>
                <p class="validate-mzg"><?= $errors['width'] ?></p>
            <?php endif; ?>
            <?php if (!empty($errors['price'])) : ?>
                <p class="validate-mzg"><?= $errors['length'] ?></p>
            <?php endif; ?>
            <?php if (!empty($errors['price'])) : ?>
                <p class="validate-mzg"><?= $errors['weight'] ?></p>
            <?php endif; ?>

            <label class="page-label" for="height">Height:</label>
            <input value="<?php echo $form_data['height'] ?>" class="page-input" type="text" id="height" name="height" style="margin-right:1rem; margin-left:0.2rem">
            <label class="page-label" for="width">Width:</label>
            <input value="<?php echo $form_data['width'] ?>" class="page-input" type="text" id="width" name="width" style="margin-right:1rem; margin-left:0.2rem">
            <label class="page-label" for="length">Length:</label>
            <input value="<?php echo $form_data['length'] ?>" class="page-input" type="text" id="length" name="length" style="margin-right:1rem; margin-left:0.2rem">
            <label class="page-label" for="weight">Weight:</label>
            <input value="<?php echo $form_data['weight'] ?>" class="page-input" type="text" id="weight" name="weight" style="margin-left:0.2rem">



        </div>






        <div style="display: flex; justify-content: center; width:100%">
            <button type="submit" class="form-btn submit-btn" style="max-width: 400px;">Add New Product</button>
        </div>
        
    </div>


</form>









<?php include "inc/footer.view.php"; ?>