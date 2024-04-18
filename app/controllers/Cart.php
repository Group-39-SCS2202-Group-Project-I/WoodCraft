<?php


class Cart extends Controller
{
    public function index()
    {
        $cart = new CartM();
        $data['cart'] = $cart->findAll();
        show($_POST);
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add':
                    $productCart = new ProductCart();
                    $productCart->setId($_POST['pid']);
                    $product = $productCart->getProductsById();
                    $productId = $product[0]->product_id;

                    $cartModel = new CartM();
                    $data['customer_id'] = 1; // Assuming a static customer ID for demonstration
                    $data['product_id'] = $productId;
                    $data['quantity'] = 1;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    $cartModel->insert($data);

                    $cartModel->setId(1); // Assuming a static customer ID for demonstration
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
                        $cartModel = new CartM();
                        $cartModel->updateQuantity($productId, $quantity);



                        echo "Quantity updated successfully.";
                    } else {
                        echo "Invalid request.";
                    }
                    exit;


                    // Add a new method to the CartM class to update the quantity

                default:
                    break;
            }
        }

        $this->view('cart/cart', $data);
    }


    // Function to remove an item from the cart
    private function removeCartItem($cart, $productId)
    {
        $cart->removeItem($productId); // Call the removeItem method from the CartM class
        echo "Item removed from cart."; // Send a response back to the client
        exit; // Terminate script execution after handling the AJAX request
    }
}
