<?php 

/**
 * products class
 */
class Products extends Controller
{
	
	public function products()
	{
		$data['title'] = "Products";

		$this->view('products',$data);
	}


	
}