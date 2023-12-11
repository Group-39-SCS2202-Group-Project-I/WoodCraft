<?php 

/**
 * login class
 */
class Login extends Controller
{
	
	public function index()
	{

		$data['title'] = "Login";

		$this->view('login',$data);
	}
	
}