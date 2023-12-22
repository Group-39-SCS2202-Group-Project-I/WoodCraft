<?php 

class ProductCategory extends Model
{
    
    public $errors = [];
    protected $table = "product_category";

    protected $allowedColumns = [
        "name",
    ];

    public function validate($data)
    {
        $this->errors = [];

        if(empty($data['name']))
        {
            $this->errors['name'] = "Name is required";
        }
        else if(!preg_match("/^[a-zA-Z0-9 ]*$/",$data['name']))
        {
            $this->errors['name'] = "Name must contain only letters, numbers, and spaces";
        }
        else if(strlen($data['name']) < 2)
        {
            $this->errors['name'] = "Name must be at least 2 characters";
        }
        else if(strlen($data['name']) > 100)
        {
            $this->errors['name'] = "Name must be less than 100 characters";
        }
        else if ($this->where(['name'=>$data['name']]))
        {
            $this->errors['name'] = "That category already exists";
        }
        
       
        if(empty($this->errors))
        {
            return true;
        }

        return false;
    }
    
}