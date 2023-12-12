<?php 

/**
 * users model
 */
class User extends Model
{
	
	public $errors = [];
	protected $table = "user";

	protected $allowedColumns = [
		"email",
		"password",
		"role",
		"created_at",
		"updated_at"
	];

	
	public function validate($data)
	{
		$this->errors = [];

		
		if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
		{
			$this->errors['email'] = "Email is not valid";
		}
		else if (empty($data['email'])) 
		{
			$this->errors['email'] = "Email is required";
		}
		else if($this->where(['email'=>$data['email']]))
		{
			$this->errors['email'] = "That email already exists";
		}
		// else if($this->exists($data['email']))
		// {
		// 	$this->errors['email'] = "Email already exists";
		// }
		if (empty($data['password'])) 
		{
			$this->errors['password'] = "Password is required";
		}
		else if(strlen($data['password']) < 8)
		{
			$this->errors['password'] = "Password must be at least 8 characters";
		}
		else if(!preg_match("#[0-9]+#",$data['password']))
		{
			$this->errors['password'] = "Password must contain at least 1 number";
		}
		else if(!preg_match("#[A-Z]+#",$data['password']))
		{
			$this->errors['password'] = "Password must contain at least 1 capital letter";
		}
		else if(!preg_match("#[a-z]+#",$data['password']))
		{
			$this->errors['password'] = "Password must contain at least 1 lowercase letter";
		}
		else if(!preg_match("#[\W]+#",$data['password']))
		{
			$this->errors['password'] = "Password must contain at least 1 special character";
		}
		if (empty($data['confirm_password'])) 
		{
			$this->errors['confirm_password'] = "Confirm password is required";
		}
		else if($data['password'] != $data['confirm_password'])
		{
			$this->errors['confirm_password'] = "Confirm password does not match";
		}



		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

	// public function exists($email)
	// {
	// 	$db = new Database;
	// 	$user = $db->select($this->table, "email = '$email'");
	// 	if($user)
	// 	{
	// 		return true;
	// 	}
	// 	return false;
	// }




	
}