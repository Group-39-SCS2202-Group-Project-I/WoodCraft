<?php 

/**
 * login class
 */
class Login extends Controller
{
	
	public function index()
	{

		show($_POST);
		$data['title'] = "Login";

		$this->view('login',$data);
	}
	
}