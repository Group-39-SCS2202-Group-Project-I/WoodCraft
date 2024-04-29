<?php

class BulkOrderReq extends Model
{
    public $errors = [];
    protected $table = "bulk_order_req";

    protected $allowedColumns = [
        "product_id",
        "quantity",
        "status",
        'user_id',
        'price_per_unit',
        'total',
        'estimated_date'
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['product_id'])) {
            $this->errors['product_id'] = "Product ID is required";
        }

        if (empty($data['user_id'])) {
            $this->errors['user_id'] = "User ID is required";
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

    public function getLastBulkOrderReqByUserId($userId)
    {
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1";
        $params = [':user_id' => $userId];
        $results = $this->query($query, $params);
        return $results;
    }

    public function updateBulkRequestStatus($bulkRequestsId, $status)
    {
        $query = "UPDATE $this->table SET status = :status WHERE bulk_req_id = :bulk_req_id";
        return $this->query($query, [':status' => $status, ':bulk_req_id' => $bulkRequestsId]);
    }

    public function getBulkReqDetails($bulk_req_id)
    {
        $query = "SELECT * FROM $this->table WHERE bulk_req_id = :bulk_req_id";
        $params = [':bulk_req_id' => $bulk_req_id];
        $results = $this->query($query, $params);
        return $results;
    }
}