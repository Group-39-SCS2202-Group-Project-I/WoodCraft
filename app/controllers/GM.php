<?php


class GM extends Controller
{

    public function index()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the GM section');
            redirect('login');
        }

        if (!Auth::is_gm()) {
            $this->view('404');
        }
        else {
            $data['title'] = "GM Dashboard";

            $this->view('gm/dashboard', $data);
        }
    }

    public function dashboard()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the GM section');
            redirect('login');
        }

        if (!Auth::is_gm()) {
            $this->view('404');
        }
        else {
            $data['title'] = "GM Dashboard";

            $this->view('gm/dashboard', $data);
        }
    }

    public function orders()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the GM section');
            redirect('login');
        }

        if (!Auth::is_gm()) {
            $this->view('404');
        }
        else {
            $data['title'] = "GM Orders";

            $this->view('gm/orders', $data);
        }
    }

    public function productions($id = '')
    {
        if (!Auth::logged_in()) {
            message('Please login to view the GM section');
            redirect('login');
        }

        if (!Auth::is_gm()) {
            $this->view('404');
        }
        else {
            $data['id'] = $id;

            if ($id == '') {
                $data['title'] = "GM Productions";
                $this->view('gm/productions', $data);
            } else {
                $data['title'] = "GM Productions";
                $this->view('gm/production', $data);
            }
        }
        
    }

    public function workers($id = '')
    {
        if (!Auth::logged_in()) {
            message('Please login to view the GM section');
            redirect('login');
        }

        if (!Auth::is_gm()) {
            $this->view('404');
        }
        else {
            $data['id'] = $id;

            if ($id == '') {
                $data['title'] = "GM Workers";
                $this->view('gm/workers', $data);
            } else {
                $data['title'] = "GM Workers";
                $this->view('gm/worker', $data);
            }
        }
    }
}
