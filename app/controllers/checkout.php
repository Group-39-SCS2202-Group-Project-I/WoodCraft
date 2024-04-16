<?php
class Checkout extends Controller {
    public function index() {
        // Your existing code

        $data['title'] = 'checkout';
        $this->view('cart/checkout', $data);
    }

    // Function to add selected items to the checkout table
    public function addSelectedItems() {
        if (isset($_POST['productId']) && isset($_POST['selected'])) {
            $productId = $_POST['productId'];
            $selected = $_POST['selected'];
        show($_POST);
            // Perform database operation to add selected item to the checkout table
            $checkoutModel = new Cartcheckout();
    
            if ($selected === 'true') {
                // Assuming you have a customer ID, you can retrieve it from session or any other method
                $customerId = 1; // Replace with actual customer ID retrieval logic
    
                // Insert the item into the checkout table
                
                $checkoutModel = new Cartcheckout();
                    $data['customer_id'] = 1; // Assuming a static customer ID for demonstration
                    $data['product_id'] = $productId;
                    $data['quantity'] = 1;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['updated_at'] = date('Y-m-d H:i:s');
                   
                $checkoutModel->insert($data);
    
                // Send a success response
                echo json_encode(['success' => true]);
                exit();
            } else {
                // Handle the case if the item is deselected (optional)
            }
        }
    
        // Send an error response if required data is not received
        echo json_encode(['error' => 'Invalid request']);
        exit();
    }
}    