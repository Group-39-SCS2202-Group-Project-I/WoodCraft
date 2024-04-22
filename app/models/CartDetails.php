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

    public function getCartByCustomerId($customerId)
    {
        $query = "SELECT * FROM cart WHERE customer_id = :customerId";
        $params = [':customerId' => $customerId];
        $this->query($query, $params);

        $result = $this->select($this->table, 'customer_id = :customer_id', [':customer_id' => $customerId]);
        // show($result);
        return $result;
    }

    public function createCart($customerId)
    {
        $query = "INSERT INTO cart (customer_id, created_at, updated_at) VALUES (:customerId, NOW(), NOW())";
        $params = [':customerId' => $customerId];
        $this->query($query, $params);
        show('works');
    }


    public function updateCartTotals($customerId)
    {
        $query = "UPDATE cart
        SET cart_item_count = (SELECT SUM(quantity) FROM cart_products WHERE Customer_id = :customerId),
            sub_total = (SELECT SUM(price * quantity) FROM product INNER JOIN cart_products ON product.product_id = cart_products.product_id WHERE customer_id = :customerId),
            total = (SELECT SUM(price * quantity) FROM product INNER JOIN cart_products ON product.product_id = cart_products.product_id WHERE customer_id = :customerId) + 0.2 * (SELECT SUM(price * quantity) FROM product INNER JOIN cart_products ON product.product_id = cart_products.product_id WHERE customer_id = :customerId)
        WHERE customer_id = :customerId;
        ";

        // $query = "SELECT COUNT(*) FROM cart_products WHERE cart_id = :cartId";
        
        $params = [':customerId' => $customerId];
        $this->query($query, $params);
        show('update_works');
    }
}
