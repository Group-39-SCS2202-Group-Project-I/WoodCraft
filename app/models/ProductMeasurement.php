<!-- 

product_measurement_id
length
width
height
weight -->

<?php

class ProductInventory extends Model
{

    public $errors = [];
    protected $table = "product_measurement";

    protected $allowedColumns = [
        "length",
        "width",
        "height",
        "weight"
    ];
}
