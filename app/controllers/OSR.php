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
}
