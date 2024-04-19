<?php


class Cart extends Controller
{
    public function index()
    {
        // show(Auth::getCustomerID());
        $db = new Database();

        $customer_id = 6;


        // Fetch cart data
        $data['cart'] = $db->query("SELECT * FROM cart WHERE customer_id = $customer_id");
        $cart_owner = $data['cart'][0]->customer_id;

        // Fetch cart products
        $cart_data['cart_products'] = $db->query("SELECT * FROM cart_products WHERE customer_id = :customer_id", [':customer_id' => $cart_owner]);


        // Initialize an empty array to hold the mapped products
        $products = [];

        // Iterate over each cart product
        foreach ($cart_data['cart_products'] as $cart_product) {
            $product_id = $cart_product->product_id;

            // Fetch product data for the current cart product
            $product = $db->query("SELECT * FROM product WHERE product_id = $product_id");

            // Fetch product images for the current product
            $product_images = $db->query("SELECT * FROM product_image WHERE product_id = $product_id");

            // Prepare product inventory ID
            $product_inventory_id = $product[0]->product_inventory_id;

            // Fetch product inventory data for the current product
            $product_inventory = $db->query("SELECT * FROM product_inventory WHERE product_inventory_id = $product_inventory_id");

            // Construct the product array for the current cart item
            $mapped_product = [
                'product_id' => $product[0]->product_id,
                'name' => $product[0]->name,
                'description' => $product[0]->description,
                'price' => $product[0]->price,
                'quantity' => $cart_product->quantity,
                'images' => $product_images, // Array of product images
                'inventory' => $product_inventory, // Product inventory details
            ];

            // Add the mapped product to the products array
            $products[] = $mapped_product;
        }

        // Now $cart_products contains an array of cart products with associated details
        $data['cart_products'] = $products;



        // show($data);
        $this->view('cart/cart', $data);
    }


    public function edit()
    {
        $cart= new CartDetails();
        $cartProducts = new CartProduct();

        $data['cart_products'] = $cartProducts->findAll();
        $data['cart'] = $cart->findAll();
        show($data['cart']);
        show($_POST);
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add':
                    // $productCart = new ProductCart();
                    // $productCart->setId($_POST['pid']);
                    // $product = $productCart->getProductsById();
                    // $productId = $product[0]->product_id;

                    $cartModel = new CartProduct();
                    $data['customer_id'] = Auth::getCustomerID(); // Assuming a static customer ID for demonstration
                    $data['product_id'] = $productId;
                    $data['quantity'] = 1;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    $cartModel->insert($data);

                    $cartModel->setId(Auth::getCustomerID()); // Assuming a static customer ID for demonstration
                    $cartItems = $cartModel->getItemsById();
                    $cartItemCount = isset($cartItems) ? count($cartItems) : 0;
                    print($cartItemCount);
                    show($cartItems);
                    break;


                case 'update':
                    if (isset($_POST['pid']) && isset($_POST['quantity'])) {

                        $productId = $_POST['pid'];
                        $quantity = $_POST['quantity'];
                        show($_POST);
                        // Update the quantity in the database
                        $cartModel = new CartProduct();
                        $cartModel->updateQuantity($productId, $quantity);



                        echo "Quantity updated successfully.";
                    } else {
                        echo "Invalid request.";
                    }
                    exit;


                    // Add a new method to the CartM class to update the quantity

                case 'remove':
                    if (isset($_POST['productId'])) {
                        $productId = $_POST['productId'];

                        $cartModel = new CartProduct();
                        $cartModel->removeCartItem($productId);
                    } else {
                        echo "Invalid request.";
                    }
                    exit;

                case 'updateSelectedItems':
                    if (isset($_POST['productId']) && isset($_POST['selected'])) {
                        $productId = $_POST['productId'];
                        $selected = $_POST['selected'];

                        $cartModel = new CartProduct();
                        $cartModel->updateSelectedStatus($productId, $selected);
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
}
