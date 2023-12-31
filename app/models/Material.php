<?php 


class Material extends Model
{
    // material_id	name	description	stock_avilable	created_at	updated_at	

    public $errors = [];
    protected $table = "material";

    protected $allowedColumns = [
        "name",
        "description",
        "stock_avilable",
        "created_at",
        "updated_at"
    ];

    public function validate($data)
    {
        $this->errors = [];

        if(empty($data['name']))
        {
            $this->errors['name'] = "Material name is required";
        }
        // elseif(!preg_match("/^[a-zA-Z ]*$/",$data['name']))
        // {
        //     $this->errors['name'] = "Material name must contain only letters and spaces";
        // }
        elseif(strlen($data['name']) < 2)
        {
            $this->errors['name'] = "Material name must be at least 2 characters";
        }

        if (empty($data['description'])) 
        {
            $this->errors['description'] = "Material description is required";
        }
        // elseif(!preg_match("/^[a-zA-Z ]*$/",$data['description']))
        // {
        //     $this->errors['description'] = "Material description must contain only letters and spaces";
        // }
        elseif(strlen($data['description']) < 2)
        {
            $this->errors['description'] = "Material description must be at least 2 characters";
        }

        if (empty($data['stock_avilable']))
        {
            $this->errors['stock_avilable'] = "Material stock avilable is required";
        }
        // else if(!is_numeric($data['stock_avilable']))
        // {
        //     $this->errors['stock_avilable'] = "Material stock avilable must be numeric";
        // }
        // must be int
        elseif(!is_int($data['stock_avilable']))
        {
            $this->errors['stock_avilable'] = "Number of units must be integer";
        }


        return $this->errors;
    }


}
