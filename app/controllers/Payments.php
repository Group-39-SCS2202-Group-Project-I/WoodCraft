<?php

/**
 * products class
 */
class Payments extends Controller
{
    public function index()
    {
        $data['title'] = 'Payments';
        // $payment = $this->pay('delivery', 1);
        $payment = $this->onCompletePayment(235);
        $this->view('cart/pay', $data);
    }

    public function pay($type, $address_id = NULL)
    {
        $data['errors'] = [];

        $customerId = Auth::getCustomerID();

        $cartProducts = new CartProduct();
        $checkout_data['checkout_products'] = $cartProducts->getSelectedItems($customerId);
        // show($checkout_data);

        if(empty($checkout_data['checkout_products'])){
            redirect('cart');
        }else{
            $cartModel = new CartDetails();
    
            $data['cart'] = $cartModel->getCartByCustomerId($customerId)[0];
            $data['cart']->type= $type;
            
            if($type == 'delivery'){
                $data['cart']->address_id = $address_id;
            }
            // show($data['cart']);
            
            $orderDetails = new OrderDetails();
            $orderDetails->createOrder($data['cart']);
    
            $userId = Auth::getUserId();
            $order = $orderDetails->getOrderByUserId($userId);
            $order_details_id = $order[0]->order_details_id;
            // show($order_details_id);
    
            $orderItem = new OrderItem();
            $products = [];
    
            foreach ($checkout_data['checkout_products'] as $checkout_product) {
                $error = [];
    
                $product_id = $checkout_product->product_id;

                $productObj = new Product();
                $product = $productObj->getProductById($product_id);
                // show($product);
                $product_inventory_id = $product[0]->product_inventory_id;

                $product_inventory = new ProductInventory();
                $quantity = $product_inventory->getQuantity($product_inventory_id);
                $quantity = $quantity[0]->quantity;
                // show($quantity);
    
    
                if ($quantity < 1) {
                    $error[$product_id]['msg'] = "out of stock";
    
                    $orderDetails->deleteOrderDetails($order_details_id);
                    if(!empty($products)){
                        $orderItem->deleteOrderItems($order_details_id);

                        foreach($products as $order_product){
                            $product_inventory->restockProductInventory($order_product);
                        }
                    }

                    $cartProducts->updateQuantity($customerId, $product_id, 0);
                    $cartProducts->updateSelectedStatus($customerId, $product_id, 0);
    
                    $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);
    
                    $cartModel->updateCartTotals($customerId);
                    $cart = $cartModel->getCartByCustomerId($customerId);
                    $_SESSION['cart'] = $cart[0];
                    $_SESSION['error'] = $error;
    
                    redirect('cart');
                    exit;
                } elseif ($checkout_product->quantity > $quantity) {
                    $error[$product_id]['msg'] = "exceeds stock";
                    $error[$product_id]['available_quantity'] = $quantity;
    
                    $orderDetails->deleteOrderDetails($order_details_id);
                    if(!empty($products)){
                        $orderItem->deleteOrderItems($order_details_id);

                        foreach($products as $order_product){
                            $product_inventory->restockProductInventory($order_product);
                        }
                    }
    
                    $cartProducts->updateQuantity($customerId, $product_id, $quantity);
    
                    $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);
    
                    $cartModel->updateCartTotals($customerId);
                    $cart = $cartModel->getCartByCustomerId($customerId);
                    $_SESSION['cart'] = $cart[0];
                    $_SESSION['error'] = $error;
    
                    redirect('cart');
                    exit;
                } else {
                    $mapped_product = [
                        'order_details_id' => $order_details_id,
                        'order_inventory_id' => $product_inventory_id,
                        'product_id' => $product_id,
                        'quantity' => $checkout_product->quantity,
                    ];
                    $orderItem->addOrderItem($mapped_product);
                }
                $products[] = $mapped_product;
            }
            $data['order_products'] = $products;
            // show($data);

            $product_inventory = new ProductInventory();
            foreach($data['order_products'] as $order_product){
                // show($order_product);
                $product_inventory->destockProductInventory($order_product);
            }


            $amount = $order[0]->total;
            $merchant_id = MERCHANT_ID;
            $order_id = $order_details_id;
            $merchant_secret = MERCHANT_SECRET;
            $currency = "LKR";
    
            $hash = strtoupper(
                md5(
                    $merchant_id .
                        $order_id .
                        number_format($amount, 2, '.', '') .
                        $currency .
                        strtoupper(md5($merchant_secret))
                )
            );
    
            $array = [];
    
            $array["amount"] = $amount;
            $array["merchant_id"] = $merchant_id;
            $array["order_id"] = $order_id;
            $array["merchant_secret"] = $merchant_secret;
            $array["currency"] = $currency;
            $array["hash"] = $hash;
    
            $jsonObj = json_encode($array);
    
            echo $jsonObj;
        }

    }

    
    // Function for payment completion
    public function onCompletePayment($orderId)
    {
        // $orderId = $_POST['order_id'];

        $data['errors'] = [];
        
        $orderDetails = new OrderDetails();
        $order = $orderDetails->getByOrderDetailsId($orderId);
        $order = $order[0];
        show($order);

        $payment_data = [
            'order_details_id' => $order->order_details_id,
            'amount' => $order->total,
            'provider' => 'visa',
            'status' => 'success'
        ];
        
        $payment = new Payment();
        $payment->addPayment($payment_data);

        $customerId = Auth::getCustomerID();
        $cartProducts = new CartProduct();
        $cartProducts->removeCartItems($customerId);
        show('done');

        $cartModel = new CartDetails();
        $cartModel->updateCartTotals($customerId);


        $userId = Auth::getUserId();
        $order = $orderDetails->getOrderByUserId($userId);
        $order_details_id = $order[0]->order_details_id;
        $orderDetails->updateOrderStatus($order_details_id, 'processing');
        show('done');

        unset($_SESSION['cart']);
        unset($_SESSION['cart_products']);
    }





    // Function to verify checkout products
    public function verifyCheckoutProducts()
    {
        $customerId = Auth::getCustomerID();

        $db = new Database();

        $query = "SELECT * FROM cart_products WHERE Customer_id = :customer_id AND selected = 1";
        $checkout_data['checkout_products'] = $db->query($query, [':customer_id' => $customerId]);
        show($checkout_data);

        $products = [];

        foreach ($checkout_data['checkout_products'] as $checkout_product) {
            $error = [];

            $product_id = $checkout_product->product_id;
            $product = $db->query("SELECT * FROM product WHERE product_id = $product_id");
            $product_inventory_id = $product[0]->product_inventory_id;
            $quantity = $db->query("SELECT quantity FROM product_inventory WHERE product_inventory_id = $product_inventory_id");
            $quantity = $quantity[0]->quantity;
            // show($quantity);

            if ($quantity < 1) {
                $error[$product_id]['msg'] = "out of stock";

                $cartModel = new CartDetails();
                $cartProducts = new CartProduct();

                $cartProducts->updateQuantity($customerId, $product_id, 0);

                $cartProducts->updateSelectedStatus($customerId, $product_id, 0);

                $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);

                $cartModel->updateCartTotals($customerId);
                $cart = $cartModel->getCartByCustomerId($customerId);
                $_SESSION['cart'] = $cart[0];
                $_SESSION['error'] = $error;

                redirect('cart');
            } elseif ($checkout_product->quantity > $quantity) {
                $error[$product_id]['msg'] = "exceeds stock";
                $error[$product_id]['available_quantity'] = $quantity;

                $cartModel = new CartDetails();
                $cartProducts = new CartProduct();

                $cartProducts->updateQuantity($customerId, $product_id, $quantity);

                $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customerId);

                $cartModel->updateCartTotals($customerId);
                $cart = $cartModel->getCartByCustomerId($customerId);
                $_SESSION['cart'] = $cart[0];
                $_SESSION['error'] = $error;

                redirect('cart');
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
        $data['checkout_products'] = $products;
        show($data);

        // $this->view('cart/pay',$data);


        // header("Content-Type: application/json");
        // echo json_encode($data['checkout_products']);

        // $url = ROOT . "/checkot/verifyCheckoutProducts";
        // $response = file_get_contents($url);
        // $product_reviews = json_decode($response);
        // $data['products'] = $product_reviews;

        // show($data['products']);
    }

}
