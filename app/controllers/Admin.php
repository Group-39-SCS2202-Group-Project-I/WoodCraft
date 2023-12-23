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

	public function products($x = '')
	{
		$y = explode('/', $x);
		$data['x'] = $y[0];
		if ($x != '') {
			if ($x == 'categories') {
				$data['title'] = "Product Category";

				$this->view('admin/product_categories',$data);
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