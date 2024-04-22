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
			$this->view('customer/edit-profile', $data);
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
			redirect('customer/editProfile/' . $id);
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
		$success = $this->updateCustomerProfile($id, $updatedData);
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
			redirect('customer/updateProfile/' . $id);
		} 
		else {
			message('Failed to update profile. Please try again.');
			redirect('customer/editProfile/' . $id);
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
			$this->view('customer/change-password', $data);
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
			$this->view('customer/edit-addressbook', $data);
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
	// 		$this->view('customer/add-address', $data);
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
				redirect('customer/address/' . $customerId);
			} else {
				message('Failed to update customer address. Please try again.');
				redirect('customer/addressbook/' . $customerId);
			}

		// Pass customer data to the view
		// $data['customer'] = $customer;
		// $data['title'] = "edit-address";

		// $this->view('customer/edit-address', $data);
	}

	public function orders($order_id = '')
	{
		if (!Auth::logged_in()) {
			message('Please login!!');
			redirect('login');
		}

		$user_id = Auth::getID();
    	$orders = $this->getOrders($user_id);
		// show($orders);

		// Group orders by order_details_id
		$groupedOrders = [];
		foreach ($orders as $order) {
			$orderDetailsId = $order['order_details_id'];
			if (!isset($groupedOrders[$orderDetailsId])) {
				$groupedOrders[$orderDetailsId] = [];
			}
			$groupedOrders[$orderDetailsId][] = $order;
		}

		$data['title'] = "orders";
		$data['groupedOrders'] = $groupedOrders;
		// $customer = [];
		$customer = null; 

		if ($order_id == '') {
			$url = ROOT . "/fetch/customers/" . $order_id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			// $data = $customer;
			$data = array_merge($data, $customer ?? []);
        	$data['orders'] = $orders;
			$this->view('customer/orders', $data);
		}
		else{
				$order_details = $this->getOrderDetails($order_id);
				// show($order_details);
				$order_items = $this->getOrderItems($order_id);
				// show($order_items);

				// Calculate total subtotal for the order
				$totalSubtotal = array_sum(array_column($order_items, 'subtotal'));

				$data['order_details'] = $order_details;
				$data['order_items'] = $order_items;
				$data['total_subtotal'] = $totalSubtotal;
				// show($totalSubtotal);
				$this->view('customer/orders-manage', $data);
		}
	}

	private function getOrders($user_id)
	{
		$query = "SELECT od.order_details_id, od.status, od.created_at, 
						oi.quantity, 
						p.name as product_name, 
						pi.image_url as product_image_url
				FROM order_details od
				LEFT JOIN order_item oi ON od.order_details_id = oi.order_details_id
				LEFT JOIN product p ON oi.product_id = p.product_id
				LEFT JOIN product_image pi ON p.product_id = pi.product_id
				WHERE od.user_id = :user_id
				GROUP BY od.order_details_id, p.product_id
				ORDER BY od.created_at DESC";

		$params = array(':user_id' => $user_id);
		$db = new Database;
		$result = $db->query($query, $params, PDO::FETCH_ASSOC);

		return $result;
	}

	private function getOrderDetails($order_id){
		$query = "SELECT od.order_details_id, od.created_at, od.total, od.updated_at, od.status, od.delivery_cost,
						a.address_line_1, a.address_line_2, a.city,
						c.first_name, c.last_name, c.telephone
					FROM order_details od
					LEFT JOIN customer c ON od.user_id = c.user_id
					LEFT JOIN address a ON c.address_id = a.address_id
					WHERE od.order_details_id = :order_id
					GROUP BY od.order_details_id";

		$params = array(':order_id' => $order_id);
		$db = new Database;
		$result = $db->query($query, $params, PDO::FETCH_ASSOC);

		return $result;
	}

	private function getOrderItems($order_id){
		$query = "SELECT oi.quantity, p.name AS product_name, p.price, 
						pi.image_url as product_image_url 
					FROM order_item oi
					LEFT JOIN product p ON oi.product_id = p.product_id
					LEFT JOIN product_image pi ON p.product_id = pi.product_id
					WHERE oi.order_details_id = :order_id
					GROUP BY p.product_id";

		$params = array(':order_id' => $order_id);
		$db = new Database;
		$result = $db->query($query, $params, PDO::FETCH_ASSOC);

		// Calculate subtotal for each order item
		foreach ($result as &$item) {
			$item['subtotal'] = $item['quantity'] * $item['price'];
		}

		return $result;
	}
}
