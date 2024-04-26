<?php include "inc/header.view.php"; ?>

<?php
$url = ROOT . "/fetch/sk_dash";
$response = file_get_contents($url);
$data = json_decode($response, true);

// show($data)
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
    .charts-card {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>

<div class="table-section" style=" padding-bottom:0">
    <h2 class="table-section__title" style=" margin-bottom:0">Dashboard</h2>
</div>

<div class="dashboard">
    <a href="<?= ROOT . '/sk/material_requests' ?>" style="text-decoration:none" onclick="navfunc('mat_req-nav')">
        <div class="card">
            <h3 class="card-title">Material Requests</h3>
            <span class="material-symbols-outlined card-icon">
                hardware
            </span>
            <p class="card-text"><?= $data['material_req_count'] ?></p>
        </div>
    </a>

    <a href="<?= ROOT . '/sk/finished_productions' ?>" style="text-decoration:none" onclick="navfunc('fin_prod-nav')">
        <div class="card">
            <h3 class="card-title">Finished Productions</h3>
            <span class="material-symbols-outlined card-icon">
                inventory
            </span>
            <p class="card-text"><?= $data['new_finished_pxn_count'] ?></p>
        </div>
    </a>

    <a href="<?= ROOT . '/sk/orders' ?>" style="text-decoration:none" onclick="navfunc('orders-nav')">
        <div class="card">
            <h3 class="card-title">New Retail Orders</h3>
            <span class="material-symbols-outlined card-icon">
                box
            </span>
            <p class="card-text"><?= $data['processing_orders_count'] ?></p>
        </div>
    </a>

    <a href="<?= ROOT . '/sk/orders/bulk' ?>" style="text-decoration:none" onclick="navfunc('orders-nav')">
        <div class="card">
            <h3 class="card-title">New Bulk Orders</h3>
            <span class="material-symbols-outlined card-icon">
                box_add
            </span>
            <p class="card-text"><?= $data['processing_bulk_orders_count'] ?></p>
        </div>
    </a>
    <!-- Repeat for other cards -->
</div>


<div class="dashboard2" id="pwc-table">
    <div>
        <div class="charts-card">
            <!-- <p class="chart-title">Customers registered in last 6 months</p> -->
            <div id="chart"></div>
        </div>
    </div>

    <!--  -->
    <div>
        <div class="charts-card">
            <!-- <p class="chart-title">Customers registered in last 6 months</p> -->
            <div id="mat-chart"></div>
        </div>
    </div>


</div>

<script>
    navfunc = (id) => {
        let nav = document.getElementById(id);
        nav.click();
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.2/apexcharts.min.js"></script>
<script>
    url = "<?= ROOT ?>/fetch/available_products_qtys";
    products = [];
    counts = [];

    fetch(url)
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            // chart.updateSeries(data);
            let products = data.product_names;
            let counts = data.quantities;

            var options = {
                series: counts,
                chart: {
                    width: '140%',
                    type: 'pie',
                },
                labels: products,
                theme: {
                    monochrome: {
                        enabled: true,
                        color: '#212121',
                        shadeTo: 'light',
                        shadeIntensity: 0.65
                    }
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -5
                        }
                    }
                },
                title: {
                    text: "Products Available in Stock",
                },
                dataLabels: {
                    formatter(val, opts) {
                        const name = opts.w.globals.labels[opts.seriesIndex]
                        return [name, val.toFixed(1) + '%']
                    }
                },
                legend: {
                    show: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });


    url2 = "<?= ROOT ?>/fetch/available_materials_qtys";
    materials = [];
    counts = [];

    fetch(url2)
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            // chart.updateSeries(data);
            let materials = data.material_names;
            let counts = data.quantities;

            var options = {
                series: counts,
                chart: {
                    width: '140%',
                    type: 'pie',
                },
                labels: materials,
                theme: {
                    monochrome: {
                        enabled: true,
                        color: '#212121',
                        shadeTo: 'light',
                        shadeIntensity: 0.65
                    }
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -5
                        }
                    }
                },
                title: {
                    text: "Materials Available in Stock",
                },
                dataLabels: {
                    formatter(val, opts) {
                        const name = opts.w.globals.labels[opts.seriesIndex]
                        return [name, val.toFixed(1) + '%']
                    }
                },
                legend: {
                    show: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#mat-chart"), options);
            chart.render();
        });

</script>

<?php include "inc/footer.view.php"; ?>