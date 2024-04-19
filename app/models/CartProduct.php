<?php

class CartProduct extends Model
{
    public $table = 'cart_products';
    public $allowedColumns = [
        'id',
        'customer_id',
        'product_id',
        'quantity',
        'created_at',
        'updated_at',
        'selected',
    ];

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

    /////////////////////////////////////////////////

    public function addItem($data)
    {
        $query = "INSERT INTO $this->table (customer_id, product_id, quantity, created_at, updated_at) VALUES (:customer_id, :product_id, :quantity, :created_at, :updated_at)";
        $params = array(
            'customer_id' => $data['customer_id'],
            'product_id' => $data['product_id'],
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->query($query, $params);
    }

    //////////////

    public function updateCartItem($id, $data)
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

        $query = "UPDATE $this->table SET $setValuesStr WHERE id = :id";
        $data['id'] = $id;

        $this->query($query, $data);
    }

    public function removeCartItem($productId)
    {
        $query = "DELETE FROM $this->table WHERE product_id = :product_id";
        $params = ['product_id' => $productId];
        $this->query($query, $params);
    }

    public function updateQuantity($productId, $quantity)
    {
        $query = "UPDATE $this->table SET quantity = :quantity WHERE product_id = :product_id";
        $params = ['quantity' => $quantity, 'product_id' => $productId];
        $this->query($query, $params);
    }

    public function updateSelectedStatus($productId, $selected)
    {
        $query = "UPDATE $this->table SET selected = :selected WHERE product_id = :product_id";
        $params = ['selected' => $selected, 'product_id' => $productId];
        $this->query($query, $params);
    }
}
