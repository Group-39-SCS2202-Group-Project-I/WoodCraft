<?php
class Cart_item extends Controller
{
    public function index()
    {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add':
                    $manage = new Managecart();
                    $manage->setId($_POST['pid']);
                    $product = $manage->getProductsById();
                    show($product[0]->product_id);


                    $cart = new CartModel();


                    $data['customer_id'] = 1;
                    $data['product_id'] = $product[0]->product_id;
                    $data['quantity'] = 1;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['updated_at'] = date('Y-m-d H:i:s');

                    $cart->insert($data);
                     



                    // $cart->setId($_POST['cid']);
                    // $cartitem = $cart->getitemsById();
                    // show($cartitem[0]->id);

                default:
                    break;

            }
        }
    }



}

