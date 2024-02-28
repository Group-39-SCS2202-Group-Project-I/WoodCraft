<?php

class Customer extends Controller {

    public function index($id = '')
    {
        if (!Auth::logged_in()) {
            message('Please login to view your account');
            redirect('login');
        }

		$data['title'] = "manage-account";

		if($id != ''){
			// show($id);
			$url = ROOT . "/fetch/customers/" . $id;
			// $url = ROOT . "/fetch/customers/" . Auth::getId();
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			// show($customer);
			// $data['row'] = $customer;

			$data = $customer;
			// show($data);
			$this->view('customer/manage-account', $data);
		}


		// $id = $id ?? Auth::getId();

		// $user = new User();
		// // show($id);
		// $data['row'] = $user->first(['user_id' => $id]);
		// // show($data['row']);


        // // $data['title'] = "manage-account";

        // $this->view('customer/manage-account', $data);
    }

    public function profile($id = null)
    {
        if (!Auth::logged_in()) {
            message('Please login to view your account');
            redirect('login');
        }

        $id = $id ?? Auth::getId();

        $user = new User();
        $data['row'] = $user->first(['user_id' => $id]);

        $addressModel = new Address();
        $customerData['address_id'] = $data['row']->address_id ?? null;

        if ($customerData['address_id']) {
            $data['address'] = $addressModel->first(['id' => $customerData['address_id']]);
        }

		$data['row'] = $data['row'] ?? null;

        if ($data['row']) {
            $data['title'] = "Manage Account";
            $data['errors'] = $user->errors;
        
            $this->view('customer/manage-account', $data);
        }
    }

    public function myProfile()
	{
		$data['title'] = "myprofile";

		$this->view('customer/profile',$data);
	}

	public function editProfile($id = '')
	{
		$data['title'] = "edit-profile";
		$customer = []; 

		if ($id != '') {
			// $url = ROOT . "/fetch/customers/" . Auth::getId();
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);
		}

		$data = $customer;
		// $data = array_merge($data, $customer); 
		// show($data);
		$this->view('customer/edit-profile', $data);
	}

	// public function editProfile() {
    //     // Retrieve existing customer data
    //     $customerId = getCurrentCustomerId(); // You should have a method to get the current customer ID
    //     $customerData = $this->model->getCustomerData($customerId);

    //     // Handle form submission
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         // Validate and update customer data
    //         $postData = sanitize($_POST); // You should have a sanitization method
    //         $this->DB->updateCustomerData($customerId, $postData);
    //         // Redirect to manage account page after updating
    //         header("Location: " . ROOT . "/customer/manage-account");
    //         exit();
    //     }

    //     // Load the view with customer data
    //     $this->view('customer/edit-profile', $customerData);
    // }

    public function changePW()
	{
		$data['title'] = "change-password";

		$this->view('customer/change-password',$data);
	}

    public function addressbook()
	{
		$data['title'] = "addressbook";

		$this->view('customer/addressbook',$data);
	}

    public function editAddressbook($id = '')
	{
		$data['title'] = "edit-profile";
		// $customer = []; 

		if ($id != '') {
			// $url = ROOT . "/fetch/customers/" . Auth::getId();
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);
		}

		$data = $customer;
		// $data = array_merge($data, $customer); 
		// show($data);
		$this->view('customer/edit-profile', $data);
	}

    public function addAddress()
	{
		$data['title'] = "add-address";

		$this->view('customer/add-address',$data);
	}

    public function orders(){
		$data['title'] = "orders";

		$this->view('customer/orders',$data);
	}

    public function returns(){
		$data['title'] = "returns";

		$this->view('customer/returns',$data);
	}

	public function cancellations(){
		$data['title'] = "cancellations";

		$this->view('customer/cancellations',$data);
	}

    public function wishlist(){
		$data['title'] = "wishlist";

		$this->view('customer/wishlist',$data);
	}

    public function reviews(){
		$data['title'] = "reviews";

		$this->view('customer/reviews',$data);
	}
	
}
