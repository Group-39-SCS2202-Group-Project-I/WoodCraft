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

    /*  */

    .category-group {
        margin-bottom: 20px;
        /* background-color: var(--light); */
        background-color: white;
        border-radius: 5px;
        padding: 15px;
        /* box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24); */
        /* border: 1.2px solid var(--blk); */
    }

    .category-group h2 {
        margin-bottom: 10px;
        font-size: 1.5em;
        /* color: #333; */
    }

    .category-group ul {
        list-style: none;
        padding: 0;
    }

    .cat-list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        margin-bottom: 0.5rem;
        background-color: var(--light);
        border-radius: 5px;
        /* box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24); */
    }

    .cat-list-item:last-child {
        margin-bottom: 0;
    }

    .delete-cat-btn {
        color: var(--blk);
        cursor: pointer;
    }



    .cat-list-item:hover {
        background-color: var(--blk);
        color: var(--light);
    }

    .cat-list-item:hover .delete-cat-btn {
        color: var(--light);
    }

    .cat-list-item:hover .delete-cat-btn:hover {
        color: var(--danger);
    }



    .category-name {
        font-size: 1.2em;
        /* font-weight: bold; */
    }

    .category-actions {
        display: flex;
        align-items: center;
    }


    .category-actions a {
        /* color: var(--blk); */
        text-decoration: none;
    }

    .material-symbols-outlined {
        margin-left: 5px;
    }

    .list-item-btn
    {
        color: var(--blk);
        text-decoration: none;
    }
</style>


<div class="table-section">

    <!-- form to add product category -->
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>



    <h1 class="list-section__title">Products</h1>


    <div class="table-section__search">
        <input type="text" id="searchCategories" placeholder="Search Products..." class="table-section__search-input">
        <!-- hidden submit button to avoid -->
        <input type="submit" id="hiddenSubmit" style="display: none;">
    </div>


    <!-- fetch and display product categories in a list-->
    <div class="category-list" style="column-count: 4; column-gap: 20px;">
        <?php
        $url = ROOT . "/fetch/product";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $data = $data['products'];

        // $categories = [];
        //     foreach ($data as $item) {
        //         $categories[strtoupper(substr($item['category_name'], 0, 1))][] = $item;
        //     }
        //     ksort($categories);

        $products = [];
        foreach ($data as $item) {
            $products[strtoupper(substr($item['name'], 0, 1))][] = $item;
        }
        ksort($products);
        // show($products);
        ?>

        <?php foreach ($products as $letter => $productsList) : ?>
            <div class="category-group" style="break-inside: avoid;">
                <h2><?php echo $letter; ?></h2>
                <ul>
                    <?php foreach ($productsList as $item) : ?>
                        <li>
                            <a href="<?= ROOT."/pm/product_materials/".$item['product_id']?>" class="cat-list-item list-item-btn">
                                <div class="category-name"><?php echo $item['name']; ?></div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>

    </div>
</div>



<?php include "inc/footer.view.php"; ?>