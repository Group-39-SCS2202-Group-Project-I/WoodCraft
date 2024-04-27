<?php include "inc/header.view.php"; ?>
<style>
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 10px;
    }

    .styled-table th,
    .styled-table td {
        /* border: 1px solid #ddd; */
        padding: 8px;
        text-align: left;
    }

    .styled-table th {
        background-color: var(--blk);
        color: var(--light);
        font-weight: 500;
    }

    .styled-table th:first-child {
        border-top-left-radius: 10px;
    }

    .styled-table th:last-child {
        border-top-right-radius: 10px;
    }

    .styled-table tr:last-child td:first-child {
        border-bottom-left-radius: 10px;
    }

    .styled-table tr:last-child td:last-child {
        border-bottom-right-radius: 10px;
    }



    .styled-table td {
        background-color: var(--light);
    }


    /*  */
    .styled-popup {
        position: relative;
        background-color: white;
        border-radius: 5px;
        /* padding: 20px; */
        display: flex;
        justify-content: space-between;
        align-items: center;
        min-width: 500px;
    }

    .close-btn {
        position: absolute;
        right: 0;
        top: 0;
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;

    }

    .close-btn:hover {
        color: var(--danger);
    }



    .styled-material-symbols {
        font-size: 24px;
    }

    .styled-details {
        /* font-size: 24px; */
        color: var(--blk);
        order: 1;
    }

    .styled-quantity {
        /* font-size: 20px; */
        color: var(--blk);
    }
</style>


<div class="table-section">
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>


    <h2 class="table-section__title">Material Stock</h2>



    <div class="table-section__search">
        <input type="text" id="searchMaterials" placeholder="Search Materials..." class="table-section__search-input">
    </div>

    <div id="scrollable_sec">
        <table class="table-section__table" id="materials-table">
            <thead>
                <tr>
                    <th>Material ID</th>
                    <th>Material Name</th>
                    <th>Stock Available</th>
                    <!-- <th>No of Products</th> -->
                    <th>Updated At</th>
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
                                    // console.log(data);
                                    let table = document.getElementById('materials-table');

                                    while (table.rows.length > 1) {
                                        table.deleteRow(1);
                                    }
                                    
                                    data.sort((a, b) => {
                                        return new Date(a.updated_at) - new Date(b.updated_at);
                                    });

                                    data.forEach(item => {
                                        let row = table.insertRow();
                                        let material_id = "MAT-" + String(item.material_id).padStart(3, '0');
                                        row.insertCell().innerHTML = material_id;
                                        row.insertCell().innerHTML = item.material_name;
                                        row.insertCell().innerHTML = item.stock_available;

                                        var mat_id = item.material_id;
                                        // console.log(mat_id);
                                        // console.log("x")

                                        // row.insertCell().innerHTML = pc;
                                        row.insertCell().innerHTML = item.updated_at;
                                        row.insertCell().innerHTML = `<a class="table-section__button" onclick="openUpdatePopup(${item.material_id})">View</a>`;

                                    });
                                });
                        }

                        updateTable();

                        const searchMaterials = document.getElementById('searchMaterials');
                        searchMaterials.addEventListener('input', function() {
                            let filter, table, tr, td, i, txtValue;
                            filter = searchMaterials.value.toUpperCase();
                            table = document.getElementById('materials-table');
                            tr = table.getElementsByTagName('tr');
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName('td')[1];
                                if (td) {
                                    txtValue = td.textContent || td.innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        tr[i].style.display = '';
                                    } else {
                                        tr[i].style.display = 'none';
                                    }
                                }
                            }
                        });


                    });
                </script>

            </tbody>
        </table>
    </div>

    <div class="popup-form" id="approve-item-popup">
        <div class="popup-form__content">
            <form action="" method="POST" class="form">
                <!-- <div class="popup-content styled-popup"> -->
                <!-- <a type="button" class="close-btn styled-close-btn" onclick="closePopup()">
                        <span class="material-symbols-outlined styled-material-symbols">
                            cancel
                        </span>
                    </a> -->
                <!-- </div> -->
                <div>
                    <h3 id="mat-details" class="styled-details"></h3>
                    <p id="mat-quantity" class="styled-quantity"></p>
                </div>
                <br>
                <table id="mat_table" class="styled-table">
                    <!-- <h3>Allocated Materials</h3> -->
                    <!-- <br> -->
                    <tr>
                        <th>Stock Number</th>
                        <th>Quantity</th>
                    </tr>
                </table>

                <!-- <br> -->

                <div class="form-group frm-btns">
                    <!-- <button type="submit" class="form-btn submit-btn">Yes</button> -->
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Close</button>
                </div>



            </form>
        </div>
    </div>

    <script>
        openUpdatePopup = (id) => {
            const popup = document.getElementById('approve-item-popup');
            // const confirmationText = document.querySelector('.confirmation-text');
            // x = "PXN-" + String(id).padStart(3, '0');
            // confirmationText.innerHTML += x + "?";

            let url = "<?= ROOT ?>/fetch/materials/" + id;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    document.getElementById('mat-details').innerHTML = data.material_name + " - MAT-" + String(data.material_id).padStart(3, '0');
                    document.getElementById('mat-quantity').innerHTML = "Quantity: " + data.stock_available;
                });




            let mat_table = document.getElementById('mat_table');

            let url2 = "<?= ROOT ?>/fetch/material_stk_by_material_id/" + id;
            fetch(url2)
                .then(response => response.json())
                .then(data => {

                    let list = '';
                    data.forEach(item => {
                        list += `<tr>
                            <td>MTO-` + String(item.stock_no).padStart(3, '0') + `</td>
                            <td>${item.quantity}</td>
                        </tr>`;
                    });
                    mat_table.innerHTML += list;
                });



            popup.classList.add('popup-form--open');
        }
    </script>

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

            popups.forEach(popup => {
                popup.classList.remove('popup-form--open');
            });


            let mat_details = document.getElementById('mat-details');
            mat_details.innerHTML = '';

            let mat_quantity = document.getElementById('mat-quantity');
            mat_quantity.innerHTML = '';



            let mat_table = document.getElementById('mat_table');
            mat_table.innerHTML = `<tr>
                            <th>Stock Number</th>
                            <th>Quantity</th>
                        </tr>`;


        }
    </script>


</div>





<?php include "inc/footer.view.php"; ?>