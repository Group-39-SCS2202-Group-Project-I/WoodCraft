<?php 


class CartC extends Controller
{
	
	
 public function index()
    {
        
        // $data['cart'] = $cart->findAll();
        // $this->view('cart/cart',$data);

        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add':
                    // $manage = new Manage();
					$productcart = new ProductCart();
					$productcart->setId($_POST['pid']);
					
                    // $manage->setId($_POST['pid']);
                    // $product = $manage->getProductsById();
                    //show($product[0]->product_id);
					$product =$productcart->getProductsById();
					show($product[0]->product_id);
                    


                   

                     $cart  = new cartM();

                    $data['customer_id'] = 1;
                    $data['product_id'] = $product[0]->product_id;
                    $data['quantity'] = 1;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['updated_at'] = date('Y-m-d H:i:s');

                    $cart->insert($data);
                    


                      $customer = new Customer();
                      $cart->setId(1);
                      $cartItem =$cart->getitemsById();
                      $cartItem =$cart ->findAll();

                    //   show($cartItem);
                     
                      $cartItemCount = isset($cartItem) ? count($cartItem) : 0;
                       print($cartItemCount);

                 



                    break;


                default:
                    break;

            }
        }
        
    }

    
    


}





