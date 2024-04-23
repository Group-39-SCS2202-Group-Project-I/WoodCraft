<?php

class Review extends Controller
{
    public function index()
	{
		if (!Auth::logged_in()) {
			message('Please login to view your account');
			redirect('login');
		}

		$id = Auth::getCustomerID();
		$data['title'] = "reviews";

		if($id != ''){
			$url = ROOT . "/fetch/customers/" . $id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			$data = $customer;
			$this->view('customers/reviews', $data);
		}
    }
}