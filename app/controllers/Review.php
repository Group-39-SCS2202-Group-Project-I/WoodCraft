<?php

class Review extends Controller
{
    public function index($product_id = '')
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

        if ($product_id == '') {
			$this->view('customers/reviews', $data);
		} else {
            // Get the product details for the provided product_id
            $product = $customerModel->getProductDetails($product_id);
            if ($product) {
                $data['product'] = $product;
                
			    $this->view('customers/add-review', $data);
            } else {
                // Product not found, handle accordingly (e.g., show error message)
                message('Product not found!');
                redirect('review');
            }
		}
	}


    public function addReview(){
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the form data
            $product_id = $_POST['product_id'];
            $customer_id = Auth::getCustomerID();
            $rating = $_POST['rating'];
            $review = $_POST['review'];

            // Call the addReview method from Customer model
            $customerModel = new Customer();
            $customerModel->addReview($product_id, $customer_id, $rating, $review);

            // Optionally, you can redirect the user to a confirmation page
            redirect('review');
        } else {
            // If the form is not submitted, redirect the user to the review page
            redirect('review');
        }
    }
}
