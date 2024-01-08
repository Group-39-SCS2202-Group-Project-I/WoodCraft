<?php 

class ProductCategory extends Model
{
    
    public $errors = [];
    protected $table = "product_category";

    protected $allowedColumns = [
        "category_name",
    ];

    public function validate($data)
    {
        $this->errors = [];

        if(empty($data['category_name']))
        {
            $this->errors['category_name'] = "Category name is required";
        }
        else if(!preg_match("/^[a-zA-Z0-9&' ]*$/",$data['category_name']))
        {
            $this->errors['category_name'] = "Category name must contain only letters, numbers, and spaces and &";
        }
        else if(strlen($data['category_name']) < 2)
        {
            $this->errors['category_name'] = "Category name must be at least 2 characters";
        }
        else if(strlen($data['category_name']) > 100)
        {
            $this->errors['category_name'] = "Category name must be less than 100 characters";
        }
        else if ($this->where(['category_name'=>$data['category_name']]))
        {
            $this->errors['category_name'] = "That category already exists";
        }
        
       
        if(empty($this->errors))
        {
            return true;
        }

        return false;
    }
    
}