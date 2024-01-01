<?php

class ProductMaterial extends Model
{

    public $errors = [];
    protected $table = "product_material";


    protected $allowedColumns = [
        "product_id",
        "material_id",
        "quantity_needed",
        "created_at",
        "updated_at"
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['product_id'])) {
            $this->errors['product_id'] = "Product ID is required";
        } else if (!is_numeric($data['product_id'])) {
            $this->errors['product_id'] = "Product ID must be numeric";
        } else if ($data['product_id'] < 0) {
            $this->errors['product_id'] = "Product ID must be greater than 0";
        }
        if (empty($data['material_id'])) {
            $this->errors['material_id'] = "Material is required";
        } else if (!is_numeric($data['material_id'])) {
            $this->errors['material_id'] = "Material ID must be numeric";
        } else if ($data['material_id'] < 0) {
            $this->errors['material_id'] = "Material ID must be greater than 0";
        }
        if (empty($data['quantity_needed'])) {
            $this->errors['quantity_needed'] = "Quantity needed is required";
        } else if (!is_numeric($data['quantity_needed'])) {
            $this->errors['quantity_needed'] = "Quantity needed must be numeric";
        } else if ($data['quantity_needed'] < 0) {
            $this->errors['quantity_needed'] = "Quantity needed must be greater than 0";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }
}
