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

            $url =  $url = ROOT . "/fetch/product_review/$id";
            $response = file_get_contents($url);
            $product_reviews = json_decode($response);
            $product_data['reviews'] = $product_reviews;



            // $count_reviews = $db->query("SELECT COUNT(*) as count FROM product_review WHERE product_id = $id");
            // show($count_reviews);

            // $product_reviews = $db->query("SELECT * FROM product_review WHERE product_id = $id");

            // // customer_id from product_reviews
            // if($product_reviews){
            //     $customer_ids = array_column($product_reviews, 'customer_id');
            //     $customer_ids = implode(',', $customer_ids);
            //     $customers = $db->query("SELECT * FROM customer WHERE customer_id IN ($customer_ids)");
            //     // add customer name to product_reviews
            //     foreach ($product_reviews as $key => $product_review) {
            //         foreach ($customers as $customer) {
            //             if ($product_review->customer_id == $customer->customer_id) {
            //                 $product_reviews[$key]->customer_name = $customer->first_name . ' ' . $customer->last_name;
            //             }
            //         }
            //     }
            //     $product_data['reviews'] = $product_reviews;
            // }
            // else{
            //     $product_data['reviews'] = [];
            // }

            // 
            $avarage_rating = 0;
            if (count($product_reviews) > 0) {
                $avarage_rating = array_sum(array_column($product_reviews, 'rating')) / count($product_reviews);
            }

            $product_data['average_rating'] = $avarage_rating;

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
            // show($data['material_order']);

            // $material_stk = [];
            $material_order_id = $data['material_order'][0]->material_order_id;
            $data['material_stk'] = $db->query("SELECT * FROM material_stk WHERE material_order_id = $material_order_id");

            //  append material_stk to material_order
            $data['material_order'][0]->material_stk = $data['material_stk'];


            header("Content-Type: application/json");
            echo json_encode($data['material_order'][0]);
        } else {
            $db = new Database();
            $data['material_orders'] = $db->query("SELECT * FROM material_order");

            // show($data['material_orders']);

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

            // show($data['material_orders']);

            $material_stks = [];
            if (count($data['material_orders']) > 0) {
                // get material_stk from material_order_id
                $material_order_ids = array_column($data['material_orders'], 'material_order_id');
                $material_order_ids = implode(',', $material_order_ids);

                $material_stks = $db->query("SELECT * FROM material_stk WHERE material_order_id IN ($material_order_ids)");
                // map $material_stks to $data['material_orders']
                $data['material_orders'] = array_map(function ($material_order) use ($material_stks) {
                    $material_order->material_stk = [];
                    foreach ($material_stks as $material_stk) {
                        if ($material_order->material_order_id == $material_stk->material_order_id) {
                            $material_order->material_stk[] = $material_stk;
                        }
                    }
                    return $material_order;
                }, $data['material_orders']);
            }

            // show($data['material_orders']);


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

    public function pxn_worker($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $pxn_worker = $db->query("SELECT * FROM production_worker WHERE worker_id = $id");

            // $production_ids = array_column($pxn_worker, 'production_id');
            header("Content-Type: application/json");
            echo json_encode($pxn_worker);
        }
    }

    public function user_cus()
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

    // 
    public function product_review($product_id)
    {
        $db = new Database();
        $data['product_reviews'] = $db->query("SELECT * FROM product_review WHERE product_id = $product_id");

        if (!$data['product_reviews']) {
            header("Content-Type: application/json");
            echo json_encode([]);
            return;
        }

        $customer_ids = array_column($data['product_reviews'], 'customer_id');
        $customer_ids = implode(',', $customer_ids);
        $data['customers'] = $db->query("SELECT * FROM customer WHERE customer_id IN ($customer_ids)");

        foreach ($data['product_reviews'] as $key => $product_review) {
            foreach ($data['customers'] as $customer) {
                if ($product_review->customer_id == $customer->customer_id) {
                    $data['product_reviews'][$key]->customer_name = $customer->first_name . ' ' . $customer->last_name;
                }
            }
        }

        header("Content-Type: application/json");
        echo json_encode($data['product_reviews']);
    }

    public function material_stk_by_material_id($id)
    {
        $db = new Database();
        $data['material_stk'] = $db->query("SELECT * FROM material_stk WHERE material_id = $id AND quantity > 0");

        header("Content-Type: application/json");
        echo json_encode($data['material_stk']);
    }


    public function material_stk($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['material_stk'] = $db->query("SELECT * FROM material_stk WHERE stock_no = $id");

            header("Content-Type: application/json");
            echo json_encode($data['material_stk'][0]);
        } else {
            $db = new Database();
            $data['material_stk'] = $db->query("SELECT * FROM material_stk");

            header("Content-Type: application/json");
            echo json_encode($data['material_stk']);
        }
    }
    // {
    //     $db = new Database();
    //     $data['material_stk'] = $db->query("SELECT * FROM material_stk");

    //     header("Content-Type: application/json");
    //     echo json_encode($data['material_stk']);
    // }



    public function production_material($production_id)
    {
        $db = new Database();
        $data['production_materials'] = $db->query("SELECT * FROM production_material WHERE production_id = $production_id");

        $production_material_ids = array_column($data['production_materials'], 'production_material_id');
        $production_material_ids = implode(',', $production_material_ids);

        // show($production_material_ids);

        // get stock_no from production_materials
        $stock_nos = array_column($data['production_materials'], 'stock_no');
        $stock_nos = implode(',', $stock_nos);
        // show($stock_nos);

        $data['material_stk'] = $db->query("SELECT * FROM material_stk WHERE stock_no IN ($stock_nos)");

        // show($stock_nos);

        // // map production materials and material_stk by stock_no
        $data['production_materials'] = array_map(function ($production_material) use ($data) {
            foreach ($data['material_stk'] as $material_stk) {
                if ($production_material->stock_no == $material_stk->stock_no) {
                    $production_material->material_id = $material_stk->material_id;
                    $db = new Database();
                    $query = "SELECT * FROM material WHERE material_id = $material_stk->material_id";
                    $material = $db->query($query);
                    $production_material->material_name = $material[0]->material_name;
                }
            }
            return $production_material;
        }, $data['production_materials']);
        // show($stock_nos);



        // get price per unit from material_stk and map to production_materials by stock_no
        $data['production_materials'] = array_map(function ($production_material) use ($data) {
            foreach ($data['material_stk'] as $material_stk) {
                if ($production_material->stock_no == $material_stk->stock_no) {
                    $production_material->price_per_unit = $material_stk->price_per_unit;
                }
            }
            return $production_material;
        }, $data['production_materials']);

        // production_material cost
        $data['production_materials'] = array_map(function ($production_material) {
            $production_material->cost = $production_material->price_per_unit * $production_material->quantity;
            return $production_material;
        }, $data['production_materials']);

        // drop production material if quantity is 0
        $data['production_materials'] = array_filter($data['production_materials'], function ($production_material) {
            return $production_material->quantity > 0;
        });

        // show($data['production_materials']);

        $result = [];
        foreach ($data['production_materials'] as $key => $object) {
            $result[$key] = (array)$object;
        }
        $result = array_values($result);
        // show($result);

        header("Content-Type: application/json");
        echo json_encode($result);
    }

    public function chat($id = '')
    {
        if ($id != '') {
            $db = new Database();
            $data['chat'] = $db->query("SELECT * FROM chat WHERE chat_id = $id");

            header("Content-Type: application/json");
            echo json_encode($data['chat'][0]);
        } else {
            $db = new Database();
            $data['chat'] = $db->query("SELECT * FROM chat");

            header("Content-Type: application/json");
            echo json_encode($data['chat']);
        }
    }

    public function chat_rec_all()
    {
        $db = new Database();
        $data['chat_records'] = $db->query("SELECT * FROM chat_records");

        header("Content-Type: application/json");
        echo json_encode($data['chat_records']);
    }

    public function chat_by_cus_id($id)
    {
        $db = new Database();
        $data['chat'] = $db->query("SELECT * FROM chat WHERE customer_user_id = $id");

        header("Content-Type: application/json");
        echo json_encode($data['chat'][0]);
    }

    public function chat_records($id)
    {
        $db = new Database();
        $data['chat'] = $db->query("SELECT * FROM chat_records WHERE connection = $id");

        header("Content-Type: application/json");
        echo json_encode($data['chat']);
    }

    public function last_chat_record_id()
    {
        $db = new Database();
        $data['chat'] = $db->query("SELECT * FROM chat_records ORDER BY chat_rec_id DESC LIMIT 1");

        $chat_rec_id = $data['chat'][0]->chat_rec_id;

        header("Content-Type: application/json");
        echo json_encode($chat_rec_id);
    }

    public function inquiry_list()
    {
        $db = new Database();
        $data['chat_records'] = $db->query("SELECT * FROM chat_records");
        // show($data['chat_records']);

        // get last chat record for each connection 
        $last_chat_records = [];
        foreach ($data['chat_records'] as $chat_record) {
            $last_chat_records[$chat_record->connection] = $chat_record;
        }
        // show($last_chat_records);

        $data['chat'] = $db->query("SELECT * FROM chat");
        // show($data['chat']);

        // map chat to last_chat_record  by connection==chat_id
        $last_chat_records = array_map(function ($last_chat_record) use ($data) {
            foreach ($data['chat'] as $chat) {
                if ($last_chat_record->connection == $chat->chat_id) {
                    $last_chat_record->cus_name = $chat->cus_name;
                    $last_chat_record->customer_user_id = $chat->customer_user_id;
                }
            }
            return $last_chat_record;
        }, $last_chat_records);

        // show($last_chat_records);
        foreach ($last_chat_records as $last_chat_record) {
            if ($last_chat_record->customer_user_id == $last_chat_record->sent_by) {
                $last_chat_record->resp = 0;
            } else {
                $last_chat_record->resp = 1;
            }
        }

        // show($last_chat_records);

        // responded chats 
        $responded_chats = array_filter($last_chat_records, function ($last_chat_record) {
            return $last_chat_record->resp == 1;
        });

        // show($responded_chats);
        // sort $responded_chats by created_at desc
        usort($responded_chats, function ($a, $b) {
            return $a->created_at < $b->created_at;
        });



        // unresponded chats
        $unresponded_chats = array_filter($last_chat_records, function ($last_chat_record) {
            return $last_chat_record->resp == 0;
        });

        usort($unresponded_chats, function ($a, $b) {
            return $a->created_at < $b->created_at;
        });

        // merge unresponded and responded chats
        $x = array_merge($unresponded_chats, $responded_chats);

        // show($x);


        header("Content-Type: application/json");
        echo json_encode($x);
    }
}
