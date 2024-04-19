<?php

class CartDetails extends Model
{
    public $errors = [];
    protected $table = "cart";

    protected $allowedColumns = [
        "customer_id",
        "cart_item_count",
        "sub_total",
        "delivery_cost",
        "total",
        "created_at",
        "updated_at",
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['customer_id'])) {
            $this->errors['customer_id'] = "Customer ID is required";
        } else if (!is_numeric($data['customer_id'])) {
            $this->errors['customer_id'] = "Customer ID must be a numeric value";
        }

        if (empty($data['cart_item_count'])) {
            $this->errors['cart_item_count'] = "Cart item count is required";
        } else if (!is_numeric($data['cart_item_count']) || $data['cart_item_count'] <= 0) {
            $this->errors['cart_item_count'] = "Cart item count must be a positive numeric value";
        }

        if (empty($data['sub_total'])) {
            $this->errors['sub_total'] = "Subtotal is required";
        } else if (!is_numeric($data['sub_total']) || $data['sub_total'] < 0) {
            $this->errors['sub_total'] = "Subtotal must be a non-negative numeric value";
        }

        if (empty($data['delivery_cost'])) {
            $this->errors['delivery_cost'] = "Delivery cost is required";
        } else if (!is_numeric($data['delivery_cost']) || $data['delivery_cost'] < 0) {
            $this->errors['delivery_cost'] = "Delivery cost must be a non-negative numeric value";
        }

        if (empty($data['total'])) {
            $this->errors['total'] = "Total cost is required";
        } else if (!is_numeric($data['total']) || $data['total'] < 0) {
            $this->errors['total'] = "Total cost must be a non-negative numeric value";
        }

        // Validation for created_at and updated_at can be added if needed

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }
}

?>
