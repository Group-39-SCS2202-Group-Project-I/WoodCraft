<?php 

/**
 * home class
 */
class Home extends Controller
{
	
	public function index()
	{

		$data['title'] = "Home";

		$this->view('home',$data);
	}

	public function home()
	{
		$this->view('home',$data);
	}
	
	

	

	


	
}