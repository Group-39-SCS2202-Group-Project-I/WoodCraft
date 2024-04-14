<?php include "inc/header.view.php"; ?>

<div class="table-section" style=" padding-bottom:0">
    <h2 class="table-section__title" style=" margin-bottom:0">Delivery Details</h2>
</div>

<style>
    .form-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 20px;
    }

    .dash-button {
        padding: 10px 20px;
        background-color: var(--blk);
        color: var(--light);
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        transition: background-color 0.2s ease-in-out;
        cursor: pointer;
    }

    .dash-button:hover {
        background-color: var(--primary);
        color: var(--light);
    }

    
</style>
<?php
if (isset($_SESSION['errors']) && isset($_SESSION['form_data'])) {
    $errors = $_SESSION['errors'];
    $form_data = $_SESSION['form_data'];

    unset($_SESSION['errors']);
    unset($_SESSION['form_data']);
} else {
    $delivery_info = $data['delivery_info'];
    $form_data['address_line_1'] = $delivery_info->address_line_1;
    $form_data['address_line_2'] = $delivery_info->address_line_2;
    $form_data['city'] = $delivery_info->city;
    $form_data['zip_code'] = $delivery_info->zip_code;
    $form_data['percentage'] = $delivery_info->percentage;
}
?>


<form action="<?php echo ROOT ?>/update/delivery" method="POST" class="form-section">
    <div class="form-wrapper">
        <div class="form-container">

        <div style="text-align:right; padding-top:10px; width:100%">
            <a class="dash-button">Edit</a>
        </div>

            <?php if (!empty($errors['address_line_1'])) : ?>
                <p class="validate-mzg"><?= $errors['address_line_1'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label class="page-label" for="address_line_1">Address Line 1 :</label>
                <input value="<?php echo $form_data['address_line_1'] ?>" class="page-input" type="text" id="address_line_1" name="address_line_1">
            </div>

            <?php if (!empty($errors['address_line_2'])) : ?>
                <p class="validate-mzg"><?= $errors['address_line_2'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label class="page-label" for="address_line_2">Address Line 2 :</label>
                <input value="<?php echo $form_data['address_line_2'] ?>" class="page-input" type="text" id="address_line_2" name="address_line_2">
            </div>

            <?php if (!empty($errors['city'])) : ?>
                <p class="validate-mzg"><?= $errors['city'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label class="page-label" for="city">City :</label>
                <input value="<?php echo $form_data['city'] ?>" class="page-input" type="text" id="city" name="city">
            </div>

            <?php if (!empty($errors['zip_code'])) : ?>
                <p class="validate-mzg"><?= $errors['zip_code'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label class="page-label" for="zip_code">Zip Code :</label>
                <input value="<?php echo $form_data['zip_code'] ?>" class="page-input" type="text" id="zip_code" name="zip_code">
            </div>

            <?php if (!empty($errors['percentage'])) : ?>
                <p class="validate-mzg"><?= $errors['percentage'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label class="page-label" for="percentage">Fair Percentage :</label>
                <input value="<?php echo $form_data['percentage'] ?>" class="page-input" type="text" id="percentage" name="percentage">
            </div>

            <div style="display: flex; justify-content: center; width:100%">
                <button type="submit" class="form-btn submit-btn" style="max-width: 400px;" id="submitbtn">Update</button>
                <button type="button" onclick="cancelInputs();" class="form-btn cancel-btn" style="max-width: 400px;">Cancel</button>
            </div>


        </div>
    </div>
</form>

<script>
    const inputs = document.querySelectorAll('.page-input');
    const submitbtn = document.getElementById('submitbtn');
    const cancelbtn = document.querySelector('.cancel-btn');
    function disableInputs() {
        inputs.forEach(input => {
            input.disabled = true;
        });
        submitbtn.style.display = 'none';
        cancelbtn.style.display = 'none';
    }
    disableInputs();

    const editbtn = document.querySelector('.dash-button');
    editbtn.addEventListener('click', () => {
        inputs.forEach(input => {
            input.disabled = false;
        });
        submitbtn.style.display = 'block';
        cancelbtn.style.display = 'block';
    });

    const form = document.querySelector('.form-section');
    
    <?php if (!empty($errors)) : ?>
        inputs.forEach(input => {
            input.disabled = false;
        });
        submitbtn.style.display = 'block';
        cancelbtn.style.display = 'block';
    <?php endif; ?>

    function cancelInputs() {
        location.reload();
    }





    


</script>



<?php include "inc/footer.view.php"; ?>