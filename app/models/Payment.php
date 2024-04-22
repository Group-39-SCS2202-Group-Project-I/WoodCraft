<?php

class Payment extends Model
{
    public $errors = [];

    protected $table = "payment";

    protected $allowedColumns = [
        "order_details_id 	status",
        " 	amount",
        " 	provider",
        " 	status"
    ];
    protected $allowedColumns = [
        "cid",
        "quantity",
        "amount",
        "orderStatus",
        "createdOn"
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['cid'])) {
            $this->errors['cid'] = "Customer ID is required";
        }

        if (empty($data['quantity'])) {
            $this->errors['quantity'] = "Quantity is required";
        } else if (!is_numeric($data['quantity'])) {
            $this->errors['quantity'] = "Quantity must be numeric";
        }

        if (empty($data['amount'])) {
            $this->errors['amount'] = "Amount is required";
        } else if (!is_numeric($data['amount'])) {
            $this->errors['amount'] = "Amount must be numeric";
        }

        if (empty($data['orderStatus'])) {
            $this->errors['orderStatus'] = "Order status is required";
        }

        if (empty($data['createdOn'])) {
            $this->errors['createdOn'] = "Created date is required";
        } else if (!strtotime($data['createdOn'])) {
            $this->errors['createdOn'] = "Invalid created date format";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    // public function getOrderStatusById($statusId)
    // {
    //     switch ($statusId) {
    //         case 0:
    //             return 'Initiated';
    //         case 1:
    //             return 'Success';
    //         case 2:
    //             return 'Aborted';
    //         case 3:
    //             return 'Failed';
    //         default:
    //             return 'Unknown';
    //     }
    // }
}
