<?php

class Customer extends Controller
{

	public function index($id = '')
	{
		if (!Auth::logged_in()) {
			message('Please login to view your account');
			redirect('login');
		}

		// $id = Auth::getCustomerID();
		$data['title'] = "manage-account";

		if($id != ''){
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customer/manage-account', $data);
		}
    }

    public function profile($id = null)
    {
        if (!Auth::logged_in()) {
			message('Please login to view your account');
			redirect('login');
		}

		// $id = Auth::getCustomerID();
		$data['title'] = "profile";

		if($id != ''){
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customer/profile', $data);
		}
    }

	public function edit($id = '')
	{
		// $id = Auth::getCustomerID();

		$data['title'] = "edit-profile";
		$customer = []; 

		if ($id != '') {
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customer/edit-profile', $data);
		}
    }

    public function changepassword($id = '')
	{
		// $id = Auth::getCustomerID();

		$data['title'] = "change-password";
		$customer = []; 

		if ($id != '') {
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customer/change-password', $data);
		}
	}

    public function addressbook($id = '')
	{
		// $id = Auth::getCustomerID();

		$data['title'] = "addressbook";
		$customer = []; 

		if ($id != '') {
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customer/addressbook', $data);
		}
	}

    public function editAddressbook($id = '')
	{
		// $id = Auth::getCustomerID();

		$data['title'] = "edit-addressbook";
		$customer = []; 

		if ($id != '') {
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customer/edit-addressbook', $data);
		}
	}

    public function addAddress($id = '')
	{
		// $id = Auth::getCustomerID();

		$data['title'] = "add-address";
		$customer = []; 

		if ($id != '') {
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customer/add-address', $data);
		}
	}

	public function orders()
	{
		$data['title'] = "orders";

		$this->view('customer/orders', $data);
	}

	public function returns()
	{
		$data['title'] = "returns";

		$this->view('customer/returns', $data);
	}

	public function cancellations()
	{
		$data['title'] = "cancellations";

		$this->view('customer/cancellations', $data);
	}

	public function wishlist()
	{
		$data['title'] = "wishlist";

		$this->view('customer/wishlist', $data);
	}

	public function reviews()
	{
		$data['title'] = "reviews";

		$this->view('customer/reviews', $data);
	}
}
