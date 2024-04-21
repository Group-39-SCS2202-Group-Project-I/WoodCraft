<!-- bulk_req_id	product_id	quantity	status -->
<?php

class BulkOrderReq extends Model
{
    public $errors = [];
    protected $table = "bulk_order_req";

    protected $allowedColumns = [
        "product_id",
        "quantity",
        "status"
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['product_id'])) {
            $this->errors['product_id'] = "Product ID is required";
        }

        if (empty($data['quantity'])) {
            $this->errors['quantity'] = "Quantity is required";
        }

        // if (empty($data['status'])) {
        //     $this->errors['status'] = "Status is required";
        // }
        // else if (!in_array($data['status'], ['new', 'accepted', 'rejected'])) {
        //     $this->errors['status'] = "Invalid status";
        // }

        if(empty($this->errors))
		{
			return true;
		}

		return false;
    }
}