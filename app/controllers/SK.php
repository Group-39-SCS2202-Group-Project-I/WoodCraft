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

    public function products()
    {

        $data['title'] = "SK Products";

        $this->view('sk/products', $data);
    }

    public function materials()
    {

        $data['title'] = "SK Materials";

        $this->view('sk/materials', $data);
    }
}
