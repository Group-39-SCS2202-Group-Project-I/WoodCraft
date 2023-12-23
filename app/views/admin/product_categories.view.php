<?php include "inc/header.view.php"; ?>

<?php
if (isset($_SESSION['errors']) && isset($_SESSION['form_data']) && isset($_SESSION['form_id'])) {
    $errors = $_SESSION['errors'];
    $form_data = $_SESSION['form_data'];
    $form_id = $_SESSION['form_id'];
    // unset the session variables so they don't persist on page refresh
    unset($_SESSION['errors']);
    unset($_SESSION['form_data']);
    unset($_SESSION['form_id']);
    // display the errors and repopulate the form with the data
    // show($form_data);
}
?>

<h1>Product Categories</h1>
<!-- form to add product category -->
<form action="<?php echo ROOT ?>/add/product_category" method="post" id="category_form">
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <!-- validate-mzg -->
        <div class="error">
            <?php echo $errors['name'] ?? '' ?>
        </div>
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="Product Category Name" class="form-control" value="<?php echo $_SESSION['form_data']['name'] ?? '' ?>">
        <div class="error">
            <?php echo $_SESSION['errors']['name'] ?? '' ?>
        </div>
    </div>
    <div class="form-group">
        <!-- button -->
        <button type="submit" class="btn btn-primary">Add Product Category</button>
    </div>
</form>

<!-- fetch and display product categories in a list-->
<div class="category-list">
    <?php
    $url = ROOT . "/fetch/product_categories";
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    // show($data);
    $categories = [];
    foreach ($data as $item) {
        $categories[strtoupper(substr($item['name'], 0, 1))][] = $item;
    }
    ksort($categories);
    ?>
    <?php foreach ($categories as $letter => $categoryList) : ?>
        <div class="category-group">
            <h2><?php echo $letter; ?></h2>
            <ul>
                <?php foreach ($categoryList as $category) : ?>
                    <li>
                        <span class="category-id">CAT-<?php echo str_pad($category['product_category_id'], 3, '0', STR_PAD_LEFT); ?></span>
                        <span class="category-name"><?php echo $category['name']; ?></span>
                        <span class="category-actions">
                            <a href="<?php echo ROOT ?>/delete/product_categories/<?php echo $category['product_category_id'] ?>" class="btn btn-danger">Delete</a>
                        </span>


                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</div>

<?php include "inc/footer.view.php"; ?>