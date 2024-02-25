<?php

class Customer extends Controller {

    public function index()
    {
        if (!Auth::logged_in()) {
            message('Please login to view your account');
            redirect('login');
        }

        $data['title'] = "manage-account";

        $this->view('customer/manage-account', $data);
    }

    public function profile($id = null)
    {
        if (!Auth::logged_in()) {
            message('Please login to view your account');
            redirect('login');
        }

        $id = $id ?? Auth::getId();

        $user = new User();
        $data['row'] = $user->first(['id' => $id]);

        $addressModel = new Address();
        $customerData['address_id'] = $data['row']->address_id ?? null;

        if ($customerData['address_id']) {
            $data['address'] = $addressModel->first(['id' => $customerData['address_id']]);
        }

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

    public function editProfile()
	{
		$data['title'] = "edit-profile";

		$this->view('customer/edit-profile',$data);
	}

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

    public function editAddressbook()
	{
		$data['title'] = "edit-addressbook";

		$this->view('customer/edit-addressbook',$data);
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
