<?php

class Payment extends Model
{
    public $errors = [];

    protected $table = "payment";

    protected $allowedColumns = [
        "amount",
        "provider",
        "status"
    ];
    public function validate($data)
    {
        $this->errors = [];
        
        if (empty($data['amount'])) {
            $this->errors['amount'] = "Amount is required";
        } else if (!is_numeric($data['amount'])) {
            $this->errors['amount'] = "Amount must be numeric";
        }
        
        if (empty($data['provider'])) {
            $this->errors['provider'] = "Provider is required";
        }
     
        if (empty($data['status'])) {
            $this->errors['status'] = "Status is required";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function getPaymentsByUserId($orderDetailsId)
    {
        $result = $this->select($this->table, "payment_id IN (SELECT payment_id FROM order_details WHERE order_details_id = :order_details_id)",[":order_details_id" => $orderDetailsId]);

        return $result;
    }

    public function addPayment($data)
    {
        $query = "INSERT INTO payment (order_details_id, amount, provider, status, created_at, updated_at) VALUES (:order_details_id, :amount, :provider, :status, :created_at, :updated_at)";
        $params = [
            ":order_details_id" => $data['order_details_id'],
            ":amount" => $data['amount'],
            ":provider" => $data['provider'],
            ":status" => $data['status'],
            ':created_at' => date('Y-m-d H:i:s'),
            ':updated_at' => date('Y-m-d H:i:s')
        ];
        $this->query($query, $params);
    }

    public function addBulkPayment($data)
    {
        $query = "INSERT INTO payment (bulk_order_details_id, amount, provider, status, created_at, updated_at) VALUES (:bulk_order_details_id, :amount, :provider, :status, :created_at, :updated_at)";
        $params = [
            ":bulk_order_details_id" => $data['bulk_order_details_id'],
            ":amount" => $data['amount'],
            ":provider" => $data['provider'],
            ":status" => $data['status'],
            ':created_at' => date('Y-m-d H:i:s'),
            ':updated_at' => date('Y-m-d H:i:s')
        ];
        $this->query($query, $params);
    }

    // public function updatePayment($data, $id)
    // {
    //     $query = "UPDATE payment SET  amount = :amount, provider = :provider, status = :status WHERE payment_id = :payment_id";
    //     $params = [
    //         ":amount" => $data['amount'],
    //         ":provider" => $data['provider'],
    //         ":status" => $data['status'],
    //         ":payment_id" => $id
    //     ];
    //     $this->query($query, $params);
    // }

    // public function deletePayment($id)
    // {
    //     $query = "DELETE FROM payment WHERE payment_id = :payment_id";
    //     $params = [":payment_id" => $id];
    //     $this->query($query, $params);
    // }
}
