<?php include "inc/header.view.php"; ?>

<h1>Customers</h1>
<!-- [{"customer_id":1,"user_id":6,"first_name":"Lasith","last_name":"Ranahewa","telephone":"0766716265","address_id":1}] -->
<table id="myTable">
    <tr>
        <th>Customer ID</th>
        <th>User ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Telephone</th>
        <th>Address ID</th>
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
                        for (let key in item) {
                            let cell = row.insertCell();
                            cell.textContent = item[key];
                        }
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

<?php include "inc/footer.view.php"; ?>