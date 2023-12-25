<?php 

/**
 * home class
 */
class Admin extends Controller
{
	
	public function index()
	{

		$data['title'] = "Admin Dashboard";

		$this->view('admin/dashboard',$data);
	}

	public function dashboard()
	{
		
		$data['title'] = "Admin Dashboard";

		$this->view('admin/dashboard',$data);
	}

	public function products($x = '',$z = '')
	{
		
		$y = explode('/', $x);
		$data['x'] = $y[0];

		$z = explode('/', $z);
		$data['z'] = $z[0];

		// show($data['z']);
		
		// show($data['z']);
		
		if ($x != '') {
			
			if ($x == 'categories') {
				$data['title'] = "Product Category";

				$this->view('admin/product_categories',$data);
			}
			else if ($x == 'add') {
				$data['title'] = "Add Product";
				$this->view('admin/add_product',$data);
			}
			else if ($x == 'update') {
					$data['title'] = "Update Product";
					$this->view('admin/update_product',$data);
				
			}
			else{
				$data['title'] = "Product";
				$this->view('admin/product',$data);
			}
		}
		else{
			$data['title'] = "Products";

			$this->view('admin/products',$data);
		}
		
		
	}

	public function workers()
	{
		
		$data['title'] = "Workers";

		$this->view('admin/workers',$data);
	}

	public function customers($id = '')
	{	
		$data['id'] = $id;

		if ($id != '') {
			$data['title'] = "Customer";
			$this->view('admin/customer',$data);
		}
		else{
			$data['title'] = "Customers";
			$this->view('admin/customers',$data);
		}
	}
	

	public function staff()
	{
		
		$data['title'] = "Staff";

		$this->view('admin/staff',$data);
	}

	public function delivery()
	{
		
		$data['title'] = "Delivery";

		$this->view('admin/delivery',$data);
	}

	
}