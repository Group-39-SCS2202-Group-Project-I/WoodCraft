<?php


class OSR extends Controller
{

    public function index()
    {

        $data['title'] = "OSR Dashboard";

        $this->view('osr/dashboard', $data);
    }

    public function dashboard()
    {

        $data['title'] = "OSR Dashboard";

        $this->view('osr/dashboard', $data);
    }

    public function inquiries($id = '')
    {

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
