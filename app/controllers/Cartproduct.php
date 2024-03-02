<?php

class Cartproduct extends Controller{

    public function index(){
        $productcart = new Productcart();
        $data['products'] =$productcart->findAll(); 
        $this->view('cart/Cartproduct',$data);
    }
}