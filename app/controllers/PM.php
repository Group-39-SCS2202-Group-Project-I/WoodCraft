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

    public function pending_productions()
    {

        $data['title'] = "Pending Productions";

        $this->view('pm/pending_productions', $data);
    }
    public function processing_productions()
    {

        $data['title'] = "Processing Productions";

        $this->view('pm/processing_productions', $data);
    }

    

    public function completed_productions()
    {

        $data['title'] = "Completed Productions";

        $this->view('pm/completed_productions', $data);
    }

    public function productions()
    {
            
            $data['title'] = "Productions";
    
            $this->view('pm/productions', $data);
    }

    public function approved_bulk_orders()
    {

        $data['title'] = "Approved Bulk Orders";

        $this->view('pm/approved_bulk_orders', $data);
    }

    public function product_materials($id = '')
    {
        $data['id'] = $id;

        if ($id != '') {
            $data['title'] = "Product Materials";
            $this->view('pm/product_mat', $data);
        } else {
            $data['title'] = "Product Materials";
            $this->view('pm/product_materials', $data);
        }
    }

    public function production($id = '')
    {
        $data['id'] = $id;

        if ($id != '') {
            $data['title'] = "Production";
            $this->view('pm/production', $data);
        } else {
            $data['title'] = "Production";
            // $this->view('pm/production', $data);
        }
    }
}
