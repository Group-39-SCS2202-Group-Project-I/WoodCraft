<?php 

/**
 * cart class
 */
class CartC extends Controller
{
	
	
 public function index()
    {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add':
                    // $manage = new Manage();
					$productcart = new ProductCart();
					$productcart->setId($_POST['pid']);
					
                    // $manage->setId($_POST['pid']);
                    // $product = $manage->getProductsById();
                    // show($product[0]->product_id);
					$product =$productcart->getProductsById();
					show($product[0]->product_id);


                    $cart = new Cart();


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




	
// }
// public function index()
// {
// 	$data['title'] = "Cart";

// 	$this->view('cart/cart',$data);
// }