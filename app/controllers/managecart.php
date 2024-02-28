<?php
class Managecart extends Model {
    public $errors = [];
    public $table = "product";
    protected $allowedColumns = [
        "product_id",
        "name",
        "price",
        "description",
        "product_category_id",
        "product_inventry_id",
        "product_mesurement_id",
        "image",
        "created_at",
        "updated_at",
        "deleted_at",
        "listed"
    ];
    


public $product_id;
public function setId($product_id)
{
    $this->product_id = $product_id;
}

public function getId()
{
    return $this->product_id;
}
public function getProductsById() {
    $result = $this->select($this->table, 'product_id = :pid', [':pid' => $this->getId()]);
    return $result;
}
}