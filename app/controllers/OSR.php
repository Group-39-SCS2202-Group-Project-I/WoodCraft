<?php


class OSR extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the OSR section');
            redirect('login');
        }

        if (!Auth::is_osr()) {
            $this->view('404');
        } else {
            $data['title'] = "OSR Dashboard";

            $this->view('osr/dashboard', $data);
        }
    }

    public function dashboard()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the OSR section');
            redirect('login');
        }

        if (!Auth::is_osr()) {
            $this->view('404');
        } else {
            $data['title'] = "OSR Dashboard";

            $this->view('osr/dashboard', $data);
        }
    }

    public function inquiries($id = '')
    {

        if (!Auth::logged_in()) {
            message('Please login to view the OSR section');
            redirect('login');
        }

        if (!Auth::is_osr()) {
            $this->view('404');
        } else {
            $data['id'] = $id;
            if ($id == '') {
                $data['title'] = "Inquiries";
                $this->view('osr/inquiries', $data);
            } else {
                $data['title'] = "Inquiry";
                $this->view('osr/inquiry', $data);
            }
        }
    }

    public function orders($id = '')
    {

        if (!Auth::logged_in()) {
            message('Please login to view the OSR section');
            redirect('login');
        }

        if (!Auth::is_osr()) {
            $this->view('404');
        } else {
            $data['id'] = $id;
            // if ($id == '') {
            //     $data['title'] = "Orders";
            //     $this->view('osr/orders', $data);
            // } else {
            //     $data['title'] = "Order";
            //     $this->view('osr/order', $data);
            // }
            $data['title'] = "Orders";
            $this->view('osr/orders', $data);
        }
    }

    // products
    public function products($id = '')
    {

        if (!Auth::logged_in()) {
            message('Please login to view the OSR section');
            redirect('login');
        }

        if (!Auth::is_osr()) {
            $this->view('404');
        } else {
            // $data['id'] = $id;
            // if ($id == '') {
            //     $data['title'] = "Products";
            //     $this->view('osr/products', $data);
            // } else {
            //     $data['title'] = "Product";
            //     $this->view('osr/product', $data);
            // }
            $data['title'] = "Products";
            $this->view('osr/products', $data);
        }
    }

    // productions
    public function productions($id = '', $start_date = '', $end_date = '')
    {

        if (!Auth::logged_in()) {
            message('Please login to view the OSR section');
            redirect('login');
        }

        if (!Auth::is_osr()) {
            $this->view('404');
        } else {
            $data['id'] = $id;

            // if ($id == '') {
            //     $data['title'] = "Productions";
            //     $this->view('osr/productions', $data);
            // } else {
            //     $data['title'] = "Production";
            //     $this->view('osr/production', $data);
            // }
            $data['title'] = "Productions";
            $this->view('osr/productions', $data);
        }
    }
}
