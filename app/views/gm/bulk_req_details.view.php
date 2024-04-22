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
        <button type="button" class="form-btn submit-btn" id="approve-btn">Approve</button>
        <button type="button" class="form-btn cancel-btn" id="reject-btn">Reject</button>
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


<div class="popup-form" id="approve">
    <div class="popup-form__content">
        <form action="<?php echo ROOT ?>/gm/update_bulk_req/<?= $request['bulk_req_id'] ?>" method="POST" class="form">
            <h2 class="popup-form-title">Approve Bulk Order Request</h2>

            <div class="form-group">
                <label for="first_name" class="form-label label-popup" >Price Per Unit</label>
                <input type="number" id="price_per_unit" name="price_per_unit" class="form-input input-popup" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="first_name" class="form-label label-popup">Quantity</label>
                <input value="<?= $request['quantity'] ?>" type="decimal" id="quantity" name="quantity" class="form-input input-popup" disabled>
            </div>
            <div class="form-group">
                <label for="first_name" class="form-label label-popup">Total</label>
                <input type="decimal" id="total" name="total" class="form-input input-popup" id="total-inp" disabled>
            </div>
            <!-- hidden input for total -->
            <input type="hidden" name="total" id="total-hidden">
            <div class="form-group">
                <label for="first_name" class="form-label label-popup">Estimated Completion Date</label>
                <input type="date" id="estimated_date" name="estimated_date" class="form-input input-popup" min="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <input type="hidden" name="status" value="accepted">
            <input type="hidden" name="email" value="<?=$request['customer_email']?>">
            <div class="form-group form-btns">
                <button type="submit" class="form-btn submit-btn">Approve</button>
                <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
            </div>
        </form>

    </div>
</div>

<div class="popup-form" id="reject">
    <div class="popup-form__content">
        <form action="<?php echo ROOT ?>/gm/update_bulk_req/<?= $request['bulk_req_id'] ?>" method="POST" class="form">
            <!-- <h2 class="popup-form-title">Reject Bulk Order Request</h2> -->

            <p class="confirmation-text" style="padding-bottom: 1rem;">Are you sure you want to reject this bulk order request?</p>

            <!-- hidden input for reject -->
            <input type="hidden" name="status" value="rejected">
            <input type="hidden" name="email" value="<?=$request['customer_email']?>">

            <div class="form-group form-btns">
                <button type="submit" class="form-btn submit-btn">Reject</button>
                <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
            </div>
        </form>

    </div>
</div>


<script>
    // Function to open popup form
    function openPopup(popupId) {
        const popup = document.getElementById(popupId);
        popup.classList.add('popup-form--open');
    }

    // Function to close popup form
    function closePopup() {
        const popups = document.querySelectorAll('.popup-form');
        // confirmText = document.querySelector('.confirmation-text');
        // confirmText.innerHTML = "Are you sure you want to delete ";
        popups.forEach(popup => {
            popup.classList.remove('popup-form--open');
        });

        // Clear validation messages
        const validationMessages = document.querySelectorAll('.validate-mzg');
        validationMessages.forEach(message => {
            message.innerHTML = '';
        });
    }

    const approveBtn = document.getElementById('approve-btn');
    const rejectBtn = document.getElementById('reject-btn');

    approveBtn.addEventListener('click', () => {
        openPopup('approve');
    });

    rejectBtn.addEventListener('click', () => {
        openPopup('reject');
    });

    // calculate total and update whene price per unit changes
    const pricePerUnit = document.getElementById('price_per_unit');
    const quantity = document.getElementById('quantity');
    const total = document.getElementById('total');
    const totalHidden = document.getElementById('total-hidden');

    pricePerUnit.addEventListener('input', () => {
        const price = pricePerUnit.value;
        const qty = quantity.value;
        const totalValue = price * qty;
        total.value = totalValue;
        totalHidden.value = totalValue;

        total.innerHTML = totalValue;
    });

   


</script>
</script>

<?php include "inc/footer.view.php"; ?>