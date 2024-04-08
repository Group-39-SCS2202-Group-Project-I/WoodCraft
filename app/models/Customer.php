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
        "telephone",
        "birth_day",
        "birth_month",
        "birth_year",
        "gender",
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

    // ..................
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getPasswordFromDb($user_id) {
        // Prepare SQL statement
        $query = "SELECT password FROM user WHERE id = :user_id";

        // Prepare and execute the statement
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Fetch the hashed password
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['password']; // Return the hashed password
    }

    public function updatePasswordInDb($user_id, $hashedPassword) {
        // Prepare SQL statement
        $query = "UPDATE user SET password = :password WHERE id = :user_id";

        // Prepare and execute the statement
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }
	
}