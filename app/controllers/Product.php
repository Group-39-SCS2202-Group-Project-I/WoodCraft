<?php 

/**
 * product class
 */
class Product extends Controller
{
	
	public function product($id)
	{
		$data['id'] = $id;
		$data['title'] = "Product";

		$this->view('product',$data);
	}


	
}