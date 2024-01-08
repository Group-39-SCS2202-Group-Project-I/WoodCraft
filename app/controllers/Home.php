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

	public function about()
	{
		$data['title'] = "About";

		$this->view('about',$data);
	}


	

	


	
}