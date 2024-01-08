<!-- supplier_details -->
<?php

class Supplier extends Model
{

    public $errors = [];
    protected $table = "supplier_details";

    // supplier_id	name	email	telephone	brn	address_id	created_at	updated_at	

    protected $allowedColumns = [
        "name",
        "email",
        "telephone",
        "brn",
        "address_id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['name'])) {
            $this->errors['name'] = "Supplier name is required";
        } else if (!preg_match("/^[a-zA-Z0-9 ]*$/", $data['name'])) {
            $this->errors['name'] = "Supplier name must contain only letters, numbers, and spaces";
        } else if (strlen($data['name']) < 2) {
            $this->errors['name'] = "Supplier name must be at least 2 characters";
        } else if (strlen($data['name']) > 100) {
            $this->errors['name'] = "Supplier name must be less than 100 characters";
        }
        if (empty($data['email'])) {
            $this->errors['email'] = "Supplier email is required";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Supplier email must be a valid email address";
        }
        if (empty($data['telephone'])) {
            $this->errors['telephone'] = "Telephone is required";
        } else if (!preg_match("/^[0-9]*$/", $data['telephone'])) {
            $this->errors['telephone'] = "Telephone must contain only numbers";
        } else if (strlen($data['telephone']) < 10) {
            $this->errors['telephone'] = "Telephone must be at least 10 characters";
        } else if (strlen($data['telephone']) > 10) {
            $this->errors['telephone'] = "Telephone must be less than 10 characters";
        }
        if (empty($data['brn'])) {
            $this->errors['brn'] = "BRN is required";
        } else if (!preg_match("/^[0-9a-zA-Z ]*$/", $data['brn'])) {
            $this->errors['brn'] = "BRN must contain only numbers and letters ";
        }
        // if (empty($data['address_id'])) {
        //     $this->errors['address_id'] = "Supplier address is required";
        // }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }
}
