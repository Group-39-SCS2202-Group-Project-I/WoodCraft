<?php include "inc/header.view.php"; ?>

<!-- fetch all production  -->
<?php
$url = ROOT . "/fetch/production";
$response = file_get_contents($url);
$productions = json_decode($response, true);

// select pending productions 
$pending_productions = [];
foreach ($productions as $production) {
    if ($production['status'] == 'pending') {
        $pending_productions[] = $production;
    }
}
// show($pending_productions);

// get product_id and quantity from pending productions
$pending_products = [];
foreach ($pending_productions as $production) {
    $pending_products[] = [
        'production_id' => $production['production_id'],
        'product_id' => $production['product_id'],
        'product_name' => $production['product_name'],
        'quantity' => $production['quantity']
    ];
}
// show($pending_products);

// get materials for each product
$materials = [];
foreach ($pending_products as $product) {
    $url = ROOT . "/fetch/product_materials/" . $product['product_id'];
    $response = file_get_contents($url);
    $materials[] = json_decode($response, true);
}
// show($materials);
// map each material to its pending production
$pending_productions_materials = [];
for ($i = 0; $i < count($pending_products); $i++) {
    $pending_productions_materials[] = [
        'production_id' => $pending_products[$i]['production_id'],
        'product_id' => $pending_products[$i]['product_id'],
        'product_name' => $pending_products[$i]['product_name'],
        'quantity' => $pending_products[$i]['quantity'],
        'materials' => $materials[$i]
    ];
}
// show($pending_productions_materials[0]['materials']);
// show($pending_productions_materials);
?>

<div class="table-section">
    <div class="table-section__search">
        <input type="text" id="searchPendingProductions" placeholder="Search Pending Productions..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="pending-productions-table">
        <thead>
            <tr>
                <th>Production ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Materials</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="table-section__tbody">
            <?php
            foreach ($pending_productions_materials as $production) {
                echo '<tr>';
                echo '<td>' . $production['production_id'] . '</td>';
                echo '<td>' . $production['product_id'] . '</td>';
                echo '<td>' . $production['product_name'] . '</td>';
                echo '<td>' . $production['quantity'] . '</td>';


                $materials = '';
                foreach ($production['materials'] as $material) {
                    // $materials .= $material['material_name'] . ' (' . $material['quantity_needed'] . '), ';
                  
                    $materials .= $material['material_name'] . ' (' . $material['quantity_needed']*$production['quantity'] . '), <br>';
                    
                }
                // $materials = rtrim($materials, ', '); // remove trailing comma and space
               
                $materials = substr($materials, 0, -6);

                echo '<td>' . $materials . '</td>';
                echo '<td>Actions</td>'; // replace with actual actions
                echo '</tr>';
            }

            ?>

        </tbody>
    </table>
</div>








<?php include "inc/footer.view.php"; ?>