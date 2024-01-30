<?php include "inc/header.view.php"; ?>
<?php

$production_id = $data['id'];

$url = ROOT . "/fetch/production/" . $production_id;

// show($url);
$response = file_get_contents($url);
$production = json_decode($response, true);

show($production);

// production workers
$url2 = ROOT . "/fetch/production_workers/" . $production_id;
$response2 = file_get_contents($url2);
$production_workers = json_decode($response2, true);

// show($url2);
// show($production_workers);

// production materials
$url3 = ROOT . "/fetch/production_material/" . $production_id;
$response3 = file_get_contents($url3);
$production_materials = json_decode($response3, true);
// show($production_materials);

//total material cost
$total_material_cost = 0;
foreach ($production_materials as $production_material) {
    $total_material_cost += $production_material['cost'];
}
show($total_material_cost);

$productionNumber = sprintf("PXN-%03d", $production_id);
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
    /* .tbl{
        width: 70% !important;
    }
    .tbl-btn{
        background-color: white !important;
    }
    .tbl-btn:hover{
        background-color: var(--primary) !important;
        color: var(--light) !important;
    } */
</style>

<div class="table-section" style=" padding-bottom:0">
    <h2 class="table-section__title" style=" margin-bottom:0">Production Details - <?= $productionNumber ?></h2>
</div>

<!-- [product_id] => 1
    [quantity] => 1
    [status] => completed
    [created_at] => 2024-01-24 21:32:16
    [updated_at] => 2024-01-29 10:46:17
    [name] => MICKE Desk -->

<div class="dashboard2" id="pwc-table">
    <div class="product-container">

        <div class="product-review-item" style="margin-bottom:0;height: 100%;">
            <div class="product-container-item">
                <p class="pc-lable">Product ID :&nbsp</p>
                <p><?php echo sprintf("PRD-%03d", $production['product_id']) ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable"> Product Name :&nbsp</p>
                <p><?php echo ucfirst($production['name']); ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Quantity :&nbsp</p>
                <p><?php echo $production['quantity']  ?></p>
            </div>


        </div>


    </div>

    <div class="product-container">

        <div class="product-review-item" style="margin-bottom:0;height: 100%;">


            <div class="product-container-item">
                <p class="pc-lable">Status :&nbsp</p>
                <p><?php echo ucfirst($production['status']); ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable"> Production Created at :&nbsp</p>
                <p><?php echo  $production['created_at'] ?></p>
            </div>
            <?php
            if ($production['status'] == 'completed') {
                echo '<div class="product-container-item">
                                <p class="pc-lable"> Production Completed at :&nbsp</p>
                                <p>' . $production['updated_at'] . '</p>
                            </div>';
            } elseif ($production['status'] == 'processing') {
                echo '<div class="product-container-item">
                                <p class="pc-lable"> Updated aat :&nbsp</p>
                                <p>' . $production['updated_at'] . '</p>
                            </div>';
            }
            ?>
        </div>



        <!--  -->



    </div>
</div>





<?php include "inc/footer.view.php"; ?>