<?php include "inc/header.view.php"; ?>

<div class="table-section" style=" padding-bottom:0">
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>
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

    /*  */
    .select {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        /* max-width: 300px; */
        width: 100%;
        gap: 5px;
    }

    .select__item {
        padding: 10px;
        cursor: pointer;
        text-align: center;
        border-radius: 10px;
        background: var(--light);
        transition: background 0.1s;
    }

    .select__item--selected {
        background: var(--blk);
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
    $form_data['province'] = $delivery_info->province;
}
?>




<form action="<?php echo ROOT ?>/update/delivery" method="POST" class="form-section">
    <div class="form-wrapper">
        <div class="form-container">



            <div style="text-align:right; padding-top:10px; width:100%">
                <a class="dash-button">Edit</a>
            </div>

            <h2 class="table-section__title" style="margin-top:0; margin-bottom:0; font-size:18px; font-weight:600;">Company Address</h2>

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

            <?php if (!empty($errors['province'])) : ?>
                <p class="validate-mzg"><?= $errors['province'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label class="page-label" for="province">Province :</label>
                <!-- 'Central','Eastern','North Central','Northern','North Western','Sabaragamuwa','Southern','Uva','Western' -->
                <select class="page-select" name="province" id="province">
                    <option value="Central" <?php echo $form_data['province'] == 'Central' ? 'selected' : '' ?>>Central</option>
                    <option value="Eastern" <?php echo $form_data['province'] == 'Eastern' ? 'selected' : '' ?>>Eastern</option>
                    <option value="North Central" <?php echo $form_data['province'] == 'North Central' ? 'selected' : '' ?>>North Central</option>
                    <option value="Northern" <?php echo $form_data['province'] == 'Northern' ? 'selected' : '' ?>>Northern</option>
                    <option value="North Western" <?php echo $form_data['province'] == 'North Western' ? 'selected' : '' ?>>North Western</option>
                    <option value="Sabaragamuwa" <?php echo $form_data['province'] == 'Sabaragamuwa' ? 'selected' : '' ?>>Sabaragamuwa</option>
                    <option value="Southern" <?php echo $form_data['province'] == 'Southern' ? 'selected' : '' ?>>Southern</option>
                    <option value="Uva" <?php echo $form_data['province'] == 'Uva' ? 'selected' : '' ?>>Uva</option>
                    <option value="Western" <?php echo $form_data['province'] == 'Western' ? 'selected' : '' ?>>Western</option>
                </select>
                <!-- hidden input  -->
                <input type="hidden" name="province" value="<?php echo $form_data['province'] ?>" id="hiddenpro">
            </div>

            <?php if (!empty($errors['zip_code'])) : ?>
                <p class="validate-mzg"><?= $errors['zip_code'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label class="page-label" for="zip_code">Zip Code :</label>
                <input value="<?php echo $form_data['zip_code'] ?>" class="page-input" type="text" id="zip_code" name="zip_code">
            </div>

            <!-- Delivery Cost -->
            <h2 class="table-section__title" style=" margin-bottom:0; font-size:18px; font-weight:600;">Delivery Cost</h2>

            <?php if (!empty($errors['percentage'])) : ?>
                <p class="validate-mzg"><?= $errors['percentage'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label class="page-label" for="percentage">Fair Percentage :</label>
                <input value="<?php echo $form_data['percentage'] ?>" class="page-input" type="text" id="percentage" name="percentage">
            </div>


            <p class="validate-mzg" id="zeroprovince"></p>

            <div class="form-group">
                <label class="page-label" for="available_provinces">Available Provinces :</label>
                <div style="width: 100%;" id="avail_pro">
                    <div class="select">
                        <?php if (!empty($data['available_provinces'])) : ?>
                            <?php foreach ($data['available_provinces'] as $province) : ?>
                                <div class="select__item" style="background: var(--light); color:var(--blk); cursor: default; "><?= $province ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (empty($data['available_provinces'])) : ?>
                            <div class="select__item" style="background: var(--light); color:var(--blk); cursor: default; ">No provinces available</div>
                        <?php endif; ?>
                    </div>
                </div>
                <div style="width:100%" id="mulsecgrp">
                    <select name="available_provinces" class="custom-select" multiple id="mulselec">
                        <option class="opt" value="Central">Central</option>
                        <option class="opt" value="Eastern">Eastern</option>
                        <option class="opt" value="North Central">North Central</option>
                        <option class="opt" value="Northern">Northern</option>
                        <option class="opt" value="North Western">North Western</option>
                        <option class="opt" value="Sabaragamuwa">Sabaragamuwa</option>
                        <option class="opt" value="Southern">Southern</option>
                        <option class="opt" value="Uva">Uva</option>
                        <option class="opt" value="Western">Western</option>
                    </select>
                </div>

            </div>

            <div style="display: flex; justify-content: center; width:100%">
                <button type="button" class="form-btn submit-btn" style="max-width: 400px;" id="submitbtn2">Update</button>
                <button type="submit" class="form-btn submit-btn" style="max-width: 400px; display:none" id="submitbtn">Update</button>
                <button type="button" onclick="cancelInputs();" class="form-btn cancel-btn" style="max-width: 400px;">Cancel</button>
                <!-- hidden button -->
                <button type="button" class="form-btn dash-button" style="max-width: 400px; display:none;" id="mulpro" onclick="logSelectedValues()">Edit</button>
            </div>



        </div>
    </div>
</form>

<script>
    //
    function applyCustomSelect(selectId) {
        const selectElement = document.getElementById(selectId);
        if (!selectElement) {
            console.error(`Select element with id '${selectId}' not found.`);
            return;
        }

        class CustomSelect {
            constructor(originalSelect) {
                this.originalSelect = originalSelect;
                this.customSelect = document.createElement("div");
                this.customSelect.classList.add("select");

                this.originalSelect.querySelectorAll("option").forEach((optionElement) => {
                    const itemElement = document.createElement("div");

                    itemElement.classList.add("select__item");
                    itemElement.textContent = optionElement.textContent;
                    this.customSelect.appendChild(itemElement);

                    if (optionElement.selected) {
                        this._select(itemElement);
                    }

                    itemElement.addEventListener("click", () => {
                        if (
                            this.originalSelect.multiple &&
                            itemElement.classList.contains("select__item--selected")
                        ) {
                            this._deselect(itemElement);
                        } else {
                            this._select(itemElement);
                        }
                    });
                });

                this.originalSelect.insertAdjacentElement("afterend", this.customSelect);
                this.originalSelect.style.display = "none";
            }

            _select(itemElement) {
                const index = Array.from(this.customSelect.children).indexOf(itemElement);

                if (!this.originalSelect.multiple) {
                    this.customSelect.querySelectorAll(".select__item").forEach((el) => {
                        el.classList.remove("select__item--selected");
                    });
                }

                this.originalSelect.querySelectorAll("option")[index].selected = true;
                itemElement.classList.add("select__item--selected");
            }

            _deselect(itemElement) {
                const index = Array.from(this.customSelect.children).indexOf(itemElement);

                this.originalSelect.querySelectorAll("option")[index].selected = false;
                itemElement.classList.remove("select__item--selected");
            }
        }

        new CustomSelect(selectElement);
    }

    applyCustomSelect("mulselec");


    const availableProvinces = <?php echo !empty($data['available_provinces']) ? json_encode($data['available_provinces']) : '[]'; ?>;
    const selectElement = document.getElementById('mulselec');
    for (const province of availableProvinces) {
        console.log(province);
        const optionElement = selectElement.querySelector(`option[value="${province}"]`);
        if (optionElement) {
            optionElement.selected = true;
        }
        const customSelectItems = document.querySelectorAll('.select__item');
        for (const item of customSelectItems) {
            if (item.textContent === province) {
                item.classList.add('select__item--selected');
            }
        }
    }





    function logSelectedValues() {
        const selectedOptions = document.querySelectorAll('.custom-select option:checked');
        const selectedValues = Array.from(selectedOptions).map(option => option.value);
        console.log(selectedValues);
    }
</script>

<script>
    const inputs = document.querySelectorAll('.page-input');
    const submitbtn = document.getElementById('submitbtn');
    const submitbtn2 = document.getElementById('submitbtn2');
    const cancelbtn = document.querySelector('.cancel-btn');

    const province = document.getElementById('province');
    const hiddenpro = document.getElementById('hiddenpro');

    const mulselgrp = document.getElementById('mulsecgrp');
    const avali = document.getElementById('avail_pro');

    function disableInputs() {
        inputs.forEach(input => {
            input.disabled = true;
        });
        // submitbtn.style.display = 'none';
        submitbtn2.style.display = 'none';
        cancelbtn.style.display = 'none';
        mulselgrp.style.display = 'none';
        avali.style.display = 'block';
        province.disabled = true;
    }
    disableInputs();

    const editbtn = document.querySelector('.dash-button');
    editbtn.addEventListener('click', () => {
        inputs.forEach(input => {
            input.disabled = false;
        });

        // submitbtn.style.display = 'block';
        submitbtn2.style.display = 'block';
        cancelbtn.style.display = 'block';
        avali.style.display = 'none';
        mulselgrp.style.display = 'block';
        editbtn.style.display = 'none';
        province.disabled = false;
    });

    const form = document.querySelector('.form-section');

    <?php if (!empty($errors)) : ?>
        inputs.forEach(input => {
            input.disabled = false;
        });
        province.disabled = false;
        submitbtn2.style.display = 'block';
        cancelbtn.style.display = 'block';
        avali.style.display = 'none';
        mulselgrp.style.display = 'block';
        editbtn.style.display = 'none';
    <?php endif; ?>

    function cancelInputs() {
        location.reload();
    }

    // Province select

    province.addEventListener('change', () => {
        hiddenpro.value = province.value;

    });
    const zeroprovince = document.getElementById('zeroprovince');
    const mulpro = document.getElementById('mulpro');
    submitbtn.addEventListener('click', () => {
        const selectedOptions = document.querySelectorAll('.custom-select option:checked');
        const selectedValues = Array.from(selectedOptions).map(option => option.value);
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'available_provinces';
        hiddenInput.value = selectedValues;
        form.appendChild(hiddenInput);
    });

    submitbtn2.addEventListener('click', () => {
        const selectedOptions = document.querySelectorAll('.custom-select option:checked');
        const selectedValues = Array.from(selectedOptions).map(option => option.value);
        
        if(selectedValues.length == 0){
            zeroprovince.textContent = 'Please select at least one province';
            return;
        }
        else{
            zeroprovince.textContent = '';
            submitbtn.click();
        }
        
    });

</script>



<?php include "inc/footer.view.php"; ?>