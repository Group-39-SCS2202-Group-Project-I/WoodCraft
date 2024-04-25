<?php include "inc/header.view.php"; ?>

<!-- fetch production details  -->
<?php
$id = $data['id'];
$url = ROOT . "/fetch/production/$id";
$response = file_get_contents($url);
$production = json_decode($response);
// show($production);
?>

<!-- <h1>Workers</h1> -->
<!-- fetch production workers-->
<?php
$url = ROOT . "/fetch/production_workers/$id";
$response = file_get_contents($url);
$workers = json_decode($response, true);
// show($workers);
?>

<!-- <h1>Production materials</h1> -->
<!-- fetch production materials-->
<?php
$url = ROOT . "/fetch/production_material/$id";
$response = file_get_contents($url);
$materials = json_decode($response, true);
// show($materials);
?>

<style>
    .product-container {
        background-color: white;
        border-radius: 10px;
        padding: 10px;
    }

    .product-container-title {
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .product-container-item {
        display: flex;
        /* justify-content:first baseline; */
        /* justify-items: center; */
        margin-bottom: 0.5rem;
    }

    .product-container-d {
        /* display: flex;  */
        /* justify-content:first baseline;
        /* justify-items: center; */
        margin-bottom: 0.5rem;
    }

    .product-review-item {
        background-color: var(--light);
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 0.5rem;
    }

    .pc-lable {
        font-weight: 500;
        margin-right: 0.5rem;
    }

    .dash-button {
        padding: 10px 20px;
        background-color: var(--blk);
        color: var(--light);
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        transition: background-color 0.2s ease-in-out;
        cursor: pointer;
    }

    .dash-button:hover {
        background-color: var(--primary);
        color: var(--light);
    }

    .dash-danger:hover {
        background-color: var(--danger);
        color: var(--light);
    }


    /* drag */
    .drag-area {
        background-color: var(--light);
        border-radius: 10px;
        /* height: 500px;
        width: 700px; */
        padding: 2rem 0;
        width: 100%;
        margin-bottom: 1rem;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .drag-area.active {
        border: 2px solid var(--blk);
    }

    .drag-area .icon {
        font-size: 100px;
        color: #fff;
    }

    .drag-area header {
        font-size: 20px;
        font-weight: 500;
        color: var(--blk);
    }

    .drag-area span {
        font-size: 20px;
        font-weight: 500;
        color: var(--blk);
        margin: 10px 0 15px 0;
    }

    .drag-area button {
        padding: 10px 25px;
        font-size: 20px;
        /* font-weight: 500; */
        border: none;
        outline: none;
        background: var(--blk);
        color: var(--light);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.5s;
    }

    .drag-area button:hover {
        background: var(--primary);
        color: var(--light);
    }

    .drag-area img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 5px;
    }



    /* @media (max-width: 745px) {

        .drag-area button {
            padding: 8px 20px;
            font-size: 18px;
            font-weight: 450;
        }

        .drag-area {
            height: 400px;
            width: 450px;
        }

        .drag-area header {
            font-size: 25px;
            font-weight: 450;
            color: var(--blk);
        }

        .drag-area .icon {
            font-size: 80px;
        }

    } */
</style>

<div class="table-section" style=" padding-bottom:0">
    <h2 class="table-section__title" style=" margin-bottom:0">Production (<?php echo sprintf('PXN-%03d', $production->production_id); ?>)</h2>
</div>

<div class="dashboard2">
    <div class="product-container">
        <h1 class="product-container-title">Production Details</h1>
        <div class="product-review-item">
            <div class="product-container-item">
                <p class="pc-lable">Production ID :&nbsp</p>
                <p><?php echo sprintf('PXN-%03d', $production->production_id); ?></p>
            </div>

            <div class="product-container-item">
                <p class="pc-lable"> Status :&nbsp</p>
                <p><?php echo $production->status; ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Production Started :&nbsp</p>
                <p><?php echo $production->created_at ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">No of workers assigned :&nbsp</p>
                <p><?php echo count($workers) ?></p>
            </div>
        </div>
    </div>

    <div class="product-container">
        <h1 class="product-container-title">Product Details</h1>
        <div class="product-review-item">
            <div class="product-container-item">
                <p class="pc-lable">Product ID :&nbsp</p>
                <p><?php echo sprintf('PRD-%03d', $production->product_id); ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable"> Product Name :&nbsp</p>
                <p><?php echo $production->name ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Quantity :&nbsp</p>
                <p><?php echo $production->quantity ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Category :&nbsp</p>
                <p><?php echo $production->category_name ?></p>
            </div>
        </div>
    </div>
</div>


<div class="table-section">
    <h2 class="table-section__title">Workers Assigned</h2>

    <table class="table-section__table">
        <thead>
            <tr>
                <th>Worker ID</th>
                <th>Worker Name</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($workers as $worker) : ?>
                <tr>
                    <td><?php echo sprintf('WRK-%03d', $worker['worker_id']); ?></td>
                    <td><?php echo ucfirst($worker['first_name']) .' '. ucfirst($worker['last_name']); ?></td>
                    <td><?php echo $worker['worker_role']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="table-section">
    <h2 class="table-section__title">Materials Allocated</h2>

    <table class="table-section__table">
        <thead>
            <tr>
                <th>Material ID</th>
                <th>Material Name</th>
                <th>Stock ID</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materials as $material) : ?>
                <tr>
                    <td><?php echo sprintf('MAT-%03d', $material['material_id']); ?></td>
                    <td><?php echo $material['material_name']; ?></td>
                    <td><?php echo sprintf('STK-%03d', $material['stock_id']); ?></td>
                    <td><?php echo $material['quantity']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>






<?php include "inc/footer.view.php"; ?>