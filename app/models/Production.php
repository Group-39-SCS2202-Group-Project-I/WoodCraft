<!-- production_id	product_id	quantity	status	created_at	updated_at -->
<?php

class Production extends Model
{
        public $errors = [];
        protected $table = "production";

        protected $allowedColumns = [
                "product_id",
                "quantity",
                "status",
                "created_at",
                "updated_at"
        ];

        public function validate($data)
        {
                $this->errors = [];

                if (empty($data['product_id'])) {
                        $this->errors['product_id'] = "Product ID is required";
                } else if (!is_numeric($data['product_id'])) {
                        $this->errors['product_id'] = "Product ID must be numeric";
                } else if ($data['product_id'] < 0) {
                        $this->errors['product_id'] = "Product ID must be greater than 0";
                }
                if (empty($data['quantity'])) {
                        $this->errors['quantity'] = "Quantity is required";
                } else if (!is_numeric($data['quantity'])) {
                        $this->errors['quantity'] = "Quantity must be numeric";
                } else if ($data['quantity'] < 0) {
                        $this->errors['quantity'] = "Quantity must be greater than 0";
                }

                $status_array = ['pending', 'ongoing', 'completed'];
                if (empty($data['status'])) {
                        $this->errors['status'] = "Status is required";
                } else if (!in_array($data['status'], $status_array)) {
                        $this->errors['status'] = "Status must be one of pending, ongoing, completed";
                }

                if (empty($this->errors)) {
                        return true;
                }

                return false;
        }



}
