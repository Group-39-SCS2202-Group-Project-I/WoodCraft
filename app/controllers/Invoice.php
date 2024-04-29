<?php

class Invoice extends Controller
{
    public function index()
    {
        $data['title'] = "Invoice";
        // $data['invoices'] = $this->Payments->get_invoices();

        $order = new OrderDetails();
        $userId = Auth::getUserId();
        $data['orderDetails'] = $order->getLastOrderByUserId($userId);
        $data['orderDetails'] = $data['orderDetails'][0];
        $orderId = $data['orderDetails']->order_details_id;

        $name = Auth::getCustomerName();
        $data['name'] = $name;
        $orderItem = new OrderItem();
        $data['orderItems'] = $orderItem->getByOrderDetailsId($orderId);

        foreach($data['orderItems'] as $key => $orderItem){
            $product = new Product();
            $productId = $orderItem->product_id;

            $product = $product->getProductById($productId);
            $data['orderItems'][$key]->product = $product[0];
        }
        // show($data['orderItems']);

        $address = new Address();
        $addressId = $data['orderDetails']->delivery_address_id;
        $data['address'] = $address->getAddressByAddressId($addressId);
        // show($data['address']);


        // $this->sendInvoiceMail($data);
        $this->view('cart/invoice', $data);
    }

    private function sendInvoiceMail($data)
    {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $message = htmlspecialchars($_POST['message']);

        if (!empty($email) && !empty($message)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $receiver = "sasankaudana@gmail.com"; //enter that email address where you want to receive all messages
                $subject = "From: $name <$email>";
                $body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message\n\nRegards,\n$name";
                $sender = "From: $email";
                if (mail($receiver, $subject, $body, $sender)) {
                    header("location:index.php?success");
                } else {
                    // echo "Sorry, failed to send your message!";
                    header('location:index.php?error1');
                }
            } else {
                // echo "Enter a valid email address!";
                header('location:index.php?error2');
            }
        } else {
            // echo "Email and message field is required!";
            header('location:index.php?error3');
        }
    }
}
