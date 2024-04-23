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
        $cart_products = $db->query("SELECT * FROM cart_products WHERE customer_id = :customer_id", [':customer_id' => $customerId]);
        $products = [];

        // Iterate over each cart product
        foreach ($cart_products as $cart_product) {
            $error = [];
            $product_id = $cart_product->product_id;

            if ($cart_product->selected == 1) {
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
                    if ($product_inventory[0]->quantity < 1) {
                        $error['out_of_stock'] = "Product is out of stock";
                    } elseif ($cart_product->quantity > $product_inventory[0]->quantity) {
                        $error['exceeds_available_stock'] = "Quantity exceeds available stock";
                    }
                }

                // Construct the product array for the current cart item
                $mapped_product = [
                    'product_id' => $product[0]->product_id,
                    'name' => $product[0]->name,
                    'description' => $product[0]->description,
                    'price' => $product[0]->price,
                    'quantity' => $cart_product->quantity,
                    'selected' => $cart_product->selected,
                    'image_url' => $product_image['image_url'],
                    'error' => $error
                ];

                // Add the mapped product to the products array
                $products[] = $mapped_product;
            }
        }

        // Assign checkout products to data array
        $data['checkout_products'] = $products;

        // Fetch customer's address
        $customerModel = new Customer();
        $customerAddress = $customerModel->getCustomerAddress($customerId);
        $data['customerAddress'] = $customerAddress;

        // Load the checkout view
        $this->view('cart/Checkout', $data);
    }

    public function saveAddress() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $customerId = Auth::getCustomerID();

            // Check if the required POST fields exist before accessing them
            if (
                isset($_POST['address_line_1']) &&
                isset($_POST['city']) &&
                isset($_POST['province']) &&
                isset($_POST['zip_code'])
            ) {
                // Create an array with the allowed columns and their values
                $addressData = [
                    // 'customer_id' => $customerId,
                    'address_line_1' => $_POST['address_line_1'],
                    'address_line_2' => $_POST['address_line_2'] ?? null,
                    'city' => $_POST['city'],
                    'province' => $_POST['province'],
                    'zip_code' => $_POST['zip_code']
                    // Add more fields as needed
                ];
                 show($addressData);
                 $newaddress = new Address();
                 $newlysavedaddress = $newaddress->saveAddressD($addressData);
                // Call the saveAddress method from the Address class
              
                if ($newlysavedaddress) {
                    // Address saved successfully
                    // You can redirect the user to the next step of the checkout process
                    redirect('checkout/payment');
                } else {
                    // Address could not be saved, handle the error
                    echo "Failed to save address. Please try again.";
                }
            } else {
                // One or more required POST fields are missing
                echo "Failed to save address. Required fields are missing.";
            }
        } else {
            // Invalid request method
            echo "Invalid request method.";
        }
    }
}
