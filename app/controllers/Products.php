<?php 
class Products extends Controller
{
	
	public function index($id = '')
    {
        if ($id != '') {
            $data['title'] = "Product";
            $data['id'] = $id;
            $this->view('product', $data);
        } else {
            $data['title'] = "Products";
            $this->view('products', $data);
        }
    }
}
	