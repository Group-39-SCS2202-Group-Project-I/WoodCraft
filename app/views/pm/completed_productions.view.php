<?php include "inc/header.view.php"; ?>
<?php
$url = ROOT . "/fetch/production";
$response = file_get_contents($url);
$productions = json_decode($response, true);
// show($productions);

$finished_productions = [];
foreach ($productions as $production) {
    if ($production['status'] == 'completed') {
        $finished_productions[] = $production;
    }
}
show($finished_productions);
?>

<?php include "inc/footer.view.php"; ?>