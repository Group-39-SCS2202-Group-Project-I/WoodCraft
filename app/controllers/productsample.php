<?php 


 

class Productsample extends Controller {
    
    public function index() {
       
         $manage = new Productsample(); 
        $data['products'] = $manage->findAll();
       
        
        // show($data);
        $this->view("productsample", $data);
    }
    
    
}

