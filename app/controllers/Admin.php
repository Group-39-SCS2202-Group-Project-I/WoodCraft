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

	public function products()
	{
		
		$data['title'] = "Products";

		$this->view('admin/products',$data);
	}

	public function workers()
	{
		
		$data['title'] = "Workers";

		$this->view('admin/workers',$data);
	}

	public function customers()
	{
		
		$data['title'] = "Customers";
		$this->view('admin/customers',$data);

		
		// echo json_encode($data['customers']);

		
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