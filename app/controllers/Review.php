<?php

class Review extends Controller
{
    public function index()
	{
		if (!Auth::logged_in()) {
			message('Please login to view your account');
			redirect('login');
		}

		$user_id = Auth::getId();
		$customer_id = Auth::getCustomerID();
		
		$customerModel = new Customer();
		$data['title'] = "reviews";

		$products = $customerModel->getProducts($user_id, $customer_id);
		$data['products'] = $products;

		$this->view('customers/reviews', $data);
	}
}