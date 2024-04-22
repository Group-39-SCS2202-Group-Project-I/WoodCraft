<?php

class CartProduct extends Model
{
    public $errors = [];

    public $table = 'cart_products';
    public $allowedColumns = [
        'id',
        'customer_id',
        'product_id',
        'quantity',
        'selected',
        'created_at',
        'updated_at'
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['customer_id'])) {
            $this->errors['customer_id'] = "Customer ID is required";
        } else if (!is_numeric($data['customer_id'])) {
            $this->errors['customer_id'] = "Customer ID must be a numeric value";
        }

        if (empty($data['product_id'])) {
            $this->errors['product_id'] = "Product ID is required";
        } else if (!is_numeric($data['product_id'])) {
            $this->errors['product_id'] = "Product ID must be a numeric value";
        }

        if (empty($data['quantity'])) {
            $this->errors['quantity'] = "Quantity is required";
        } else if (!is_numeric($data['quantity']) || $data['quantity'] <= 0) {
            $this->errors['quantity'] = "Quantity must be a positive numeric value";
        }

        if (isset($data['selected']) && !in_array($data['selected'], [0, 1])) {
            $this->errors['selected'] = "Selected value must be either 0 or 1";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    public $id;
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getItemsById()
    {
        $result = $this->select($this->table, 'customer_id = :customer_id', [':customer_id' => $this->getId()]);
        return $result;
    }

    public function getItemsByCustomerId($customerId)
    {
        return $this->select($this->table, 'customer_id = :customer_id', [':customer_id' => $customerId]);
    }

    public function getCartItem($customerId, $product_id)
    {
        
        $results = $this->select($this->table, 'customer_id = :customer_id AND product_id = :product_id', [':customer_id' => $customerId, 'product_id' => $product_id]);
        // show($results);
        return $results;
    }

    // public function addItem($data)
    // {
    //     $query = "INSERT INTO $this->table (customer_id, product_id, quantity, selected, created_at, updated_at) VALUES (:customer_id, :product_id, :quantity, :selected, :created_at, :updated_at)";
    //     $this->query($query, $data);
    // }

    public function addItemToCart($customerId, $productId, $quantity)
    {
        $query = "INSERT INTO cart_products (customer_id, product_id, quantity, selected) VALUES (:customerId, :productId, :quantity, 1)";
        $params = [':customerId' => $customerId, ':productId' => $productId, ':quantity' => $quantity];
        $this->query($query, $params);
        show('add_to_cart_works');
    }

    public function updateCartItem($customerId, $id, $data)
{
    if (!empty($this->allowedColumns)) {
        foreach ($data as $key => $value) {
            if (!in_array($key, $this->allowedColumns)) {
                // Handle disallowed column updates (e.g., throw error or skip)
                // Example:
                unset($data[$key]);
                throw new Exception("Column '$key' is not allowed for updating.");
            }
        }
    }

    $setValues = [];
    foreach ($data as $key => $value) {
        $setValues[] = "$key = :$key";
    }
    $setValuesStr = implode(", ", $setValues);

    $query = "UPDATE $this->table SET $setValuesStr WHERE id = :id AND customer_id = :customer_id";
    $data['id'] = $id;
    $data['customer_id'] = $customerId;

    $this->query($query, $data);
}


public function removeCartItem($customerId, $productId)
{
    $query = "DELETE FROM $this->table WHERE product_id = :product_id AND customer_id = :customer_id";
    $params = ['product_id' => $productId, 'customer_id' => $customerId];
    $this->query($query, $params);
}


public function updateQuantity($customerId, $productId, $quantity)
{
    $query = "UPDATE $this->table SET quantity = :quantity WHERE product_id = :product_id AND customer_id = :customer_id";
    $params = ['quantity' => $quantity, 'product_id' => $productId, 'customer_id' => $customerId];
    $this->query($query, $params);
}

public function updateSelectedStatus($customerId, $productId, $selected)
{
    $query = "UPDATE $this->table SET selected = :selected WHERE product_id = :product_id AND customer_id = :customer_id";
    $params = ['selected' => $selected, 'product_id' => $productId, 'customer_id' => $customerId];
    $this->query($query, $params);
}
}
