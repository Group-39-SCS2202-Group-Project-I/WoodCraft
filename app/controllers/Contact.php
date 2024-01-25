<?php 

/**
 * contact class
 */
class Contact extends Controller
{
	
	public function contact()
	{
		$data['title'] = "Contact";

		$this->view('contact',$data);
	}


	
}