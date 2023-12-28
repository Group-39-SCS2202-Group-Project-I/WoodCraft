<?php include "inc/header.view.php"; ?>

<?php
if (isset($_SESSION['errors']) && isset($_SESSION['form_data'])) {
    $errors = $_SESSION['errors'];
    $form_data = $_SESSION['form_data'];

    // unset the session variables so they don't persist on page refresh
    unset($_SESSION['errors']);
    unset($_SESSION['form_data']);

    // display the errors and repopulate the form with the data
    // show($form_data);
}

// show($form_data);
// show($errors);
// show($form_id);
?>




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
            <textarea class="page-input" id="description" name="description" style="height: 10em;"><?php echo $form_data['description'] ?></textarea>
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
                $x = false;
                foreach ($categories as $category) {
                    if ($form_data['product_category_id'] == $category['product_category_id']) {
                        $x = true;
                        echo '<option value="' . $category['product_category_id'] . '" selected>' . $category['category_name'] . '</option>';
                    }
                }
                if ($x == false) {
                    echo '<option value="" selected disabled>Select a category</option>';
                }
                ?>

                <?php foreach ($categories as $category) : ?>
                    <?php if ($form_data['product_category_id'] != $category['product_category_id']) : ?>
                        <option value="<?php echo $category['product_category_id'] ?>"><?php echo $category['category_name'] ?></option>
                    <?php endif; ?>
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


        <div>
            <?php if (!empty($errors['height'])) : ?>
                <p class="validate-mzg" style="width: 100%;"><?= $errors['height'] ?></p>
            <?php endif; ?>
            <?php if (!empty($errors['width'])) : ?>
                <p class="validate-mzg" style="width: 100%;"><?= $errors['width'] ?></p>
            <?php endif; ?>
            <?php if (!empty($errors['length'])) : ?>
                <p class="validate-mzg" style="width: 100%;"><?= $errors['length'] ?></p>
            <?php endif; ?>
            <?php if (!empty($errors['weight'])) : ?>
                <p class="validate-mzg" style="width: 100%;"><?= $errors['weight'] ?></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <!-- height, width, length, weight -->


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