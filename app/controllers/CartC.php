<?php 


class CartC extends Controller
{
    public function index()
    {
        $cart = new CartM();
        $data['cart'] = $cart->findAll();

        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add':
                    
                    break;
                case 'remove':
                    $this->removeCartItem($cart, $_POST['productId']);
                    break;
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

