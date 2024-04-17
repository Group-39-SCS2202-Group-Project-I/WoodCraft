<?php 

/**
 * users model
 */
class Address
{
	
	public $errors = [];
	protected $table = "address";

    protected $allowedColumns = [
        "address_line_1",
        "address_line_2",
        "city",
        "province",
        "zip_code"
    ];

	public function validate($data)
	{
		$this->errors = [];

        if(empty($data['address_line_1']))
        {
            $this->errors['address_line_1'] = "Address line 1 is required";
        }
        // if(empty($data['address_line_2']))
        // {
        //     $this->errors['address_line_2'] = "Address line 2 is required";
        // }
        if(empty($data['city']))
        {
            $this->errors['city'] = "City is required";
        }
        if(empty($data['zip_code']))
        {
            $this->errors['zip_code'] = "Zip code is required";
        }
        else if(!is_numeric($data['zip_code']))
        {
            $this->errors['zip_code'] = "Zip code must be numeric";
        }
        else if(strlen($data['zip_code']) != 5)
        {
            $this->errors['zip_code'] = "Zip code must be 5 digits";
        }
        
        if(empty($data['province']))
        {
            $this->errors['province'] = "Province is required";
        }

		
		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}
	
}