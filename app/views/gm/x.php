<?php

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/invoice.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
	<title>WoodCraft Furniture - General Manager</title>
</head>

<body>


	<div class="wrapper">
		<div class="invoice_wrapper">
			<!-- <h1>Production Details</h1> -->
			<!-- fetch production details  -->
			<?php
			$id = $data['id'];
			$url = ROOT . "/fetch/production/$id";
			$response = file_get_contents($url);
			$production = json_decode($response);
			// show($production);
			show($id)
			?>

			<!-- <h1>Workers</h1> -->
			<!-- fetch production workers-->
			<?php
			$url = ROOT . "/fetch/production_workers/$id";
			$response = file_get_contents($url);
			$workers = json_decode($response, true);
			// show($workers);
			?>

			<!-- <h1>Production materials</h1> -->
			<!-- fetch production materials-->
			<?php
			$url = ROOT . "/fetch/production_material/$id";
			$response = file_get_contents($url);
			$materials = json_decode($response, true);
			// show($materials);
			?>

			<div class="header">
				<div class="logo_invoice_wrap">
					<div class="logo_sec">
						<!-- <img src="codingboss.png" alt="code logo"> -->
						<div class="title_wrap">
							<p class="title bold">WoodCraft Furnitures</p>
							<p class="sub_title">Privite Limited</p>
						</div>
					</div>
					<div class="invoice_sec">
						<p class="invoice bold">Production Report</p>
						<p class="invoice_no">
							<span class="bold">ID</span>
							<span><?= "PXN-" . str_pad($production->production_id, 3, '0', STR_PAD_LEFT); ?></span>
						</p>
						<p class="date">
							<span class="bold">Status</span>
							<span><?= ucfirst($production->status) ?></span>
						</p>

						<p class="date">
							<span class="bold">Started</span>
							<span><?= $production->created_at ?></span>
						</p>
						<?php
						if ($production->status == 'completed') {
						?>
							<p class="date">
								<span class="bold">Finished</span>
								<span><?= $production->updated_at ?></span>
							<?php
						}
							?>
					</div>
				</div>
				<!-- <div class="bill_total_wrap">
					<div class="bill_sec">
						<p>Bill To</p>
						<p class="bold name">Alex Deo</p>
						<span>
							123 walls street, Townhall<br />
							+111 222345667
						</span>
					</div>
					<div class="total_wrap">
						<p>Total Due</p>
						<p class="bold price">USD: $1200</p>
					</div>
				</div> -->
			</div>
			<div class="body">
				<div class="main_table">
					<div class="table_header">
						<div class="row">
							<div class="col col_no">NO.</div>
							<div class="col col_des">ITEM DESCRIPTION</div>
							<div class="col col_price">PRICE</div>
							<div class="col col_qty">QTY</div>
							<div class="col col_total">TOTAL</div>
						</div>
					</div>
					<div class="table_body">
						<div class="row">
							<div class="col col_no">
								<p>01</p>
							</div>
							<div class="col col_des">
								<p class="bold">Web Design</p>
								<p>Lorem ipsum dolor sit.</p>
							</div>
							<div class="col col_price">
								<p>$350</p>
							</div>
							<div class="col col_qty">
								<p>2</p>
							</div>
							<div class="col col_total">
								<p>$700.00</p>
							</div>
						</div>
						<div class="row">
							<div class="col col_no">
								<p>02</p>
							</div>
							<div class="col col_des">
								<p class="bold">Web Development</p>
								<p>Lorem ipsum dolor sit.</p>
							</div>
							<div class="col col_price">
								<p>$350</p>
							</div>
							<div class="col col_qty">
								<p>2</p>
							</div>
							<div class="col col_total">
								<p>$700.00</p>
							</div>
						</div>
						<div class="row">
							<div class="col col_no">
								<p>03</p>
							</div>
							<div class="col col_des">
								<p class="bold">GitHub</p>
								<p>Lorem ipsum dolor sit.</p>
							</div>
							<div class="col col_price">
								<p>$120</p>
							</div>
							<div class="col col_qty">
								<p>1</p>
							</div>
							<div class="col col_total">
								<p>$700.00</p>
							</div>
						</div>
						<div class="row">
							<div class="col col_no">
								<p>04</p>
							</div>
							<div class="col col_des">
								<p class="bold">Backend Design</p>
								<p>Lorem ipsum dolor sit.</p>
							</div>
							<div class="col col_price">
								<p>$350</p>
							</div>
							<div class="col col_qty">
								<p>2</p>
							</div>
							<div class="col col_total">
								<p>$700.00</p>
							</div>
						</div>
						<div class="row">
							<div class="col col_no">
								<p>05</p>
							</div>
							<div class="col col_des">
								<p class="bold">Backend Development</p>
								<p>Lorem ipsum dolor sit.</p>
							</div>
							<div class="col col_price">
								<p>$150</p>
							</div>
							<div class="col col_qty">
								<p>1</p>
							</div>
							<div class="col col_total">
								<p>$700.00</p>
							</div>
						</div>
					</div>
				</div>
				<div class="paymethod_grandtotal_wrap">
					<div class="paymethod_sec">
						<!-- <p class="bold">Payment Method</p>
						<p>Visa, master Card and We accept Cheque</p> -->
					</div>
					<div class="grandtotal_sec">
						<p class="bold">
							<span>SUB TOTAL</span>
							<span>$7500</span>
						</p>
						<p>
							<span>Tax Vat 18%</span>
							<span>$200</span>
						</p>
						<p>
							<span>Discount 10%</span>
							<span>-$700</span>
						</p>
						<p class="bold">
							<span>Grand Total</span>
							<span>$7000.0</span>
						</p>
					</div>
				</div>
			</div>
			<!-- <div class="footer">
				<p>Thank you and Best Wishes</p>
				<div class="terms">
					<p class="tc bold">Terms & Coditions</p>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit non praesentium doloribus. Quaerat
						vero iure itaque odio numquam, debitis illo quasi consequuntur velit, explicabo esse nesciunt
						error aliquid quis eius!</p>
				</div>
			</div> -->
		</div>
	</div>


</body>

</html>