<?php include "inc/header.view.php"; ?>
<?php
$newBulkRequests = $data['new_bulk_requests'];
$bulkRequests = $data['bulk_requests'];

// show($newBulkRequests);
// show($bulkRequests);
?>
<?php if (message()) : ?>
    <div class="mzg-box">
        <div class="messege"><?= message('', true) ?></div>
    </div>
<?php endif; ?>

<div class="table-section">
    <h2 class="table-section__title">New Bulk Requests</h2>

    <div id="scrollable_sec">
        <table class="table-section__table">
            <thead>
                <tr>
                    <th>Bulk Request ID</th>
                    <th>Customer ID</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

            </thead>
            <tbody class="table-section__tbody">
                <?php foreach ($newBulkRequests as $request) : ?>
                    <tr>
                        <td><?= 'BRI-' . str_pad($request['bulk_req_id'], 3, '0', STR_PAD_LEFT) ?></td>
                        <td><?= 'CUS-' . str_pad($request['customer_id'], 3, '0', STR_PAD_LEFT) ?></td>
                        <td><?= $request['product_name'] ?></td>
                        <td><?= $request['category_name'] ?></td>
                        <td><?= $request['status'] ?></td>
                        <td>
                            <a class="table-section__button" href="<?= ROOT ?>/gm/bulk_order_requests/<?= $request['bulk_req_id'] ?>">Approve/Reject</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<div class="table-section">
    <h2 class="table-section__title">Previous Bulk Requests</h2>

    <div id="scrollable_sec">
        <table class="table-section__table">
            <thead>
                <tr>
                    <th>Bulk Request ID</th>
                    <th>Customer ID</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Status</th>
                    <!-- <th>Actions</th> -->
                </tr>

            </thead>
            <tbody class="table-section__tbody">
                <?php foreach ($bulkRequests as $request) : ?>
                    <tr>
                        <td><?= 'BRI-' . str_pad($request['bulk_req_id'], 3, '0', STR_PAD_LEFT) ?></td>
                        <td><?= 'CUS-' . str_pad($request['customer_id'], 3, '0', STR_PAD_LEFT) ?></td>
                        <td><?= $request['product_name'] ?></td>
                        <td><?= $request['category_name'] ?></td>
                        <td><?= $request['status'] ?></td>
                        <!-- <td>
                        <a href="<?= ROOT ?>/gm/bulk_order_requests/<?= $request['bulk_req_id'] ?>">View</a>
                    </td> -->
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>







<?php include "inc/footer.view.php"; ?>