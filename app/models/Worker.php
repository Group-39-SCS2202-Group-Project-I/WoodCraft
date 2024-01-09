<?php 

/**
 * workers model
 */
class Worker extends Model
{
    // worker_id	first_name	last_name	mobile_number	address_id	availability	created_at	updated_at	deleted_at	
    public $errors = [];
    protected $table = "worker";

    protected $allowedColumns = [
        "first_name",
        "last_name",
        "mobile_number",
        "address_id",
        "availability",
        "worker_role",
        "created_at",
        "updated_at",
        "deleted_at"
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

        if (empty($data['mobile_number']))
        {
            $this->errors['mobile_number'] = "Mobile number is required";
        }
        else if(!is_numeric($data['mobile_number']))
        {
            $this->errors['mobile_number'] = "Mobile number must be numeric";
        }
        else if(strlen($data['mobile_number']) != 10)
        {
            $this->errors['mobile_number'] = "Mobile number must be 10 digits";
        }
        // else if($this->where(['mobile_number'=>$data['mobile_number']]))
        // {
        //     $this->errors['mobile_number'] = "That mobile number already exists";
        // }
        else if(substr($data['mobile_number'],0,1) != 0)
        {
            $this->errors['mobile_number'] = "Mobile number must start with 0";
        }
        if(empty($data['worker_role']))
        {
            $this->errors['worker_role'] = "Worker role is required";
        }

        if(empty($this->errors))
        {
            return true;
        }

        return false;
    }


}