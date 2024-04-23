<?php

/**
 * authentication class
 */
class Auth
{
	
	public static function authenticate($row)
	{
		if(is_object($row)){
			$_SESSION['USER_DATA'] = $row;
		}
	}

	public static function logout()
	{
		if(!empty($_SESSION['USER_DATA'])){
			unset($_SESSION['USER_DATA']);

			//session_unset();
			//session_regenerate_id();
		}
	}

	

	public static function logged_in()
	{
		if(!empty($_SESSION['USER_DATA']))
		{
			return true;
		}

		return false;
	}

	public static function is_customer()
	{
		if(!empty($_SESSION['USER_DATA']))
		{
			if($_SESSION['USER_DATA']->role == 'customer'){
				return true;
			}
		}

		return false;
	}

    public static function is_admin()
    {
        if(!empty($_SESSION['USER_DATA']))
        {
            if($_SESSION['USER_DATA']->role == 'admin'){
                return true;
            }
        }

        return false;
    }

    public static function is_osr()
    {
        if(!empty($_SESSION['USER_DATA']))
        {
            if($_SESSION['USER_DATA']->role == 'osr'){
                return true;
            }
        }

        return false;
    }

    //sk
    public static function is_sk()
    {
        if(!empty($_SESSION['USER_DATA']))
        {
            if($_SESSION['USER_DATA']->role == 'sk'){
                return true;
            }
        }

        return false;
    }

    // gm
    public static function is_gm()
    {
        if(!empty($_SESSION['USER_DATA']))
        {
            if($_SESSION['USER_DATA']->role == 'gm'){
                return true;
            }
        }

        return false;
    }

    //pm
    public static function is_pm()
    {
        if(!empty($_SESSION['USER_DATA']))
        {
            if($_SESSION['USER_DATA']->role == 'pm'){
                return true;
            }
        }

        return false;
    }

    public static function customerDetails()
    {
        // show($_SESSION['USER_DATA']);
        if($_SESSION['USER_DATA']->role === 'customer'){
            $db = new Database;
            $customer = $db->select('customer','user_id = '.$_SESSION['USER_DATA']->user_id);
            // show($customer[0]);
            return $customer[0];
        }
        // $db = new Database;
        // $customer = $db->select('customer','user_id = '.$_SESSION['USER_DATA']->user_id);
        // // show($customer[0]);
        // return $customer[0];
    }

    public static function getStaffID()
    {
        //get staff id based on user id
        $db = new Database;
        $query = "SELECT * FROM staff WHERE user_id = ".$_SESSION['USER_DATA']->user_id;
        $staff = $db->query($query);
        // show($staff);
        return $staff[0]->staff_id;
    }

    // Dynamic retrieval of user data property....
    public static function __callStatic($funcname, $args)
    {
        $key = str_replace("get", "", strtolower($funcname));
        if(!empty($_SESSION['USER_DATA']->$key)){
            return $_SESSION['USER_DATA']->$key;
        }

        return '';
    }

    public static function getId()
    {
        return $_SESSION['USER_DATA']->user_id;
    }

    public static function getCustomerID()
     {
         $userID = $_SESSION['USER_DATA']->user_id;

         $db = new Database;
         $query = "SELECT * FROM customer WHERE user_id = $userID";

         $customer = $db->query($query);

         return $customer[0]->customer_id;
     }

    public static function getCustomerName()
    {
        $userID = $_SESSION['USER_DATA']->user_id;

        $db = new Database;
        $query = "SELECT * FROM customer WHERE user_id = $userID";

        $customer = $db->query($query);

        $first_name = $customer[0]->first_name;
        // $last_name = $customer[0]->last_name;

        // return $first_name . " " . $last_name;
        return $first_name;
        // return $customer[0];
    }


    public static function is_role($role)
    {
        return isset($_SESSION['USER_DATA']) && $_SESSION['USER_DATA']->role === $role;
    }

    public static function getUserData()
    {
        return isset($_SESSION['USER_DATA']) ? $_SESSION['USER_DATA'] : null;
    }

    public static function getUserId()
    {
        return isset($_SESSION['USER_DATA']) ? $_SESSION['USER_DATA']->user_id : null;
    }

    // Add more role checking functions if needed

    // Other functions remain unchanged
    //public static function getCustomerID()
    //{
    //   if (!empty($_SESSION['USER_DATA']) && $_SESSION['USER_DATA']->role === 'customer') {
    //        return $_SESSION['USER_DATA']->customer_id;
    //    }
    //    return null;
    //}

}
?>