<?php


class GM extends Controller
{

    public function index()
    {

        $data['title'] = "GM Dashboard";

        $this->view('gm/dashboard', $data);
    }

    public function dashboard()
    {

        $data['title'] = "GM Dashboard";

        $this->view('gm/dashboard', $data);
    }
}
