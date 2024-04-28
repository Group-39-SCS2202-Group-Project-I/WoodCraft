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

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if(!isset($_POST['email']) || empty($_POST['email']))
			{
				$data['errors']['email1'] = "Email is required";
			}
			else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			{
				$data['errors']['email1'] = "Invalid email";
			}
			if(!isset($_POST['password']) || empty($_POST['password']))
			{
				$data['errors']['password1'] = "Password is required";
			}
			if(count($data['errors']) > 0)
			{
				$this->view('login', $data);
				return;
			}

			$row = $user->where([
				'email' => $_POST['email']
			]);

			$a = $row[0];


			if ($a) {
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

					if (Auth::is_admin()) {
						redirect("admin");
					} else if (Auth::is_osr()) {
						redirect("osr");
					} elseif (Auth::is_sk()) {
						redirect("sk");
					} elseif (Auth::is_gm()) {
						redirect("gm");
					} elseif (Auth::is_pm()) {
						redirect("pm");
					} else {
						$cartModel = new CartDetails();
                        $cartProducts = new CartProduct();

						$customer_id = Auth::getCustomerID();
                        $_SESSION['cart_products'] = $cartProducts->getItemsByCustomerId($customer_id);

                        $cart = $cartModel->getCartByCustomerId($customer_id);
                        $_SESSION['cart'] = $cart[0];
						redirect("home");
					}
				} else {
					$data['errors']['email'] = "Wrong email or password";
				}
			} else {
				$data['errors']['email'] = "Wrong email or password";
			}
		}


		// $data['errors']['email'] = "Wrong email or password";

		if (!Auth::logged_in())
			$this->view('login', $data);
		else {
			if (Auth::is_admin()) {
				redirect("admin");
			} else if (Auth::is_osr()) {
				redirect("osr");
			} elseif (Auth::is_sk()) {
				redirect("sk");
			} elseif (Auth::is_gm()) {
				redirect("gm");
			} elseif (Auth::is_pm()) {
				redirect("pm");
			} else {
				redirect("home");
			}
		}
	}
}
