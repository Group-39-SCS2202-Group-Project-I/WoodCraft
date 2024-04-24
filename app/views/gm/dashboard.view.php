<?php include "inc/header.view.php"; ?>

<?php
$url = ROOT . "/fetch/no_of_curr_month"; 
$response = file_get_contents($url);
$data = json_decode($response, true);

$retail = $data['retail_orders'];
$bulk = $data['bulk_orders'];
$pxn = $data['production'];

$url2 = ROOT . "/fetch/new_bulk_req";
$response2 = file_get_contents($url2);
$data2 = json_decode($response2, true);
$newblkCount = count($data2);
// show($data2);

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
    <h2 class="table-section__title" style=" margin-bottom:0">Dashboard</h2>
</div>

<div class="dashboard">
    <a  style="text-decoration:none" onclick="navfunc('products-nav')">
        <div class="card">
            <h3 class="card-title">No of Productions - <?php
                                                        echo date('F Y');
                                                        ?></h3>
            <span class="material-icons-outlined card-icon">chair</span>
            <p class="card-text"><?= $pxn ?></p>
        </div>
    </a>

    <a  style="text-decoration:none" onclick="navfunc('products-nav')">
        <div class="card">
            <h3 class="card-title">No of Retail Orders - <?php
                                                            echo date('F Y');
                                                            ?></h3>
            <span class="material-icons-outlined card-icon">chair</span>
            <p class="card-text"><?= $retail ?></p>
        </div>
    </a>

    <a  style="text-decoration:none" onclick="navfunc('products-nav')">
        <div class="card">
            <h3 class="card-title">No of Bulk Orders - <?php
                                                        echo date('F Y');
                                                        ?></h3>
            <span class="material-icons-outlined card-icon">chair</span>
            <p class="card-text"><?= $bulk ?></p>
        </div>
    </a>



</div>


<div class="dashboard2" id="pwc-table">
    <div>
        <div class="charts-card">
            <!-- <p class="chart-title">Orders</p> -->
            <div id="chart"></div>
        </div>
    </div>

    <!--  -->

    <?php if ($newblkCount > 0) : ?>
        <div class="table-section" style="width: 100%;margin:0; padding:0% ">
            <div class="mzg-box col-danger">
                <div class="messege"><?= (($newblkCount == 1) ? 'A new bulk order request has been received ' : 'New bulk order requests have been received')  ?>!</div>
            </div>
            <table class="table-section__table" style="margin:0; padding:0%" id="pwi">
                <thead>
                    <tr>
                        <th>Bulk Request ID</th>
                        <!-- <th>Product Name</th> -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table-section__tbody">
                    <?php foreach ($data2 as $req) : ?>
                        <tr>
                            <td><?= sprintf("BRI-%03d", $req['bulk_req_id']) ?></td>
                            <td>
                                <a href="<?= ROOT ?>/gm/bulk_order_requests/<?= $req['bulk_req_id'] ?>" class="table-section__button">Click</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.2/apexcharts.min.js"></script>
<script>
    url1 = "<?= ROOT ?>/fetch/gm_dash_chart";
    days = [];
    counts = [];

    fetch(url1)
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            // chart.updateSeries(data);
            let days = data.days;
            let counts = data.counts;
            let bulk_counts = data.bulk_counts;

            let last30Days = days.slice(-30);
            let last30Counts = counts.slice(-30);
            let last30BulkCounts = bulk_counts.slice(-30);

            days = last30Days;
            counts = last30Counts;
            bulk_counts = last30BulkCounts;

            max = Math.max(...counts, ...bulk_counts)+2

            // console.log(days);
            // console.log(counts);
            var options = {
                series: [{
                        name: "Retail Orders",
                        data: counts
                    },
                    {
                        name: "Bulk Orders",
                        data: bulk_counts
                    }
                ],
                chart: {
                    height: 350,
                    type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#6D9886', '#212121'],
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    curve: 'smooth'
                },
                title: {
                    text: 'Orders',
                    align: 'left',
                    style: {
                            fontSize: '18px',
                            fontFamily:'Montserrat,sans-serif',
                            fontWeight:'600'

                        }
                },
                grid: {
                    borderColor: '#e7e7e7',
                    // row: {
                    //     colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    //     opacity: 0.5
                    // },
                },
                markers: {
                    size: 1
                },
                xaxis: {
                    categories: days,
                    title: {
                        text: 'Days'
                    }
                },
                yaxis: {
                    title: {
                        text: 'No of Orders'
                    },
                    min: 0,
                    max: max,
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();


        });
</script>
<?php include "inc/footer.view.php"; ?>