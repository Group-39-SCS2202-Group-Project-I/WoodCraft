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
    
    public function add_production()
    {

        $data['title'] = "Add Production";

        $this->view('pm/add_production', $data);
    }

    public function ongoing_productions()
    {

        $data['title'] = "Ongoing Productions";

        $this->view('pm/ongoing_productions', $data);
    }

    public function completed_productions()
    {

        $data['title'] = "Completed Productions";

        $this->view('pm/completed_productions', $data);
    }

    public function approved_bulk_orders()
    {

        $data['title'] = "Approved Bulk Orders";

        $this->view('pm/approved_bulk_orders', $data);
    }

    public function product_materials()
    {

        $data['title'] = "Product Materials";

        $this->view('pm/product_materials', $data);
    }
}
