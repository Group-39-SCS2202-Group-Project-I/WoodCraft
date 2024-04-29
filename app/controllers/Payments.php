<?php

/**
 * products class
 */
class Payments extends Controller
{
    public function index()
    {
        $data['title'] = 'Payments';
        $payment = $this->pay();
        // $payment = $this->onCompletePayment(235);
        // $this->view('cart/pay', $data);
    }

    public function pay()
    {

        $data['errors'] = [];

        $customerId = Auth::getCustomerID();

        $type = 'pickup';

        // Parse query parameters from the URL
        if (isset($_GET['type'])) {
            $type = $_GET['type'];
        }
        if (isset($_GET['address_id'])) {
            $address_id = $_GET['address_id'];
        } else {
            $customerModel = new Customer();
            $address_id = $customerModel->getAddressId($customerId);
        }

        $cartProducts = new CartProduct();
        $checkout_data['checkout_products'] = $cartProducts->getSelectedItems($customerId);
        // show($checkout_data);

        if (empty($checkout_data['checkout_products'])) {
            redirect('cart');
        } else {
            $cartModel = new CartDetails();

            $data['cart'] = $cartModel->getCartByCustomerId($customerId)[0];
            $data['cart']->type = $type;

            if ($type == 'delivery') {
                $data['cart']->address_id = $address_id;
            }
            // show($data['cart']);

            $orderDetails = new OrderDetails();
            $orderDetails->createOrder($data['cart']);

            $userId = Auth::getUserId();
            $order = $orderDetails->getLastOrderByUserId($userId);
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
                    if (!empty($products)) {
                        $orderItem->deleteOrderItems($order_details_id);

                        foreach ($products as $order_product) {
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
                    if (!empty($products)) {
                        $orderItem->deleteOrderItems($order_details_id);

                        foreach ($products as $order_product) {
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
            foreach ($data['order_products'] as $order_product) {
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
        // show($order);

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
        // show('done');

        $cartModel = new CartDetails();
        $cartModel->updateCartTotals($customerId);

        $order_details_id = $order->order_details_id;
        $orderDetails->updateOrderStatus($order_details_id, 'processing');
        // show('done');

        unset($_SESSION['cart']);
        unset($_SESSION['cart_products']);
    }


    //function for payment failure
    public function onFaliurePayment($orderId)
    {
        // $orderId = $_POST['order_id'];

        $data['errors'] = [];
        $data['errors']['payment'] = "Payment failed";

        $orderItem = new OrderItem();

        $orderItems = $orderItem->getByOrderDetailsId($orderId);
        // show($orderItems);

        foreach ($orderItems as $order_item) {
            $product_id = $order_item->product_id;

            $product = new Product();
            $product_inventory_id = $product->getProductInventoryId($product_id);
            $product_inventory_id = $product_inventory_id[0]->product_inventory_id;
            // show($product_inventory_id);

            $data['order_inventory_id'] = $product_inventory_id;
            $data['quantity'] = $order_item->quantity;
            // show($data);

            $product_inventory = new ProductInventory();
            $product_inventory->restockProductInventory($data);
        }

        $orderItem->deleteOrderItems($orderId);
        // show('done');

        $orderDetails = new OrderDetails();
        $orderDetails->deleteOrderDetails($orderId);
        // show('done');       
    }

    public function BulkPay()
    {
        $data['errors'] = [];

        $userId = Auth::getUserId();

        $bulkOrderRequest = new BulkOrderReq();
        $bulkOrderReq = $bulkOrderRequest->getLastBulkOrderReqByUserId($userId);

        if (empty($bulkOrderReq)) {
            message('No bulk order requests. please make a request.');
            show('No bulk order requests. please make a request.');
            redirect('home');
        } elseif (!empty($bulkOrderReq) && $bulkOrderReq[0]->status == 'accepted') {
            // message('payment successful!!');
            // show('payment successful!!');

            $customerId = Auth::getCustomerID();

            $type = 'pickup';

            // Parse query parameters from the URL
            if (isset($_GET['type'])) {
                $type = $_GET['type'];
            }
            if (isset($_GET['address_id'])) {
                $address_id = $_GET['address_id'];
            } else {
                $customerModel = new Customer();
                $address_id = $customerModel->getAddressId($customerId);
            }


            $bulkOrder = new BulkOrderDetails();
            $bulkOrderDetails = $bulkOrder->getBulkByRequestId($bulkOrderReq[0]->bulk_req_id);

            // show($bulkOrderDetails);
            $total = $bulkOrderReq[0]->total;

            $array = [];

            if($type == 'delivery'){
                $delivery = $total*0.15;
                $total = $total + $delivery;
                // $array["address_id"] = $address_id;
            }

            $amount = $total;
            $merchant_id = MERCHANT_ID;
            $order_id = $bulkOrderDetails[0]->bulk_order_details_id;
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

            $array["amount"] = $amount;
            $array["merchant_id"] = $merchant_id;
            $array["order_id"] = $order_id;
            $array["merchant_secret"] = $merchant_secret;
            $array["currency"] = $currency;
            $array["hash"] = $hash;

            $jsonObj = json_encode($array);

            echo $jsonObj;
        } elseif (!empty($bulkOrderReq) && $bulkOrderReq[0]->status == '') {
            message('Your Bulk order is not accepted yet.');
            show('Your Bulk order is not accepted yet.');
            redirect('home');
        } else {
            message('Your Bulk order is rejected.');
            show('Your Bulk order is rejected.');
        }
    }

    public function onCompleteBulkPayment($bulk_order_details_id)
    {
        // $orderId = $_POST['order_id'];

        $data['errors'] = [];

        $userId = Auth::getUserId();
        $bulkOrderDetails = new BulkOrderDetails();
        $bulkOrder = $bulkOrderDetails->getBulkOrderById($bulk_order_details_id);
        // $bulkOrder = $bulkOrderDetails->getLastbulkOrderByUserId($userId);
        show($bulkOrder);
        // $bulkOrderDetailsId = $bulkOrder[0]->bulk_order_details_id;

        $payment_data = [
            'bulk_order_details_id' => $bulk_order_details_id,
            'amount' => $bulkOrder[0]->total,
            'provider' => 'visa',
            'status' => 'success'
        ];

        $payment = new Payment();
        $payment->addPayment($payment_data);

        $bulkOrderRequest = new BulkOrderReq();
        $bulkOrderRequest->updateBulkRequestStatus($bulkOrder[0]->bulk_req_id, 'proceeded');
        show('done');
    }

    public function onFaliureBulkPayment() {
        echo "faliure";
    }


    // Function to verify checkout products
    public function verifyCheckoutProducts()
    {
        $customerId = Auth::getCustomerID();

        $db = new Database();

        $query = "SELECT * FROM cart_products WHERE Customer_id = :customer_id AND selected = 1";
        $checkout_data['checkout_products'] = $db->query($query, [':customer_id' => $customerId]);
        // show($checkout_data);

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

    public function invoice()
    {
        $userId = Auth::getUserId();
        $orderDetails = new OrderDetails();
        $order = $orderDetails->getOrderByUserId($userId);
        $order = $order[0];
        // show($order);

        $orderId = $order->order_details_id;
        $orderItems = new OrderItem();
        $order_items = $orderItems->getByOrderDetailsId($orderId);
        // show($order_items);

        $data['order'] = $order;
        $data['order_items'] = $order_items;
        show($data);

        $this->view('cart/invoice', $data);
    }
}