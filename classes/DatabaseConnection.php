<?php

/*
 *	Name - JumboTeam
 *  Description - Database Connection class
 *  Created On - 26 Dec 13
*/

/* Include files */



/* Define Constant  */
define('REQUIREDDATA','Please enter required fields');
define('SUCCESS','Success');
define('FAIL','Fail');
define('MESSAGE','Data retreived succesfully!');
define('ERRORMESSAGE','Data not available');
define('EMAILMESSAGE','Email already exist');
define('ERROREMAIL','Email not available in database');
define('LOGOUTMSG', 'Logout successfully');
define('USERERRORMESSAGE','User name already exist');
define('USERMESSAGE','User name available');
define('WEATHERKEY','297duh7k7dhwq242rrwjqtqd');
define('REGMESSAGE','Registered succesfully!');

class DatabaseConnection {
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPass = "";
    private $dbName = "webService";
    public $connection;

    function __construct() {
								if($_SERVER["HTTP_HOST"] == "localhost"){
									$dbHost = "localhost";
									$dbUser = "root";
									$dbPass = "";
									$dbName = "webService";
								}else{
									$dbHost = "localhost";
									$dbUser = "apiservice";
									$dbPass = "apiservice";
									$dbName = "webService";	
								}
        $this->connection = mysql_connect($dbHost, $dbUser, $dbPass)
            or die("Could not connect to the database:<br />" . mysql_error());
        mysql_select_db($dbName, $this->connection) 
            or die("Database error:<br />" . mysql_error());
    }
}
?>