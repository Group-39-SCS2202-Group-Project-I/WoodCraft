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

<style>
    #cat-inp {
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        background-color: white;
        font-size: 1rem;
        width: 60%;
        /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); */
    }

    #cat-inp:focus {
        outline: none;
        border: 2px solid var(--primary);
    }

    .cat-add-btn {
        margin-right: 0px;
        width: 30%;
    }
</style>


<div class="table-section">

    <!-- form to add product category -->
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>

    <div style="display: flex;">
        <div class="flex-half"></div>
        <div class="flex-half">

            <?php if (!empty($errors['category_name'])) : ?>
                <p style="display: flex; justify-content: flex-end; padding:0; margin-bottom: 0.5rem" class="validate-mzg"><?= $errors['category_name'] ?></p>
            <?php endif; ?>
            <form action="<?php echo ROOT ?>/add/product_category" method="post" id="category_form" style="display: flex; justify-content: flex-end; padding:0">

                <input type="text" value="<?= set_value('category_name') ?>" name="category_name" placeholder="Enter Category Name" id="cat-inp">
                <span style="margin-left: 10px;"></span>
                <Button type="submit" class="form-btn submit-btn cat-add-btn" style="height: 44px;">Add Category</Button>
            </form>
        </div>
    </div>

    <h1 class="list-section__title">Product Categories </span></h1>


    <div class="table-section__search">
        <input type="text" id="searchCategories" placeholder="Search Categories..." class="table-section__search-input">
        <!-- hidden submit button to avoid -->
        <input type="submit" id="hiddenSubmit" style="display: none;">
    </div>



    <!-- fetch and display product categories in a list-->
    <div class="category-list">
        <?php
        $url = ROOT . "/fetch/product_categories";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        // show($data);
        $categories = [];
        foreach ($data as $item) {
            $categories[strtoupper(substr($item['category_name'], 0, 1))][] = $item;
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
                            <span class="category-name"><?php echo $category['category_name']; ?></span>
                            <span class="category-actions">
                                <a href="<?php echo ROOT ?>/delete/product_categories/<?php echo $category['product_category_id'] ?>" class="btn btn-danger">Delete</a>
                            </span>


                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include "inc/footer.view.php"; ?>