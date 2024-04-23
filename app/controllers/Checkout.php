<?php

class Checkout extends Controller {
    public function index() {
        $data['title'] = 'checkout';


        // Fetch cart items
        $db = new Database();

        $customerId = Auth::getCustomerID();


        // Fetch cart data
        $data['cart'] = $db->query("SELECT * FROM cart WHERE customer_id = $customerId");
        
        // Fetch cart products
        $cart_data['cart_products'] = $db->query("SELECT * FROM cart_products WHERE customer_id = :customer_id", [':customer_id' => $customerId]);


        // Initialize an empty array to hold the mapped products
        $products = [];

        // Iterate over each cart product
        foreach ($cart_data['cart_products'] as $cart_product) {
            $error = [];

            $product_id = $cart_product->product_id;

            if($cart_product->selected == 1){

                // Fetch product data for the current cart product
                $product = $db->query("SELECT * FROM product WHERE product_id = $product_id");
    
                // Fetch product images for the current product
                $images = $db->query("SELECT * FROM product_image WHERE product_id = $product_id");
                $product_image = (array) $images[0];
    
                // Prepare product inventory ID
                $product_inventory_id = $product[0]->product_inventory_id;
    
                // Fetch product inventory data for the current product
                $product_inventory = $db->query("SELECT * FROM product_inventory WHERE product_inventory_id = $product_inventory_id");
    
                if (!empty($product_inventory) || isset($product_inventory[0])) {
                    if($product_inventory[0]->quantity < 1){
                        $error['out of stock'] = "Product is out of stock";
                    } elseif($cart_product->quantity > $product_inventory[0]->quantity){
                        $cart_product->quantity > $product_inventory[0]->quantity;
                        $error['exceeds available stock'] = "Quantity exceeds available stock";
                    } else {
                        // Construct the product array for the current cart item
                        $mapped_product = [
                            'product_id' => $product[0]->product_id,
                            'name' => $product[0]->name,
                            'description' => $product[0]->description,
                            'price' => $product[0]->price,
                            'quantity' => $cart_product->quantity,
                            'selected' => $cart_product->selected,
                            'image_url' => $product_image['image_url'],
                            'reamaing_quantity' => $product_inventory['quantity'],
                            'error' => $error
                        ];
    
                        // Add the mapped product to the products array
                        $products[] = $mapped_product;
    
                        // Now $cart_products contains an array of cart products with associated details
                        $data['checkout_products'] = $products;
                    }
                    $data['error'] = $error;
                    
                }
            }


        }


        
        // Fetch customer's address
        $customerModel = new Customer();
        $customerAddress = $customerModel->getCustomerAddress($customerId); // Replace with your actual method
        $data['customerAddress'] = $customerAddress;
       

        // Load the checkout view
        $this->view('cart/Checkout', $data);
    }

    public function getCheckoutProducts() {
        $customerId = Auth::getCustomerID();

        $db = new Database();

        $query = "SELECT * FROM cart_products WHERE Customer_id = :customer_id AND selected = 1";
        $checkout_data['checkout_products'] = $db->query($query, [':customer_id' => $customerId]);
        show($checkout_data);
        
        $products = [];

        foreach ($checkout_data['checkout_products'] as $checkout_product){
            $error = [];

            $product_id = $checkout_product->product_id;
            $product = $db->query("SELECT * FROM product WHERE product_id = $product_id");
            $product_inventory_id = $product[0]->product_inventory_id;
            $quantity = $db->query("SELECT quantity FROM product_inventory WHERE product_inventory_id = $product_inventory_id");
            $quantity = $quantity[0]->quantity;
            show($quantity);

            if($quantity[0]->quantity < 1){
                $error['out of stock'] = "Product is out of stock";
                $data['error'] = $error;

                $cartModel = new CartDetails();
                $cartProducts = new CartProduct();

                $cartProducts->updateSelectedStatus($customerId, $product_id, 0);

                $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);

                $cartModel->updateCartTotals($customerId);
                $cart = $cartModel->getCartByCustomerId($customerId);
                $_SESSION['cart'] = $cart[0];

                $this->view('cart', $data);

                // $_SESSION['error'] = $error;

                // message('Product is out of stock');
			    // redirect('cart');
            } elseif($checkout_product->quantity > $quantity[0]->quantity){
                $error['exceeds available stock'] = "Quantity exceeds available stock";

                $cartModel = new CartDetails();
                $cartProducts = new CartProduct();

                $cartProducts->updateSelectedStatus($customerId, $product_id, $quantity[0]->quantity);

                $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);

                $cartModel->updateCartTotals($customerId);
                $cart = $cartModel->getCartByCustomerId($customerId);
                $_SESSION['cart'] = $cart[0];

                $data['error'] = $error;
                $this->view('cart', $data);
            } else {
                $mapped_product = [
                    'product_id' => $product[0]->product_id,
                    'name' => $product[0]->name,
                    'price' => $product[0]->price,
                    'quantity' => $checkout_product->quantity,
                ];
                
            }
            $products[] = $mapped_product;
        }
        $data['cart_products'] = $products;
        show($data);
        return $data;
    }

    // Function to add selected items to the checkout table

    //     public function addSelectedItems() {
    //         if (isset($_POST['productId']) && isset($_POST['selected'])) {
    //             $productId = $_POST['productId'];
    //             $selected = $_POST['selected'];
    //         show($_POST);
    //             // Perform database operation to add selected item to the checkout table
    //             $checkoutModel = new Cartcheckout();
        
    //             if ($selected === 'true') {
    //                 // Assuming you have a customer ID, you can retrieve it from session or any other method
    //                 $customerId = 1; // Replace with actual customer ID retrieval logic
        
    //                 // Insert the item into the checkout table
                    
    //                 $checkoutModel = new Cartcheckout();
    //                     $data['customer_id'] = 1; // Assuming a static customer ID for demonstration
    //                     $data['product_id'] = $productId;
    //                     $data['quantity'] = 1;
    //                     $data['created_at'] = date('Y-m-d H:i:s');
    //                     $data['updated_at'] = date('Y-m-d H:i:s');
                       
    //                 $checkoutModel->insert($data);
        
    //                 // Send a success response
    //                 echo json_encode(['success' => true]);
    //                 exit();
    //             } else {
    //                 // Handle the case if the item is deselected (optional)
    //             }
    //         }
        
    //         // Send an error response if required data is not received
    //         echo json_encode(['error' => 'Invalid request']);
    //         exit();
    //     }
    //     // Your existing code to add selected items
    // }

}

    
