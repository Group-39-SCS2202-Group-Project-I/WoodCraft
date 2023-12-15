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
			$row = $user->where([
				'email'=>$_POST['email']
			]);

			$a = $row[0];

			
			if ($a) 
			{
				// show($a->password);
				
				if (password_verify($_POST['password'], $a->password)) 
				// if ($_POST['password'] == $a->password) 
				{
					// $_SESSION['USER_DATA'] = $a;
					Auth::authenticate($a);
					// $_SESSION['role'] = $a->role;
					

					// if($_SESSION['role'] == "admin")
					// {
					// 	redirect("admin");
					// }
					// else
					// {
					// 	redirect("home");
					// }

					if(Auth::is_admin())
					{
						redirect("admin");
					}
					else if(Auth::is_osr())
					{
						redirect("home"); //
					}
					elseif(Auth::is_sk())
					{
						redirect("home");
					}
					elseif(Auth::is_gm())
					{
						redirect("home");
					}
					elseif(Auth::is_pm())
					{
						redirect("home");
					}
					else
					{
						redirect("home");
					}

				}
				else
				{
					$data['errors']['password'] = "Wrong email or password";
					
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