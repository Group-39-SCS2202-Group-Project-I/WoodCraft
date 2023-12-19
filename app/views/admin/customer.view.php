<?php include "inc/header.view.php"; ?>

<h1>Customer</h1>

<?php
$id = $data['id']; 
$url = ROOT."/fetch/customers/$id";
$response = file_get_contents($url);
$customer = json_decode($response);

// show($customer);
?>

<div class="customer_details">
    <div class="customer_details_left">
        <h3>Customer Details</h3>
        <p>Customer ID: <?php echo $customer->customer_id ?></p>
        <p>First Name: <?php echo $customer->first_name ?></p>
        <p>Last Name: <?php echo $customer->last_name ?></p>
        <p>Telephone: <?php echo $customer->telephone ?></p>
        <p>Email: <?php echo $customer->email ?></p>
    </div>
    <div class="customer_details_right">
        <h3>Address Details</h3>
        <p>Address ID: <?php echo $customer->address_id ?></p>
        <p>Address Line 1: <?php echo $customer->address_line_1 ?></p>
        <p>Address Line 2: <?php echo $customer->address_line_2 ?></p>
        <p>City: <?php echo $customer->city ?></p>
        <p>Zip Code: <?php echo $customer->zip_code ?></p>
    </div>
</div>

<?php include "inc/footer.view.php"; ?>


