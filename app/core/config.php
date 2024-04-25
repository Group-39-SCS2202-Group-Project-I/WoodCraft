<?php 


/****
* app info
*/
define('APP_NAME', 'WoodCraft Furnitures');
define('APP_DESC', '');//

/****
* database config
*/
if($_SERVER['SERVER_NAME'] == 'localhost')
{
	define('DBHOST', 'localhost');
	define('DBNAME', 'wcdb');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', 'mysql');

	//root path e.g localhost/
	define('ROOT', 'http://localhost/wcf');
}else
{
	//database config for live server
	define('DBHOST', 'localhost');
	define('DBNAME', 'wcdf');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', 'mysql');

	// define('ROOT', 'http://');
}

