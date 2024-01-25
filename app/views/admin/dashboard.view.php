<?php include "inc/header.view.php"; ?>

<?php
$products_url = ROOT . "/fetch/product";
$products_response = file_get_contents($products_url);
$products = json_decode($products_response, true);
// show($products['products']);
$products_count = count($products['products']);
// show($products_count);

$materials_url = ROOT . "/fetch/materials";
$materials_response = file_get_contents($materials_url);
$materials = json_decode($materials_response, true);
// show($materials);
$materials_count = count($materials);
// show($materials_count);

$staff_url = ROOT . "/fetch/staff";
$staff_response = file_get_contents($staff_url);
$staff = json_decode($staff_response, true);
// show($staff);
$staff_count = count($staff);
// show($staff_count);

$workers_url = ROOT . "/fetch/workers";
$workers_response = file_get_contents($workers_url);
$workers = json_decode($workers_response, true);
// show($workers);
$workers_count = count($workers);
// show($workers_count);

//fetch product_images
$product_images_url = ROOT . "/fetch/product_images";
$product_images_response = file_get_contents($product_images_url);
$product_images = json_decode($product_images_response, true);
// show($product_images);
// get unique product_ids
$product_ids = [];
foreach ($product_images as $product_image) {
    $product_ids[] = $product_image['product_id'];
}
$product_ids = array_unique($product_ids);
// show($product_ids);

//get products without images
$products_without_images = [];
foreach ($products['products'] as $product) {
    if (!in_array($product['product_id'], $product_ids)) {
        $products_without_images[] = $product;
    }
}
// show($products_without_images);
$products_without_images_count = count($products_without_images);
// show($products_without_images_count);


//last6monthCustomers
$last6monthCustomers_url = ROOT . "/fetch/user_cus";
$last6monthCustomers_response = file_get_contents($last6monthCustomers_url);
$last6monthCustomers = json_decode($last6monthCustomers_response, true);
// show($last6monthCustomers);

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
    <a href="<?= ROOT . '/admin/products' ?>" style="text-decoration:none" onclick="navfunc('products-nav')">
        <div class="card">
            <h3 class="card-title">No of Products</h3>
            <span class="material-icons-outlined card-icon">chair</span>
            <p class="card-text"><?= $products_count ?></p>
        </div>
    </a>

    <a href="<?= ROOT . '/admin/materials' ?>" style="text-decoration:none" onclick="navfunc('materials-nav')">
        <div class="card">
            <h3 class="card-title">No of Materials</h3>
            <span class="material-icons-outlined card-icon">
                handyman
            </span>
            <p class="card-text"><?= $materials_count ?></p>
        </div>
    </a>

    <a href="<?= ROOT . '/admin/staff' ?>" style="text-decoration:none" onclick="navfunc('staff-nav')">
        <div class="card">
            <h3 class="card-title">No of Staff Members</h3>
            <span class="material-icons-outlined card-icon">supervised_user_circle</span> 
            <p class="card-text"><?= $staff_count ?></p>
        </div>
    </a>

    <a href="<?= ROOT . '/admin/workers' ?>" style="text-decoration:none" onclick="navfunc('workers-nav')">
        <div class="card">
            <h3 class="card-title">No of Workers</h3>
            <span class="material-icons-outlined card-icon">engineering</span> 
            <p class="card-text"><?= $workers_count ?></p>
        </div>
    </a>
    <!-- Repeat for other cards -->
</div>

<div class="dashboard2" id="pwc-table">
    <div>
        <div class="charts-card">
            <p class="chart-title">Customers registered in last 6 months</p>
            <div id="area-chart"></div>
        </div>
    </div>

    <!--  -->

    <?php if ($products_without_images_count > 0) : ?>
        <div class="table-section" style="width: 100%;margin:0; padding:0% ">
            <div class="mzg-box col-danger">
                <div class="messege">There <?= (($products_without_images_count == 1) ? 'is a product ' : 'are ' . $products_without_images_count) . ' ' ?> without product images!</div>
            </div>
            <table class="table-section__table" style="margin:0; padding:0%" id="pwi">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table-section__tbody">
                    <?php foreach ($products_without_images as $product) : ?>
                        <tr>
                            <td><?= sprintf("PRD-%03d", $product['product_id']) ?></td>
                            <td><?= $product['name'] ?></td>
                            <td>
                                <a href="<?= ROOT ?>/admin/products/<?= $product['product_id'] ?>" class="table-section__button">Click</a>
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
    let last6monthCustomers = <?= json_encode($last6monthCustomers) ?>;
    console.log(last6monthCustomers);
    let yearMonthCount = [];
    for (const [key, value] of Object.entries(last6monthCustomers)) {
        // console.log(`${key}: ${value}`);
        let yearMonth = key.split(" ");
        let year = yearMonth[1];
        let month = yearMonth[0];
        let count = value;
        yearMonthCount.push({
            year,
            month,
            count
        });
    }

    console.log(yearMonthCount);




    const areaChartOptions = {
        series: [{
                name: 'No of customers',
                // data: [31, 40, 28, 51, 42, 109, 100],
                //set count as data in yearMonthCount
                data: yearMonthCount.map(({
                    count
                }) => count)
            },

        ],
        chart: {
            height: 300,
            type: 'area',
            toolbar: {
                show: false,
            },
        },
        fill: {
            type: 'gradient',
            opacity: 0.9
        },
        colors: ['var(--blk)'],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: 'smooth',
        },
        // labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        //set month and year as labels in yearMonthCount
        labels: yearMonthCount.map(({
            month,
            year
        }) => month + "\n" + year),

        markers: {
            size: 0,
        },
        yaxis: [{
            title: {
                text: 'No of customers',
            },
        }, ],
        tooltip: {
            shared: true,
            intersect: false,
        },
    };

    const areaChart = new ApexCharts(
        document.querySelector('#area-chart'),
        areaChartOptions
    );
    areaChart.render();
</script>

<script>
    navfunc = (id) => {
        let nav = document.getElementById(id);
        nav.click();
    }
</script>






<?php include "inc/footer.view.php"; ?>