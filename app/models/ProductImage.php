<?php 

class ProductImage extends Model
{
    
    public $errors = [];
    protected $table = "product_image";


    protected $allowedColumns = [	
        "product_id",
        "image_url",
    ];

}