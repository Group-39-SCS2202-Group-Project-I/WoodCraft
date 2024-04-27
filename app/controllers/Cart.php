<?php


class Cart extends Controller
{
    public function index()
    {
        // show(Auth::getCustomerID());
        $db = new Database();
        
        $customer_id = Auth::getCustomerID();


        // Fetch cart data
        $data['cart'] = $db->query("SELECT * FROM cart WHERE customer_id = $customer_id");
        $cart_owner = $data['cart'][0]->customer_id;

        // Fetch cart products
        $cart_data['cart_products'] = $db->query("SELECT * FROM cart_products WHERE customer_id = :customer_id", [':customer_id' => $cart_owner]);

               
        // Initialize an empty array to hold the mapped products
        $products = [];

        // Iterate over each cart product
        foreach ($cart_data['cart_products'] as $cart_product) {
            $error = [];

            $product_id = $cart_product->product_id;

            // Fetch product data for the current cart product
            $product = $db->query("SELECT * FROM product WHERE product_id = $product_id");

            // Fetch product images for the current product
            $images = $db->query("SELECT * FROM product_image WHERE product_id = $product_id");
            $product_image = (array) $images[0];
            $product_category_id = $product[0]->product_category_id;
            $category = $db->query("SELECT category_name FROM product_category WHERE product_category_id = $product_category_id");
            // Prepare product inventory ID
            $product_inventory_id = $product[0]->product_inventory_id;

            // Fetch product inventory data for the current product
            $product_inventory = $db->query("SELECT * FROM product_inventory WHERE product_inventory_id = $product_inventory_id");

            if (empty($product_inventory) || !isset($product_inventory[0])) {
                $product_inventory = ['quantity' => 0];
                $cart_product->quantity = 0;
            } elseif ($cart_product->quantity > $product_inventory[0]->quantity) {
                $cart_product->quantity = $product_inventory[0]->quantity;
                $error[] = "Quantity exceeds available stock";
                // $cart_product->selected = 0;
            } else {
                $product_inventory = (array) $product_inventory[0];
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
                'reamaing_quantity' => $product_inventory['quantity'],
                'category' => $category[0]->category_name,
                'error' => $error
            ];

            // Add the mapped product to the products array
            $products[] = $mapped_product;
            
        }

        // Now $cart_products contains an array of cart products with associated details
        $data['cart_products'] = $products;

          

        //  show($data);
        $this->view('cart/cart', $data);
    }


    public function edit()
    {
        $data = [];
        $errors = [];

        // $results = validate($_POST);

        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add':

                    $customerId = $_POST['customer_id'];
                    $productId = $_POST['product_id'];
                    $quantity = $_POST['quantity'];


                    // Initialize CartProduct model
                    $cartModel = new CartDetails();

                    // Check if cart record already exists for the customer
                    $existingCart = $cartModel->getCartByCustomerId($customerId);

                    if (!$existingCart) {
                        // If cart doesn't exist, create a new one
                        $cartModel->createCart($customerId);
                        $existingCart = $cartModel->getCartByCustomerId($customerId);
                    }


                    $cart_customer = $existingCart[0]->customer_id;

                    // Add item to the cart
                    $cartProducts = new CartProduct();

                    $validateItem = $cartProducts->validate($_POST);

                    if ($validateItem) {

                        $quantityAddable = $cartModel->getQuantitybyProductId($productId);

                        if($quantityAddable < 1){
                            $error[$productId]['msg'] = "out of stock";

                            $cartProducts->addItemToCart($cart_customer, $productId, 0);

                            $cartProducts->updateSelectedStatus($customerId, $productId, 0);

                            $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);

                            $cartModel->updateCartTotals($customerId);
                            $cart = $cartModel->getCartByCustomerId($customerId);
                            $_SESSION['cart'] = $cart[0];

                            $_SESSION['error'] = $error;

                        } elseif($quantity > $quantityAddable){
                            $error[$productId]['msg'] = "exceeds stock";
                            $error[$productId]['available_quantity'] = $quantity;

                            $cartProducts->addItemToCart($cart_customer, $productId, $quantityAddable);

                            $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);

                            $cartModel->updateCartTotals($customerId);
                            $cart = $cartModel->getCartByCustomerId($customerId);
                            $_SESSION['cart'] = $cart[0];

                            $_SESSION['error'] = $error;
                        } else {
                            $cartProducts->addItemToCart($cart_customer, $productId, $quantity);
    
                            // Update cart totals
                            $cartModel->updateCartTotals($cart_customer);
                            $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);
                            $cart = $cartModel->getCartByCustomerId($customerId);
                            $_SESSION['cart'] = $cart[0];
                        }
                    } else {
                        $data['errors'] = array_merge($cartProducts->errors);
                        show($data['errors']);

                        //how to keep popup open and show errors

                        $_SESSION['errors'] = $data['errors'];
                    }
                    exit;
                

                case 'update':
                    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {

                        $customerId = $_POST['customer_id'];
                        $productId = $_POST['product_id'];
                        $quantity = $_POST['quantity'];
                        show($_POST);
                        // Update the quantity in the database

                        $cartModel = new CartDetails();
                        $cartProducts = new CartProduct();

                        $validateItem = $cartProducts->validate($_POST);

                        if ($validateItem) {

                            $quantityAddable = $cartModel->getQuantitybyProductId($productId);
    
                            if($quantityAddable < 1){
                                $error[$productId]['msg'] = "out of stock";

                                $cartProducts->updateQuantity($customerId, $productId, 0);
    
                                $cartProducts->updateSelectedStatus($customerId, $productId, 0);
    
                                $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);
    
                                $cartModel->updateCartTotals($customerId);
                                $cart = $cartModel->getCartByCustomerId($customerId);
                                $_SESSION['cart'] = $cart[0];
    
                                $_SESSION['error'] = $error;
  
                            } elseif($quantity > $quantityAddable){
                                $error[$productId]['msg'] = "exceeds stock";
                                $error[$productId]['available_quantity'] = $quantity;

                                $cartProducts->updateQuantity($customerId, $productId, $quantityAddable);
    
                                $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);
    
                                $cartModel->updateCartTotals($customerId);
                                $cart = $cartModel->getCartByCustomerId($customerId);
                                $_SESSION['cart'] = $cart[0];
    
                                $_SESSION['error'] = $error;
                            } else {
                                $cartProducts->updateQuantity($customerId, $productId, $quantity);
        
                                $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);

                                // Update cart totals
                                $cartModel->updateCartTotals($customerId);
                                $cart = $cartModel->getCartByCustomerId($customerId);
                                $_SESSION['cart'] = $cart[0];
                            }

                            echo "Quantity updated successfully.";
                        } else {
                            echo "Invalid request.";
                        }
                    }
                    exit;

                    case 'remove':
                    if (isset($_POST['product_id'])) {
                        $customerId = $_POST['customer_id'];
                        $productId = $_POST['product_id'];

                        $cartModel = new CartDetails();
                        $cartProducts = new CartProduct();
                        $cartProducts->removeCartItem($customerId, $productId);

                        $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);

                        $cartModel->updateCartTotals($customerId);
                        $cart = $cartModel->getCartByCustomerId($customerId);
                        $_SESSION['cart'] = $cart[0];
                    } else {
                        echo "Invalid request.";
                    }
                    exit;

                case 'updateSelectedItems':
                    if (isset($_POST['product_id']) && isset($_POST['selected'])) {
                        $customer_id = $_POST['customer_id'];
                        $productId = $_POST['product_id'];
                        $selected = $_POST['selected'];

                        $cartModel = new CartDetails();
                        $cartProducts = new CartProduct();

                        $cartProducts->updateSelectedStatus($customer_id, $productId, $selected);

                        $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customer_id);

                        $cartModel->updateCartTotals($customer_id);
                        $cart = $cartModel->getCartByCustomerId($customer_id);
                        $_SESSION['cart'] = $cart[0];
                        echo "Selected items updated successfully.";
                    } else {
                        echo "Invalid request.";
                    }
                    exit;
                default:
                    break;
            }
        }

        $this->view('cart/cart', $data);
    }

    public static function getCartItemsCount()
    {
        $cartModel = new CartProduct();
        $cartModel->setId(6); // Assuming a static customer ID for demonstration
        $cartItems = $cartModel->getItemsById();
        $cartItemCount = isset($cartItems) ? count($cartItems) : 0;

        $data['cart_item_count'] = $cartItemCount;

        // show($data['cart_item_count']);
        return $data['cart_item_count'];
    }

    // public function checkout()
    // {
    //     $db = new Database();

    //     $customer_id = 6;

    //     // Fetch cart data
    //     $data['cart'] = $db->query("SELECT * FROM cart WHERE customer_id = $customer_id ");
    //     $cart_owner = $data['cart'][0]->customer_id;

    //     // Fetch cart products
    //     $cart_data['cart_products'] = $db->query("SELECT * FROM cart_products WHERE customer_id = :customer_id AND selected = 1", [':customer_id' => $cart_owner]);
    // }

}
