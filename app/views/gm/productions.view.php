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



// show($completed);
$comjson = json_encode($completed);


usort($completed, function ($a, $b) {
    return strtotime($a['updated_at']) - strtotime($b['updated_at']);
});

$oldestProductionDate = $completed[0]['updated_at'];
// show($oldestProductionDate);
$date = date_create($oldestProductionDate);
$oldestProductionDate = date_format($date, 'Y-m-d');
// show($oldestProductionDate);


?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

    /* flatpicker */
    .flatpickr-weekdays .flatpickr-months {
        font-family: 'Montserrat', sans-serif;
    }

    .flatpickr-month {
        font-size: 16px;
    }

    .flatpickr-current-month {
        font-size: 100%;
        font-weight: bolder;
    }

    .dayContainer>.selected {
        background-color: var(--primary);
        background: var(--primary);
        border-color: var(--primary);
        color: var(--light);

    }

    .dayContainer>.selected:hover {
        background-color: #959ea9;
        background: #959ea9;
        border-color: #959ea9;
        color: var(--light);
    }

    .dayContainer>.prevMonthDay {
        color: rgba(57, 57, 57, 0.3);
        background: transparent;
        border-color: transparent;
        cursor: default
    }

    .flatpickr-day.selected.prevMonthDay,
    .flatpickr-day.selected.nextMonthDay {
        background-color: var(--primary);
        background: var(--primary);
        border-color: var(--primary);
        color: var(--light);
    }

    .flatpickr-day {
        border-radius: 10px;
    }

    .flatpickr-calendar {
        border-radius: 10px;
        padding: 0.5rem 0.5rem 0.5rem 0.5rem;
        width: auto;
        height: auto;
    }

    .reports_sec {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        background-color: #fff;
    }

    .reports_sec__input {
        background-color: var(--light);
    }

    .btnx {
        /* margin-top: 1rem; */
        padding: 10px 20px;
        background-color: var(--blk);
        color: var(--light);
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        transition: background-color 0.2s ease-in-out;
        cursor: pointer;
    }
</style>

<div class="table-section" style=" padding-bottom:0">
    <h2 class="table-section__title" style=" margin-bottom:0">Completed Productions</h2>
    <div class="reports_sec">

        <div class="reports_sec__item">
            <span class="reports_sec__label">Start Date:</span>
            <input type="text" id="start-date" placeholder="Start date" value="2024-01-01" class="reports_sec__input">
        </div>
        <div class="reports_sec__item">
            <span class="reports_sec__label">End Date:&nbsp&nbsp</span>
            <input type="text" id="end-date" placeholder="End date" class="reports_sec__input">
        </div>
        <div class="reports_sec__item">
            <a id="print-dates" class="reports_sec__button" style="width: 100%; text-align:center">Generate Report</a>
        </div>
    </div>
</div>

<div class="table-section" style=" padding-bottom:0">
    <h2 class="table-section__title" style=" margin-bottom:0">Productions</h2>
</div>

<div class="dashboard">
    <a href="" style="text-decoration:none" onclick="filterProductions('pending')">
        <div class="card" id="pen-card">
            <h3 class="card-title">Pending Productions</h3>
            <span class="material-icons-outlined card-icon">pending_actions</span>
            <p class="card-text"><?= $pen_count ?></p>
        </div>
    </a>
    <a href="" style="text-decoration:none" onclick="filterProductions('processing')">
        <div class="card" id="pro-card">
            <h3 class="card-title">Ongoing Productions</h3>
            <span class="material-icons-outlined card-icon">hourglass_top</span>
            <p class="card-text"><?= $pro_count ?></p>
        </div>
    </a>
    <a href="" style="text-decoration:none" onclick="filterProductions('completed')">
        <div class="card" id="com-card">
            <h3 class="card-title">Completed Productions</h3>
            <span class="material-icons-outlined card-icon">done_all</span>
            <p class="card-text"><?= $com_count ?></p>
        </div>
    </a>
</div>

<!--  -->

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const startDatepicker = flatpickr("#start-date", {
            defaultDate: "<?= $oldestProductionDate ?>",
            minDate: "<?= $oldestProductionDate ?>",
            maxDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                if (endDatepicker.selectedDates[0] && selectedDates[0] > endDatepicker.selectedDates[0]) {
                    endDatepicker.setDate(selectedDates[0]);
                }
                endDatepicker.set('minDate', dateStr);
            }
        });

        const endDatepicker = flatpickr("#end-date", {
            defaultDate: "today",
            minDate: "<?= $oldestProductionDate ?>",
            maxDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                if (startDatepicker.selectedDates[0] && selectedDates[0] < startDatepicker.selectedDates[0]) {
                    startDatepicker.setDate(selectedDates[0]);
                }
                startDatepicker.set('maxDate', dateStr);
            }
        });

        const printButton = document.getElementById('print-dates');
        printButton.addEventListener('click', () => {
            const startDate = document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;
            console.log('Start Date:', startDate);
            console.log('End Date:', endDate);

            var completed = <?php echo $comjson; ?>;
            console.log(completed);

            var filtered = completed.filter(function(a) {
                return a.created_at >= startDate && a.updated_at <= endDate;
            });

            // console.log(count(filtered));

            //get count of filtered
            // var count = Object.keys(filtered).length;

            // console.log(count);
            generateAndOpenPdf(startDate, endDate, "Production Report", filtered);
        });
    });
</script>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.2/apexcharts.min.js"></script>
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
</script> -->


<script>
    function generateAndOpenPdf(startDate, endDate, Title = "Production Report", data = []) {
        window.location.href = `<?php echo ROOT ?>/gm/productions/report/${startDate}/${endDate}`;
    }
</script>

<div class="table-section">
    <div class="table-section__search">
        <input type="text" id="searchPenProductions" placeholder="Search Productions..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="pen-productions-table">

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