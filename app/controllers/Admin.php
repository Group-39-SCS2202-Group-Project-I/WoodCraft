<?php

/**
 * home class
 */

class Admin extends Controller
{

	public function index()
	{
		if (!Auth::logged_in()) {
			message('Please login to view the admin section');
			redirect('login');
		}

		if (Auth::is_admin()) {
			// message('You are not authorized to view the admin section');
			// redirect('home');
			$data['title'] = "Admin Dashboard";

			$this->view('admin/dashboard', $data);
		} else {
			$this->view('404');
		}
	}

	public function dashboard()
	{
		if (!Auth::logged_in()) {
			message('Please login to view the admin section');
			redirect('login');
		}
		if (Auth::is_admin()) {
			$data['title'] = "Admin Dashboard";

			$this->view('admin/dashboard', $data);
		} else {
			$this->view('404');
		}
	}

	public function products($x = '', $z = '')
	{

		if (!Auth::logged_in()) {
			message('Please login to view the admin section');
			redirect('login');
		}

		if (!Auth::is_admin()) {
			$this->view('404');
		} else {
			$y = explode('/', $x);
			$data['x'] = $y[0];

			$z = explode('/', $z);
			$data['z'] = $z[0];

			// show($data['z']);

			// show($data['z']);

			if ($x != '') {

				// if ($x == 'categories') {
				// 	$data['title'] = "Product Category";

				// 	$this->view('admin/product_categories',$data);
				// }
				// else 
				if ($x == 'add') {
					$data['title'] = "Add Product";
					$this->view('admin/add_product', $data);
				} else if ($x == 'update') {
					$data['title'] = "Update Product";
					$this->view('admin/update_product', $data);
				} else {
					$data['title'] = "Product";
					// $this->view('admin/product',$data);
					$this->view('admin/product2', $data);
				}
			} else {
				$data['title'] = "Products";

				$this->view('admin/products', $data);
			}
		}
	}

	public function categories()
	{
		if (!Auth::logged_in()) {
			message('Please login to view the admin section');
			redirect('login');
		}

		if (!Auth::is_admin()) {
			$this->view('404');
		} else {
			$data['title'] = "Product Categories";

			$this->view('admin/product_categories', $data);
		}
	}

	public function workers()
	{
		if (!Auth::logged_in()) {
			message('Please login to view the admin section');
			redirect('login');
		}

		if (!Auth::is_admin()) {
			$this->view('404');
		} else {
			$data['title'] = "Workers";

			$this->view('admin/workers', $data);
		}
	}

	public function customers($id = '')
	{
		if (!Auth::logged_in()) {
			message('Please login to view the admin section');
			redirect('login');
		}

		if (!Auth::is_admin()) {
			$this->view('404');
		}
		else{
			$data['id'] = $id;

			if ($id != '') {
				$data['title'] = "Customer";
				$this->view('admin/customer', $data);
			} else {
				$data['title'] = "Customers";
				$this->view('admin/customers', $data);
			}
		}
	}


	public function staff()
	{
		if (!Auth::logged_in()) {
			message('Please login to view the admin section');
			redirect('login');
		}

		if (!Auth::is_admin()) {
			$this->view('404');
		}
		else{
			$data['title'] = "Staff";

			$this->view('admin/staff', $data);
		}
	}

	public function delivery()
	{
		if (!Auth::logged_in()) {
			message('Please login to view the admin section');
			redirect('login');
		}

		if (!Auth::is_admin()) {
			$this->view('404');
		}
		else{
			$data['title'] = "Delivery";

			$this->view('admin/delivery', $data);
		}
	}

	public function materials()
	{

		if (!Auth::logged_in()) {
			message('Please login to view the admin section');
			redirect('login');
		}

		if (!Auth::is_admin()) {
			$this->view('404');
		}
		else{
			$data['title'] = "Materials";

			$this->view('admin/materials', $data);
		}
	}
}
