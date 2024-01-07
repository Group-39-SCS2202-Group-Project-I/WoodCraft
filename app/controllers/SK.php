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

    public function material_requests()
    {

        $data['title'] = "Material Requests";

        $this->view('sk/material_requests', $data);
    }

    public function material_orders($x='')
    {
        if ($x == 'add') {
            $data['title'] = "Material Order";
            $this->view('sk/add_material_order', $data);
        } else {
            $data['title'] = "Material Orders";
            $this->view('sk/material_orders', $data);
        }
    }



    public function materials()
    {

        $data['title'] = "Materials";

        $this->view('sk/materials', $data);
    }

    public function products()
    {

        $data['title'] = "Products";

        $this->view('sk/products', $data);
    }

    public function finished_productions()
    {
            
            $data['title'] = "Finished Productions";
    
            $this->view('sk/finished_productions', $data);
    }

    public function orders()
    {

        $data['title'] = "Orders";

        $this->view('sk/orders', $data);
    }

    public function suppliers()
    {

        $data['title'] = "Supplier";

        $this->view('sk/suppliers', $data);
    }


}
