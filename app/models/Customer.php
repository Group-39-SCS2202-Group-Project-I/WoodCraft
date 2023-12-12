<?php 

/**
 * users model
 */
class Customer
{
	
	public $errors = [];
	protected $table = "customer";

	public function validate($data)
	{
		$this->errors = [];

        if(empty($data['first_name']))
		{
			$this->errors['first_name'] = "First name is required";
		}
        elseif(!preg_match("/^[a-zA-Z ]*$/",$data['first_name']))
        {
            $this->errors['first_name'] = "First name must contain only letters and spaces";
        }
        elseif(strlen($data['first_name']) < 2)
        {
            $this->errors['first_name'] = "First name must be at least 2 characters";
        }

		if (empty($data['last_name'])) 
		{
			$this->errors['last_name'] = "Last name is required";
		}
        elseif(!preg_match("/^[a-zA-Z ]*$/",$data['last_name']))
        {
            $this->errors['last_name'] = "Last name must contain only letters and spaces";
        }
        elseif(strlen($data['last_name']) < 2)
        {
            $this->errors['last_name'] = "Last name must be at least 2 characters";
        }

        if (empty($data['telephone']))
        {
            $this->errors['telephone'] = "Telephone is required";
        }
        else if(!is_numeric($data['telephone']))
        {
            $this->errors['telephone'] = "Telephone must be numeric";
        }
        else if(strlen($data['telephone']) != 10)
        {
            $this->errors['telephone'] = "Telephone must be 10 digits";
        }
        else if(substr($data['telephone'],0,1) != 0)
        {
            $this->errors['telephone'] = "Telephone must start with 0";
        }

		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}
	
}