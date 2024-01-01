<?php include "inc/header.view.php"; ?>

<!-- fetch productions and display them here -->
<?php
$url = ROOT . "/fetch/production";
$response = file_get_contents($url);
$productions = json_decode($response, true);
// show($productions);

$ongoing_productions = [];
foreach ($productions as $production) {
    if ($production['status'] != 'completed') {
        $ongoing_productions[] = $production;
    }
}
show($ongoing_productions);

?>


<?php include "inc/footer.view.php"; ?>