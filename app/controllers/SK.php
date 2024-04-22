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
        }
        else {
            $data['title'] = "Finished Productions";

            $this->view('sk/finished_productions', $data);
        }
    }

    public function orders($x='')
    {

        if (!Auth::logged_in()) {
            message('Please login to view the SK section');
            redirect('login');
        }

        if (!Auth::is_sk()) {
            $this->view('404');
        }
        else {
            $data['title'] = "Orders";

            if($x == 'completed')
            {
                $this->view('sk/completed_orders', $data);
            }
            else if($x == 'bulk')
            {
                $this->view('sk/bulk_orders', $data);
            }
            else
            {
                $db = new Database();
                $pickup_orders = "SELECT * FROM order_details WHERE  status = 'processing' AND type = 'pickup'";
                $delivery_orders = "SELECT * FROM order_details WHERE  status = 'processing' AND type = 'delivery'";

                $pickups = $db->query($pickup_orders);

                foreach($pickups as $pickup)
                {
                    $items = "SELECT product_id,quantity FROM order_item WHERE order_details_id = $pickup->order_details_id";
                    $x = $db->query($items);
                    foreach($x as $item)
                    {
                        $product = "SELECT * FROM product WHERE product_id = $item->product_id";
                        $y = $db->query($product)[0];
                        $item->product_name = $y->name;
                        $item->price = $y->price;
                    }
                    $pickup->items = $x;
                }



                $data['pickup_orders'] = $pickups;


                $deliveries = $db->query($delivery_orders);
                foreach($deliveries as $delivery)
                {
                    $address = "SELECT * FROM address WHERE address_id = $delivery->delivery_address_id";
                    $x = $db->query($address)[0];
                    // $x = (array) $x;
                    $delivery->delivery_address = $x;

                    $items = "SELECT product_id,quantity FROM order_item WHERE order_details_id = $delivery->order_details_id";
                    $y = $db->query($items);
                    foreach($y as $item)
                    {
                        $product = "SELECT * FROM product WHERE product_id = $item->product_id";
                        $z = $db->query($product)[0];
                        $item->product_name = $z->name;
                        $item->price = $z->price;
                    }
                    $delivery->items = $y;

                }
                $data['delivery_orders'] = $deliveries;


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
        }
        else {
            $data['title'] = "Supplier";

            $this->view('sk/suppliers', $data);
        }
    }
}
