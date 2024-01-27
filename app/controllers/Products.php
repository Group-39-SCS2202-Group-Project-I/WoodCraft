<?php 

/**
 * products class
 */
class Products extends Controller
{
	public function index($id = '')
	{
		$data['id'] = $id;
		if($id == ''){
			$this->view('products', $data);
		}
		else{
			$this->view('product', $data);
		}
	}
}