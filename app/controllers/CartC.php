<?php

class CartC extends Controller
{
    public function index()
    {
        $cart = new Cart();
        $data['cart'] = $cart->findAll();
        show($_POST);
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add':
                    $productCart = new ProductCart();
                    $productCart->setId($_POST['pid']);
                    $product = $productCart->getProductsById();
                    $productId = $product[0]->product_id;

                    $cartModel = new Cart();
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
                    
                    case 'updateSelectedItems':
                        if (isset($_POST['productId'], $_POST['selected'])) {
                            $productId = $_POST['productId'];
                            $selected = $_POST['selected'] == 'true' ? 'Yes' : 'No'; // Convert 'true' to 'Yes' and 'false' to 'No'
                            
                            $cartModel = new Cart();
                            $cartModel->updateSelectedStatus($productId, $selected); // Update selected status in the database
                            
                            echo "Selected item updated successfully.";
                        } else {
                            echo "Invalid request.";
                        }
                        exit;
                    
                    

                case 'update':
                    if (isset($_POST['pid']) && isset($_POST['quantity'])) {

                        $productId = $_POST['pid'];
                        $quantity = $_POST['quantity'];
                        show($_POST);
                        // Update the quantity in the database
                        $cartModel = new Cart();
                        $cartModel->updateQuantity($productId, $quantity);

                        echo "Quantity updated successfully.";
                    } else {
                        echo "Invalid request.";
                    }
                    exit;
                   case 'remove':
                    if (isset($_POST['pid'])) {
                        $productId = $_POST['pid'];
                        
                        $cartModel = new Cart();
                        $cartModel->removeCartItem($productId);
                        
                        echo "Item removed successfully.";
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


