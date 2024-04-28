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



<div class="table-section">
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>


    <h2 class="table-section__title">Materials</h2>

    <div class="table-section__add">
        <a href="#" class="table-section__add-link" onclick="openPopup('add-item-popup')">Add New Material</a>
    </div>

    <div class="table-section__search">
        <input type="text" id="searchMaterials" placeholder="Search Materials..." class="table-section__search-input">
    </div>
    <div id="scrollable_sec">
        <table class="table-section__table" id="material_table">
            <thead>
                <tr>
                    <th>Material ID</th>
                    <th>Material Name</th>
                    <th>Material Description</th>
                    <th>Stocks Available</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody id="table-section__tbody">
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        function updateTable() {
                            fetch('<?php echo ROOT ?>/fetch/materials')
                                .then(response => response.json())
                                .then(data => {
                                    console.log(data);
                                    let tableBody = document.getElementById('table-section__tbody');
                                    let table = document.getElementById('material_table');
                                    
                                    while (tableBody.firstChild) {
                                        tableBody.removeChild(tableBody.firstChild);
                                    }

                                    data.sort((a, b) => {
                                        return b.material_id - a.material_id;
                                    });
                                  
                                    data.forEach(item => {
                                        let row = document.createElement('tr');
                                        let material_id = "MAT-" + String(item.material_id).padStart(3, '0');

                                        let idCell = document.createElement('td');
                                        idCell.textContent = material_id;
                                        row.appendChild(idCell);

                                        let nameCell = document.createElement('td');
                                        nameCell.innerHTML = `<p>${item.material_name}</p>`;
                                        row.appendChild(nameCell);

                                        let descriptionCell = document.createElement('td');
                                        descriptionCell.innerHTML = `<p>${item.material_description}</p>`;
                                        row.appendChild(descriptionCell);

                                        let stocksCell = document.createElement('td');
                                        stocksCell.textContent = item.stock_available;
                                        row.appendChild(stocksCell);

                                        let actionsCell = document.createElement('td');
                                        actionsCell.innerHTML = `<a class="table-section__button" onclick="openUpdatePopup(${item.material_id})">Update</a><a class="table-section__button table-section__button-del" onclick="openDeletePopup(${item.material_id})">Delete</a>`;
                                        row.appendChild(actionsCell);

                                        tableBody.appendChild(row);
                                    });
                                })
                                .catch(error => console.log(error));
                        }
                        updateTable();
                        // setInterval(updateTable, 5000);
                        
                        document.getElementById('searchMaterials').addEventListener('input', function() {
                            let searchValue = this.value.toLowerCase();
                            let rows = document.querySelectorAll('#material_table tbody tr');
                            rows.forEach(row => {
                                let id = row.cells[0].textContent.toLowerCase();
                                let name = row.cells[1].textContent.toLowerCase();
                                if (id.includes(searchValue) || name.includes(searchValue)) {
                                    row.style.display = '';
                                } else {
                                    row.style.display = 'none';
                                }
                            });
                        });
                    });

                    let ths = document.querySelectorAll('th');
                    ths.forEach(th => {
                        th.addEventListener('click', function() {
                            let table = document.getElementById('material_table');
                            let tbody = table.querySelector('tbody');
                            let rows = Array.from(tbody.querySelectorAll('tr'));

                            let index = Array.from(this.parentNode.children).indexOf(this);

                            let order = this.dataset.order = -(this.dataset.order || -1);

                            rows.sort((a, b) => {
                                a = a.children[index].textContent;
                                b = b.children[index].textContent;
                                return a.localeCompare(b, undefined, {
                                    numeric: true
                                }) * order;
                            });

                            rows.forEach(row => tbody.appendChild(row));
                        });
                    });
                </script>
            </tbody>
        </table>
    </div>
</div>


<!-- Add new item popup form -->
<div class="popup-form" id="add-item-popup">
    <div class="popup-form__content">
        <form action="<?php echo ROOT ?>/add/material" method="POST" class="form">
            <h2 class="popup-form-title">Add New Material</h2>

            <?php if (!empty($errors['name'])) : ?>
                <p class="validate-mzg"><?= $errors['name'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label for="name" class="form-label label-popup">Material Name</label>
                <input value="<?php echo $form_data['name'] ?>" type="text" id="name" name="name" class="form-input input-popup">
            </div>

            <?php if (!empty($errors['description'])) : ?>
                <p class="validate-mzg"><?= $errors['description'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label class="form-label label-popup" for="description">Material Description:</label>
                <textarea class="form-textarea input-popup" id="description" name="description" style="height: 10em;"><?php echo $form_data['description'] ?></textarea>
            </div>

            <div class="form-group form-btns">
                <button type="submit" class="form-btn submit-btn">Add New Material</button>
                <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
            </div>
        </form>

    </div>
</div>

<!-- Update item popup form -->
<div class="popup-form" id="update-item-popup">
    <div class="popup-form__content">
        <form action="<?php echo ROOT ?>/update/material" method="POST" class="form">
            <h2 class="popup-form-title" id="update_title">Update Material</h2>

            <?php if (!empty($errors['name'])) : ?>
                <p class="validate-mzg"><?= $errors['name'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label for="name" class="form-label label-popup">Material Name</label>
                <input value="<?php echo $form_data['name'] ?>" type="text" id="name-update" name="name" class="form-input input-popup">
            </div>

            <?php if (!empty($errors['description'])) : ?>
                <p class="validate-mzg"><?= $errors['description'] ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label class="form-label label-popup" for="description">Material Description:</label>
                <textarea class="form-textarea input-popup" id="description-update" name="description" style="height: 10em;"><?php echo $form_data['description'] ?></textarea>
            </div>

            <div class="form-group form-btns">
                <button type="submit" class="form-btn submit-btn">Update</button>
                <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
            </div>
        </form>

    </div>
</div>

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

<script>
    openDeletePopup = (id) => {
        const popup = document.getElementById('delete-item-popup');
        const confirmationText = document.querySelector('.confirmation-text');
        x = "MAT-" + String(id).padStart(3, '0');
        confirmationText.innerHTML += "Material ID: " + x + "?";
        popup.classList.add('popup-form--open');
        popup.querySelector('form').action = "<?php echo ROOT ?>/delete/materials/" + id;
    }

    openUpdatePopup = (id) => {
        sessionStorage.setItem('material_id', id);

        const popupTitle = document.getElementById('update_title');
        popupTitle.innerHTML = "Update Material (ID: MAT-" + String(id).padStart(3, '0') + ")";

        const popup = document.getElementById('update-item-popup');

        // fetch data from database as json
        fetch('<?php echo ROOT ?>/fetch/materials/' + id)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // populate form with data
                document.getElementById('name-update').value = data.material_name;
                document.getElementById('description-update').value = data.material_description;

            })
            .catch(error => console.error(error));
        popup.classList.add('popup-form--open');
        popup.querySelector('form').action = "<?php echo ROOT ?>/update/material/" + id;
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
        sessionStorage.removeItem('material_id');

    }

    <?php if (!empty($errors)) : ?>
        if ('<?php echo $form_id; ?>' === 'form1') {
            openPopup('add-item-popup');
        } else if ('<?php echo $form_id; ?>' === 'form2') {
            // code to open your second popup goes here
            material_id = sessionStorage.getItem('material_id');
            openUpdatePopup(material_id);
            //print id
        }
    <?php endif; ?>
</script>


<?php include "inc/footer.view.php"; ?>