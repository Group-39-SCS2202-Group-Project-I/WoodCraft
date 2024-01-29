<?php include "inc/header.view.php"; ?>
<?php
$url = ROOT . "/fetch/production";
$response = file_get_contents($url);
$productions = json_decode($response, true);
// show($productions);

$pending = [];
$processing = [];
$completed = [];

foreach ($productions as $production) {
    if ($production['status'] == 'pending') {
        $pending[] = $production;
    } elseif ($production['status'] == 'processing') {
        $processing[] = $production;
    } elseif ($production['status'] == 'completed') {
        $completed[] = $production;
    }
}

// show($pending);
// show($processing);
// show($completed);



// $pen_count = 0;
// $pro_count = 0;
// $com_count = 0;

if ($pending) {
    $pen_count = count($pending);
}
if ($processing) {
    $pro_count = count($processing);
}
if ($completed) {
    $com_count = count($completed);
}

// show($pen_count);
// show($pro_count);
// show($com_count);

//select created_at from productions 
$created_at_array = [];
foreach ($productions as $production) {
    $created_at_array[] = $production['created_at'];
}
// show($created_at_array);
// get month and year from created_at timestamp
$month_year_array = [];
foreach ($created_at_array as $created_at) {
    $month_year_array[] = date("M Y", strtotime($created_at));
}
// show($month_year_array);
// count the number of productions in each month
$month_year_count = array_count_values($month_year_array);
// show($month_year_count);
// get the month and year and count as key value pair
$month_year_count_array = [];
foreach ($month_year_count as $key => $value) {
    $month_year_count_array[] = [
        'month_year' => $key,
        'count' => $value
    ];
}
// show($month_year_count_array);

// get current month and year and 12 months before to a array
// $month_year_array2 = [];
// for ($i = 0; $i < 12; $i++) {
//     $month_year_array2[] = date("M Y", strtotime("-$i month"));
// }
// show($month_year_array2);

$month_year_count_array2 = [];
for ($i = 0; $i < 12; $i++) {
    $month_year_count_array2[] = [
        'month_year' => date("M Y", strtotime("-$i month")),
        'count' => 0
    ];
}
// show($month_year_count_array2);

// merge the two arrays
$month_year_count_array3 = array_merge($month_year_count_array, $month_year_count_array2);

// reverse array
$month_year_count_array3 = array_reverse($month_year_count_array3);
// show($month_year_count_array3);

$jsmonth_year_count_array3 = json_encode($month_year_count_array3);



// finished productions



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

    .card-clicked {
        background-color: var(--blk);
        color: var(--light);
    }
</style>

<div class="table-section" style=" padding-bottom:0">
    <h2 class="table-section__title" style=" margin-bottom:0">Productions</h2>
</div>

<div class="dashboard">
    <a href="" style="text-decoration:none" onclick="filterProductions('pending')">
        <div class="card" id="pen-card">
            <h3 class="card-title">Pending Productions</h3>
            <span class="material-icons-outlined card-icon">chair</span>
            <p class="card-text"><?= $pen_count ?></p>
        </div>
    </a>
    <a href="" style="text-decoration:none" onclick="filterProductions('processing')">
        <div class="card" id="pro-card">
            <h3 class="card-title">Ongoing Productions</h3>
            <span class="material-icons-outlined card-icon">chair</span>
            <p class="card-text"><?= $pro_count ?></p>
        </div>
    </a>
    <a href="" style="text-decoration:none" onclick="filterProductions('completed')">
        <div class="card" id="com-card">
            <h3 class="card-title">Completed Productions</h3>
            <span class="material-icons-outlined card-icon">chair</span>
            <p class="card-text"><?= $com_count ?></p>
        </div>
    </a>
    <!-- Repeat for other cards -->
</div>


<div class="dashboard2" id="pxn-chart">
    <div>
        <div class="charts-card">
            <p class="chart-title">Productions Last Year</p>
            <div id="chart"></div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.2/apexcharts.min.js"></script>
<script>
    var arr = <?php echo $jsmonth_year_count_array3; ?>;
    console.log(arr);
    const barChartOptions = {
        series: [{
                // data: [available_carpenters, available_painters, available_supervisors],
                data: arr.map(a => a.count),
            },

        ],
        chart: {
            type: 'bar',
            height: 300,
            toolbar: {
                show: false,
            },
        },
        colors: ['var(--blk)', 'var(--blk)', 'var(--blk)'],
        plotOptions: {
            bar: {
                distributed: true,
                borderRadius: 4,
                horizontal: false,
                //   columnWidth: '40%',
            },
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: false,
        },
        xaxis: {
            // categories: ['Carpenters', 'Painters', 'Supervisors'],
            categories: arr.map(a => a.month_year),

        },
        yaxis: {
            title: {
                //   text: 'Worker Role',
            },
        },
    };

    const barChart = new ApexCharts(
        document.querySelector('#chart'),
        barChartOptions
    );
    barChart.render();
</script>

<div class="table-section">
    <div class="table-section__search">
        <input type="text" id="searchPenProductions" placeholder="Search Productions..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="pen-productions-table">
        <!-- [production_id] => 2
            [product_id] => 7
            [quantity] => 1
            [status] => completed
            [created_at] => 2024-01-01 22:46:18
            [updated_at] => 2024-01-01 22:46:18
            [product_name] => Brooklyn Sofa -->
        <thead>
            <tr>
                <th>Production ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Status</th>
                <!-- <th>Created At</th> -->
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="table-section__tbody">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function updateTable(filter) {
                        fetch('<?php echo ROOT ?>/fetch/production')
                            .then(response => response.json())
                            .then(data => {
                                let table = document.getElementById('pen-productions-table');

                                while (table.rows.length > 1) {
                                    table.deleteRow(1);
                                }

                                data.forEach(item => {
                                    let row = table.insertRow();
                                    let production_id = "PXN-" + String(item.production_id).padStart(3, '0');
                                    let product_id = "PRD-" + String(item.product_id).padStart(3, '0');
                                    let product_name = item.product_name;
                                    let quantity = item.quantity;
                                    let status = item.status;
                                    status = status.charAt(0).toUpperCase() + status.slice(1);
                                    let created_at = item.created_at;
                                    let updated_at = item.updated_at;

                                    if (filter === 'pending' && status !== 'Pending') {
                                        return; // Skip this row if filter is 'pending' and status is not 'Pending'
                                    }

                                    if (filter === 'processing' && status !== 'Processing') {
                                        return; // Skip this row if filter is 'processing' and status is not 'Processing'
                                    }

                                    if (filter === 'completed' && status !== 'Completed') {
                                        return; // Skip this row if filter is 'completed' and status is not 'Completed'
                                    }

                                    row.insertCell().innerHTML = production_id;
                                    row.insertCell().innerHTML = product_id;
                                    row.insertCell().innerHTML = product_name;
                                    row.insertCell().innerHTML = quantity;

                                    if (status == 'Pending') {
                                        row.insertCell().innerHTML = `<a class="table-section__button pending table-section__button-pending">${status}</a>`;
                                    } else if (status == 'Processing') {
                                        row.insertCell().innerHTML = `<a class="table-section__button processing table-section__button-processing">${status}</a>`;
                                    } else if (status == 'Completed') {
                                        row.insertCell().innerHTML = `<a class="table-section__button completed table-section__button-completed">${status}</a>`;
                                    }

                                    row.insertCell().innerHTML = updated_at;

                                    if (status == 'Processing') {
                                        row.insertCell().innerHTML = `<a href="<?php echo ROOT ?>/gm/productions/${item.production_id}" class="table-section__button">View</a>`;
                                    } else {
                                        row.insertCell().innerHTML = `<a href="<?php echo ROOT ?>/gm/productions/${item.production_id}" class="table-section__button">View</a>`;
                                    }
                                });
                            }).catch(error => console.error(error));
                    }

                    updateTable('all');

                    // Button click event handlers
                    document.getElementById('pen-btn').addEventListener('click', function() {
                        updateTable('pending');

                        document.getElementById('pen-btn').classList.add('top-btn-selected');
                        document.getElementById('pro-btn').classList.remove('top-btn-selected');
                        document.getElementById('com-btn').classList.remove('top-btn-selected');
                        document.getElementById('all-btn').classList.remove('top-btn-selected');

                    });

                    document.getElementById('pro-btn').addEventListener('click', function() {
                        updateTable('processing');

                        document.getElementById('pro-btn').classList.add('top-btn-selected');
                        document.getElementById('pen-btn').classList.remove('top-btn-selected');
                        document.getElementById('com-btn').classList.remove('top-btn-selected');
                        document.getElementById('all-btn').classList.remove('top-btn-selected');
                    });

                    document.getElementById('com-btn').addEventListener('click', function() {
                        updateTable('completed');

                        document.getElementById('com-btn').classList.add('top-btn-selected');
                        document.getElementById('pen-btn').classList.remove('top-btn-selected');
                        document.getElementById('pro-btn').classList.remove('top-btn-selected');
                        document.getElementById('all-btn').classList.remove('top-btn-selected');
                    });

                    document.getElementById('all-btn').addEventListener('click', function() {
                        updateTable('all');

                        document.getElementById('all-btn').classList.add('top-btn-selected');
                        document.getElementById('pen-btn').classList.remove('top-btn-selected');
                        document.getElementById('pro-btn').classList.remove('top-btn-selected');
                        document.getElementById('com-btn').classList.remove('top-btn-selected');
                    });


                });
            </script>
        </tbody>
    </table>
</div>


<script>
    // filterProductions function

    // prevent
    
    function filterProductions(filter) {
        event.preventDefault();

        document.getElementById('pxn-chart').style.display = 'none';

        
        //btn select
        if (filter == 'pending') {
            document.getElementById('pen-card').classList.add('card-clicked');
            document.getElementById('pro-card').classList.remove('card-clicked');
            document.getElementById('com-card').classList.remove('card-clicked');
        } else if (filter == 'processing') {
            document.getElementById('pro-card').classList.add('card-clicked');
            document.getElementById('pen-card').classList.remove('card-clicked');
            document.getElementById('com-card').classList.remove('card-clicked');
        } else if (filter == 'completed') {
            document.getElementById('com-card').classList.add('card-clicked');
            document.getElementById('pen-card').classList.remove('card-clicked');
            document.getElementById('pro-card').classList.remove('card-clicked');
        }

        fetch('<?php echo ROOT ?>/fetch/production')
            .then(response => response.json())
            .then(data => {
                let table = document.getElementById('pen-productions-table');

                while (table.rows.length > 1) {
                    table.deleteRow(1);
                }

                data.forEach(item => {
                    let row = table.insertRow();
                    let production_id = "PXN-" + String(item.production_id).padStart(3, '0');
                    let product_id = "PRD-" + String(item.product_id).padStart(3, '0');
                    let product_name = item.product_name;
                    let quantity = item.quantity;
                    let status = item.status;
                    status = status.charAt(0).toUpperCase() + status.slice(1);
                    let created_at = item.created_at;
                    let updated_at = item.updated_at;

                    if (filter === 'pending' && status !== 'Pending') {
                        return; // Skip this row if filter is 'pending' and status is not 'Pending'
                    }

                    if (filter === 'processing' && status !== 'Processing') {
                        return; // Skip this row if filter is 'processing' and status is not 'Processing'
                    }

                    if (filter === 'completed' && status !== 'Completed') {
                        return; // Skip this row if filter is 'completed' and status is not 'Completed'
                    }

                    row.insertCell().innerHTML = production_id;
                    row.insertCell().innerHTML = product_id;
                    row.insertCell().innerHTML = product_name;
                    row.insertCell().innerHTML = quantity;

                    if (status == 'Pending') {
                        row.insertCell().innerHTML = `<a class="table-section__button pending table-section__button-pending">${status}</a>`;
                    } else if (status == 'Processing') {
                        row.insertCell().innerHTML = `<a class="table-section__button processing table-section__button-processing">${status}</a>`;
                    } else if (status == 'Completed') {
                        row.insertCell().innerHTML = `<a class="table-section__button completed table-section__button-completed">${status}</a>`;
                    }

                    row.insertCell().innerHTML = updated_at;

                    if (status == 'Processing') {
                        row.insertCell().innerHTML = `<a href="<?php echo ROOT ?>/gm/productions/${item.production_id}" class="table-section__button">View</a>`;
                    } else {
                        row.insertCell().innerHTML = `<a href="<?php echo ROOT ?>/gm/productions/${item.production_id}" class="table-section__button">View</a>`;
                    }
                });
            }).catch(error => console.error(error));
    }
    

</script>


<?php include "inc/footer.view.php"; ?>