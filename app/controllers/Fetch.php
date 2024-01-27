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

    public function product_inventory($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['product_inventory'] = $db->query("SELECT * FROM product_inventory WHERE product_inventory_id = $id");

            header("Content-Type: application/json");
            echo json_encode($data['product_inventory'][0]);
        } else {
            $db = new Database();
            $data['product_inventories'] = $db->query("SELECT * FROM product_inventory");

            header("Content-Type: application/json");
            echo json_encode($data['product_inventories']);
        }
    }

    public function product_measurement($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['product_measurement'] = $db->query("SELECT * FROM product_measurement WHERE product_measurement_id = $id");

            header("Content-Type: application/json");
            echo json_encode($data['product_measurement'][0]);
        } else {
            $db = new Database();
            $data['product_measurements'] = $db->query("SELECT * FROM product_measurement");

            header("Content-Type: application/json");
            echo json_encode($data['product_measurements']);
        }
    }



    public function product($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['product'] = $db->query("SELECT * FROM product WHERE product_id = $id");

            $product_category_id = $data['product'][0]->product_category_id;
            $data['product_category'] = $db->query("SELECT * FROM product_category WHERE product_category_id = $product_category_id");

            $product_inventory_id = $data['product'][0]->product_inventory_id;
            $data['product_inventory'] = $db->query("SELECT * FROM product_inventory WHERE product_inventory_id = $product_inventory_id");

            $product_measurement_id = $data['product'][0]->product_measurement_id;
            $data['product_measurement'] = $db->query("SELECT * FROM product_measurement WHERE product_measurement_id = $product_measurement_id");

            $product_data = array_merge((array) $data['product'][0], (array) $data['product_category'][0], (array) $data['product_inventory'][0], (array) $data['product_measurement'][0]);

            $product_reviews = $db->query("SELECT * FROM product_review WHERE product_id = $id");
            // customer_id from product_reviews
            if($product_reviews){
                $customer_ids = array_column($product_reviews, 'customer_id');
                $customer_ids = implode(',', $customer_ids);
                $customers = $db->query("SELECT * FROM customer WHERE customer_id IN ($customer_ids)");
                // add customer name to product_reviews
                foreach ($product_reviews as $key => $product_review) {
                    foreach ($customers as $customer) {
                        if ($product_review->customer_id == $customer->customer_id) {
                            $product_reviews[$key]->customer_name = $customer->first_name . ' ' . $customer->last_name;
                        }
                    }
                }
                $product_data['reviews'] = $product_reviews;
            }
            else{
                $product_data['reviews'] = [];
            }

            // 
            $avarage_rating = 0;
            if (count($product_reviews) > 0) {
                $avarage_rating = array_sum(array_column($product_reviews, 'rating')) / count($product_reviews);
            }

            $product_data['avarage_rating'] = $avarage_rating;
            
            header("Content-Type: application/json");
            echo json_encode($product_data);
        } else {
            $db = new Database();
            $data['products'] = $db->query("SELECT * FROM product");

            $product_category_ids = array_column($data['products'], 'product_category_id');
            $product_category_ids = implode(',', $product_category_ids);
            $data['product_categories'] = $db->query("SELECT * FROM product_category WHERE product_category_id IN ($product_category_ids)");


            $product_inventory_ids = array_column($data['products'], 'product_inventory_id');
            $product_inventory_ids = implode(',', $product_inventory_ids);
            $data['product_inventories'] = $db->query("SELECT * FROM product_inventory WHERE product_inventory_id IN ($product_inventory_ids)");

            $product_measurement_ids = array_column($data['products'], 'product_measurement_id');
            $product_measurement_ids = implode(',', $product_measurement_ids);
            $data['product_measurements'] = $db->query("SELECT * FROM product_measurement WHERE product_measurement_id IN ($product_measurement_ids)");

            foreach ($data['products'] as $key => $product) {
                foreach ($data['product_categories'] as $product_category) {
                    if ($product->product_category_id == $product_category->product_category_id) {
                        $data['products'][$key]->category_name = $product_category->category_name;
                    }
                }
                foreach ($data['product_inventories'] as $product_inventory) {
                    if ($product->product_inventory_id == $product_inventory->product_inventory_id) {
                        $data['products'][$key]->quantity = $product_inventory->quantity;
                    }
                }
                foreach ($data['product_measurements'] as $product_measurement) {
                    if ($product->product_measurement_id == $product_measurement->product_measurement_id) {
                        $height = $product_measurement->height;
                        $width = $product_measurement->width;
                        $length = $product_measurement->length;
                        $weight = $product_measurement->weight;
                        $product_measurement->measurement = [
                            'height' => $height,
                            'width' => $width,
                            'length' => $length,
                            'weight' => $weight
                        ];

                        $data['products'][$key]->measurement = $product_measurement->measurement;
                    }
                }
            }

            //product reviews
            $product_ids = array_column($data['products'], 'product_id');
            $product_ids = implode(',', $product_ids);
            $product_reviews = $db->query("SELECT * FROM product_review WHERE product_id IN ($product_ids)");
            
            $data['products'] = array_map(function ($product) use ($product_reviews) {
                $product->reviews = [];
                foreach ($product_reviews as $product_review) {
                    if ($product->product_id == $product_review->product_id) {
                        $product->reviews[] = $product_review;
                    }
                }
                return $product;
            }, $data['products']);

            // show($data['products']);

            // get customer_id from product_reviews
            $customer_ids = array_column($product_reviews, 'customer_id');
            $customer_ids = implode(',', $customer_ids);
            

        
            //map avarage rating of each product to its $data['products']
            $data['products'] = array_map(function ($product) use ($product_reviews) {
                $product->avarage_rating = 0;
                if (count($product->reviews) > 0) {
                    $product->avarage_rating = array_sum(array_column($product->reviews, 'rating')) / count($product->reviews);
                }
                return $product;
            }, $data['products']);

            // show($data['products']);

            $data['products'] = array_map(function ($product) {
                unset($product->reviews);
                return $product;
            }, $data['products']);

            // show($data['products']);

            // get customer_id from product_reviews
            // $customer_ids = array_column($product_reviews, 'customer_id');
            // $customer_ids = implode(',', $customer_ids);
            // $customers = $db->query("SELECT * FROM customer WHERE customer_id IN ($customer_ids)");
            // // add customer name to product_reviews
            // foreach ($data['products'] as $key => $product) {
            //     foreach ($product->reviews as $review_key => $product_review) {
            //         foreach ($customers as $customer) {
            //             if ($product_review->customer_id == $customer->customer_id) {
            //                 $data['products'][$key]->reviews[$review_key]->customer_name = $customer->first_name . ' ' . $customer->last_name;
            //             }
            //         }
            //     }
            // }

            


            // show($data['products']);

            header("Content-Type: application/json");
            echo json_encode($data);
        }
    }

    public function product_images($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['product_images'] = $db->query("SELECT * FROM product_image WHERE product_id = $id");

            header("Content-Type: application/json");
            echo json_encode($data['product_images']);
        } else {
            $db = new Database();
            $data['product_images'] = $db->query("SELECT * FROM product_image");

            header("Content-Type: application/json");
            echo json_encode($data['product_images']);
        }
    }

    public function materials($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['material'] = $db->query("SELECT * FROM material WHERE material_id = $id");

            header("Content-Type: application/json");
            echo json_encode($data['material'][0]);
        } else {
            $db = new Database();
            $data['materials'] = $db->query("SELECT * FROM material");

            header("Content-Type: application/json");
            echo json_encode($data['materials']);
        }
    }

    public function product_materials($id = '')
    {
        if ($id != '') {
            //select all product_materials with product_id = $id

            $db = new Database();
            $data['product_materials'] = $db->query("SELECT * FROM product_material WHERE product_id = $id");

            $material_ids = array_column($data['product_materials'], 'material_id');
            $material_ids = implode(',', $material_ids);
            $data['materials'] = $db->query("SELECT * FROM material WHERE material_id IN ($material_ids)");

            foreach ($data['product_materials'] as $key => $product_material) {
                foreach ($data['materials'] as $material) {
                    if ($product_material->material_id == $material->material_id) {
                        $data['product_materials'][$key]->material_name = $material->material_name;
                        $data['product_materials'][$key]->stock_available = $material->stock_available;
                    }
                }
            }

            header("Content-Type: application/json");
            echo json_encode($data['product_materials']);
        } else {
            $db = new Database();
            $data['product_materials'] = $db->query("SELECT * FROM product_material");

            $material_ids = array_column($data['product_materials'], 'material_id');
            $material_ids = implode(',', $material_ids);
            $data['materials'] = $db->query("SELECT * FROM material WHERE material_id IN ($material_ids)");

            foreach ($data['product_materials'] as $key => $product_material) {
                foreach ($data['materials'] as $material) {
                    if ($product_material->material_id == $material->material_id) {
                        $data['product_materials'][$key]->material_name = $material->material_name;
                    }
                }
            }

            header("Content-Type: application/json");
            echo json_encode($data['product_materials']);
        }
    }

    public function product_material($id = '')
    {
        if ($id != '') {


            $db = new Database();
            $data['product_materials'] = $db->query("SELECT * FROM product_material WHERE product_material_id = $id");

            $material_id = $data['product_materials'][0]->material_id;
            $data['material'] = $db->query("SELECT * FROM material WHERE material_id = $material_id");

            $product_material_data = array_merge((array) $data['product_materials'][0], (array) $data['material'][0]);

            header("Content-Type: application/json");
            echo json_encode($product_material_data);
        }
        else
        {
            $db = new Database();
            $data['product_materials'] = $db->query("SELECT * FROM product_material");

            $material_ids = array_column($data['product_materials'], 'material_id');
            $material_ids = implode(',', $material_ids);
            $data['materials'] = $db->query("SELECT * FROM material WHERE material_id IN ($material_ids)");

            foreach ($data['product_materials'] as $key => $product_material) {
                foreach ($data['materials'] as $material) {
                    if ($product_material->material_id == $material->material_id) {
                        $data['product_materials'][$key]->material_name = $material->material_name;
                    }
                }
            }

            header("Content-Type: application/json");
            echo json_encode($data['product_materials']);
        }
    }

    public function production($id = '')
    {
        if ($id != '') {
            //select all product_materials with product_id = $id

            $db = new Database();
            $data['production'] = $db->query("SELECT * FROM production WHERE production_id = $id");

            $product_id = $data['production'][0]->product_id;
            $data['product'] = $db->query("SELECT * FROM product WHERE product_id = $product_id");

            $production_data = array_merge((array) $data['production'][0], (array) $data['product'][0]);

            header("Content-Type: application/json");
            echo json_encode($production_data);
        } else {
            $db = new Database();
            $data['production'] = $db->query("SELECT * FROM production");

            $product_ids = array_column($data['production'], 'product_id');
            $product_ids = implode(',', $product_ids);
            $data['products'] = $db->query("SELECT * FROM product WHERE product_id IN ($product_ids)");

            foreach ($data['production'] as $key => $production) {
                foreach ($data['products'] as $product) {
                    if ($production->product_id == $product->product_id) {
                        $data['production'][$key]->product_name = $product->name;
                    }
                }
            }

            header("Content-Type: application/json");
            echo json_encode($data['production']);
        }
    }

    public function suppliers($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['supplier'] = $db->query("SELECT * FROM supplier_details WHERE supplier_id = $id");

            $address_id = $data['supplier'][0]->address_id;
            $data['address'] = $db->query("SELECT * FROM address WHERE address_id = $address_id");

            $supplier_data = array_merge((array) $data['supplier'][0], (array) $data['address'][0]);

            header("Content-Type: application/json");
            echo json_encode($supplier_data);
        } else {
            $db = new Database();
            $data['suppliers'] = $db->query("SELECT * FROM supplier_details");

            $address_ids = array_column($data['suppliers'], 'address_id');
            $address_ids = implode(',', $address_ids);
            $data['addresses'] = $db->query("SELECT * FROM address WHERE address_id IN ($address_ids)");

            foreach ($data['suppliers'] as $key => $supplier) {
                foreach ($data['addresses'] as $address) {
                    if ($supplier->address_id == $address->address_id) {
                        $data['suppliers'][$key]->address_line_1 = $address->address_line_1;
                        $data['suppliers'][$key]->address_line_2 = $address->address_line_2;
                        $data['suppliers'][$key]->city = $address->city;
                        $data['suppliers'][$key]->zip_code = $address->zip_code;
                    }
                }
            }

            header("Content-Type: application/json");
            echo json_encode($data['suppliers']);
        }
    }

    public function material_orders($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['material_order'] = $db->query("SELECT * FROM material_order WHERE material_order_id = $id");

            header("Content-Type: application/json");
            echo json_encode($data['material_order'][0]);
        } else {
            $db = new Database();
            $data['material_orders'] = $db->query("SELECT * FROM material_order");

            $material_ids = array_column($data['material_orders'], 'material_id');
            $material_ids = implode(',', $material_ids);
            $materials = $db->query("SELECT * FROM material WHERE material_id IN ($material_ids)");

            $data['material_orders'] = array_map(function ($material_order) use ($materials) {
                foreach ($materials as $material) {
                    if ($material_order->material_id == $material->material_id) {
                        $material_order->material_name = $material->material_name;
                    }
                }
                return $material_order;
            }, $data['material_orders']);

            header("Content-Type: application/json");
            echo json_encode($data['material_orders']);
        }

        
    }

    public function finished_productions($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['finished_production'] = $db->query("SELECT * FROM finished_production WHERE finished_production_id = $id");

            $production_id = $data['finished_production'][0]->production_id;
            $data['production'] = $db->query("SELECT * FROM production WHERE production_id = $production_id");

            $product_id = $data['production'][0]->product_id;
            $data['product'] = $db->query("SELECT * FROM product WHERE product_id = $product_id");

            $finished_production_data = array_merge((array) $data['finished_production'][0], (array) $data['production'][0], (array) $data['product'][0]);

            header("Content-Type: application/json");
            echo json_encode($finished_production_data);
        } else {
            $db = new Database();
            $data['finished_productions'] = $db->query("SELECT * FROM finished_production");

            $production_ids = array_column($data['finished_productions'], 'production_id');
            $production_ids = implode(',', $production_ids);
            $data['productions'] = $db->query("SELECT * FROM production WHERE production_id IN ($production_ids)");

            $product_ids = array_column($data['productions'], 'product_id');
            $product_ids = implode(',', $product_ids);
            $data['products'] = $db->query("SELECT * FROM product WHERE product_id IN ($product_ids)");

            foreach ($data['finished_productions'] as $key => $finished_production) {
                foreach ($data['productions'] as $production) {
                    if ($finished_production->production_id == $production->production_id) {
                        $data['finished_productions'][$key]->product_id = $production->product_id;
                        $data['finished_productions'][$key]->quantity = $production->quantity;
                        $data['finished_productions'][$key]->status = $production->status;
                    }
                }
                foreach ($data['products'] as $product) {
                    if ($finished_production->product_id == $product->product_id) {
                        $data['finished_productions'][$key]->product_name = $product->name;
                    }
                }
            }

            header("Content-Type: application/json");
            echo json_encode($data['finished_productions']);

          

        }
    }

    public function production_workers($production_id = '')
    {
        if ($production_id != '') {
            $db = new Database();
            $data['production_workers'] = $db->query("SELECT * FROM production_worker WHERE production_id = $production_id");

            $worker_ids = array_column($data['production_workers'], 'worker_id');
            $worker_ids = implode(',', $worker_ids);
            $data['workers'] = $db->query("SELECT * FROM worker WHERE worker_id IN ($worker_ids)");

            foreach ($data['production_workers'] as $key => $production_worker) {
                foreach ($data['workers'] as $worker) {
                    if ($production_worker->worker_id == $worker->worker_id) {
                        $data['production_workers'][$key]->first_name = $worker->first_name;
                        $data['production_workers'][$key]->last_name = $worker->last_name;

                    }
                }
            }

            header("Content-Type: application/json");
            echo json_encode($data['production_workers']);
        }

    }

    public function user_cus ()
    {
        $db = new Database();
        $data['users'] = $db->query("SELECT * FROM user WHERE role = 'customer'");

        //sort by created_at desc
        usort($data['users'], function ($a, $b) {
            return $a->created_at < $b->created_at;
        });

        //get current year and month
        $current_year = date('Y');
        $current_month = date('m');

        //get last 6 months with year
        $last_6_months = [];
        for ($i = 0; $i < 6; $i++) {
            $last_6_months[] = date('Y-m', strtotime("-$i month"));
        }
        // show($last_6_months);

        //get number of users registered in last 6 months
        $users_count = [];
        foreach ($last_6_months as $month) {
            $users_count[] = count(array_filter($data['users'], function ($user) use ($month) {
                return date('Y-m', strtotime($user->created_at)) == $month;
            }));
        }
        // show($users_count);

        // append month and year to $users_count
        $users_count = array_combine($last_6_months, $users_count);
        // show($users_count);

        //get month name from month number
        $month_names = [];
        foreach ($users_count as $key => $value) {
            $month_names[] = date('F', strtotime($key));
        }

        // append month name with year to last_6_months then append to $users_count
        $users_count_with_month_year = [];
        foreach ($users_count as $key => $value) {
            $month_year = date('F Y', strtotime($key));
            $users_count_with_month_year[$month_year] = $value;
        }
        // show($users_count_with_month_year);

        // reverse $users_count_with_month_year
        $users_count_with_month_year = array_reverse($users_count_with_month_year);


        header("Content-Type: application/json");
        echo json_encode($users_count_with_month_year);
    }


}


