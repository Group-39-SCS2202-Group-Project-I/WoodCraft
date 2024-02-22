<?php


class PM extends Controller
{

    public function index()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the PM section');
            redirect('login');
        }

        if (!Auth::is_pm()) {
            $this->view('404');
        } else {
            $data['title'] = "PM Dashboard";

            $this->view('pm/dashboard', $data);
        }
    }

    public function dashboard()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the PM section');
            redirect('login');
        }

        if (!Auth::is_pm()) {
            $this->view('404');
        } else {
            $data['title'] = "PM Dashboard";

            $this->view('pm/dashboard', $data);
        }
    }

    public function add_production()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the PM section');
            redirect('login');
        }

        if (!Auth::is_pm()) {
            $this->view('404');
        } else {
            $data['title'] = "Add Production";

            $this->view('pm/add_production', $data);
        }
    }

    // public function pending_productions()
    // {

    //     $data['title'] = "Pending Productions";

    //     $this->view('pm/pending_productions', $data);
    // }
    // public function processing_productions()
    // {

    //     $data['title'] = "Processing Productions";

    //     $this->view('pm/processing_productions', $data);
    // }



    // public function completed_productions()
    // {

    //     $data['title'] = "Completed Productions";

    //     $this->view('pm/completed_productions', $data);
    // }

    public function productions()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the PM section');
            redirect('login');
        }

        if (!Auth::is_pm()) {
            $this->view('404');
        } else {
            $data['title'] = "Productions";
            $this->view('pm/productions', $data);
        }
    }

    public function approved_bulk_orders()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the PM section');
            redirect('login');
        }

        if (!Auth::is_pm()) {
            $this->view('404');
        } else {
            $data['title'] = "Approved Bulk Orders";

            $this->view('pm/approved_bulk_orders', $data);
        }

    }

    public function product_materials($id = '')
    {
        if (!Auth::logged_in()) {
            message('Please login to view the PM section');
            redirect('login');
        }

        if (!Auth::is_pm()) {
            $this->view('404');
        }
        else{
            $data['id'] = $id;

            if ($id != '') {
                $data['title'] = "Product Materials";
                $this->view('pm/product_mat', $data);
            } else {
                $data['title'] = "Product Materials";
                $this->view('pm/product_materials', $data);
            }
        }
    }

    public function production($id = '')
    {
        if (!Auth::logged_in()) {
            message('Please login to view the PM section');
            redirect('login');
        }

        if (!Auth::is_pm()) {
            $this->view('404');
        }
        else{
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
}
