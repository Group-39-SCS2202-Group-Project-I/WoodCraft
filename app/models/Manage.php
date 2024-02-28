<?php
class Manage extends Model {
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
    

    public function setId($product_id)
    {
        $this->product_id = $product_id;
    }

    public function getId()
    {
        return $this->product_id;
    }

    public function setTitle($name)
    {
        $this->name = $name;
    }

    public function getTitle()
    {
        return $this->name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setCreated_at($created_at)
    {
        $this->createdOn = $created_at;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

   
    public function getAllProduct() {
        $result = $this->select($this->table);
        if ($result) {
            // Log successful query execution
            error_log("Database query executed successfully.");
            // echo "Database query executed successfully.";
        } else {
            // Log error if query fails
            error_log("Error executing database query.");
            // echo "Error executing database query.";
        }
        error_log("Retrieved products from database: " . print_r($result, true));
         // Log retrieved data
        //  echo "Retrieved products from database: " . print_r($result, true);
        return $result;
        
    }
    

    public function getProductsById() {
        return $this->select($this->table, 'product_id = :pid', ['pid' => $this->getId()]);
    }
}



