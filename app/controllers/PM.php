<?php


class PM extends Controller
{

    public function index()
    {

        $data['title'] = "PM Dashboard";

        $this->view('pm/dashboard', $data);
    }

    public function dashboard()
    {

        $data['title'] = "PM Dashboard";

        $this->view('pm/dashboard', $data);
    }
}
