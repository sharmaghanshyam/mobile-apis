<?php

/*
 *	Name - JumboTeam
 *  Description - User Login and Registraion Class for database manipulation
 *  Created On - 26 Dec 13
*/

class userModel extends DatabaseConnection {

	/*
	* Function Name - loginCheck()
	* Input - $email, $password
	* Purpose - To login query check from database
	*/
	public function loginCheck($email,$password)
	{
		$sql = "SELECT * FROM api_user WHERE email = '".$email."' and password = '".$password."' and status =1 ";
		$result = mysql_query($sql,$this->connection);
		return $result;
	}

	/*
	* Function Name - emailCheck()
	* Input - $email
	* Purpose - To check email already exist in database or not
	*/
	public function emailCheck($email)
	{
		$sql = "SELECT * FROM api_user WHERE email = '".$email."'";
		$result = mysql_query($sql,$this->connection);
		return $result;
	}
	/*
	* Function Name - userCheck()
	* Input - $email
	* Purpose - To check user already exist in database or not
	*/
	public function userCheck($username)
	{
		$sql = "SELECT * FROM api_user WHERE username = '".$username."'";
		$result = mysql_query($sql,$this->connection);
		return $result;
	}
	/*
	* Function Name - countryList()
	* Input - 
	* Purpose - To get country list from datbase
	*/
	public function countryList()
	{
		$sql = "SELECT * FROM api_countries";
		$result = mysql_query($sql,$this->connection);
		return $result;
	}
	/*
	* Function Name - stateList()
	* Input - $countryid
	* Purpose - To get state list from datbase accourding to countryid
	*/
	public function stateList($countryid)
	{
		$sql = "SELECT * FROM api_states where country_id='".$countryid."'";
		$result = mysql_query($sql,$this->connection);
		return $result;
	}
	
	/*
	* Function Name - cityList()
	* Input -  $stateid
	* Purpose - To get city list from datbase accourding to stateid
	*/
	public function cityList($stateid)
	{
		$sql = "SELECT * FROM api_cities where state_id='".$stateid."'";
		$result = mysql_query($sql,$this->connection);
		return $result;
	}

	/*
	* Function Name - register()
	* Input - $userName, $email, $password
	* Purpose - To register with database
	*/
	public function register($userName,$email,$password)
	{
		$sql = "INSERT INTO api_user(`username`,`email`,`password`) VALUES('".$userName."','".$email."','".$password."') ";
		$result = mysql_query($sql,$this->connection);
		return $result;
	}

	
	
	
	
}




?>


