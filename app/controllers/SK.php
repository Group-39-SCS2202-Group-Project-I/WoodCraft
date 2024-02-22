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

    public function orders()
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

            $this->view('sk/orders', $data);
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
