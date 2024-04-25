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
                        $data['customers'][$key]->province = $address->province;
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
                        $data['workers'][$key]->province = $address->province;
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
                        $data['staff'][$key]->province = $address->province;
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


            // $avarage_rating = 0;
            // if (count($product_reviews) > 0) {
            //     $avarage_rating = array_sum(array_column($product_reviews, 'rating')) / count($product_reviews);
            // }

            // $product_data['average_rating'] = $avarage_rating;

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

    // public function product_category_images($id = '')
    // {
    //     if ($id != '') {
    //         $db = new Database();
    //         $data['product_category_images'] = $db->query("SELECT product_category_img FROM product_category WHERE product_category_id = $id");

    //         header("Content-Type: application/json");
    //         echo json_encode($data['product_category_images']);
    //     } else {
    //         $db = new Database();
    //         $data['product_category_images'] = $db->query("SELECT product_category_img FROM product_category");

    //         header("Content-Type: application/json");
    //         echo json_encode($data['product_category_images']);
    //     }
    // }

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

            $product_category_id = $data['product'][0]->product_category_id;
            $cat_name = $db->query("SELECT category_name FROM product_category WHERE product_category_id = $product_category_id");
            $production_data['category_name'] = $cat_name[0]->category_name;


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
                        $data['production_workers'][$key]->worker_role = $worker->worker_role;
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

    public function product_rating($product_id)
    {
        $db = new Database();
        $data = $db->query("SELECT * FROM product_rating WHERE product_id = $product_id");

        $product_rating = array_merge((array) $data[0]);

        if (!$data) {
            header("Content-Type: application/json");
            echo json_encode('');
            return;
        }

        header("Content-Type: application/json");
        echo json_encode($product_rating);
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

    public function products_count()
    {
        $db = new Database();
        $data['products'] = $db->query("SELECT * FROM product");

        $count = count($data['products']);

        header("Content-Type: application/json");
        echo json_encode($count);
    }

    public function ongoing_pxn_count()
    {
        $db = new Database();
        $data['production'] = $db->query("SELECT * FROM production WHERE status = 'processing'");

        $count = count($data['production']);

        header("Content-Type: application/json");
        echo json_encode($count);
    }

    public function new_bulk_req()
    {
        $db = new Database();
        $newBulkRequests = $db->query("SELECT * FROM bulk_order_req WHERE status = 'new'");

        foreach ($newBulkRequests as $key => $newBulkRequest) {
            $product_id = $newBulkRequest->product_id;
            $product = $db->query("SELECT * FROM product WHERE product_id = $product_id");
            $newBulkRequests[$key]->product_name = $product[0]->name;
            $cat_id = $product[0]->product_category_id;
            $category = $db->query("SELECT * FROM product_category WHERE product_category_id = $cat_id");
            $newBulkRequests[$key]->category_name = $category[0]->category_name;
            $user_id = $newBulkRequest->user_id;
            $customer = $db->query("SELECT * FROM customer WHERE user_id = $user_id");
            $newBulkRequests[$key]->customer_id = $customer[0]->customer_id;




            $piid = $product[0]->product_inventory_id;

            $quantity_available = $db->query("SELECT quantity FROM product_inventory WHERE product_inventory_id = $piid");
            $newBulkRequests[$key]->quantity_available = $quantity_available[0]->quantity;
        }

        header("Content-Type: application/json");
        echo json_encode($newBulkRequests);
    }

    public function bulk_req()
    {
        $db = new Database();
        $bulkReq = $db->query("SELECT * FROM bulk_order_req WHERE status != 'new'");

        foreach ($bulkReq as $key => $newBulkRequest) {
            $product_id = $newBulkRequest->product_id;
            $product = $db->query("SELECT * FROM product WHERE product_id = $product_id");
            $bulkReq[$key]->product_name = $product[0]->name;
            $cat_id = $product[0]->product_category_id;
            $category = $db->query("SELECT * FROM product_category WHERE product_category_id = $cat_id");
            $bulkReq[$key]->category_name = $category[0]->category_name;

            $user_id = $newBulkRequest->user_id;
            $customer = $db->query("SELECT * FROM customer WHERE user_id = $user_id");
            $bulkReq[$key]->customer_id = $customer[0]->customer_id;



            // $piid = $product[0]->product_inventory_id;

            // $quantity_available = $db->query("SELECT quantity FROM product_inventory WHERE product_inventory_id = $piid");
            // $newBulkRequests[$key]->quantity_available = $quantity_available[0]->quantity;
        }

        header("Content-Type: application/json");
        echo json_encode($bulkReq);
    }

    public function bulk_req_by_id($id)
    {
        $db = new Database();
        $bulkReq = $db->query("SELECT * FROM bulk_order_req WHERE bulk_req_id = $id");

        $product_id = $bulkReq[0]->product_id;
        $product = $db->query("SELECT * FROM product WHERE product_id = $product_id");
        $bulkReq[0]->product_name = $product[0]->name;
        $bulkReq[0]->product_description = $product[0]->description;
        $bulkReq[0]->product_price = $product[0]->price;

        $product_inventory_id = $product[0]->product_inventory_id;
        $product_inventory = $db->query("SELECT * FROM product_inventory WHERE product_inventory_id = $product_inventory_id");
        $bulkReq[0]->quantity_available = $product_inventory[0]->quantity;

        $cat_id = $product[0]->product_category_id;
        $category = $db->query("SELECT * FROM product_category WHERE product_category_id = $cat_id");
        $bulkReq[0]->category_name = $category[0]->category_name;

        $user_id = $bulkReq[0]->user_id;
        $customer = $db->query("SELECT * FROM customer WHERE user_id = $user_id");
        $bulkReq[0]->customer_id = $customer[0]->customer_id;
        $bulkReq[0]->customer_name = ucfirst($customer[0]->first_name) . ' ' . ucfirst($customer[0]->last_name);

        $bulkReq[0]->customer_email = $db->query("SELECT email FROM user WHERE user_id = $user_id")[0]->email;




        header("Content-Type: application/json");
        echo json_encode($bulkReq[0]);
    }

    public function completed_retail_orders()
    {
        $db = new Database();
        $cro = "SELECT * FROM order_details WHERE  status = 'completed'";
        $retail_orders = $db->query($cro);

        foreach ($retail_orders as $retail) {
            $user_id = $retail->user_id;
            $customer_name = "SELECT first_name,last_name FROM customer WHERE user_id = $user_id";
            $x = $db->query($customer_name)[0];
            $retail->customer_name = ucfirst($x->first_name) . " " . ucfirst($x->last_name);

            $items = "SELECT product_id,quantity FROM order_item WHERE order_details_id = $retail->order_details_id";
            $y = $db->query($items);
            foreach ($y as $item) {
                $product = "SELECT * FROM product WHERE product_id = $item->product_id";
                $z = $db->query($product)[0];
                $item->product_name = $z->name;
                $item->price = $z->price;

                $product_category_id = $z->product_category_id;
                $category_name = "SELECT category_name FROM product_category WHERE product_category_id = $product_category_id";
                $p = $db->query($category_name)[0];
                $item->category_name = $p->category_name;
            }
            $retail->items = $y;
        }

        header("Content-Type: application/json");
        echo json_encode($retail_orders);
    }

    public function completed_bulk_orders()
    {
        $db = new Database();
        $cbo = "SELECT * FROM bulk_order_details WHERE  status = 'completed'";
        $bulk_orders = $db->query($cbo);

        foreach ($bulk_orders as $bulk) {
            $user_id = $bulk->user_id;
            $customer_name = "SELECT first_name,last_name FROM customer WHERE user_id = $user_id";
            $x = $db->query($customer_name)[0];
            $bulk->customer_name = ucfirst($x->first_name) . " " . ucfirst($x->last_name);

            $bulk_req = "SELECT * FROM bulk_order_req WHERE bulk_req_id = $bulk->bulk_req_id";
            $x = $db->query($bulk_req)[0];
            $product_name = "SELECT name FROM product WHERE product_id = $x->product_id";
            $y = $db->query($product_name)[0];
            $x->product_name = $y->name;

            $product_inventory_id = "SELECT product_inventory_id FROM product WHERE product_id = $x->product_id";
            $y = $db->query($product_inventory_id)[0];
            $quantity_available = "SELECT quantity FROM product_inventory WHERE product_inventory_id = $y->product_inventory_id";
            $z = $db->query($quantity_available)[0];
            $x->quantity_available = $z->quantity;
            $x->product_inventory_id = $y->product_inventory_id;

            $product_category_id = "SELECT product_category_id FROM product WHERE product_id = $x->product_id";
            $z = $db->query($product_category_id)[0];
            $category_name = "SELECT category_name FROM product_category WHERE product_category_id = $z->product_category_id";
            $a = $db->query($category_name)[0];
            $x->category_name = $a->category_name;
            $bulk->bulk_req = $x;
        }

        header("Content-Type: application/json");
        echo json_encode($bulk_orders);
    }

    public function pxn_bulk_orders($id = '')
    {
        $db = new Database();
        $cbo = "SELECT * FROM bulk_order_details WHERE  status = 'pending'";
        $bulk_orders = $db->query($cbo);

        foreach ($bulk_orders as $b) {
            $user_id = $b->user_id;
            $customer_name = "SELECT first_name,last_name FROM customer WHERE user_id = $user_id";
            $x = $db->query($customer_name)[0];
            $b->customer_name = ucfirst($x->first_name) . " " . ucfirst($x->last_name);

            $bulk_req = "SELECT * FROM bulk_order_req WHERE bulk_req_id = $b->bulk_req_id";
            $x = $db->query($bulk_req)[0];
            $product_name = "SELECT name FROM product WHERE product_id = $x->product_id";
            $y = $db->query($product_name)[0];
            $x->product_name = $y->name;

            $product_inventory_id = "SELECT product_inventory_id FROM product WHERE product_id = $x->product_id";
            $y = $db->query($product_inventory_id)[0];
            $quantity_available = "SELECT quantity FROM product_inventory WHERE product_inventory_id = $y->product_inventory_id";
            $z = $db->query($quantity_available)[0];
            $x->quantity_available = $z->quantity;
            $x->product_inventory_id = $y->product_inventory_id;

            $product_category_id = "SELECT product_category_id FROM product WHERE product_id = $x->product_id";
            $z = $db->query($product_category_id)[0];
            $category_name = "SELECT category_name FROM product_category WHERE product_category_id = $z->product_category_id";
            $a = $db->query($category_name)[0];
            $x->category_name = $a->category_name;
            $b->bulk_req = $x;

            $product_meterials = "SELECT * FROM product_material WHERE product_id = $x->product_id";
            $x = $db->query($product_meterials);
            $b->product_materials = $x;

            $missing_materials = [];

            foreach ($x as $p) {
                $material_id = $p->material_id;
                $z = "SELECT material_name,stock_available FROM material WHERE material_id = $material_id";
                $y = $db->query($z)[0];
                $p->material_name = $y->material_name;
                $p->stock_available = $y->stock_available;

                if ($p->stock_available < $b->bulk_req->quantity * $p->quantity_needed) {
                    $missing_materials[] = [
                        'material_name' => $p->material_name,
                        'missing_qty' => ($b->bulk_req->quantity * $p->quantity_needed) - $p->stock_available,
                        'material_id' => $p->material_id
                    ];
                }
            }
            $b->missing_materials = $missing_materials;
            $b->missing_materials_count = count($missing_materials);
        }

        if ($id == '') {
            header("Content-Type: application/json");
            echo json_encode($bulk_orders);
        } else {
            // get $b , $b->bulk_order_details_id = $id
            $b = array_filter($bulk_orders, function ($bulk_order) use ($id) {
                return $bulk_order->bulk_order_details_id == $id;
            });
            $b = array_values($b)[0];

            header("Content-Type: application/json");
            echo json_encode($b);
        }
    }

    public function pxn_missing($id)
    {
        $url = ROOT . '/fetch/pxn_bulk_orders/' . $id;
        $data = json_decode(file_get_contents($url), true);
        $missing_materials = $data['missing_materials'];

        header("Content-Type: application/json");
        echo json_encode($missing_materials);
    }

    public function blk_chart()
    {
        $db = new Database();

        $bulk_req_ids = $db->query("SELECT bulk_req_id FROM bulk_order_details WHERE status != 'pending' OR status != 'cancelled'");
        $bulk_req_ids = array_column($bulk_req_ids, 'bulk_req_id');

        $arr = [];

        foreach ($bulk_req_ids as $blk) {
            $bulk_req = $db->query("SELECT product_id,quantity FROM bulk_order_req WHERE bulk_req_id = $blk");
            $quantity = $bulk_req[0]->quantity;
            $product_id = $bulk_req[0]->product_id;

            $product = $db->query("SELECT name FROM product WHERE product_id = $product_id");
            $product_name = $product[0]->name;

            if (array_key_exists($product_name, $arr)) {
                $arr[$product_name] += $quantity;
            } else {
                $arr[$product_name] = $quantity;
            }
        }


        $product_names = array_keys($arr);
        $quantities = array_values($arr);

        $arr2 = [
            'product_names' => $product_names,
            'quantities' => $quantities
        ];

        header("Content-Type: application/json");
        echo json_encode($arr2);
    }

    public function retail_chart()
    {
        $db = new Database();

        $order_ids = $db->query("SELECT order_details_id FROM order_details WHERE status != 'pending' OR status != 'cancelled'");
        $order_ids = array_column($order_ids, 'order_details_id');

        $arr = [];

        foreach ($order_ids as $order) {
            $order_items = $db->query("SELECT product_id,quantity FROM order_item WHERE order_details_id = $order");

            foreach ($order_items as $item) {
                $quantity = $item->quantity;
                $product_id = $item->product_id;

                $product = $db->query("SELECT name FROM product WHERE product_id = $product_id");
                $product_name = $product[0]->name;

                if (array_key_exists($product_name, $arr)) {
                    $arr[$product_name] += $quantity;
                } else {
                    $arr[$product_name] = $quantity;
                }
            }
        }

        $product_names = array_keys($arr);
        $quantities = array_values($arr);

        $arr2 = [
            'product_names' => $product_names,
            'quantities' => $quantities
        ];

        header("Content-Type: application/json");
        echo json_encode($arr2);
    }

    public function ongoing_pxns()
    {
        $db = new Database();
        $pxns = $db->query("SELECT * FROM production WHERE status = 'processing'");

        foreach ($pxns as $pxn) {
            $product_id = $pxn->product_id;
            $product = $db->query("SELECT name FROM product WHERE product_id = $product_id");
            $pxn->product_name = $product[0]->name;
        }

        header("Content-Type: application/json");
        echo json_encode($pxns);
    }

    public function retail_orders()
    {
        $db = new Database();
        $orders = $db->query("SELECT * FROM order_details");

        foreach ($orders as $order) {
            $user_id = $order->user_id;
            $customer = $db->query("SELECT customer_id,first_name,last_name FROM customer WHERE user_id = $user_id");
            $order->customer_name = ucfirst($customer[0]->first_name) . " " . ucfirst($customer[0]->last_name);
            $order->customer_id = $customer[0]->customer_id;

            $items = $db->query("SELECT product_id,quantity FROM order_item WHERE order_details_id = $order->order_details_id");

            foreach ($items as $item) {
                $product_id = $item->product_id;
                $product = $db->query("SELECT name FROM product WHERE product_id = $product_id");
                $item->product_name = $product[0]->name;

                $product_category_id = $db->query("SELECT product_category_id FROM product WHERE product_id = $product_id")[0]->product_category_id;
                $category_name = $db->query("SELECT category_name FROM product_category WHERE product_category_id = $product_category_id")[0]->category_name;
                $item->category_name = $category_name;
            }

            $order->items = $items;
        }

        header("Content-Type: application/json");
        echo json_encode($orders);
    }


    public function bulk_orders()
    {
        $db = new Database();
        $orders = $db->query("SELECT * FROM bulk_order_details");

        foreach ($orders as $order) {
            $user_id = $order->user_id;
            $customer = $db->query("SELECT customer_id,first_name,last_name FROM customer WHERE user_id = $user_id");
            $order->customer_name = ucfirst($customer[0]->first_name) . " " . ucfirst($customer[0]->last_name);
            $order->customer_id = $customer[0]->customer_id;

            $bulk_req = $db->query("SELECT * FROM bulk_order_req WHERE bulk_req_id = $order->bulk_req_id");
            $product_id = $bulk_req[0]->product_id;
            $product = $db->query("SELECT name FROM product WHERE product_id = $product_id");
            $order->product_name = $product[0]->name;

            $product_category_id = $db->query("SELECT product_category_id FROM product WHERE product_id = $product_id")[0]->product_category_id;
            $category_name = $db->query("SELECT category_name FROM product_category WHERE product_category_id = $product_category_id")[0]->category_name;
            $order->category_name = $category_name;

            $order->bulk_req = $bulk_req[0];
        }

        header("Content-Type: application/json");
        echo json_encode($orders);
    }

    public function gm_dash_chart()
    {
        $db = new Database();
        
        $dates = $db->query("SELECT DATE(created_at) as date, COUNT(*) as count FROM order_details GROUP BY DATE(created_at)");
        $dates = array_map(function ($date) {
            $date->date = date('d-m-Y', strtotime($date->date));
            return $date;
        }, $dates);

        $dates = array_combine(array_column($dates, 'date'), array_column($dates, 'count'));

        

        
        // $arr = [];
        // for ($i = $min_date; $i <= $max_date; $i = date('d-m-Y', strtotime($i . ' +1 day'))) {
        //     if (array_key_exists($i, $dates)) {
        //         $arr[$i] = $dates[$i];
        //     } else {
        //         $arr[$i] = 0;
        //     }
        // }

        // $days = array_keys($arr);
        // $counts = array_values($arr);

        // $arr2 = [
        //     'days' => $days,
        //     'counts' => $counts
        // ];

        $bulk_days = $db->query("SELECT DATE(created_at) as date, COUNT(*) as count FROM bulk_order_details GROUP BY DATE(created_at)");
        $bulk_days = array_map(function ($date) {
            $date->date = date('d-m-Y', strtotime($date->date));
            return $date;
        }, $bulk_days);

        $bulk_days = array_combine(array_column($bulk_days, 'date'), array_column($bulk_days, 'count'));

        // combine dates and bulk_days arrays to get all dates 
        $all_dates = array_merge(array_keys($dates), array_keys($bulk_days));
        $all_dates = array_unique($all_dates);
        $min_date = min($all_dates);

        $max_date = date('Y-m-d');

        $bulk_min_date = $min_date;
        $bulk_max_date = $max_date;

        
        $arr = [];
        for ($i = date('Y-m-d', strtotime($min_date)); $i <= date('Y-m-d', strtotime($max_date)); $i = date('Y-m-d', strtotime($i . ' +1 day'))) {
            $formattedDate = date('d-m-Y', strtotime($i));
            if (array_key_exists($formattedDate, $dates)) {
                $arr[$formattedDate] = $dates[$formattedDate];
            } else {
                $arr[$formattedDate] = 0;
            }
        }
        
        $bulk_arr = [];
        for ($i = date('Y-m-d', strtotime($bulk_min_date)); $i <= date('Y-m-d', strtotime($bulk_max_date)); $i = date('Y-m-d', strtotime($i . ' +1 day'))) {
            $formattedDate = date('d-m-Y', strtotime($i));
            if (array_key_exists($formattedDate, $bulk_days)) {
                $bulk_arr[$formattedDate] = $bulk_days[$formattedDate];
            } else {
                $bulk_arr[$formattedDate] = 0;
            }
        }

        $days = array_keys($arr);
        $counts = array_values($arr);

        $bulk_days = array_keys($bulk_arr);
        $bulk_counts = array_values($bulk_arr);

        $arr2 = [
            'days' => $days,
            'counts' => $counts,
            'bulk_days' => $bulk_days,
            'bulk_counts' => $bulk_counts
        ];

        header("Content-Type: application/json");
        echo json_encode($arr2);
    }

    public function no_of_curr_month()
    {
        $db = new Database();
        $orders = $db->query("SELECT * FROM order_details WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND status != 'cancelled'");

        $count = 0;
        $bulk_count = 0;
        $production_count = 0;
        
        if ($orders) {
            $count = count($orders);
        }

        $bulk_orders = $db->query("SELECT * FROM bulk_order_details WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND status != 'cancelled'");
        
        if ($bulk_orders) {
            $bulk_count = count($bulk_orders);
        }

        $production = $db->query("SELECT * FROM production WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())");
        
        if ($production) {
            $production_count = count($production);
        }

        $arr = [
            'retail_orders' => $count,
            'bulk_orders' => $bulk_count,
            'production' => $production_count
        ];

        header("Content-Type: application/json");
        echo json_encode($arr);
    }
    
}
