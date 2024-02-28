<?php 
class CustomerModel extends Model{

    public $error =[];

    public $table = 'customer';

    public $allowedColumns = [
        'id',
        'name',
        'address',
        'email',
        'mobile',
        'createdOn'
    ];

  
    
    }
    
    

