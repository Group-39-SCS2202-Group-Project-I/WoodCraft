<?php 

/**
 * products class
 */
class Products extends Controller
{
	
	public function index($id = '')
	{
		$data['id'] = $id;
		$data['title'] = "Products";

		if ($id == '') {
			$this->view('products',$data);
		}else{
			$this->view('product',$data);
		}
	}
}