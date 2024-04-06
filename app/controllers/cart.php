<?php

class Cart extends Controller{
    public function index(){
      $cartItem = new CartM();
      $data['cart'] = $cartItem->findAll();

      
        
        $this ->view('cart/cart',$data);

    }
}