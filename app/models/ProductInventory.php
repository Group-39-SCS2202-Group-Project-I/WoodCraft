<?php

class ProductInventory extends Model
{

    public $errors = [];
    protected $table = "product_inventory";

    protected $allowedColumns = [
        "product_inventory_id",
        "quantity"
    ];

    public function getQuantity($productInventoryId)
    {
        $query = "SELECT quantity FROM product_inventory WHERE product_inventory_id = :product_inventory_id";
        $params = [':product_inventory_id' => $productInventoryId];
        return $this->query($query, $params);
    }

    public function destockProductInventory($data)
    {
        $query = "UPDATE product_inventory SET quantity = quantity - :quantityToRemove WHERE product_inventory_id = :product_inventory_id";
        $params = [
            ':product_inventory_id'=> $data['order_inventory_id'],
            ':quantityToRemove' => $data['quantity']
        ];
        $this->query($query, $params);
    }

    public function restockProductInventory($data)
    {
        $query = "UPDATE product_inventory SET quantity = quantity + :quantityToAdd WHERE product_inventory_id = :product_inventory_id";
        $params = [
            ':product_inventory_id'=> $data['order_inventory_id'],
            ':quantityToAdd' => $data['quantity']
        ];
        $this->query($query, $params);
    }
}
