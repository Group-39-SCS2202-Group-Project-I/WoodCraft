<?php include "inc/header.view.php"; ?>

<h1>Customers</h1>

<!-- [{"customer_id":1,"user_id":6,"first_name":"Lasith","last_name":"Ranahewa","telephone":"0766716265","address_id":1,"email":"lasithmrana@gmail.com","role":"customer","address_line_1":"150\/A","address_line_2":"Kandy Road","city":"Kadawatha","zip_code":"11850"},{"customer_id":3,"user_id":8,"first_name":"Sasanka","last_name":"Udana","telephone":"0987654321","address_id":3,"email":"sasa@gmail.com","role":"customer","address_line_1":"100\/A","address_line_2":"Kottawa Road","city":"Maharagama","zip_code":"10300"}] -->

<table id="myTable">
    <tr>
        <th>Customer ID</th>
        <th>Name</th>
        <th>Telephone</th>
        <th>Email</th>
        <th>Address ID</th>
        <th>Zip Code</th>
        <th>Actions</th>
    </tr>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateTable() {
                fetch('<?php echo ROOT ?>/fetch/customers')
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        let table = document.getElementById('myTable');
                        // Clear existing table rows
                        while (table.rows.length > 1) {
                            table.deleteRow(1);
                        }
                        // Insert new rows with updated data
                        data.forEach(item => {
                            let row = table.insertRow();
                            let customer_id = "CUS-" + String(item.customer_id).padStart(3, '0');
                            let name = item.first_name + ' ' + item.last_name;
                            let addressId = "ADD-" + String(item.address_id).padStart(3, '0');
                            let zipCode = item.zip_code;
                            let telephone = item.telephone;
                            let email = item.email;

                            row.insertCell().innerHTML = customer_id;
                            row.insertCell().innerHTML = name;
                            row.insertCell().innerHTML = telephone;
                            row.insertCell().innerHTML = email;
                            row.insertCell().innerHTML = addressId;
                            row.insertCell().innerHTML = zipCode;

                            row.insertCell().innerHTML = `<a href="<?php echo ROOT ?>/admin/customers/${item.customer_id}">View</a> | <a href="<?php echo ROOT ?>/admin/customers/delete/${item.customer_id}">Delete</a>`;

                        });
                    })
                    .catch(error => console.error(error));
            }

            // Initial table update
            updateTable();

            // Schedule periodic table updates
            setInterval(updateTable, 5000); // Update every 5 seconds
        });
    </script>
   
</table>



<?php include "inc/footer.view.php"; ?>