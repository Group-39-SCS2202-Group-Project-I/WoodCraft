<?php 

/**
 * cart class
 */
class Manage extends Controller
{
	
	public function index()
	{
		$data['title'] = "manage";

		$this->view('manage/manage',$data);
	}
	public function myreturns(){
		$data['title'] = "myreturns";

		$this->view('manage/myreturns',$data);
	}

	public function mycollections(){
		$data['title'] = "mycollections";

		$this->view('manage/mycollections',$data);
	}
	public function myreviews(){
		$data['title'] = "myreviews";

		$this->view('manage/myreviews',$data);
	}

	public function mywishlist(){
		$data['title'] = "mywishlist";

		$this->view('manage/mywishlist',$data);
	}

	
}