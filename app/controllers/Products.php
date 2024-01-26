<?php 

/**
 * products class
 */
class Products extends Controller
{
	
	public function index()
	{
		$data['title'] = "Products";

		$this->view('products',$data);
	}

	public function product($id)
	{
		$data['id'] = $id;
		$data['title'] = "Product";

		$this->view('product',$data);
	}


	
}