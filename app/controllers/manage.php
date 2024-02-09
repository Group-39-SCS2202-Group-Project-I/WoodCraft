<?php 

/**
 * cart class
 */
class Manage extends Controller
{
	
	public function index()
	{
		$data['title'] = "manage";

		$this->view('o&a/manage',$data);
	}


	
}