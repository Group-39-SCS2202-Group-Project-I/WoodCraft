<?php


class Delivery extends Model
{

    public $errors = [];
    protected $table = "delivery";

    protected $allowedColumns = [
        "id",
        "address_line_1",
        "address_line_2",
        "city",
        "zip_code",
        "percentage"
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['address_line_1'])) {
            $this->errors['address_line_1'] = "Address line 1 is required";
        } elseif (strlen($data['address_line_1']) < 2) {
            $this->errors['address_line_1'] = "Address line 1 must be at least 2 characters";
        }

        if (empty($data['address_line_2'])) {
            $this->errors['address_line_2'] = "Address line 2 is required";
        } elseif (strlen($data['address_line_2']) < 2) {
            $this->errors['address_line_2'] = "Address line 2 must be at least 2 characters";
        }

        if (empty($data['city'])) {
            $this->errors['city'] = "City is required";
        } elseif (strlen($data['city']) < 2) {
            $this->errors['city'] = "City must be at least 2 characters";
        }

        if (empty($data['zip_code'])) {
            $this->errors['zip_code'] = "Zip code is required";
        } elseif (!is_numeric($data['zip_code'])) {
            $this->errors['zip_code'] = "Zip code must be numeric";
        } elseif (strlen($data['zip_code']) != 5) {
            $this->errors['zip_code'] = "Zip code must be 5 digits";
        }

        if (empty($data['percentage'])) {
            $this->errors['percentage'] = "Percentage is required";
        } elseif (!is_numeric($data['percentage'])) {
            $this->errors['percentage'] = "Percentage must be numeric";
        } elseif ($data['percentage'] < 0 || $data['percentage'] > 100) {
            $this->errors['percentage'] = "Percentage must be between 0 and 100";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function getDeliveryInfo()
    {
        $db = new Database;
        $query = "SELECT * FROM delivery LIMIT 1";
        $delivery = $db->query($query);

        return $delivery[0];
    }
}
