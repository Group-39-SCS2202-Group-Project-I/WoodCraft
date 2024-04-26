<?php include "inc/header.view.php"; ?>

<?php
$worker_id = $data['id'];
$url = ROOT . "/fetch/workers/" . "$worker_id";
$response = file_get_contents($url);
$worker = json_decode($response, true);
// show($worker);
$workerId = $worker['worker_id'];
$wrkNumber = sprintf("WRK-%03d", $workerId);
// echo $wrkNumber;

$production_worker_url = ROOT . "/fetch/pxn_worker/" . "$worker_id";
$production_worker_response = file_get_contents($production_worker_url);
$production_worker = json_decode($production_worker_response, true);
// show($production_worker);

// $total_pxns = 0;
if ($production_worker) {
    $total_pxns = count($production_worker);
}
// show($total_pxns);

// [address_line_1] => 45, Hillside Avenue
//     [address_line_2] => Kandy
//     [city] => Kandy
//     [zip_code] => 20000

// get address from worker
$address_line_1 = $worker['address_line_1'];
$address_line_2 = $worker['address_line_2'];
$city = $worker['city'];
$zip_code = $worker['zip_code'];

$address = $address_line_1 . ",<br>" . $address_line_2 . ",<br>" . $city . ",<br>" . $zip_code;

$first_name = $worker['first_name'];
$last_name = $worker['last_name'];
$full_name = $first_name . " " . $last_name;


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
    <h2 class="table-section__title" style=" margin-bottom:0">Worker Details - <?= $wrkNumber ?></h2>
</div>

<div class="dashboard2" id="pwc-table">
    <div class="product-container">
        <!-- <h1 class="product-container-title"><?= $wrkNumber ?></h1> -->
        <!-- <h1 class="product-container-title"></h1> -->

        <div class="product-review-item" style="margin-bottom:0;height: 100%;">


            <div class="product-container-item">
                <p class="pc-lable">Worker Role :&nbsp</p>
                <p><?php echo ucfirst($worker['worker_role']); ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable"> Availability :&nbsp</p>
                <p><?php echo ucfirst($worker['availability']); ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable"> Date Joined :&nbsp</p>
                <p><?php echo date('Y-m-d', strtotime($worker['created_at'])); ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">No of productions :&nbsp</p>
                <p><?php echo $total_pxns ?></p>
            </div>
        </div>

    </div>


    <!--  -->

    <div class="product-container">
        <div class="product-review-item" style="margin-bottom:0;">
            <div class="product-container-item">
                <p class="pc-lable">Name :&nbsp</p>
                <p><?php echo $full_name ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable"> Mobile :&nbsp</p>
                <p><?php echo ucfirst($worker['mobile_number']); ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Address :&nbsp</p>
                <p><?php echo $address  ?></p>
            </div>

        </div>


    </div>

</div>


<div class="dashboard2" style="padding-top:0px" id="pwc-table">
    <div class="product-container" style="padding: 10px 0">
        <h1 class="product-container-title">Productions</h1>

        <div id="scrollable_sec">
            <table class="table-section__table tbl" id="staff_table">
                <thead>
                    <tr>
                        <th>Production ID</th>
                        <th>Started At</th>

                        <!-- <th>Created At</th> -->
                        <!-- <th>Updated At</th> -->

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table-section__tbody">
                    <?php foreach ($production_worker as $production) : ?>
                        <tr>
                            <td><?= sprintf("PXR-%03d", $production['production_id']) ?></td>
                            <td><?= date('Y-m-d', strtotime($production['created_at'])) ?></td>
                            <!-- <td><?= date('Y-m-d', strtotime($production['created_at'])) ?></td> -->
                            <!-- <td><?= date('Y-m-d', strtotime($production['updated_at'])) ?></td> -->
                            <td>
                                <a href="<?= ROOT ?>/gm/productions/<?= $production['production_id'] ?>" class="table-section__button tbl-btn">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include "inc/footer.view.php"; ?>