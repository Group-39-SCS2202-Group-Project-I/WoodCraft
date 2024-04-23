<?php include "inc/header.view.php"; ?>

<h1>Production Details</h1>
<!-- fetch production details  -->
<?php
$id = $data['id'];
$url = ROOT."/fetch/production/$id";
$response = file_get_contents($url);
$production = json_decode($response);
show($production);
?>

<h1>Workers</h1>
<!-- fetch production workers-->
<?php
$url = ROOT."/fetch/production_workers/$id";
$response = file_get_contents($url);
$workers = json_decode($response, true);
show($workers);
?>

<h1>Production materials</h1>
<!-- fetch production materials-->
<?php
$url = ROOT."/fetch/production_material/$id";
$response = file_get_contents($url);
$materials = json_decode($response, true);
show($materials);
?>




<?php include "inc/footer.view.php"; ?>