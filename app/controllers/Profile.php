<?php

class Profile extends Controller
{
    public function index()
	{
		if (!Auth::logged_in()) {
			message('Please login to view your account');
			redirect('login');
		}

		$id = Auth::getCustomerID();
		$data['title'] = "manage-account";

		if($id != ''){
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			// show($data);
			$this->view('customers/manage-account', $data);
		}
    }

    public function myProfile($id = null)
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
			$this->view('customers/profile', $data);
		}
    }

	public function editProfile($id = '')
	{
		if (!Auth::logged_in()) {
			message('Please login!!');
			redirect('login');
		}

		// $id = Auth::getCustomerID();

		$data['title'] = "edit-profile";
		$customer = []; 

		if ($id != '') {
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customers/edit-profile', $data);
		}
    }

	public function updateProfile($id)
	{
		if (!Auth::logged_in()) {
			message('Please login to update your profile');
			redirect('login');
		}

		$customerModel = new Customer();

		// Validate form data
		$postData = [
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'telephone' => $_POST['telephone'],
			'birth_month' => $_POST['birth-month'],
			'birth_day' => $_POST['birth-day'],
			'birth_year' => $_POST['birth-year'],
			'gender' => $_POST['gender'],
		];
		show($postData);
	
		if (!$customerModel->validate($postData)) {
			// Validation failed, redirect back to the edit profile page with errors
			message('Validation failed. Please check your inputs.');
			redirect('customers/editProfile/' . $id);
		}


		
		// Validate and sanitize form data
		$updatedData = [
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			// 'email' => $_POST['email'],
			'telephone' => $_POST['telephone'],
			'birth_month' => $_POST['birth-month'],
			'birth_day' => $_POST['birth-day'],
			'birth_year' => $_POST['birth-year'],
			'gender' => $_POST['gender'],
		];
		show($updatedData);

		// Perform the database update
		$success = $customerModel->updateCustomerProfile($id, $updatedData);
		show($success);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$errors = [];
			if (empty($first_name)) {
				$errors['first_name'] = "You can't leave this empty.";
			}
			if (empty($last_name)) {
				$errors['last_name'] = "You can't leave this empty.";
			}
		}

		if ($success) {
			message('Profile updated successfully');
			redirect('customers/profile/' . $id);
		} 
		else {
			message('Failed to update profile. Please try again.');
			redirect('customers/editProfile/' . $id);
		}
	}

	private function updateCustomerProfile($id, $data)
	{
		$table = 'customer';

		$setClause = '';
		foreach ($data as $key => $value) {
			$setClause .= "`$key` = :$key, ";
		}
		$setClause = rtrim($setClause, ', ');

		// Construct the full SQL query
		$query = "UPDATE $table SET $setClause WHERE `customer_id` = :id";

		// Add the customer ID to the data array
		$data['id'] = $id;

		// Perform the database update
		$db = new Database;
		$db->query($query, $data);
		return 1;
	}

	public function changepassword($id = '')
	{
		if (!Auth::logged_in()) {
			message('Please login!!');
			redirect('login');
		}

		// $id = Auth::getCustomerID();

		$data['title'] = "change-password";
		$customer = []; 

		if ($id != '') {
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customers/change-password', $data);
		}
    }

    public function addressbook($id = '')
	{
		if (!Auth::logged_in()) {
			message('Please login!!');
			redirect('login');
		}

		// $id = Auth::getCustomerID();

		$data['title'] = "addressbook";
		$customer = []; 

		if ($id != '') {
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customers/addressbook', $data);
		}
	}

    public function editAddress($id = '')
	{
		if (!Auth::logged_in()) {
			message('Please login!!');
			redirect('login');
		}

		// $id = Auth::getCustomerID();

		$data['title'] = "edit-addressbook";
		$customer = []; 

		if ($id != '') {
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customers/edit-addressbook', $data);
		}
	}

    // public function addAddress($id = '')
	// {
	// 	if (!Auth::logged_in()) {
	// 		message('Please login!!');
	// 		redirect('login');
	// 	}
		
	// 	// $id = Auth::getCustomerID();

	// 	$data['title'] = "add-address";
	// 	$data['errors'] = [];
	// 	$customer = []; 
	// 	$address = new Address;

	// 	if ($id != '') {
	// 		$url = ROOT . "/fetch/customers/" . $id;
	// 		$response = file_get_contents($url);
	// 		$customer = json_decode($response, true);

	// 		$data = $customer;
	// 		$this->view('customers/add-address', $data);
	// 	}

	// 	if ($_SERVER['REQUEST_METHOD'] == "POST") {

	// 		$_POST['role'] = "customer";


	// 		$result1 = $address->validate($_POST);
	// 		$result2 = $customer->validate($_POST);

	// 		// show($_POST);

	// 		if ($result1 && $result2) {
	// 			$db = new Database;

	// 			// $user_arr['role'] = "customer";

	// 			$address_arr['address_line_1'] = $_POST['address_line_1'];
	// 			$address_arr['address_line_2'] = $_POST['address_line_2'];
	// 			$address_arr['city'] = $_POST['city'];
	// 			$address_arr['zip_code'] = $_POST['zip_code'];
	// 			$address_query = "INSERT INTO address (address_line_1, address_line_2, city, zip_code) VALUES (:address_line_1, :address_line_2, :city, :zip_code)";
	// 			$db->query($address_query, $address_arr);

	// 			// Get the last inserted address_id
	// 			// $last_address_id = $db->query("SELECT address_id FROM address WHERE address_line_1 = $_POST[address_line_1] AND address_line_2 = $_POST[address_line_2] AND city = $_POST[city] AND zip_code = $_POST[zip_code]")
	// 			$last_address_id = $db->query("SELECT address_id FROM address WHERE address_id = (SELECT MAX(address_id) FROM address)");

	// 			// $customer_arr['user_id'] = $last_user_id;
	// 			$customer_arr['first_name'] = $_POST['first_name'];
	// 			$customer_arr['last_name'] = $_POST['last_name'];
	// 			$customer_arr['telephone'] = $_POST['telephone'];
	// 			// $customer_arr['address_id'] = $last_address_id;

	// 			show($customer_arr);
	// 		}
	// 	}

	// 	$data['errors'] = array_merge($data['errors'], $address->errors);
	// 	$data['errors'] = array_merge($data['errors'], $customer->errors);
	// }

	private function updateCustomerAddress($id, $data)
	{
		$table = 'address';

		$setClause = '';
		foreach ($data as $key => $value) {
			$setClause .= "`$key` = :$key, ";
		}
		$setClause = rtrim($setClause, ', ');

		// Construct the full SQL query
		$query = "UPDATE $table SET $setClause WHERE `address_id` = :id";

		// Add the customer ID to the data array
		$data['id'] = $id;

		// Perform the database update
		$db = new Database;
		return $db->query($query, $data);
	}

	public function updateAddress($customerId)
	{
		if (!Auth::logged_in()) {
			message('Please login!!');
			redirect('login');
		}

		// Fetch the customer data from your API using the provided $customerId
		$url = ROOT . "/fetch/customers/" . $customerId;
		$response = file_get_contents($url);
		$customer = json_decode($response, true);

		// Get the address ID associated with the customer ID
		$addressId = $customer['address_id'];

		// Validate and sanitize form data
		$updatedCustomerData = [
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'telephone' => $_POST['telephone'],
		];

		$updatedAddressData = [
			'city' => $_POST['city'],
			'zip_code' => $_POST['zip_code'],
			'address_line_1' => $_POST['address_line_1'],
			'address_line_2' => $_POST['address_line_2'],
		];

		show($updatedCustomerData);
		show($updatedAddressData);

			// Perform the database update
			$customerSuccess = $this->updateCustomerProfile($customerId, $updatedCustomerData);
			$addressSuccess = $this->updateCustomerAddress($addressId, $updatedAddressData);

			if ($customerSuccess && $addressSuccess) {
				message('Customer address updated successfully');
				redirect('customers/address/' . $customerId);
			} else {
				message('Failed to update customer address. Please try again.');
				redirect('customers/addressbook/' . $customerId);
			}

		// Pass customer data to the view
		// $data['customer'] = $customer;
		// $data['title'] = "edit-address";

		// $this->view('customers/edit-address', $data);
	}

    public function edit(){
        if (!Auth::logged_in()) {
			message('Please login to view your account');
			redirect('login');
		}

		$id = Auth::getCustomerID();
        $data['title'] = "edit-profile";

        $this->view('customers/edit-profile', $data);
    }
}