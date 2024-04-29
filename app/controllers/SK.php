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
                $this->view('sk/completed_orders', $data);
            } else if ($x == 'bulk') {
                $this->view('sk/bulk_orders', $data);
            } else {
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
