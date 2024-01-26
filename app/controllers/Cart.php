<?php 

/**
 * cart class
 */
class Cart extends Controller
{
	
	public function index($id)
	{
		$data['id'] = $id;
		$data['title'] = "Cart";

		$this->view('cart',$data);
	}


	
}