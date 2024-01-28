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

    .disabled-input {
        background-color: #ddd;
        color: #666;

    }
</style>

<form action="<?php echo ROOT ?>/add/material_order" method="POST" class="form-section">
    <h2 class="table-section__title">Add Received Material Order</h2>

    <!-- material_order_id	material_id	supplier_id	quantity	price_per_unit	total	created_at	updated_at	 -->

    <div class="form-wrapper">
        <div class="form-container">
            <?php
            $url_mat = ROOT . "/fetch/materials";
            $response_mat = file_get_contents($url_mat);
            $materials = json_decode($response_mat, true);
            // show($materials);
            // show($products['products']);

            ?>

            <?php if (!empty($errors['material_id'])) : ?>
                <p class="validate-mzg"><?= $errors['material_id'] ?></p>
            <?php endif; ?>

            <div class="form-group">
                <label for="material_id" class="page-label">Material:</label>
                <select id="material_id" name="material_id" class="page-select">
                    <?php
                    $x = false;
                    foreach ($materials as $material) {
                        if ($form_data['material_id'] == $material['material_id']) {
                            $x = true;
                            echo '<option value="' . $material['material_id'] . '" selected>' . $material['material_name'] . '</option>';
                        }
                    }
                    if ($x == false) {
                        echo '<option value="" selected disabled>Select a material</option>';
                    }
                    ?>

                    <?php foreach ($materials as $material) : ?>
                        <?php if ($form_data['material_id'] != $material['material_id']) : ?>
                            <option value="<?php echo $material['material_id'] ?>"><?php echo $material['material_name'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- supplier -->
            <?php
            $url_sup = ROOT . "/fetch/suppliers";
            $response_sup = file_get_contents($url_sup);
            $suppliers = json_decode($response_sup, true);
            // show($products['products']);
            ?>

            <?php if (!empty($errors['supplier_id'])) : ?>
                <p class="validate-mzg"><?= $errors['supplier_id'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label for="supplier_id" class="page-label">Supplier:</label>
                <select id="supplier_id" name="supplier_id" class="page-select">
                    <?php
                    $x = false;
                    foreach ($suppliers as $supplier) {
                        if ($form_data['supplier_id'] == $supplier['supplier_id']) {
                            $x = true;
                            echo '<option value="' . $supplier['supplier_id'] . '" selected>' . $supplier['name'] . '</option>';
                        }
                    }
                    if ($x == false) {
                        echo '<option value="" selected disabled>Select a supplier</option>';
                    }
                    ?>

                    <?php foreach ($suppliers as $supplier) : ?>
                        <?php if ($form_data['supplier_id'] != $supplier['supplier_id']) : ?>
                            <option value="<?php echo $supplier['supplier_id'] ?>"><?php echo $supplier['name'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php if (!empty($errors['quantity'])) : ?>
                <p class="validate-mzg"><?= $errors['quantity'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label class="page-label" for="quantity">Quantity:</label>
                <input value="<?php echo $form_data['quantity'] ?>" class="page-input" type="text" id="quantity" name="quantity" oninput="calculateTotal()">
            </div>

            <?php if (!empty($errors['price_per_unit'])) : ?>
                <p class="validate-mzg"><?= $errors['price_per_unit'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label class="page-label" for="price_per_unit">Price Per Unit:</label>
                <input value="<?php echo $form_data['price_per_unit'] ?>" class="page-input" type="text" id="price_per_unit" name="price_per_unit" oninput="calculateTotal()">
            </div>

            <div class="form-group">
                <label class="page-label" for="total">Total:</label>
                <input value="<?php echo $form_data['total'] ?>" class="page-input disabled-input" type="text" id="total" name="total" disabled>
                <input value="<?php echo $form_data['total'] ?>" class="page-input disabled-input" type="hidden" id="total-form" name="total">

            </div>

            <script>
                function calculateTotal() {
                    var quantity = parseFloat(document.getElementById('quantity').value);
                    var pricePerUnit = parseFloat(document.getElementById('price_per_unit').value);
                    var total = isNaN(quantity) || isNaN(pricePerUnit) ? 0 : quantity * pricePerUnit;
                    document.getElementById('total').value = total.toFixed(2);
                    document.getElementById('total-form').value = total.toFixed(2);
                }
            </script>


            <div style="display: flex; justify-content: center; width:100%">
                <button type="submit" class="form-btn submit-btn" style="max-width: 400px;">Received Material Order</button>
            </div>

        </div>
    </div>


</form>









<?php include "inc/footer.view.php"; ?>