<!-- material_order_id	material_id	supplier_id	quantity	price_per_unit	total	created_at	updated_at	 -->
<?php


class MaterialOrder extends Model
{
    // material_order_id	material_id	supplier_id	quantity	price_per_unit	total	created_at	updated_at	

    public $errors = [];
    protected $table = "material_order";

    protected $allowedColumns = [
        "material_id",
        "supplier_id",
        "quantity",
        "price_per_unit",
        "total",
        "created_at",
        "updated_at"
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['material_id'])) {
            $this->errors['material_id'] = "Material is required";
        }

        if (empty($data['supplier_id'])) {
            $this->errors['supplier_id'] = "Supplier is required";
        }

        if (empty($data['quantity'])) {
            $this->errors['quantity'] = "Quantity is required";
        }
        elseif(!preg_match("/^[0-9]*$/",$data['quantity']))
        {
            $this->errors['quantity'] = "Quantity must contain only numbers";
        }
        elseif ($data['quantity'] < 1) {
            $this->errors['quantity'] = "Quantity must be at least 1";
        }

        if (empty($data['price_per_unit'])) {
            $this->errors['price_per_unit'] = "Price per unit is required";
        }
        elseif(!preg_match("/^[0-9]*$/",$data['price_per_unit']))
        {
            $this->errors['price_per_unit'] = "Price per unit must contain only numbers";
        }
        elseif ($data['price_per_unit'] < 1) {
            $this->errors['price_per_unit'] = "Price per unit must be at least 1";
        }

        // if (empty($data['total'])) {
        //     $this->errors['total'] = "Total is required";
        // }
        // elseif(!preg_match("/^[0-9]*$/",$data['total']))
        // {
        //     $this->errors['total'] = "Total must contain only numbers";
        // }
        // elseif ($data['total'] < 1) {
        //     $this->errors['total'] = "Total must be at least 1";
        // }

        if (empty($this->errors)) {
            return true;
        }
    }
}
    