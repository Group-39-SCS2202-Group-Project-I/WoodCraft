<?php

class Review extends Controller
{
    public function index($product_id = '') {
        if (!Auth::logged_in()) {
            message('Please login to view your account');
            redirect('login');
        }
    
        $user_id = Auth::getId();
        $customer_id = Auth::getCustomerID();
    
        $customerModel = new Customer();
        $data['title'] = "reviews";
    
        $retail_products = $customerModel->getProducts($user_id, $customer_id);
        $bulk_products = $customerModel->getBulkProducts($user_id, $customer_id);

        $products = [];

        if (is_array($retail_products)) {

            if (is_array($bulk_products)) {
                $products = array_merge($retail_products, $bulk_products);
            }
            else{
                $products = $retail_products;
            }
        }
        else if(is_array($bulk_products)) {
            $products = $bulk_products;
        }
        // show($products);
    
        $toReviewProducts = [];
        $reviewedProducts = [];
    
        foreach ($products as $product) {
            if ($product['review_id'] === null) {
                // Product has not been reviewed yet
                $toReviewProducts[$product['product_id']] = $product;
            } else {
                // Product has been reviewed
                $reviewedProducts[$product['product_id']] = $product;
            }
        }
    
        $data['toReviewProducts'] = $toReviewProducts;
        $data['reviewedProducts'] = $reviewedProducts;
    
        if ($product_id == '') {
            // No specific product ID provided, show all products for review
            $this->view('customers/reviews', $data);
        } else {
            // Specific product ID provided
            if (array_key_exists($product_id, $toReviewProducts) && !array_key_exists($product_id, $reviewedProducts)) {
                // Product is in toReviewProducts but not in reviewedProducts, navigate to the add-review page
                $data['product'] = $toReviewProducts[$product_id];
                $this->view('customers/add-review', $data);

            } elseif (array_key_exists($product_id, $reviewedProducts)) {
                // Product is in reviewedProducts, navigate to the edit-review page
                $data['product'] = $reviewedProducts[$product_id];
                $data['review_id'] = $reviewedProducts[$product_id]['review_id'];
                $this->view('customers/edit-review', $data);

            } else {
                // Product is neither in toReviewProducts nor in reviewedProducts
                message('Product not found to review!');
                redirect('review');
            }
        }
    }

    public function add(){
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

    public function edit(){
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
            message('Review updated successfully!');
            redirect('review');
        } 
        else {
            message('Failed to update review. Please try again!');
            redirect('review/edit-review');
        }
    }
}
