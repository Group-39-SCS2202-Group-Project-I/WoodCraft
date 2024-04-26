<?php

class OrderDetails extends Model
{
    public $errors = [];
    protected $table = "order_details";

    protected $allowedColumns = [
        "user_id",
        "delivery_cost",
        "total",
        "type",
        "status",
        "delivery_address_id",
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['user_id'])) {
            $this->errors['user_id'] = "User ID is required";
        } else if (!is_numeric($data['user_id'])) {
            $this->errors['user_id'] = "User ID must be a numeric value";
        }

        if (empty($data['delivery_cost'])) {
            $this->errors['delivery_cost'] = "Delivery cost is required";
        } else if (!is_numeric($data['delivery_cost'])) {
            $this->errors['delivery_cost'] = "Delivery cost must be a numeric value";
        }

        if (empty($data['total'])) {
            $this->errors['total'] = "Total amount is required";
        } else if (!is_numeric($data['total'])) {
            $this->errors['total'] = "Total amount must be a numeric value";
        }

        if (empty($data['type'])) {
            $this->errors['type'] = "Order type is required";
        }

        if (empty($data['status'])) {
            $this->errors['status'] = "Order status is required";
        }

        if (empty($data['payment_id'])) {
            $this->errors['payment_id'] = "Payment ID is required";
        } else if (!is_numeric($data['payment_id'])) {
            $this->errors['payment_id'] = "Payment ID must be a numeric value";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function getByOrderDetailsId($orderDetailsId)
    {
        return $this->select($this->table, 'order_details_id = :order_details_id', [':order_details_id' => $orderDetailsId]);
    }

    public function getOrderByUserId($userId)
    {
        return $this->select($this->table, 'user_id = :user_id', [':user_id' => $userId]);
    }

    public function getLastOrderByUserId($userId)
{
    $query = "SELECT * FROM $this->table WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1";
    $params = [':user_id' => $userId];
    return $this->query($query, $params);
}

    public function createOrder($data)
    {
        $userId = Auth::getUserId();

        $params = [
            ':user_id' => $userId,
            ':delivery_cost' => $data->delivery_cost,
            ':total' => $data->total,
            ':type' => $data->type,
            ':status' => 'pending',
            ':delivery_address_id' => $data->delivery_address_id,
            ':created_at' => date('Y-m-d H:i:s'),
            ':updated_at' => date('Y-m-d H:i:s')
        ];

        $query = "INSERT INTO $this->table (user_id, delivery_cost, total, type, status, delivery_address_id, created_at, updated_at) VALUES (:user_id, :delivery_cost, :total, :type, :status, :delivery_address_id, :created_at, :updated_at)";
        $this->query($query, $params);
    }

    public function updateOrderDetails($orderDetailsId, $data)
    {
        $setValues = [];
        foreach ($data as $key => $value) {
            if (in_array($key, $this->allowedColumns)) {
                $setValues[] = "$key = :$key";
            }
        }
        $setValuesStr = implode(", ", $setValues);

        $query = "UPDATE $this->table SET $setValuesStr WHERE order_details_id = :order_details_id";
        $data['order_details_id'] = $orderDetailsId;

        return $this->query($query, $data);
    }

    public function updateOrderStatus($orderDetailsId, $status)
    {
        $query = "UPDATE $this->table SET status = :status WHERE order_details_id = :order_details_id";
        return $this->query($query, [':status' => $status, ':order_details_id' => $orderDetailsId]);
    }

    public function deleteOrderDetails($orderDetailsId)
    {
        $query = "DELETE FROM $this->table WHERE order_details_id = :order_details_id";
        return $this->query($query, [':order_details_id' => $orderDetailsId]);
    }
}