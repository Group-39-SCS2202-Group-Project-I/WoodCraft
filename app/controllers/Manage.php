<?php 


//  Manage class

class Manage extends Controller
{
	
	public function index()
	{
		$data['title'] = "manage-account";

		$this->view('manage/manage-account',$data);
	}

    public function myProfile()
	{
		$data['title'] = "myprofile";

		$this->view('manage/profile',$data);
	}

    public function editProfile()
	{
		$data['title'] = "edit-profile";

		$this->view('manage/edit-profile',$data);
	}

    public function changePW()
	{
		$data['title'] = "change-password";

		$this->view('manage/change-password',$data);
	}

    public function addressbook()
	{
		$data['title'] = "addressbook";

		$this->view('manage/addressbook',$data);
	}

    public function editAddressbook()
	{
		$data['title'] = "edit-addressbook";

		$this->view('manage/edit-addressbook',$data);
	}

    public function addAddress()
	{
		$data['title'] = "add-address";

		$this->view('manage/add-address',$data);
	}

    public function orders(){
		$data['title'] = "orders";

		$this->view('manage/orders',$data);
	}

    public function returns(){
		$data['title'] = "returns";

		$this->view('manage/returns',$data);
	}

	public function cancellations(){
		$data['title'] = "cancellations";

		$this->view('manage/cancellations',$data);
	}

    public function wishlist(){
		$data['title'] = "wishlist";

		$this->view('manage/wishlist',$data);
	}

    public function reviews(){
		$data['title'] = "reviews";

		$this->view('manage/reviews',$data);
	}
	
}