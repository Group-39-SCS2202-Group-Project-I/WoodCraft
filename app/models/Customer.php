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

    // public function getCustomerById($id)
    // {
    //     $db = new Database();
    //     return $db->query("SELECT * FROM customer WHERE customer_id = $id");
    // }

    // // public function updateCustomerProfile($id, $data)
    // // {
    // //     // Validate $data if necessary

    // //     $db = new Database();

    // //     $address_id = $data['address_id'];  // Add this line to get the address_id from $data

    // //     $address_arr = [
    // //         'address_line_1' => $data['address_line_1'],
    // //         'address_line_2' => $data['address_line_2'],
    // //         'city' => $data['city'],
    // //         'zip_code' => $data['zip_code']
    // //     ];

    // //     $db->query("UPDATE address SET address_line_1 = :address_line_1, address_line_2 = :address_line_2, city = :city, zip_code = :zip_code WHERE address_id = $address_id", $address_arr);

    // //     $customer_arr = [
    // //         'first_name' => $data['first_name'],
    // //         'last_name' => $data['last_name'],
    // //         'email' => $data['email'],
    // //         'telephone' => $data['telephone'],
    // //         'address_id' => $address_id,
    // //         'birthday' => $data['birth-year'] . '-' . $data['birth-month'] . '-' . $data['birth-day'],
    // //         'gender' => $data['gender']
    // //     ];

    // //     $db->query("UPDATE customer SET first_name = :first_name, last_name = :last_name, email = :email, telephone = :telephone, address_id = :address_id, birthday = :birthday, gender = :gender WHERE customer_id = $id", $customer_arr);

    // //     // Return true if the update was successful
    // //     return true;
    // // }

    // public function updateCustomerProfile($customerId)
    // {
    //     // Fetch customer data from the database, validate, and update
    //     $customerModel = new Customer();
    //     $customer = $customerModel->getCustomerById($customerId);

    //     if (!$customer) {
    //         // Handle error or redirect accordingly
    //         die("Customer not found");
    //     }

    //     // Validate and update customer profile data
    //     $updateResult = $customerModel->updateCustomerProfile($customerId, $_POST);

    //     if ($updateResult) {
    //         // Successful update
    //         message("Customer updated successfully!");
    //         redirect('customer/manage-account');
    //     } else {
    //         // Update failed
    //         $_SESSION['errors'] = $customerModel->errors;
    //         $_SESSION['form_data'] = $_POST;
    //         $_SESSION['form_id'] = 'form_customer_update';
    //         redirect('customer/manage-account');
    //     }
    // }

    
    // public function processUpdateProfile($id)
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $customerModel = new Customer();
    //         $result = $customerModel->updateCustomerProfile($id, $_POST);

    //         if ($result) {
    //             message("Customer updated successfully!");
    //             redirect('customer/manage-account');
    //         } else {
    //             message("Error updating customer");
    //             redirect('customer/update-profile/' . $id);
    //         }
    //     }
    // }
	
}