<!-- 

product_measurement_id
length
width
height
weight -->

<?php

class ProductMeasurement extends Model
{

    public $errors = [];
    protected $table = "product_measurement";

    protected $allowedColumns = [
        "length",
        "width",
        "height",
        "weight"
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['length'])) {
            $this->errors['length'] = "Product length is required";
        } else if (!is_numeric($data['length'])) {
            $this->errors['length'] = "Product length must be numeric";
        } else if ($data['length'] < 0) {
            $this->errors['length'] = "Product length must be greater than 0";
        }
        if (empty($data['width'])) {
            $this->errors['width'] = "Product width is required";
        } else if (!is_numeric($data['width'])) {
            $this->errors['width'] = "Product width must be numeric";
        } else if ($data['width'] < 0) {
            $this->errors['width'] = "Product width must be greater than 0";
        }
        if (empty($data['height'])) {
            $this->errors['height'] = "Product height is required";
        } else if (!is_numeric($data['height'])) {
            $this->errors['height'] = "Product height must be numeric";
        } else if ($data['height'] < 0) {
            $this->errors['height'] = "Product height must be greater than 0";
        }
        if (empty($data['weight'])) {
            $this->errors['weight'] = "Product weight is required";
        } else if (!is_numeric($data['weight'])) {
            $this->errors['weight'] = "Product weight must be numeric";
        } else if ($data['weight'] < 0) {
            $this->errors['weight'] = "Product weight must be greater than 0";
        }

        if(empty($this->errors))
		{
			return true;
		}

		return false;
    }


}
