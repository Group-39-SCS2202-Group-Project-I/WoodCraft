<?php 

/**
 * about class
 */
class About extends Controller
{
	
	public function about()
	{
		$data['title'] = "About";

		$this->view('about',$data);
	}


	
}