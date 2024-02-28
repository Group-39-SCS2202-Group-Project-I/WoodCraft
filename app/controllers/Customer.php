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

    public function editaddress($id = '')
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

	// public function saveProfile()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         // Assuming you have a model to handle database interactions
    //         $customerModel = $this->customers('CustomerModel'); // Adjust the model class name

    //         // Get the customer ID from the session or wherever you store it
    //         $customerId = Auth::getCustomerID();

    //         // Get the updated customer details from the form
    //         $updatedData = [
    //             'first_name' => $_POST['first_name'],
    //             'last_name' => $_POST['last_name'], // Correct the name attribute
    //             'email' => $_POST['email'],
    //             'telephone' => $_POST['telephone'],
    //             'birth_month' => $_POST['birth-month'],
    //             'birth_day' => $_POST['birth-day'],
    //             'birth_year' => $_POST['birth-year'],
    //             'gender' => $_POST['gender'],
    //         ];

    //         // Assuming there's a method in your model to update customer details
    //         $success = $customerModel->updateCustomerDetails($customerId, $updatedData);

    //         if ($success) {
    //             // Redirect to the profile page after successful update
    //             redirect(ROOT . '/customer/profile/' . $customerId);
    //         } else {
    //             // Handle error, e.g., display an error message
    //             echo "Failed to update customer details.";
    //         }
    //     }
    // }

	// public function updateProfile($id = '')
	// {
	// 	if (!Auth::logged_in()) {
	// 		message('Please login to update your profile');
	// 		redirect('login');
	// 	}

	// 	$id = Auth::getCustomerID();

	// 	$data['title'] = "profile";
	// 	$customer = [];

	// 	if ($id != '') {
	// 		$url = ROOT . "/fetch/customers/" . $id;
	// 		$response = file_get_contents($url);
	// 		$customer = json_decode($response, true);

	// 		$data = $customer; // Pass the customer data to the view

	// 		// Forward the update request to the Update controller
	// 		$updateController = new Update();
	// 		$updateController->customer($id);
	// 	}

	// 	// Display the view with the data
	// 	$this->view('customer/profile', $data);
	// }

	// public function updateProfile($id = '')
    // {
    //     if (!Auth::logged_in()) {
    //         message('Please login to update your profile');
    //         redirect('login');
    //     }

    //     $id = Auth::getCustomerID();

    //     $data['title'] = "Profile";

    //     if ($id != '') {
    //         // Fetch customer data from the model
    //         $customerModel = new Customer();
    //         $customer = $customerModel->getCustomerById($id);

    //         if (!$customer) {
    //             message('Customer not found');
    //             redirect('customer/manage-account');
    //         }

    //         $data['customer'] = $customer;

    //         // Display the view with the data
    //         $this->view('customer/profile', $data);
    //     }
    // }

// 	public function updateProfile($id = '')
// {
//     if (!Auth::logged_in()) {
//         message('Please login to update your profile');
//         redirect('login');
//     }

//     $id = Auth::getCustomerID();

//     $data['title'] = "edit-profile";
//     $customerModel = new Customer(); // Create an instance of CustomerModel
//     $customer = $customerModel->getCustomerById($id); // Use the method to fetch customer data

//     $data['customer'] = $customer; // Pass the customer data to the view

//     // Forward the update request to the Update controller
//     $updateController = new Update();
//     $updateController->customer($id);

//     // Display the view with the data
//     $this->view('customer/edit-profile', $data);
// }

// public function add(){
// 	if(count($_POST) > 0){
// 		$maintainrequests=new Maintains();
// 		$maintainrequests->insert($_POST);
// 		$this->redirect('maintainrequests');
// 	}

// 	$this->view('storekeeperSendRequests');
// }

// public function delete($id=null){
   
// 	if(count($_POST) > 0){
// 		$maintainrequests=new Maintains();
// 		$maintainrequests->delete($id);
// 		$this->redirect('maintainrequests');

// 	}
// 	$this->view('DeleteMaintain');
// }



public function update($id=null){
   
	if(count($_POST) > 0){
		$maintainrequests=new Customer();
		$maintainrequests->update($id,$_POST);
		redirect('profile');

	}
	$this->view('edit-profile');
}
	
}
