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
		$customer = []; 

		if ($id != '') {
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customer/add-address', $data);
		}
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

	// public function update($id=null)
	// {
	// 	if(count($_POST) > 0){
	// 		$maintainrequests=new Customer();
	// 		$maintainrequests->update($id,$_POST);
	// 		redirect('profile');

	// 	}
	// 	$this->view('edit-profile');
	// }

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
        'email' => sanitize($_POST['email']),
        'telephone' => sanitize($_POST['telephone']),
        // 'birth_month' => sanitize($_POST['birth-month']),
        // 'birth_day' => sanitize($_POST['birth-day']),
        // 'birth_year' => sanitize($_POST['birth-year']),
        // 'gender' => sanitize($_POST['gender']),
    ];

	show($updatedData);

    // Perform the database update
    $success = $this->updateCustomerProfile($id, $updatedData);

    if ($success) {
        message('Profile updated successfully');
        redirect('customer/profile/' . $id);
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

	
}
