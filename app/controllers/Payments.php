<?php

/**
 * products class
 */
class Payments extends Controller
{
    // public function index($id = '')
    // {
    //     $data['id'] = $id;
    //     if ($id == '') {
    //         $this->view('cart/pay', $data);
    //     } else {
    //         $this->view('payment', $data);
    //     }
    // }

    public function pay()
    {
        // require ROOT.'core/credentials.php';
        show('$checkout'); 

        $data['errors'] = [];

        $db = new Database;

        show('$checkout');
        $checkout = new Checkout;
        // show('$checkout');
        // show('$checkout'); 
        // $checkout->getCheckoutProducts();
        // show($checkout);     

        // require 'classes/cart.class.php';
        // $objCart = new cart($conn);
        // $objCart->setCid($_SESSION['cid']);
        // $cartItems = $objCart->getAllCartItems();
        // $cartPrices = $objCart->calculatePrices($cartItems);

        // require 'classes/transaction.class.php';
        // $objTrans = new transaction($conn);
        // $objTrans->setCid($_SESSION['cid']);
        // $objTrans->setAmount(str_replace(',', '', $cartPrices['finalPrice']));


        // $amount = $objTrans->getAmount();
        // $merchant_id = MERCHANT_ID;
        // $order_id = uniqid();
        // $merchant_secret = MERCHANT_SECRET;
        // $currency = "LKR";

        // $hash = strtoupper(
        //     md5(
        //         $merchant_id .
        //             $order_id .
        //             number_format($amount, 2, '.', '') .
        //             $currency .
        //             strtoupper(md5($merchant_secret))
        //     )
        // );

        // $array = [];

        // $array["amount"] = $amount;
        // $array["merchant_id"] = $merchant_id;
        // $array["order_id"] = $order_id;
        // $array["merchant_secret"] = $merchant_secret;
        // $array["currency"] = $currency;
        // $array["hash"] = $hash;

        // $jsonObj = json_encode($array);

        // echo $jsonObj;
    }

    // public function confirmPayment()
    // {
    //     $data['errors'] = [];

    //     $db = new Database;

    //     if (isset($_GET['orderId'])) {
    //         $orderId = $_GET['orderId'];
        
                
    //         require 'classes/cart.class.php';
    //         $objCart = new cart($conn);
    //         $objCart->setCid($_SESSION['cid']);
    //         $cartItems = $objCart->getAllCartItems();
    //         $cartPrices = $objCart->calculatePrices($cartItems);
        
    //         require 'classes/transaction.class.php';
    //         $objTrans = new transaction($conn);
    //         $objTrans->setCid($_SESSION['cid']);
    //         $objTrans->setQuantity($cartPrices['itemCount']);
    //         $objTrans->setAmount( str_replace(',', '', $cartPrices['finalPrice']));
    //         $objTrans->setOrderStatus(2);
    //         $objTrans->setCreatedOn(date('Y-m-d H:i:s'));
    //         $tId = $objTrans->saveTransaction();
        
        
    //         if(!is_numeric($tId)){
    //             echo "Something went wrong, Please try again.";
    //         }
        
    //         require 'classes/workshopSeat.class.php';
    //         $objWseat = new workshopSeat($conn);
    //         foreach ($cartItems as $key => $cartItem) {
    //             $objWseat->setTid($tId);
    //             $objWseat->setWid($cartItem['pid']);
    //             $objWseat->setQuantity($cartItem['quantity']);
    //             $objWseat->setCreatedOn(date('Y-m-d H:i:s'));
    //             $orderId = $objWseat->bookSeats();
        
    //             if(!is_numeric($orderId)) {
    //                 echo "Something went wrong, Please try again.";
        
    //             }
    //         }
        
    //         $objCart->removeAllItems();
        
    //         $_SESSION['tid'] = $tId;
        
    //         // Perform actions based on the completed payment
    //         // For example, update the order status in the database, generate an invoice, etc.
        
    //         // Your PHP code for handling payment completion goes here
        
    //         // Respond with a success message (optional)
    //         $logMessage = "Order ID: $orderId\n";
    //         file_put_contents('order_log.log', $logMessage, FILE_APPEND | LOCK_EX);
    //     } else {
    //         // Respond with an error message if the order ID is not provided
    //         echo "Error: OrderID not provided.";
    //     }
    // }
}
