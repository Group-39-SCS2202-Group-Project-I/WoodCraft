<?php include "inc/header.view.php"; ?>
<?php
$workers_url = ROOT . "/fetch/workers";
$workers_response = file_get_contents($workers_url);
$workers = json_decode($workers_response, true);

$carpenters = [];
$painters = [];
$supervisors = [];

foreach ($workers as $worker) {
    if ($worker['worker_role'] == "carpenter") {
        array_push($carpenters, $worker);
    } elseif ($worker['worker_role'] == "painter") {
        array_push($painters, $worker);
    } elseif ($worker['worker_role'] == "supervisor") {
        array_push($supervisors, $worker);
    }
}

// show($carpenters);
// show($painters);
// show($supervisors);
$carpenters_count = 0;
$painters_count = 0;
$supervisors_count = 0;
if ($carpenters) {
    $carpenters_count = count($carpenters);
}
if ($painters) {
    $painters_count = count($painters);
}
if ($supervisors) {
    $supervisors_count = count($supervisors);
}

$availavle_carpenters = [];
$availavle_painters = [];
$availavle_supervisors = [];

foreach ($carpenters as $carpenter) {
    if ($carpenter['availability'] == "available") {
        array_push($availavle_carpenters, $carpenter);
    }
}
foreach ($painters as $painter) {
    if ($painter['availability'] == "available") {
        array_push($availavle_painters, $painter);
    }
}
foreach ($supervisors as $supervisor) {
    if ($supervisor['availability'] == "available") {
        array_push($availavle_supervisors, $supervisor);
    }
}

$availavle_carpenter_count = 0;
$availavle_painter_count = 0;
$availavle_supervisor_count = 0;

if ($availavle_carpenters) {
    $availavle_carpenter_count = count($availavle_carpenters);
}
if ($availavle_painters) {
    $availavle_painter_count = count($availavle_painters);
}
if ($availavle_supervisors) {
    $availavle_supervisor_count = count($availavle_supervisors);
}
?>
<style>
    .card-icon {
        font-size: 70px;
        /* color: #333; */
        font-variation-settings:
            'FILL' 0,
            'wght' 100,
            'GRAD' 0,
            'opsz' 24;
    }
</style>

<div class="table-section" style=" padding-bottom:0">
    <h2 class="table-section__title" style=" margin-bottom:0">Workers</h2>
</div>

<div class="dashboard">
    <a href="" style="text-decoration:none" onclick="filterWorkers('carpenter')">
        <div class="card">
            <h3 class="card-title">Carpenters</h3>
            <span class="material-icons-outlined card-icon">chair</span>
            <p class="card-text"><?= $availavle_carpenter_count ?>/<?= $carpenters_count ?></p>
        </div>
    </a>
    <a href="" style="text-decoration:none" onclick="filterWorkers('painter')">
        <div class="card">
            <h3 class="card-title">Painters</h3>
            <span class="material-icons-outlined card-icon">chair</span>
            <p class="card-text"><?= $availavle_painter_count ?>/<?= $painters_count ?></p>
        </div>
    </a>
    <a href="" style="text-decoration:none" onclick="filterWorkers('supervisor')">
        <div class="card">
            <h3 class="card-title">Supervisors</h3>
            <span class="material-icons-outlined card-icon">chair</span>
            <p class="card-text"><?= $availavle_supervisor_count ?>/<?= $supervisors_count ?></p>
        </div>
    </a>
    <!-- Repeat for other cards -->
</div>

<div class="table-section">
    <div class="table-section__search">
        <input type="text" id="searchWorkers" placeholder="Search Workers..." class="table-section__search-input">
    </div>


    <table class="table-section__table" id="workers_table">
        <!-- worker_id	first_name	last_name	mobile_number	address_id	availability	created_at	updated_at	deleted_at	 -->
        <thead>
            <tr>
                <th onclick="sortTable(0)">Worker ID</th>
                <th onclick="sortTable(1)">Name</th>
                <th onclick="sortTable(2)">Mobile Number</th>
                <th onclick="sortTable(3)">Address</th>
                <th onclick="sortTable(4)">Availability</th>
                <th onclick="sortTable(5)">Role</th>

                <!-- <th onclick="sortTable(6)">Date Added</th> -->
                <!-- <th onclick="sortTable(7)">Date Updated</th> -->

                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="table-section__tbody">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function updateTable() {
                        fetch('<?php echo ROOT ?>/fetch/workers')
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                let table = document.getElementById('workers_table');
                                // Clear existing table rows
                                while (table.rows.length > 1) {
                                    table.deleteRow(1);
                                }
                                // Insert new rows with updated data
                                data.forEach(item => {
                                    let row = table.insertRow();
                                    let worker_id = "WRK-" + String(item.worker_id).padStart(3, '0');
                                    let name = item.first_name + ' ' + item.last_name;
                                    item.first_name = item.first_name.charAt(0).toUpperCase() + item.first_name.slice(1).toLowerCase();
                                    item.last_name = item.last_name.charAt(0).toUpperCase() + item.last_name.slice(1).toLowerCase();
                                    name = item.first_name + ' ' + item.last_name;
                                    let mobile_number = item.mobile_number;
                                    let address = item.address_line_1 + ',<br>' + item.address_line_2 + ',<br>' + item.city + '.<br>' + item.zip_code;
                                    let availability = item.availability;
                                    let worker_role = item.worker_role;
                                    worker_role = worker_role.charAt(0).toUpperCase() + worker_role.slice(1);
                                    availability = availability.charAt(0).toUpperCase() + availability.slice(1);
                                    let date_added = item.created_at;
                                    let date_updated = item.updated_at;

                                    row.insertCell().innerHTML = worker_id;
                                    row.insertCell().innerHTML = name;
                                    row.insertCell().innerHTML = mobile_number;
                                    row.insertCell().innerHTML = `<p style="text-align: left;">${address}</p>`
                                    row.insertCell().innerHTML = availability;
                                    row.insertCell().innerHTML = worker_role;
                                    // row.insertCell().innerHTML = date_added;
                                    // row.insertCell().innerHTML = date_updated;

                                    // row.insertCell().innerHTML = `<a class="table-section__button" onclick="openUpdatePopup(${item.worker_id})">Update</a><a class="table-section__button table-section__button-del" onclick="openDeletePopup(${item.worker_id})">Delete</a>`;
                                    row.insertCell().innerHTML = `<a class="table-section__button" href="<?= ROOT ?>/gm/workers/${item.worker_id}">View</a>`;

                                });
                            })
                            .catch(error => console.error(error));
                    }

                    // Initial table update
                    updateTable();

                    // Schedule periodic table updates
                    // setInterval(updateTable, 5000); // Update every 5 seconds
                });
            </script>
        </tbody>
    </table>
</div>

<script>
    function filterWorkers(role) {
        event.preventDefault(); // Prevent page reload

        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById('searchWorkers');
        filter = input.value.toUpperCase();
        table = document.getElementById('workers_table');
        tr = table.getElementsByTagName('tr');

        for (i = 0; i < tr.length; i++) {
            var roleTd = tr[i].getElementsByTagName('td')[5];

            if (roleTd) {
                var roleTxtValue = roleTd ? roleTd.textContent || roleTd.innerText : '';

                if (roleTxtValue.toUpperCase().indexOf(role.toUpperCase()) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    }
</script>

<script>
    document.getElementById('searchWorkers').addEventListener('keyup', function() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById('searchWorkers');
        filter = input.value.toUpperCase();
        table = document.getElementById('workers_table');
        tr = table.getElementsByTagName('tr');

        for (i = 0; i < tr.length; i++) {
            var idTd = tr[i].getElementsByTagName('td')[0];
            var nameTd = tr[i].getElementsByTagName('td')[1];

            if (idTd || nameTd) {
                var idTxtValue = idTd ? idTd.textContent || idTd.innerText : '';
                var nameTxtValue = nameTd ? nameTd.textContent || nameTd.innerText : '';

                if (idTxtValue.toUpperCase().indexOf(filter) > -1 || nameTxtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    });


    // Keep track of the current sort direction for each column
    var sortDirections = Array.from(document.getElementsByTagName('th')).map(() => 'asc');

    function sortTable(n) {
        var table = document.getElementById("workers_table");
        var rows = Array.from(table.rows).slice(1); // Get all rows, excluding the header

        // Sort rows based on the content of the nth column
        rows.sort((rowA, rowB) => {
            var textA = rowA.cells[n].textContent;
            var textB = rowB.cells[n].textContent;

            // If the content of the cells are numbers, convert them
            if (!isNaN(textA) && !isNaN(textB)) {
                textA = Number(textA);
                textB = Number(textB);
            }

            return (textA < textB ? -1 : (textA > textB ? 1 : 0)) * (sortDirections[n] === 'asc' ? 1 : -1);
        });

        // Reverse sort direction
        sortDirections[n] = sortDirections[n] === 'asc' ? 'desc' : 'asc';

        // Remove all rows from the table, then append the sorted rows
        for (var i = table.rows.length - 1; i > 0; i--) {
            table.deleteRow(i);
        }
        for (var row of rows) {
            table.appendChild(row);
        }
    }
</script>

<?php include "inc/footer.view.php"; ?>