<?php

class Product extends Model
{

    public $errors = [];
    protected $table = "product_review";

    protected $allowedColumns = [
        "review_id",
        "product_id",
        "user_id",
        "rating",
        "review",
        "created_at",
        "updated_at",
    ];

    public function validate($data)
    {
        $this->errors = [];
        
        //product_id
        if (empty($data['product_id'])) {
            $this->errors['product_id'] = "Product id is required";
        }

        //user_id
        if (empty($data['user_id'])) {
            $this->errors['user_id'] = "User id is required";
        }
        
        if (empty($data['rating'])) {
            $this->errors['rating'] = "Add a rating";
        } else if (!('rating'>=0 && 'rating'<=5)) {
            $this->errors['rating'] = "Rating should be between 1 and 5";
        }


        if(empty($this->errors))
		{
			return true;
		}

		return false;
    }
}