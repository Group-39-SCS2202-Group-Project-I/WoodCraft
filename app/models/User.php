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
			if(empty($data['email']))
			{
				$this->errors['email'] = "Email is required";
			}
			else
			{
				$this->errors['email'] = "Email is not valid";
			}
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
		if (empty($data['role'])) 
		{
			$this->errors['role'] = "Role is required";
		}
		else if(!in_array($data['role'], ['osr','gm','pm','admin','sk','customer']))
		{
			$this->errors['role'] = "Role is not valid";
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

	// public function edit_validate($data,$id)
	// {
	// 	$this->errors = [];

	// 	if(empty($data['first_name']))
	// 	{
	// 		$this->errors['first_name'] = "A first name is required";
	// 	}else
	// 	if(!preg_match("/^[a-zA-Z]+$/", trim($data['first_name'])))
	// 	{
	// 		$this->errors['first_name'] = "first name can only have letters without spaces";
	// 	}
		

	// 	if(empty($data['last_name']))
	// 	{
	// 		$this->errors['last_name'] = "A last name is required";
	// 	}else
	// 	if(!preg_match("/^[a-zA-Z]+$/", trim($data['last_name'])))
	// 	{
	// 		$this->errors['last_name'] = "last name can only have letters without spaces";
	// 	}

	// 	//check email
	// 	if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
	// 	{
	// 		$this->errors['email'] = "Email is not valid";
	// 	}else
	// 	if($results = $this->where(['email'=>$data['email']]))
	// 	{
	// 		foreach ($results as $result) {
	// 			if($id != $result->id)
	// 				$this->errors['email'] = "That email already exists";
	// 		}
			
	// 	}

	// 	if(!empty($data['telephone']))
	// 	{
	// 		if(!preg_match("/^(09|\+2609)[0-9]{8}$/", trim($data['telephone'])))
	// 		{
	// 			$this->errors['telephone'] = "Phone number not valid";
	// 		}
	// 	}

	// 	// if(!empty($data['facebook_link']))
	// 	// {
	// 	// 	if(!filter_var($data['facebook_link'],FILTER_VALIDATE_URL))
	// 	// 	{
	// 	// 		$this->errors['facebook_link'] = "Facebook link is not valid";
	// 	// 	}
	// 	// }

	// 	// if(!empty($data['twitter_link']))
	// 	// {
	// 	// 	if(!filter_var($data['twitter_link'],FILTER_VALIDATE_URL))
	// 	// 	{
	// 	// 		$this->errors['twitter_link'] = "Twitter link is not valid";
	// 	// 	}
	// 	// }

	// 	// if(!empty($data['instagram_link']))
	// 	// {
	// 	// 	if(!filter_var($data['instagram_link'],FILTER_VALIDATE_URL))
	// 	// 	{
	// 	// 		$this->errors['instagram_link'] = "Instagram link is not valid";
	// 	// 	}
	// 	// }

	// 	// if(!empty($data['linkedin_link']))
	// 	// {
	// 	// 	if(!filter_var($data['linkedin_link'],FILTER_VALIDATE_URL))
	// 	// 	{
	// 	// 		$this->errors['linkedin_link'] = "Linkedin link is not valid";
	// 	// 	}
	// 	// }

  
	// 	if(empty($this->errors))
	// 	{
	// 		return true;
	// 	}

	// 	return false;
	// }
}