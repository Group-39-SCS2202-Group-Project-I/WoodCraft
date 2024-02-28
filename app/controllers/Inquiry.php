<?php 

/**
    * user_id
 */
class Inquiry extends Controller
{
	
	public function index($id = '')
    {
        $data['id'] = $id;
        if($id == ''){
            $this->view('inquiries', $data);
        }
        else{
            $this->view('inquiry', $data);
        }
    }

	// public function home()
	// {

	// 	$data['title'] = "Home";

	// 	$this->view('home',$data);
	// }
	
	

	
}