<?php include "inc/header.view.php"; ?>



<div class="table-section">
    <h2 class="table-section__title">Customers</h2>

    <div class="table-section__search">
        <input type="text" id="searchWorkers" placeholder="Search Customers..." class="table-section__search-input">
    </div>
    <div id="scrollable_sec">
        <table class="table-section__table" id="customers_table">
            <tr>
                <th>Customer ID</th>
                <th>Name</th>

                <th>Email</th>
                <th>Address</th>
                <th>Telephone</th>
                <!-- <th>Address ID</th> -->
                <!-- <th>Zip Code</th> -->

                <!-- <th>Actions</th> -->
            </tr>

            <tbody id="table-section__tbody">
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        function updateTable() {
                            fetch('<?php echo ROOT ?>/fetch/customers')
                                .then(response => response.json())
                                .then(data => {
                                    console.log(data);
                                    let table = document.getElementById('customers_table');
                                    // Clear existing table rows
                                    while (table.rows.length > 1) {
                                        table.deleteRow(1);
                                    }

                                    data.sort((a, b) => b.customer_id - a.customer_id);

                                    data.forEach(item => {
                                        let row = table.insertRow();
                                        let customer_id = "CUS-" + String(item.customer_id).padStart(3, '0');
                                        let name = item.first_name + ' ' + item.last_name;
                                        let addressId = "ADD-" + String(item.address_id).padStart(3, '0');
                                        let zipCode = item.zip_code;
                                        let telephone = item.telephone;
                                        let email = item.email;

                                        let address_line_1 = item.address_line_1;
                                        let address_line_2 = item.address_line_2;
                                        let city = item.city;
                                        // let zip_code = item.zip_code;
                                        let province = item.province;

                                        let address = item.address_line_1 + ",<br> " + item.address_line_2 + ",<br> " + item.city + ".<br> " + item.province + ' Province.<br>' + item.zip_code;


                                        row.insertCell().innerHTML = customer_id;
                                        row.insertCell().innerHTML = name;

                                        row.insertCell().innerHTML = email;
                                        row.insertCell().innerHTML = `<p style="text-align: left;">${address}</p>`
                                        row.insertCell().innerHTML = telephone;
                                        // row.insertCell().innerHTML = addressId;
                                        // row.insertCell().innerHTML = zipCode;

                                        // row.insertCell().innerHTML = `<a class="table-section__button" href="<?php echo ROOT ?>/admin/customers/${item.customer_id}">View</a> <a href="<?php echo ROOT ?>/delete/customers/${item.customer_id}">Delete</a>`;
                                        // row.insertCell().innerHTML = `<a class="table-section__button" href="<?php echo ROOT ?>/admin/customers/${item.customer_id}">View</a>`;

                                    });
                                })
                                .catch(error => console.error(error));
                        }

                        // Initial table update
                        updateTable();

                        // Schedule periodic table updates
                        // setInterval(updateTable, 5000); // Update every 5 seconds
                    });

                    document.getElementById('searchWorkers').addEventListener('input', function() {
                        let searchValue = this.value.toLowerCase();
                        let rows = document.getElementById('customers_table').rows;
                        for (let i = 1; i < rows.length; i++) {
                            let name = rows[i].cells[1].innerText.toLowerCase();
                            let id = rows[i].cells[0].innerText.toLowerCase();
                            let email = rows[i].cells[2].innerText.toLowerCase();
                            
                            if (name.includes(searchValue) || id.includes(searchValue) || email.includes(searchValue)) {
                                rows[i].style.display = '';
                            } else {
                                rows[i].style.display = 'none';
                            }
                        }
                    });


                </script>
            </tbody>

        </table>
    </div>

</div>




<?php include "inc/footer.view.php"; ?>