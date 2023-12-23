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
        if($_SESSION['USER_DATA']->role == 'customer'){
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
	
}