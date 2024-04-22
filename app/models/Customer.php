<?php 

/**
 * Customer model
 */
class Customer extends Model
{
	
	public $errors = [];
	protected $table = "customer";

    protected $allowedColumns = [
        "user_id", 
        "address_id",
        "first_name",
        "last_name",
        "email",
        "telephone"
    ];

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
     public $customer_id;
     public function setCId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    // public function setId()
    // {
    //     $result = $this->select($this->table, 'Customer_id = :cid', [':cid' => $this->getId()]);
    //     return $result;
    // }

    // ....
    // public function edit_validate($data)
    // {
    //     $this->errors = [];

    //     if(empty($data['firstname'])){
    //         $this->errors['firstname'] = "First name is required";
    //     }

    //     if(empty($data['lastname'])){
    //         $this->errors['lastname'] = "Last name is required";
    //     }

    //     // check email
    //     if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
    //         $this->errors['email'] = "Email is not valid";
    //     }
    //     else
    //     if($this->where(['email' => $data['email']])){
    //         $this->errors['email'] = "Email is already exists";
    //     }

    //     if(!empty($data['facebook_link'])){
    //         if(!filter_var($data['facebook_link'], FILTER_VALIDATE_URL)){
    //             $this->errors['facebook_link'] = "Facebook link is not valid";
    //         }
    //     }

    //     if(!empty($data['twitter_link'])){
    //         if(!filter_var($data['twitter_link'], FILTER_VALIDATE_URL)){
    //             $this->errors['twitter_link'] = "Twitter link is not valid";
    //         }
    //     }

    //     if(!empty($data['instagram_link'])){
    //         if(!filter_var($data['instagram_link'], FILTER_VALIDATE_URL)){
    //             $this->errors['instagram_link'] = "Instagram link is not valid";
    //         }
    //     }

    //     if(!empty($data['linkedin_link'])){
    //         if(!filter_var($data['linkedin_link'], FILTER_VALIDATE_URL)){
    //             $this->errors['linkedin_link'] = "Linkedin link is not valid";
    //         }
    //     }

    //     if(empty($this->errors)){
    //         return true;
    //     }
        
    //     return false;
    // }
    public function getCustomerAddress($customerId)
{
    // Fetch the customer's address from the database based on the customer ID
    $addressModel = new Address(); // Assuming you have an Address model
    $customerAddress = $addressModel->getAddressByCustomerId($customerId);

    return $customerAddress;
}

   
}