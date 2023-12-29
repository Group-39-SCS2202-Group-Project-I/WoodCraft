<?php


class SK extends Controller
{

    public function index()
    {

        $data['title'] = "SK Dashboard";

        $this->view('sk/dashboard', $data);
    }

    public function dashboard()
    {

        $data['title'] = "SK Dashboard";

        $this->view('sk/dashboard', $data);
    }
}
