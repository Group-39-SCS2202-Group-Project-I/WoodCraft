<?php 

/**
 * cart class
 */
class Cart extends Controller
{
	
	public function cart($id)
	{
		$data['id'] = $id;
		$data['title'] = "Cart";

		$this->view('cart',$data);
	}


	
}