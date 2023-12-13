<?php 

/**
 * login class
 */
class Login extends Controller
{
	
	public function index()
	{

		$data['errors'] = [];

		$data['title'] = "Login";
		$user = new User();

		if($_SERVER['REQUEST_METHOD'] == "POST")
		{

			// $row = $user->first([
			// 	'email'=>$_POST['email']
			// ]);

			show($_POST['email']);

			$row = $user->where([
				'email'=>$_POST['email']
			]);

			$a = $row[0];

			show($a);
			
			// show($_POST);
			//validate
			// $row = $user->first([
			// 	'email'=>$_POST['email']
			// ]);

			// show($row);
			// die();

			if ($a) 
			{
				show($a->password);
				show($_POST['password']);
				// if (password_verify($_POST['password'], $a->password)) 
				if ($_POST['password'] == $a->password) //hash karanna
				{
					$_SESSION['user_id'] = $a->id;
					$_SESSION['role'] = $a->role;
					$_SESSION['email'] = $a->email;
					$_SESSION['name'] = $a->name;
					$_SESSION['logged_in'] = true;

					show($_SESSION['role']);
					show($_SESSION['email']);

					if($_SESSION['role'] == "admin")
					{
						redirect("admin");
					}
					else
					{
						redirect("home");
					}
				}
				else
				{
					$data['errors']['password'] = "Wrong email or password";
					show($data['errors']['password']);
				}
			}
			else
			{
				$data['errors']['email'] = "Wrong email or password";
			}

			
		}
				

			// $data['errors']['email'] = "Wrong email or password";
		

		$this->view('login',$data);
	}
	
}