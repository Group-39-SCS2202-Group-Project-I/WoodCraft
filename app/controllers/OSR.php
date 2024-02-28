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
}
