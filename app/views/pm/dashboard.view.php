<?php include "inc/header.view.php"; ?>
<?php 

$pxn_url = ROOT . "/fetch/production";
$pxn_response = file_get_contents($pxn_url);
$pxn = json_decode($pxn_response, true);
// show($pxn);
$nopxn = count($pxn);
// show($nopxn); 

$nopxn_cmp = 0;
$nopxn_prc = 0;
$nopxn_pnd = 0;

foreach ($pxn as $pxn) {
    if ($pxn['status'] == "completed") {
        $nopxn_cmp++;
    } elseif ($pxn['status'] == "processing") {
        $nopxn_prc++;
    } elseif ($pxn['status'] == "pending") {
        $nopxn_pnd++;
    }
}

// show($nopxn_cmp);
// show($nopxn_prc);
// show($nopxn_pnd);

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
    <a href="<?= ROOT . '/pm/productions' ?>" style="text-decoration:none">
        <div class="card">
            <h3 class="card-title">No of Pending Productions</h3>
            <span class="material-icons-outlined card-icon">chair</span>
            <p class="card-text"><?= $nopxn_pnd ?></p>
        </div>
    </a>
    <a href="<?= ROOT . '/pm/productions' ?>" style="text-decoration:none">
        <div class="card">
            <h3 class="card-title">No of Ongoing Productions</h3>
            <span class="material-icons-outlined card-icon">chair</span>
            <p class="card-text"><?= $nopxn_prc ?></p>
        </div>
    </a>


    <!-- Repeat for other cards -->
</div>

<?php include "inc/footer.view.php"; ?>