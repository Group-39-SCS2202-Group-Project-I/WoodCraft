<?php 

class Bulk extends Controller
{
	
	public function index()
	{
		// $data['title'] = "Bulk Orders";
		
		// $products_url = ROOT . "/fetch/product";
        // $response = file_get_contents($products_url);
        // $products = json_decode($response, true);

		// $data['products'] = $products['products'];

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


		$this->view('bulk',$d['products']);
	}	
	
}