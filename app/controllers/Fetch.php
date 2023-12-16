<?php 

class Fetch extends Controller
{
    
    public function index()
    {
        $data['title'] = "FetchApi";
        $this->view('fetchapi',$data);
    }

    public function customers()
    {
        $db = new Database();
		$data['customers'] = $db->query("SELECT * FROM customer");
        
		header("Content-Type: application/json");
        echo json_encode($data['customers']);
    }
}

      