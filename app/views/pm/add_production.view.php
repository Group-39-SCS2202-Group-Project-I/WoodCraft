<?php include "inc/header.view.php"; ?>
<?php echo "Add Production" ?>

<!-- fetch workers and get count of available workers -->
<?php
$url = ROOT . "/fetch/workers";
$response = file_get_contents($url);
$workers = json_decode($response, true);
// show($workers);

$available_workers = [];
foreach ($workers as $worker) {
    if ($worker['availability'] == 'available') {
        $available_workers[] = $worker;
    }
}
// show($available_workers);

//sort workers by updated_at and make a queue
usort($available_workers, function ($a, $b) {
    return $a['updated_at'] <=> $b['updated_at'];
});
// show($available_workers);

$available_workers_count = count($available_workers);
// show($available_workers_count);
?>




<?php include "inc/footer.view.php"; ?>