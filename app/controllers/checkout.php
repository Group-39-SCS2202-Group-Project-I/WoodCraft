<?php

class Checkout extends Controller{
    public function index(){

        $data['title'] = 'checkout';
        $this->view('cart/checkout',$data);

    }
}