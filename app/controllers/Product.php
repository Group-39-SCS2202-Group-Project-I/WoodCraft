<?php

class Product extends Controller {
    
    public function index() {
       
        $manage = new Managecart(); 
        $data['products'] = $manage->findAll();
       
        
        // show($data);
        $this->view("product2", $data);
    }
    
    
}

