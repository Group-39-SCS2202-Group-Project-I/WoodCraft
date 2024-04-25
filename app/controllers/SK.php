<?php


class SK extends Controller
{

    public function index()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the SK section');
            redirect('login');
        }

        if (!Auth::is_sk()) {
            $this->view('404');
        } else {
            $data['title'] = "SK Dashboard";

            $this->view('sk/dashboard', $data);
        }
    }

    public function dashboard()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the SK section');
            redirect('login');
        }

        if (!Auth::is_sk()) {
            $this->view('404');
        } else {
            $data['title'] = "SK Dashboard";

            $this->view('sk/dashboard', $data);
        }
    }

    public function material_requests()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the SK section');
            redirect('login');
        }

        if (!Auth::is_sk()) {
            $this->view('404');
        } else {
            $data['title'] = "Material Requests";

            $this->view('sk/material_requests', $data);
        }
    }

    public function material_orders($x = '')
    {
        if (!Auth::logged_in()) {
            message('Please login to view the SK section');
            redirect('login');
        }

        if (!Auth::is_sk()) {
            $this->view('404');
        } else {
            if ($x == 'add') {
                $data['title'] = "Material Order";
                $this->view('sk/add_material_order', $data);
            } else {
                $data['title'] = "Material Orders";
                $this->view('sk/material_orders', $data);
            }
        }
    }



    public function materials()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the SK section');
            redirect('login');
        }

        if (!Auth::is_sk()) {
            $this->view('404');
        } else {
            $data['title'] = "Materials";

            $this->view('sk/materials', $data);
        }
    }

    public function products()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the SK section');
            redirect('login');
        }

        if (!Auth::is_sk()) {
            $this->view('404');
        } else {
            $data['title'] = "Products";

            $this->view('sk/products', $data);
        }
    }

    public function finished_productions()
    {

        if (!Auth::logged_in()) {
            message('Please login to view the SK section');
            redirect('login');
        }

        if (!Auth::is_sk()) {
            $this->view('404');
        } else {
            $data['title'] = "Finished Productions";

            $this->view('sk/finished_productions', $data);
        }
    }

    public function orders($x = '')
    {

        if (!Auth::logged_in()) {
            message('Please login to view the SK section');
            redirect('login');
        }

        if (!Auth::is_sk()) {
            $this->view('404');
        } else {
            $data['title'] = "Orders";

            if ($x == 'completed') {
                
                // $url = ROOT . "/fetch/completed_retail_orders";
                // $retail_orders = json_decode(file_get_contents($url));
                // $url = ROOT . "/fetch/completed_bulk_orders";
                // $bulk_orders = json_decode(file_get_contents($url));

                // $data['retail_orders'] = $retail_orders;
                // $data['bulk_orders'] = $bulk_orders;
                $this->view('sk/completed_orders', $data);
            } else if ($x == 'bulk') {
                $db = new Database();
                $bulk_orders = "SELECT * FROM bulk_order_details WHERE  status = 'processing' OR status = 'pending' OR status = 'ready to pick up' OR status = 'delivering'";
                $bulks = $db->query($bulk_orders);

                foreach ($bulks as $bulk) {
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

                // filter type=pickup and type=delivery from $bulks
                $pickups = [];
                $deliveries = [];
                foreach ($bulks as $bulk) {
                    if ($bulk->type == 'pickup') {
                        array_push($pickups, $bulk);
                    } else {
                        array_push($deliveries, $bulk);
                    }
                }
                foreach ($deliveries as $d) {
                    $address = "SELECT * FROM address WHERE address_id = $d->delivery_address_id";
                    $x = $db->query($address)[0];
                    // $x = (array) $x;
                    $d->delivery_address = $x;
                }

                $data['pickups'] = $pickups;
                $data['deliveries'] = $deliveries;

                $data['pickup_count'] = count($pickups);
                $data['delivery_count'] = count($deliveries);

                $this->view('sk/bulk_orders', $data);
            } else {
                $db = new Database();
                $pickup_orders = "SELECT * FROM order_details WHERE type = 'pickup' AND (status = 'processing' OR status = 'ready to pick up' OR status = 'delivering')";
                $delivery_orders = "SELECT * FROM order_details WHERE  (status = 'processing' OR status = 'ready to pick up' OR status = 'delivering') AND type = 'delivery'";

                $pickups = $db->query($pickup_orders);

                foreach ($pickups as $pickup) {
                    $user_id = $pickup->user_id;
                    $customer_name = "SELECT first_name,last_name FROM customer WHERE user_id = $user_id";
                    $x = $db->query($customer_name)[0];
                    $pickup->customer_name = ucfirst($x->first_name) . " " . ucfirst($x->last_name);

                    $items = "SELECT product_id,quantity FROM order_item WHERE order_details_id = $pickup->order_details_id";
                    $x = $db->query($items);
                    foreach ($x as $item) {
                        $product = "SELECT * FROM product WHERE product_id = $item->product_id";
                        $y = $db->query($product)[0];
                        $item->product_name = $y->name;
                        $item->price = $y->price;

                        $product_category_id = $y->product_category_id;
                        $category_name = "SELECT category_name FROM product_category WHERE product_category_id = $product_category_id";
                        $z = $db->query($category_name)[0];
                        $item->category_name = $z->category_name;
                    }
                    $pickup->items = $x;
                }



                $data['pickup_orders'] = $pickups;
                $data['pickup_count'] = count($pickups);


                $deliveries = $db->query($delivery_orders);
                foreach ($deliveries as $delivery) {
                    $user_id = $delivery->user_id;
                    $customer_name = "SELECT first_name,last_name FROM customer WHERE user_id = $user_id";
                    $x = $db->query($customer_name)[0];
                    $delivery->customer_name = ucfirst($x->first_name) . " " . ucfirst($x->last_name);
                    $address = "SELECT * FROM address WHERE address_id = $delivery->delivery_address_id";
                    $x = $db->query($address)[0];
                    // $x = (array) $x;
                    $delivery->delivery_address = $x;

                    $items = "SELECT product_id,quantity FROM order_item WHERE order_details_id = $delivery->order_details_id";
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
                    $delivery->items = $y;
                }
                $data['delivery_orders'] = $deliveries;
                $data['delivery_count'] = count($deliveries);


                $this->view('sk/orders', $data);
            }
        }
    }

    public function suppliers()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the SK section');
            redirect('login');
        }

        if (!Auth::is_sk()) {
            $this->view('404');
        } else {
            $data['title'] = "Supplier";

            $this->view('sk/suppliers', $data);
        }
    }

    public function update_order_status($order_details_id)
    {
        show($_POST);
        $db = new Database();
        $status = $_POST['status'];

        $q = "UPDATE order_details SET status = '$status' WHERE order_details_id = $order_details_id";
        $db->query($q);
        message('Order status updated successfully');
        redirect('sk/orders');
    }

    public function update_bulk_order_status($bulk_order_details_id)
    {
        show($_POST);
        $db = new Database();
        $status = $_POST['status'];

        if ($status == 'processing') {
            $quntity_required = $_POST['quantity_required'];
            $product_inventory_id = $_POST['product_inventory_id'];
            $q = "UPDATE product_inventory SET quantity = quantity - $quntity_required WHERE product_inventory_id = $product_inventory_id";
            $db->query($q);
        }

        $q = "UPDATE bulk_order_details SET status = '$status' WHERE bulk_order_details_id = $bulk_order_details_id";
        $db->query($q);
        message('Order status updated successfully');
        if ($_POST['status'] == 'processing') {
            message('Product allocated  and order status updated successfully');
        }

        redirect('sk/orders/bulk');
    }
}
