<?php

class Product extends Model
{

    public $errors = [];
    protected $table = "product";

    protected $allowedColumns = [
        "name",
        "description",
        "product_category_id",
        "product_inventory_id",
        "product_measurement_id",
        "price",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['name'])) {
            $this->errors['name'] = "Product name is required";
        } else if (!preg_match("/^[a-zA-Z0-9 ]*$/", $data['name'])) {
            $this->errors['name'] = "Product name must contain only letters, numbers, and spaces";
        } else if (strlen($data['name']) < 2) {
            $this->errors['name'] = "Product name must be at least 2 characters";
        } else if (strlen($data['name']) > 100) {
            $this->errors['name'] = "Product name must be less than 100 characters";
        } 
        if (empty($data['description'])) {
            $this->errors['description'] = "Product description is required";
        }
        //price
        if (empty($data['price'])) {
            $this->errors['price'] = "Product price is required";
        } else if (!is_numeric($data['price'])) {
            $this->errors['price'] = "Product price must be numeric";
        } else if ($data['price'] < 0) {
            $this->errors['price'] = "Product price must be greater than 0";
        }
        //product_category_id
        if (empty($data['product_category_id'])) {
            $this->errors['product_category_id'] = "Product category is required";
        }

        if(empty($this->errors))
		{
			return true;
		}

		return false;
    }
}
