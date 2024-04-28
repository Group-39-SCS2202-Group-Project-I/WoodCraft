<?php

/**
 * users model
 */
class Address extends Model
{

    public $errors = [];
    protected $table = "address";

    protected $allowedColumns = [
        "address_line_1",
        "address_line_2",
        "city",
        "province",
        "zip_code"
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['address_line_1'])) {
            $this->errors['address_line_1'] = "Address line 1 is required";
        }
        // if(empty($data['address_line_2']))
        // {
        //     $this->errors['address_line_2'] = "Address line 2 is required";
        // }
        if (empty($data['city'])) {
            $this->errors['city'] = "City is required";
        }
        if (empty($data['zip_code'])) {
            $this->errors['zip_code'] = "Zip code is required";
        } else if (!is_numeric($data['zip_code'])) {
            $this->errors['zip_code'] = "Zip code must be numeric";
        } else if (strlen($data['zip_code']) != 5) {
            $this->errors['zip_code'] = "Zip code must be 5 digits";
        }

        if (empty($data['province'])) {
            $this->errors['province'] = "Province is required";
        }


        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function getAddressByAddressId($addressId)
    {
        $address = $this->select($this->table, 'address_id = ?', [$addressId])[0] ?? null;
        return $address;
    }

    public function getAddressByCustomerId($customerId)
    {
        $db = new Database();

        // Fetch the customer's address_id from the customer table
        $customerAddressId = $db->select('customer', 'customer_id = ?', [$customerId])[0]->address_id;

        // Fetch the address using the retrieved address_id
        $address = $db->select($this->table, 'address_id = ?', [$customerAddressId])[0] ?? null;

        return $address;
    }

    public function saveAddressD($addressData)
    {

        // Validate the address data
        if (!$this->validate($addressData)) {
            return false; // Address data is not valid
        }
        // show($addressData);

        // Prepare the query to insert data into the address table
        $query = "INSERT INTO {$this->table} (";
        $query .= implode(', ', array_keys($addressData)); // Columns
        $query .= ") VALUES (";
        $query .= implode(', ', array_map(function ($value) {
            return ':' . $value;
        }, array_keys($addressData))); // Parameter placeholders
        $query .= ")";

        try {
            // Execute the query
            $this->query($query, $addressData);
        } catch (Exception $e) {
            // Log the exception for debugging
            error_log('Error saving address: ' . $e->getMessage());
            return false;
        }
    }

    public function getLastAddressIdByAddress($addressData)
    {
        $query = "
                SELECT
                    address_id
                FROM
                    address
                WHERE
                    address_line_1 = :address_line_1 AND
                    address_line_2 = :address_line_2 AND
                    city = :city AND
                    province = :province AND
                    zip_code = :zip_code
                ORDER BY
                    address_id DESC
                LIMIT 1
            ";
        $params = [
            ':address_line_1' => $addressData['address_line_1'],
            ':address_line_2' => $addressData['address_line_2'],
            ':city' => $addressData['city'],
            ':province' => $addressData['province'],
            ':zip_code' => $addressData['zip_code']
        ];
        $result = $this->query($query, $params);

        // show($result);


        if ($result) {
            // Address exists, return the last address ID
            $lastAddressId = $result[0]->address_id;
            // echo "Last Address ID: $lastAddressId";

            return $lastAddressId;
        } else {
            // Address does not exist, return 0
            echo "Address does not exist";
        }
    }
}
