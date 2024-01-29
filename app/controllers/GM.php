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

    public function productions($id = '')
    {
        $data['id'] = $id;

        if ($id == '') {
            $data['title'] = "GM Productions";
            $this->view('gm/productions', $data);
        } else {
            $data['title'] = "GM Productions";
            $this->view('gm/production', $data);
        }
    }

    public function workers($id = '')
    {
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
