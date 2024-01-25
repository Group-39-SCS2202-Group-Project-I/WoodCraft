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

    public function orders()
    {

        $data['title'] = "GM Orders";

        $this->view('gm/orders', $data);
    }

    public function productions()
    {

        $data['title'] = "GM Production";

        $this->view('gm/productions', $data);
    }
    
}
