<?php

class Fetch extends Controller
{

    public function index()
    {
        $data['title'] = "FetchApi";
    }

    public function customers($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['customer'] = $db->query("SELECT * FROM customer WHERE customer_id = $id");

            $address_id = $data['customer'][0]->address_id;
            $data['address'] = $db->query("SELECT * FROM address WHERE address_id = $address_id");

            $user_id = $data['customer'][0]->user_id;
            $data['user'] = $db->query("SELECT * FROM user WHERE user_id = $user_id");

            $cus_data = array_merge((array) $data['customer'][0], (array) $data['address'][0], (array) $data['user'][0]);

            header("Content-Type: application/json");
            echo json_encode($cus_data);
        } else {
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
    }

    public function workers($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['worker'] = $db->query("SELECT * FROM worker WHERE worker_id = $id");

            $address_id = $data['worker'][0]->address_id;
            $data['address'] = $db->query("SELECT * FROM address WHERE address_id = $address_id");

            $worker_data = array_merge((array) $data['worker'][0], (array) $data['address'][0]);

            header("Content-Type: application/json");
            echo json_encode($worker_data);
        } else {
            $db = new Database();
            $data['workers'] = $db->query("SELECT * FROM worker");

            $address_ids = array_column($data['workers'], 'address_id');
            $address_ids = implode(',', $address_ids);
            $data['addresses'] = $db->query("SELECT * FROM address WHERE address_id IN ($address_ids)");

            foreach ($data['workers'] as $key => $worker) {
                foreach ($data['addresses'] as $address) {
                    if ($worker->address_id == $address->address_id) {
                        $data['workers'][$key]->address_line_1 = $address->address_line_1;
                        $data['workers'][$key]->address_line_2 = $address->address_line_2;
                        $data['workers'][$key]->city = $address->city;
                        $data['workers'][$key]->zip_code = $address->zip_code;
                    }
                }
            }

            // sort ($data['workers']) desc order by updated_at;
            usort($data['workers'], function ($a, $b) {
                return $a->updated_at < $b->updated_at;
            });

            header("Content-Type: application/json");
            echo json_encode($data['workers']);
        }
    }

    public function staff($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['staff'] = $db->query("SELECT * FROM staff WHERE staff_id = $id");

            $address_id = $data['staff'][0]->address_id;
            $data['address'] = $db->query("SELECT * FROM address WHERE address_id = $address_id");

            $user_id = $data['staff'][0]->user_id;
            $data['user'] = $db->query("SELECT * FROM user WHERE user_id = $user_id");

            $staff_data = array_merge((array) $data['staff'][0], (array) $data['address'][0], (array) $data['user'][0]);

            header("Content-Type: application/json");
            echo json_encode($staff_data);
        } else {
            $db = new Database();
            $data['staff'] = $db->query("SELECT * FROM staff");

            $user_ids = array_column($data['staff'], 'user_id');
            $user_ids = implode(',', $user_ids);
            $data['users'] = $db->query("SELECT * FROM user WHERE user_id IN ($user_ids)");

            $address_ids = array_column($data['staff'], 'address_id');
            $address_ids = implode(',', $address_ids);
            $data['addresses'] = $db->query("SELECT * FROM address WHERE address_id IN ($address_ids)");

            foreach ($data['staff'] as $key => $staff) {
                foreach ($data['users'] as $user) {
                    if ($staff->user_id == $user->user_id) {
                        $data['staff'][$key]->email = $user->email;
                        $data['staff'][$key]->role = $user->role;
                    }
                }
                foreach ($data['addresses'] as $address) {
                    if ($staff->address_id == $address->address_id) {
                        $data['staff'][$key]->address_line_1 = $address->address_line_1;
                        $data['staff'][$key]->address_line_2 = $address->address_line_2;
                        $data['staff'][$key]->city = $address->city;
                        $data['staff'][$key]->zip_code = $address->zip_code;
                    }
                }
            }

            header("Content-Type: application/json");
            echo json_encode($data['staff']);
        }
    }

    public function product_categories($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['product_category'] = $db->query("SELECT * FROM product_category WHERE product_category_id = $id");

            header("Content-Type: application/json");
            echo json_encode($data['product_category'][0]);
        } else {
            $db = new Database();
            $data['product_categories'] = $db->query("SELECT * FROM product_category");

            header("Content-Type: application/json");
            echo json_encode($data['product_categories']);
        }
    }
}