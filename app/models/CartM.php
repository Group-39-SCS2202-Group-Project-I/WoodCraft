<?php
class CartM extends Model
{
    public $error = [];
    public $table = 'cart';

    public $allowedColumns = [
        'id',
        'customer_id',
        'product_id',
        'quantity',
        'created_at',
        'updated_at',
        'selected', // Add selected column to allowed columns
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

    public function find($condition, $params = [])
    {
        $query = "SELECT * FROM " . $this->table . " WHERE " . $condition;
        return $this->query($query, $params);
    }

    public function update($id, $data)
    {

        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
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

    public function removeItem($productId)
    {

        $query = "DELETE FROM $this->table WHERE product_id = :product_id";
        $params = array('product_id' => $productId);
        $this->query($query, $params);
    }

    public function updateQuantity($productId, $quantity)
    {
        $query = "UPDATE $this->table SET quantity = :quantity WHERE product_id = :product_id";
        $params = array('quantity' => $quantity, 'product_id' => $productId);
        $this->query($query, $params);
    }

    // New method to update the selected column
    public function updateSelectedStatus($productId, $selected)
{
    $query = "UPDATE $this->table SET selected = :selected WHERE product_id = :product_id";
    $params = array('selected' => $selected, 'product_id' => $productId);
    $this->query($query, $params);
}

}
