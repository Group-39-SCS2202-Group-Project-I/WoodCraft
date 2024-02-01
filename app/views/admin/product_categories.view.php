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
</style>


<div class="table-section">

    <!-- form to add product category -->
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>

    <!-- <div style="display: flex;">
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
    </div> -->

    <h1 class="list-section__title">Product Categories </span></h1>

    <div class="table-section__add">
        <a href="#" class="table-section__add-link" onclick="openPopup('add-cat-popup')">Add New Category</a>
    </div>



    <div class="table-section__search">
        <input type="text" id="searchCategories" placeholder="Search Categories..." class="table-section__search-input">
        <!-- hidden submit button to avoid -->
        <input type="submit" id="hiddenSubmit" style="display: none;">
    </div>



    <!-- fetch and display product categories in a list-->

    <div class="category-list" style="column-count: 4; column-gap: 20px;">
        <?php
        $url = ROOT . "/fetch/product_categories";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $categories = [];
        foreach ($data as $item) {
            $categories[strtoupper(substr($item['category_name'], 0, 1))][] = $item;
        }
        ksort($categories);
        ?>
        <?php foreach ($categories as $letter => $categoryList) : ?>
            <div class="category-group" style="break-inside: avoid;">
                <h2><?php echo $letter; ?></h2>
                <ul>
                    <?php foreach ($categoryList as $category) : ?>
                        <li class="cat-list-item">
                            <span class="category-name"><?php echo $category['category_name']; ?></span>
                            <span class="category-actions">
                                <a href="<?php echo ROOT ?>/delete/product_categories/<?php echo $category['product_category_id'] ?>">
                                    <span class="material-symbols-outlined delete-cat-btn">
                                        delete
                                    </span>
                                </a>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>

</div>


<div class="popup-form" id="add-cat-popup">
    <div class="popup-form__content">
        <form action="<?php echo ROOT ?>/add/product_category" method="POST" class="form">
            <h2 class="popup-form-title">Add New Category</h2>

            <?php if (!empty($errors['category_name'])) : ?>
                    <p class="validate-mzg"><?= $errors['category_name'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="category_name" class="form-label label-popup">Category</label>
                    <!-- <input value="<?php echo $form_data['first_name'] ?>" type="text" id="first_name" name="first_name" class="form-input input-popup"> -->
                    <input type="text" value="<?= set_value('category_name') ?>" name="category_name" placeholder="" class="form-input input-popup">
                </div>


            <div class="form-group form-btns">
                <button type="submit" class="form-btn submit-btn">Add New Category</button>
                <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
            </div>
        </form>

    </div>
</div>
<script>
    // Function to open popup form
    function openPopup(popupId) {
        const popup = document.getElementById(popupId);
        popup.classList.add('popup-form--open');
    }

    // Function to close popup form
    function closePopup() {
        const popups = document.querySelectorAll('.popup-form');
        // confirmText = document.querySelector('.confirmation-text');
        // confirmText.innerHTML = "Are you sure you want to delete ";
        popups.forEach(popup => {
            popup.classList.remove('popup-form--open');
        });

        // Clear validation messages
        const validationMessages = document.querySelectorAll('.validate-mzg');
        validationMessages.forEach(message => {
            message.innerHTML = '';
        });
    }
</script>
<script>
        <?php if (!empty($errors)) : ?>
            if ('<?php echo $form_id; ?>' === 'form1') {
                openPopup('add-cat-popup');
            } else if ('<?php echo $form_id; ?>' === 'form2') {
                // code to open your second popup goes here
                // worker_id = sessionStorage.getItem('worker_id');
                // openUpdatePopup(worker_id);
                //print id
            }
        <?php endif; ?>
    </script>



<?php include "inc/footer.view.php"; ?>