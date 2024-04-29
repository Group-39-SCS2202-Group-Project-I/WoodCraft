<?php

class BulkOrderDetails extends Model
{
    public $errors = [];
    protected $table = "bulk_order_details";

    protected $allowedColumns = [
        "bulk_req_id",
        "user_id ",
        "type",
        "delivery_cost",
        "delivery_address_id",
        "total_cost",
        "status",
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['bulk_req_id'])) {
            $this->errors['bulk_req_id'] = "Product ID is required";
        }

        if (empty($data['user_id'])) {
            $this->errors['user_id'] = "User ID is required";
        }

        if (empty($data['delivery_cost'])) {
            $this->errors['delivery_cost'] = "Quantity is required";
        }

        if (empty($data['delivery_address_id'])) {
            $this->errors['delivery_address_id'] = "Product ID is required";
        }

        if(empty($this->errors))
		{
			return true;
		}

		return false;
    }

    public function getBulkByRequestId($bulk_req_id){
        $query = "SELECT * FROM $this->table WHERE bulk_req_id = :bulk_req_id";
        $params = [':bulk_req_id' => $bulk_req_id];
        return $this->query($query, $params);
    }

    public function getLastbulkOrderByUserId($userId) {
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1";
        $params = [':user_id' => $userId];
        return $this->query($query, $params);
    }

    public function getBulkOrderById($bulk_order_details_id){
        $query = "SELECT * FROM $this->table WHERE bulk_order_details_id = :bulk_order_details_id";
        $params = [':bulk_order_details_id' => $bulk_order_details_id];
        return $this->query($query, $params);
    }

    public function createBulkOrder($bulkDetails)
    {
        $query = "INSERT INTO $this->table (bulk_req_id, user_id, delivery_cost, delivery_address_id, total_cost, type, status) VALUES (:bulk_req_id, :user_id, :delivery_cost, :delivery_address_id, :total_cost, :type, :status)";
        $params = [
            ':bulk_req_id' => $bulkDetails['bulk_req_id'],
            ':user_id' => $bulkDetails['user_id'],
            ':delivery_cost' => $bulkDetails['delivery_cost'],
            ':delivery_address_id' => $bulkDetails['delivery_address_id'],
            ':total_cost' => $bulkDetails['total'],
            ':type' => $bulkDetails['type'],
            ':status' => 'pending'
        ];
        $this->query($query, $params);
    }

    

    public function updateOrderStatus($bulkOrderDetailsId, $status)
    {
        $query = "UPDATE $this->table SET status = :status WHERE bulk_order_details_id = :bulk_order_details_id";
        return $this->query($query, [':status' => $status, ':bulk_order_details_id' => $bulkOrderDetailsId]);
    }

}