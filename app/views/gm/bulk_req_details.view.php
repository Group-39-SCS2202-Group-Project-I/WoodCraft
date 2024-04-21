<?php include "inc/header.view.php"; ?>
<?php
$request = $data['bulk_req'];
// show($request);
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
</style>

<div class="table-section" style=" padding-bottom:0">
    <h2 class="table-section__title" style=" margin-bottom:0">Bulk Order Request (<?php echo sprintf('BRI-%03d', $request['bulk_req_id']); ?>)</h2>
</div>

<div class="dashboard2" style="padding-bottom:0;">
    <div class="form-group form-btns">
        <button type="button" class="form-btn submit-btn">Approve</button>
        <button type="button" class="form-btn cancel-btn">Reject</button>
    </div>
</div>

<div class="dashboard2">
    <div class="product-container">
        <h1 class="product-container-title">Bulk Order Request Details</h1>


        <div class="product-review-item">
            <div class="product-container-item">
                <p class="pc-lable">Bulk Order Request ID :&nbsp</p>
                <p><?php echo sprintf('BRI-%03d', $request['bulk_req_id']); ?></p>
            </div>

            <div class="product-container-item">
                <p class="pc-lable"> Customer ID :&nbsp</p>
                <p><?php echo sprintf('CUS-%03d', $request['customer_id']); ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Customer Name :&nbsp</p>
                <p><?php echo $request['customer_name'] ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Email :&nbsp</p>
                <p><?php echo $request['customer_email'] ?></p>
            </div>


            <div class="product-container-item">
                <p class="pc-lable">Quantity Requested :&nbsp</p>
                <p><?php echo $request['quantity'] ?></p>
            </div>



            <!-- <div style="background-color: #fff; padding:1rem; border-radius:10px;">
                <div class="form-group">
                    <label for="first_name" class="form-label label-popup">First Name</label>
                    <input value="<?php echo $form_data['first_name'] ?>" type="text" id="first_name" name="first_name" class="form-input input-popup">
                </div>
                <div class="form-group">
                    <label for="first_name" class="form-label label-popup">First Name</label>
                    <input value="<?php echo $form_data['first_name'] ?>" type="text" id="first_name" name="first_name" class="form-input input-popup">
                </div>
                <div class="form-group">
                    <label for="first_name" class="form-label label-popup">First Name</label>
                    <input value="<?php echo $form_data['first_name'] ?>" type="text" id="first_name" name="first_name" class="form-input input-popup">
                </div>
                <div class="form-group form-btns">
                    <button type="button" class="form-btn submit-btn">Approve</button>
                    <button type="button" class="form-btn cancel-btn">Reject</button>
                </div>
            </div> -->
        </div>


    </div>
    <div class="product-container">
        <h1 class="product-container-title">Product Details</h1>


        <div class="product-review-item">
            <div class="product-container-item">
                <p class="pc-lable">Product ID :&nbsp</p>
                <p><?php echo sprintf('PRD-%03d', $request['product_id']); ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable"> Product Name :&nbsp</p>
                <p><?php echo $request['product_name'] ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Category :&nbsp</p>
                <p><?php echo $request['category_name'] ?></p>
            </div>
            <!-- <div class="product-container-d">
                <p class="pc-lable">Product Description :&nbsp</p>
                <p style="margin:5px 20px 10px 20px"><?php echo $request['product_description']; ?></p>
            </div> -->
            <div class="product-container-item">
                <p class="pc-lable">Listed Price (Retail) :&nbsp</p>
                <p><?php echo $request['product_price'] ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Quantity Available :&nbsp</p>
                <p><?php echo $request['quantity_available'] ?></p>
            </div>


        </div>


    </div>


</div>

<?php include "inc/footer.view.php"; ?>