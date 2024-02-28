<?php 

/**
 * cart class
 */
class Cart extends Controller
{
	
	public function index()
	{
		$data['title'] = "Cart";

		$this->view('cart',$data);
	}


	
}
     