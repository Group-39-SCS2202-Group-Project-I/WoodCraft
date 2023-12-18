<?php

class Fetch extends Controller
{

    public function index()
    {
        $data['title'] = "FetchApi";
    }

    public function customers()
    {
        $db = new Database();
        $data['customers'] = $db->query("SELECT * FROM customer");

        $user_ids = array_column($data['customers'], 'user_id');
        $user_ids = implode(',', $user_ids);
        $data['users'] = $db->query("SELECT * FROM user WHERE user_id IN ($user_ids)");

        $address_ids = array_column($data['customers'], 'address_id');
        $address_ids = implode(',', $address_ids);
        $data['addresses'] = $db->query("SELECT * FROM address WHERE address_id IN ($address_ids)");

        foreach ($data['customers'] as $key => $customer) {
            foreach ($data['users'] as $user) {
                if ($customer->user_id == $user->user_id) {
                    $data['customers'][$key]->email = $user->email;
                    $data['customers'][$key]->role = $user->role;
                }
            }
            foreach ($data['addresses'] as $address) {
                if ($customer->address_id == $address->address_id) {
                    $data['customers'][$key]->address_line_1 = $address->address_line_1;
                    $data['customers'][$key]->address_line_2 = $address->address_line_2;
                    $data['customers'][$key]->city = $address->city;
                    $data['customers'][$key]->zip_code = $address->zip_code;
                }
            }
        }

        header("Content-Type: application/json");
        echo json_encode($data['customers']);
    }

    public function customer($id)
    {
        $db = new Database();
        $data['customer'] = $db->query("SELECT * FROM customer WHERE customer_id = $id");

        $address_id = $data['customer'][0]->address_id;
        $data['address'] = $db->query("SELECT * FROM address WHERE address_id = $address_id");

        $user_id = $data['customer'][0]->user_id;
        $data['user'] = $db->query("SELECT * FROM user WHERE user_id = $user_id");

        $cus_data = array_merge((array) $data['customer'][0], (array) $data['address'][0], (array) $data['user'][0]);

        header("Content-Type: application/json");
        echo json_encode($cus_data);
    }
}
