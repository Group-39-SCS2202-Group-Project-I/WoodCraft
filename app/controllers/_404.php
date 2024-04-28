<?php

/**
 * 404 class page not found
 */
class _404 extends Controller
{

	public function index()
	{
		$data = [
			'url' => ROOT.'/',
			'mzg' => 'Go back to home page'
		];
		$this->view('404', $data);
	}
}
