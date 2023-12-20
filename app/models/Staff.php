<!-- staff_id	user_id	first_name	last_name	mobile_number	address_id	created_at	updated_at	 -->
<?php

/**
 * staff model
 */
class Staff extends Model
{
    public $errors = [];
    protected $table = "staff";

    protected $allowedColumns = [
        "user_id",
        "first_name",
        "last_name",
        "mobile_number",
        "address_id",
        "created_at",
        "updated_at"
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['first_name'])) {
            $this->errors['first_name'] = "First name is required";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $data['first_name'])) {
            $this->errors['first_name'] = "First name must contain only letters and spaces";
        } elseif (strlen($data['first_name']) < 2) {
            $this->errors['first_name'] = "First name must be at least 2 characters";
        }

        if (empty($data['last_name'])) {
            $this->errors['last_name'] = "Last name is required";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $data['last_name'])) {
            $this->errors['last_name'] = "Last name must contain only letters and spaces";
        } elseif (strlen($data['last_name']) < 2) {
            $this->errors['last_name'] = "Last name must be at least 2 characters";
        }

        if (empty($data['mobile_number'])) {
            $this->errors['mobile_number'] = "Mobile number is required";
        } else if (!is_numeric($data['mobile_number'])) {
            $this->errors['mobile_number'] = "Mobile number must be numeric";
        } else if (strlen($data['mobile_number']) != 10) {
            $this->errors['mobile_number'] = "Mobile number must be 10 digits";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }
}
