<?php

class Review extends Controller
{
    public function index($review_id = '') {
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
    
        if ($review_id == '') {
            $this->view('customers/reviews', $data);
        } 
        else {
            // Get the product details for the provided review_id
            $product_review = $customerModel->getReviewDetails($review_id);
            
            if ($product_review) {
                if ($review_id === null) {
                    // Product has not been reviewed yet, navigate to the add-review page
                    $data['product'] = $product_review;
                    $this->view('customers/add-review', $data); 
                } 
                else {
                    // Product has been reviewed, navigate to the edit-review page
                    $data['product'] = $product_review;
                    $data['review_id'] = $review_id;
                    $this->view('customers/edit-review', $data);
                }
            } 
            else {
                message('Review not found!');
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

            message('Product reviewed successfully!');
            redirect('review');
        } else {
            message('Failed!');
            redirect('add-review');
        }
    }

    public function editReview(){
        if (!Auth::logged_in()) {
			message('Please login!!');
			redirect('login');
		}

        // Retrieve review_id from the form submission
        $review_id = $_POST['review_id'];

        $customerModel = new Customer();

        $updatedData = [
			'rating' => $_POST['rating'],
			'review' => $_POST['review'],
		];

        // Perform the database update
		$success = $customerModel->updateReview($review_id, $updatedData);

		if ($success) {
			message('Review updated successfully');
			redirect('review');
		} 
		else {
			message('Failed to update review. Please try again.');
			redirect('review/editReview');
		}
    }
}
