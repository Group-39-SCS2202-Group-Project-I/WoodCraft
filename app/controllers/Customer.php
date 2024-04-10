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
			// show($data);
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
			$this->view('customer/edit-profile', $data);
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
			$this->view('customer/addressbook', $data);
		}
	}

    public function address($id = '')
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
			$this->view('customer/edit-addressbook', $data);
		}
	}

    public function addAddress($id = '')
	{
		if (!Auth::logged_in()) {
			message('Please login!!');
			redirect('login');
		}
		
		// $id = Auth::getCustomerID();

		$data['title'] = "add-address";
		$data['errors'] = [];
		$customer = []; 
		$address = new Address;

		if ($id != '') {
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customer/add-address', $data);
		}

		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			$_POST['role'] = "customer";


			$result1 = $address->validate($_POST);
			$result2 = $customer->validate($_POST);

			// show($_POST);

			if ($result1 && $result2) {
				$db = new Database;

				// $user_arr['role'] = "customer";

				$address_arr['address_line_1'] = $_POST['address_line_1'];
				$address_arr['address_line_2'] = $_POST['address_line_2'];
				$address_arr['city'] = $_POST['city'];
				$address_arr['zip_code'] = $_POST['zip_code'];
				$address_query = "INSERT INTO address (address_line_1, address_line_2, city, zip_code) VALUES (:address_line_1, :address_line_2, :city, :zip_code)";
				$db->query($address_query, $address_arr);

				// Get the last inserted address_id
				// $last_address_id = $db->query("SELECT address_id FROM address WHERE address_line_1 = $_POST[address_line_1] AND address_line_2 = $_POST[address_line_2] AND city = $_POST[city] AND zip_code = $_POST[zip_code]")
				$last_address_id = $db->query("SELECT address_id FROM address WHERE address_id = (SELECT MAX(address_id) FROM address)");

				// $customer_arr['user_id'] = $last_user_id;
				$customer_arr['first_name'] = $_POST['first_name'];
				$customer_arr['last_name'] = $_POST['last_name'];
				$customer_arr['telephone'] = $_POST['telephone'];
				// $customer_arr['address_id'] = $last_address_id;

				show($customer_arr);
			}
		}

		$data['errors'] = array_merge($data['errors'], $address->errors);
		$data['errors'] = array_merge($data['errors'], $customer->errors);
	}

	public function orders($id = '')
	{
		if (!Auth::logged_in()) {
			message('Please login!!');
			redirect('login');
		}
		
		// $id = Auth::getCustomerID();

		$data['title'] = "orders";
		$customer = []; 

		if ($id != '') {
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customer/orders', $data);
		}
	}

	public function updateProfile($id)
	{
		if (!Auth::logged_in()) {
			message('Please login to update your profile');
			redirect('login');
		}

		// Validate and sanitize form data
		$updatedData = [
			'first_name' => sanitize($_POST['first_name']),
			'last_name' => sanitize($_POST['last-name']),
			// 'email' => sanitize($_POST['email']),
			'telephone' => sanitize($_POST['telephone']),
			'birth_month' => sanitize($_POST['birth-month']),
			'birth_day' => sanitize($_POST['birth-day']),
			'birth_year' => sanitize($_POST['birth-year']),
			'gender' => sanitize($_POST['gender']),
		];

		show($updatedData);

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

		// Perform the database update
		$success = $this->updateCustomerProfile($id, $updatedData);
		show($success);

		if ($success) {
			message('Profile updated successfully');
			redirect('customer/index/' . $id);
		} else {
			message('Failed to update profile. Please try again.');
			redirect('customer/edit/' . $id);
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
		return $db->query($query, $data);
	}

	public function updateAddress($id)
	{
		if (!Auth::logged_in()) {
			message('Please login to update your profile');
			redirect('login');
		}

		// $id = Auth::getCustomerID();
		// $id = sanitize($_POST['customer_id']);

		// Validate and sanitize form data
		$updatedData = [
			'first_name' => sanitize($_POST['first_name']),
			'last_name' => sanitize($_POST['last_name']),
			'telephone' => sanitize($_POST['telephone']),
			// 'city' => sanitize($_POST['city']),
			// 'zip_code' => sanitize($_POST['zip_code']),
			// 'address_line_1' => sanitize($_POST['address_line_1']),
			// 'address_line_2' => sanitize($_POST['address_line_2']),
		];

		show($updatedData);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$telephone = $_POST['telephone'];
			$errors = [];
			if (empty($first_name)) {
				$errors['first_name'] = "You can't leave this empty.";
			}
			if (empty($last_name)) {
				$errors['last_name'] = "You can't leave this empty.";
			}
			if (empty($telephone)) {
				$errors['telephone'] = "Please provide a valid phone number.";
			}
		}

		// Perform the database update
		$success = $this->updateCustomerAddress($id, $updatedData);

		if ($success) {
			message('Address updated successfully');
			redirect('customer/address/' . $id);
		} else {
			message('Failed to update Address. Please try again.');
			redirect('customer/addressbook/' . $id);
		}
	}

	private function updateCustomerAddress($id, $data)
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
		return $db->query($query, $data);
	}

	// private function updateCustomerAddress($id, $data)
	// {
	// 	// Assuming your tables are named 'customer' and 'address'
	// 	$tableCustomer = 'customer';
	// 	$tableAddress = 'address';

	// 	// Sanitize data
	// 	$sanitizedData = [];
	// 	foreach ($data as $key => $value) {
	// 		$sanitizedData[$key] = sanitize($value);
	// 	}

	// 	// Begin a database transaction
	// 	$db = new Database;
	// 	$db->query('START TRANSACTION');

	// 	try {
	// 		// Update customer table
	// 		$db->updateaddress($tableCustomer, $sanitizedData, 'customer_id = :id', [':id' => $id]);

	// 		// Update address table
	// 		$addressData = [
	// 			'address_line_1' => $sanitizedData['address_line_1'],
	// 			'address_line_2' => $sanitizedData['address_line_2'],
	// 			'zip_code' => $sanitizedData['zip_code'],
	// 		];
	// 		$db->updateaddress($tableAddress, $addressData, 'customer_id = :id', [':id' => $id]);

	// 		// Commit the transaction
	// 		$db->query('COMMIT');

	// 		return true;  // Return success
	// 	} catch (Exception $e) {
	// 		// An error occurred, rollback changes
	// 		$db->query('ROLLBACK');
	// 		return false;  // Return failure
	// 	}
	// }

}
