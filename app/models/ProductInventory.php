<?php

class ProductInventory extends Model
{

    public $errors = [];
    protected $table = "product_inventory";

    protected $allowedColumns = [
        "quantity"
    ];
}
