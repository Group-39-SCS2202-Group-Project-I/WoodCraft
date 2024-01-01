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

// show($product['measurement']);

//fetch and load product images
$url = ROOT . "/fetch/product_images/" . $product['product_id'];
$response = file_get_contents($url);
$images = json_decode($response, true);
// show($images);
?>

<?php
// show($product['product_id']);
$url = ROOT . "/fetch/product_materials/" . $product['product_id'];
$response = file_get_contents($url);
$materials = json_decode($response, true);
// show($materials);
?>





<div class="table-section">
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>
    <h1 class="list-section__title"><?php echo $product['name'] . " Materials" ?> </span></h1>


    <div class="table-section__add">
        <a href="#" class="table-section__add-link" onclick="openPopup('add-item-popup')">Add New Material</a>
    </div>

    <!-- <div class="table-section__search">
        <input type="text" id="searchMaterials" placeholder="Search Materials..." class="table-section__search-input">
    </div> -->

    <table class="table-section__table" id="material_table">
        <thead>
            <tr>
                <th>Material ID</th>
                <th>Material Name</th>
                <th>Quantity Needed</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="table-section__tbody">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function updateTable() {
                        fetch('<?php echo ROOT ?>/fetch/product_materials/<?php echo $product['product_id'] ?>')
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                let tableBody = document.getElementById('table-section__tbody');
                                let table = document.getElementById('material_table');

                                // Clear existing table rows
                                while (table.rows.length > 1) {
                                    table.deleteRow(1);
                                }

                                // Insert new rows with updated data
                                data.forEach(item => {
                                    let row = tableBody.insertRow();
                                    let material_id = "MAT-" + String(item.material_id).padStart(3, '0');

                                    console.log(item);

                                    row.insertCell().innerHTML = material_id;
                                    row.insertCell().innerHTML = item.material_name;
                                    row.insertCell().innerHTML = item.quantity_needed;
                                    row.insertCell().innerHTML = `<a class="table-section__button" onclick="openUpdatePopup(${item.product_material_id})">Update</a><a class="table-section__button table-section__button-del" onclick="openDeletePopup(${item.product_material_id})">Delete</a>`;
                                });

                            });
                    }
                    updateTable();

                });
            </script>
        </tbody>
    </table>
</div>

<?php
$url = ROOT . "/fetch/materials";
$response = file_get_contents($url);
$materials = json_decode($response, true);
// show($materials);
?>

<!-- Add Item Popup -->
<div class="popup-form" id="add-item-popup">
    <div class="popup-form__content">
        <form action="<?php echo ROOT ?>/add/product_material" method="POST" class="form">
            <h2 class="popup-form-title">Add Material</h2>


            <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">

            <!-- fetch and load materials -->


            <?php if (!empty($errors['material_id'])) : ?>
                <p class="validate-mzg"><?= $errors['material_id'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label for="material_id" class="form-label label-popup">Material</label>
                <select id="material_id" name="material_id" class="form-select input-popup">
                    <?php
                    $x = false;
                    foreach ($materials as $material) {
                        if ($form_data['material_id'] == $material['material_id']) {
                            $x = true;
                            echo '<option value="' . $material['material_id'] . '" selected>' . $material['material_name'] . '</option>';
                        }
                    }
                    if ($x == false) {
                        echo '<option value="" selected disabled>Select a category</option>';
                    }
                    ?>

                    <?php foreach ($materials as $material) : ?>
                        <?php if ($material['material_id'] != $form_data['material_id']) : ?>
                            <option value="<?php echo $material['material_id'] ?>"><?php echo $material['material_name'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php if (!empty($errors['quantity_needed'])) : ?>
                <p class="validate-mzg"><?= $errors['quantity_needed'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label for="quantity_needed" class="form-label label-popup">Quantity Needed</label>
                <input value="<?php echo $form_data['quantity_needed'] ?>" type="number" id="quantity_needed" name="quantity_needed" class="form-input input-popup">
            </div>

            <div class="form-group form-btns">
                <button type="submit" class="form-btn submit-btn">Add New Material</button>
                <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
            </div>

        </form>
    </div>
</div>

<!-- Delete item popup form -->
<div class="popup-form" id="delete-item-popup">
    <div class="popup-form__content">
        <form action="" method="POST" class="form">
            <!-- <h2 class="popup-form-title">Delete Item</h2> -->
            <!-- <p>Are you sure you want to delete this item?</p> -->
            <p class="confirmation-text">Are you sure you want to delete </p>

            <div class="form-group frm-btns">
                <button type="submit" class="form-btn submit-btn">Yes</button>
                <button type="button" class="form-btn cancel-btn" onclick="closePopup()">No</button>
            </div>
        </form>
    </div>
</div>

<div class="popup-form" id="update-item-popup">
    <div class="popup-form__content">
        <form action="<?php echo ROOT ?>/update/product_material" method="POST" class="form">
            <h2 class="popup-form-title" id="update_title">Update Material</h2>

            <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
            <!-- <input type="hidden" name="product_material_id" value="<?php echo $product['product_id'] ?>"> -->

            <!-- fetch and load materials -->

            <?php if (!empty($errors['material_id'])) : ?>
                <p class="validate-mzg"><?= $errors['material_id'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label for="material_id" class="form-label label-popup">Material</label>
                <input value="<?php echo $form_data['material_id'] ?>" type="hidden" id="material_id-upd" name="material_id" class="form-input input-popup">
                <input value="" type="text" id="material_name-upd" name="material_id" class="form-input input-popup">

            </div>

            <?php if (!empty($errors['quantity_needed'])) : ?>
                <p class="validate-mzg"><?= $errors['quantity_needed'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label for="quantity_needed" class="form-label label-popup">Quantity Needed</label>
                <input value="<?php echo $form_data['quantity_needed'] ?>" type="number" id="quantity_needed-upd" name="quantity_needed" class="form-input input-popup">
            </div>

            <div class="form-group form-btns">
                <button type="submit" class="form-btn submit-btn">Update</button>
                <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
            </div>




        </form>

    </div>
</div>
















































<!-- <script>
    const carouselImages = document.getElementById('carouselImages');
    const imageCount = document.querySelector('.image-count');

    let images = <?php echo json_encode($images) ?>;
    let currentImage = 0;

    images.forEach(image => {
        carouselImages.innerHTML += `
                <img src="<?php echo ROOT . '/' ?>${image.image_url}" alt="Product Image-${image.product_image_id}" class="carousel-image">
            `;
    });

    imageCount.innerHTML = `${currentImage + 1}/${images.length}`;



    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    // Add event listeners to carousel buttons
    prevBtn.addEventListener('click', () => {
        // Decrease currentImage index
        currentImage--;
        // If currentImage is less than 0, set it to the last image
        if (currentImage < 0) {
            currentImage = images.length - 1;
        }
        updateCarousel();
    });

    nextBtn.addEventListener('click', () => {
        currentImage++;
        if (currentImage >= images.length) {
            currentImage = 0;
        }
        updateCarousel();
    });

    function updateCarousel() {

        carouselImages.innerHTML = '';
        carouselImages.innerHTML += `
        <img src="<?php echo ROOT . '/' ?>${images[currentImage].image_url}" alt="Product Image-${images[currentImage].product_image_id}" class="carousel-image">
    `;
        // Update image count
        imageCount.innerHTML = `${currentImage + 1}/${images.length}`;
    }

    // Initial carousel update
    updateCarousel();
</script> -->

<script>
    openDeletePopup = (id) => {
        const popup = document.getElementById('delete-item-popup');
        const confirmationText = document.querySelector('.confirmation-text');
        // x = "MAT-" + String(id).padStart(3, '0');
        // confirmationText.innerHTML += "Material ID: " + x + "?";
        popup.classList.add('popup-form--open');
        popup.querySelector('form').action = "<?php echo ROOT ?>/delete/product_materials/" + id;
    }

    openUpdatePopup = (id) => {

        sessionStorage.setItem('product_material_id', id);

        console.log(id);

        const popupTitle = document.getElementById('update_title');
        // popupTitle.innerHTML = "Update Product Material";

        const popup = document.getElementById('update-item-popup');

        // fetch data from database as json
        fetch('<?php echo ROOT ?>/fetch/product_material/' + id)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // populate form with data
                document.getElementById('material_id-upd').value = data.material_id;
                document.getElementById('material_name-upd').value = data.material_name;

                //disable material name input
                document.getElementById('material_name-upd').disabled = true;
                // add disabled-input class to input
                document.getElementById('material_name-upd').classList.add('disabled-input');

                // disable 
                document.getElementById('material_id-upd').disabled = true;

                //send material id to server by hidden input append new input to form
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'material_id';
                input.value = data.material_id;
                
                updateform = document.querySelector('#update-item-popup form');
                updateform.appendChild(input);







                document.getElementById('quantity_needed-upd').value = data.quantity_needed;
            })
            .catch(error => console.error(error));
        popup.classList.add('popup-form--open');
        popup.querySelector('form').action = "<?php echo ROOT ?>/update/product_material/" + id;
    }

    // Function to open popup form
    function openPopup(popupId) {
        const popup = document.getElementById(popupId);
        popup.classList.add('popup-form--open');
    }

    // Function to close popup form
    function closePopup() {
        const popups = document.querySelectorAll('.popup-form');
        confirmText = document.querySelector('.confirmation-text');

        popups.forEach(popup => {
            popup.classList.remove('popup-form--open');
        });

        confirmText.innerHTML = "Are you sure you want to delete ";

        // Clear validation messages
        const validationMessages = document.querySelectorAll('.validate-mzg');
        validationMessages.forEach(message => {
            message.innerHTML = '';
        });

        // Session storage
        sessionStorage.removeItem('product_material_id');

    }

    <?php if (!empty($errors)) : ?>
        if ('<?php echo $form_id; ?>' === 'form1') {
            openPopup('add-item-popup');
        } else if ('<?php echo $form_id; ?>' === 'form2') {
            // code to open your second popup goes here
            product_material_id = sessionStorage.getItem('product_material_id');
            openUpdatePopup(product_material_id);
            //print id
        }
    <?php endif; ?>
</script>



<?php include "inc/footer.view.php"; ?>