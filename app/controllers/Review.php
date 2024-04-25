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
		
		$toReviewProducts = [];
        $reviewedProducts = [];

        foreach ($products as $product) {
            if ($product['review_id'] === null) {
                // Product has not been reviewed yet
                $toReviewProducts[] = $product;
            } else {
                // Product has been reviewed
                $reviewedProducts[] = $product;
            }
        }

        $data['toReviewProducts'] = $toReviewProducts;
        $data['reviewedProducts'] = $reviewedProducts;

		$this->view('customers/reviews', $data);
	}
}