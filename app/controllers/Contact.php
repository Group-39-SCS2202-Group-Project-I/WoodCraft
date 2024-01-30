<?php 

/**
 * contact class
 */
class Contact extends Controller
{
	
	public function index()
	{
		$data['title'] = "Contact";

		$this->view('contact',$data);

		if(isset($_POST['btn-send']))
		{
			$name = htmlspecialchars($_POST['name']);
			$email = htmlspecialchars($_POST['email']);
			$phone = htmlspecialchars($_POST['phone']);
			$message = htmlspecialchars($_POST['message']);

			if(!empty($email) && !empty($message)){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$receiver = "sasankaudana@gmail.com"; //enter that email address where you want to receive all messages
				$subject = "From: $name <$email>";
				$body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message\n\nRegards,\n$name";
				$sender = "From: $email";
				if(mail($receiver, $subject, $body, $sender)){
					header("location:index.php?success");
				}else{
					// echo "Sorry, failed to send your message!";
					header('location:index.php?error1');
				}
				}else{
				// echo "Enter a valid email address!";
				header('location:index.php?error2');
				}
			}else{
				// echo "Email and message field is required!";
				header('location:index.php?error3');
			}
		}
	}

	
}