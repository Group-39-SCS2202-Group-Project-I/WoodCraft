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

}