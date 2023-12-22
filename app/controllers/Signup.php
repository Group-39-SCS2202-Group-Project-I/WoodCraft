<?php

/**
 * signup class
 */
class Signup extends Controller
{

	public function index()
	{
		$data['errors'] = [];
		$user = new User;
		$address = new Address;
		$customer = new Customer;


		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			$_POST['role'] = "customer";

			$result = $user->validate($_POST);

			$result2 = $address->validate($_POST);

			$result3 = $customer->validate($_POST);

			show($_POST);

			if ($result && $result2 && $result3) {
				$db = new Database;

				$user_arr['email'] = $_POST['email'];
				// $user_arr['password'] = $_POST['password'];
				$user_arr['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$user_arr['role'] = "customer";

				show(1);

				$user_query = "INSERT INTO user (email,password,role) VALUES (:email,:password,:role)";
				$db->query($user_query, $user_arr);

				// Get the last inserted user_id
				// $last_user_id = $db->query("SELECT user_id FROM user WHERE email = $_POST[email]");
				$last_user_id = $db->query("SELECT user_id FROM user WHERE user_id = (SELECT MAX(user_id) FROM user)");


				$customer_arr['user_id'] = $last_user_id[0]->user_id;


				$address_arr['address_line_1'] = $_POST['address_line_1'];
				$address_arr['address_line_2'] = $_POST['address_line_2'];
				$address_arr['city'] = $_POST['city'];
				$address_arr['zip_code'] = $_POST['zip_code'];
				$address_query = "INSERT INTO address (address_line_1, address_line_2, city, zip_code) VALUES (:address_line_1, :address_line_2, :city, :zip_code)";
				$db->query($address_query, $address_arr);

				// Get the last inserted address_id
				// $last_address_id = $db->query("SELECT address_id FROM address WHERE address_line_1 = $_POST[address_line_1] AND address_line_2 = $_POST[address_line_2] AND city = $_POST[city] AND zip_code = $_POST[zip_code]")
				$last_address_id = $db->query("SELECT address_id FROM address WHERE address_id = (SELECT MAX(address_id) FROM address)");


				$customer_arr['address_id'] = $last_address_id[0]->address_id;

				// $customer_arr['user_id'] = $last_user_id;
				$customer_arr['first_name'] = $_POST['first_name'];
				$customer_arr['last_name'] = $_POST['last_name'];
				$customer_arr['telephone'] = $_POST['telephone'];
				// $customer_arr['address_id'] = $last_address_id;

				show($customer_arr);

				// INSERT INTO customer (user_id, first_name, last_name, telephone, address_id) VALUES (LAST_INSERT_ID(), 'John', 'Doe', '555-1234', LAST_INSERT_ID());
				$customer_query = "INSERT INTO customer (user_id, first_name, last_name, telephone, address_id) VALUES (:user_id, :first_name, :last_name, :telephone, :address_id)";
				$db->query($customer_query, $customer_arr);

				


				message("Your profile was successfuly created. Please login");
				redirect('login');
			}
		}

		// var_dump($result);
		// var_dump($result2);
		// var_dump($result3);

		// show($user->errors);
		// show($address->errors);
		// show($customer->errors);

		// show($data['errors']);


		// show($_POST);
		$data['errors'] = $user->errors;
		$data['errors'] = array_merge($data['errors'], $address->errors);
		$data['errors'] = array_merge($data['errors'], $customer->errors);

		// show($data['errors']);

		$data['title'] = "Signup";

		$this->view('signup', $data);
	}
}