<?php include "inc/header.view.php"; ?>
<?php
$url = ROOT . "/fetch/pxn_bulk_orders";
$response = file_get_contents($url);
$pxn_blks = json_decode($response, true);
show($pxn_blks);
?>

<div class="table-section">
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>

    <h2 class="table-section__title">Production needed approved bulk orders</h2>

    <table class="table-section__table" id="pxn-blk-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Materials Needed</th>
                <!-- <th>Created At</th> -->
                <th>Target Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="table-section__tbody">
            <?php foreach ($pxn_blks as $pxn_blk) : ?>
                <tr>
                    <td><?= $pxn_blk['bulk_order_details_id'] ?></td>
                    <td><?= 'PRD-' . str_pad($pxn_blk['bulk_req']['product_id'], 3, '0', STR_PAD_LEFT) ?></td>
                    <td><?= $pxn_blk['bulk_req']['product_name'] ?></td>
                    <td><?= $pxn_blk['bulk_req']['quantity'] ?></td>
                    <td>
                        <?php
                        foreach ($pxn_blk['product_materials'] as $mat) {
                            echo $mat['material_name'] . ' x ' . $mat['quantity_needed'] * $pxn_blk['bulk_req']['quantity']  . "<br>";
                        }
                        ?>
                    </td>
                    <!-- <td><?= $pxn_blk['created_at'] ?></td> -->
                    <td><?= $pxn_blk['bulk_req']['estimated_date'] ?></td>
                    <td>
                        <?php
                        if ($pxn_blk['missing_materials_count'] == 0) {
                            echo "<a  class='table-section__button' onclick='navfunc(\"{$pxn_blk['bulk_req']['product_id']}\",\"{$pxn_blk['bulk_req']['quantity']}\")'>Start Production</a>";
                        } else {
                            echo "<a  class='table-section__button table-section__button-del'>Missing Materials</a>";
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<script>
    navfunc = (product_id,qty) => {
        sessionStorage.setItem('product_id',product_id );
        sessionStorage.setItem('quantity',qty );
        let nav = document.getElementById('add_prod-nav');
        nav.click();
    }
</script>


<?php include "inc/footer.view.php"; ?>