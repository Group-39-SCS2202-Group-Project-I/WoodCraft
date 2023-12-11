<?php 


/****
* app info
*/
define('APP_NAME', 'WoodCraft');
define('APP_DESC', '');//

/****
* database config
*/
if($_SERVER['SERVER_NAME'] == 'localhost')
{
	//database config for local server
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

	//root path e.g https://www.yourwebsite.com
	define('ROOT', 'http://');
}

