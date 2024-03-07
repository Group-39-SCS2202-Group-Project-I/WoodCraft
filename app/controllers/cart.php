<?php

class Cart extends Controller{
    public function index(){
        $data['title'] = "cart";
        $this->view("cart/cart");
    }
}