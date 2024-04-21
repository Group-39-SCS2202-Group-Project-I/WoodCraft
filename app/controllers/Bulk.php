<?php

class Bulk extends Controller
{

	public function index($id = '')
	{
		// $data['title'] = "Bulk Orders";

		// $products_url = ROOT . "/fetch/product";
		// $response = file_get_contents($products_url);
		// $products = json_decode($response, true);

		// $data['products'] = $products['products'];
		if (!Auth::logged_in()) {
			message('Please login to view this section');
			redirect('login');
		}

		if ($id == '') {
			$url = ROOT . "/fetch/product";
			$response = file_get_contents($url);
			$data = json_decode($response, true);
			// show($data);

			$url2 = ROOT . "/fetch/product_images";
			$response = file_get_contents($url2);
			$images = json_decode($response, true);
			// show($images);

			$grouped_images = [];
			foreach ($images as $image) {
				$grouped_images[$image['product_id']][] = $image;
			}
			// show($grouped_images);

			foreach ($data['products'] as $key => $product) {
				if (array_key_exists($product['product_id'], $grouped_images)) {
					$data['products'][$key]['images'] = $grouped_images[$product['product_id']];
				} else {
					$data['products'][$key]['images'] = [];
				}
			}

			$listed_products = [];
			foreach ($data['products'] as $product) {
				if ($product['listed'] == 1) {
					$listed_products[] = $product;
				}
			}

			$d['products'] = $listed_products;
			// show($d);


			$this->view('bulk', $d['products']);
		}
		else
		{
			$url = ROOT . "/fetch/product/" . $id;
			$response = file_get_contents($url);
			$product = json_decode($response, true);
			// show($product);

			$url2 = ROOT . "/fetch/product_images";
			$response = file_get_contents($url2);
			$images = json_decode($response, true);
			// show($images);

			$grouped_images = [];
			foreach ($images as $image) {
				$grouped_images[$image['product_id']][] = $image;
			}
			// show($grouped_images);

			if (array_key_exists($product['product_id'], $grouped_images)) {
				$product['images'] = $grouped_images[$product['product_id']];
			} else {
				$product['images'] = [];
			}

			// show($product);

			$this->view('bulkprd', $product);

		}
	}

	public function add_bulk_req()
	{
		show($_POST);
		$bulk_order_req = new BulkOrderReq();

		$result = $bulk_order_req->validate($_POST);

		show($result);

		if ($result) {
			$bulk_order_req->insert($_POST);
			message('Your bulk order request added successfully');
			show('Your bulk order request added successfully');

			//email -> customer email
			$to = $_POST['customer_email'];
			
			redirect('bulk');
		} else {
			message('Unable to add bulk order request');
			show('Unable to add bulk order request');
			redirect('bulk');
		}		
	}
}
