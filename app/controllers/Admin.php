<?php 

/**
 * home class
 */
class Admin extends Controller
{
	
	public function index()
	{

		$data['title'] = "Admin Dashboard";

		$this->view('admin/dashboard',$data);
	}
	
}