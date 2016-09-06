<?php
/*
 *	Name - JumboTeam
 *  Description - User Login and Registraion Class for Json format
 *  Created On - 26 Dec 13
*/
session_start();
include_once("DatabaseConnection.php");
include_once("userModel.php");

class userApi extends DatabaseConnection {

	public $msg;
	
	
	/*
	* Function Name - register()
	* Input - Array $data
	* Purpose - To register in application
	*
	*/
	public function register($data){
	
		$passArray = array();
		$mod = new userModel();
		
		$userName = $data['username'];
		$email = $data['email'];
		$password = md5($data['password']);
		
		try{
			// Check for unique username
			$resUser = $mod->userCheck($userName);
			if(mysql_num_rows($resUser) > 0){
				$status = FAIL;
				$message = USRERRORMESSAGE;
			}
			else
			{
				$resEmail = $mod->emailCheck($email);
				if(mysql_num_rows($resEmail) > 0){
					$status = FAIL;
					$message = EMAILMESSAGE;
				}
				else
				{
					// Registration process goes here
					$res = $mod->register($userName,$email,$password);
					$status = SUCCESS;
					$message = REGMESSAGE;
				}
			}
		}
		catch(exception $error)
		{
			$status =FAIL;
			$message = $error;
		}
		
		$response = array(
							"Status" => $status,
							"Message"=> $message,
							"Result"=>$passArray
						);
		
		return $response;
	}	
	
	
	
	/*
	* Function Name - getLogin()
	* Input - Array $data
	* Purpose - To login in application
	*
	*/
	public function getLogin($data){
	
		$passArray = array();
		$mod = new userModel();
		
		$email = $data['email'];
		$password = md5($data['password']);
		
		$res = $mod->loginCheck($email,$password);
		
		if(mysql_num_rows($res) > 0){
			while($row = mysql_fetch_array($res)){
				$passArray['userDetails'] =  array("id"=>$row["id"],"UserName"=>$row["username"],"Email"=>$row["email"]);
			}
			$status = SUCCESS;
			$message = MESSAGE;
			/* Set session and send session token */
			//$_SESSION['token'] =$this->rand_str();
			$_SESSION['id'] = $passArray['userDetails']['id'];
			$_SESSION['username'] = $passArray['userDetails']['UserName'];
			$_SESSION['email'] = $passArray['userDetails']['Email'];
		
			$passArray['token']=$this->newTokenEncode($passArray['userDetails']['UserName'],$passArray['userDetails']['id']);
			$_SESSION['token'] =$passArray['token'];
		}
		else
		{
			$status =FAIL;
			$message = ERRORMESSAGE;
		}
		
		$response = array(
							"Status" => $status,
							"Message"=> $message,
							"Result"=>$passArray
						);
		
		return $response;
	}	
	
	
	/*
	* Function Name - emailCheck()
	* Input - Array $data
	* Purpose - To check email already exist or not
	*
	*/
	public function emailCheck($emailid){
	
		$passArray = array();
		$mod = new userModel();
		$email = $emailid;
		$res = $mod->emailCheck($email);
		
		if(mysql_num_rows($res) > 0){
			$passArray[] =  array();
			$status = FAIL;
			$message = EMAILMESSAGE;
		}
		else
		{
			$status =SUCCESS;
			$message = ERROREMAIL;
		}
		
		$response = array(
							"Status" => $status,
							"Message"=> $message,
							"Result"=>$passArray
						);
		
		return $response;
	}
	/*
	* Function Name - userCheck()
	* Input - Array $data
	* Purpose - To check user already exist or not
	*
	*/
	public function userCheck($userName){
	
		$passArray = array();
		$mod = new userModel();
		$res = $mod->userCheck($userName);
		
		if(mysql_num_rows($res) > 0){
			$passArray[] =  array();
			$status = FAIL;
			$message = USERERRORMESSAGE;
		}
		else
		{
			$status =SUCCESS;
			$message = USERMESSAGE;
		}
		
		$response = array(
							"Status" => $status,
							"Message"=> $message
						);
		
		return $response;
	}
	/*
	* Function Name - rand_str()
	* Input - $length, $cahrs
	* Purpose - To generate random number for token
	*
	*/
	private function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')
	{
			// Length of character list
			$chars_length = (strlen($chars) - 1);

			// Start our string
			$string = $chars{rand(0, $chars_length)};
			
			// Generate random string
			for ($i = 1; $i < $length; $i = strlen($string))
			{
				// Grab a random character from our list
				$r = $chars{rand(0, $chars_length)};
				
				// Make sure the same two characters don't appear next to each other
				if ($r != $string{$i - 1}) $string .=  $r;
			}
			
			// Return the string
			return $string;
	}
	
	/*
	* Function Name - logout()
	* Input - 
	* Purpose - To logout and destroy session
	*
	*/
	function logout()
	{
		session_start();
		session_destroy();
		$status =SUCCESS;
		$message = LOGOUTMSG;
		$response = array(
							"Status" => $status,
							"Message"=> $message
						);
		return $response;
	}

	/*
	* Function Name - getLocationByIp()
	* Input - Array $data
	* Purpose - To get geo location info using ip address
	*
	*/
	
	function getLocationByIp($data)
	{
		$passArray = array();
		
		$ipAddress = $data['ipAddress'];
		$ipResult = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ipAddress));
		if(sizeof($ipResult)>0)
		{
			$status =SUCCESS;
			$message = MESSAGE;
		}
		else
		{
			$status =FAIL;
			$message = ERRORMESSAGE;
		}		
		$response = array(
							"Status" => $status,
							"Message"=> $message,
							"Result" =>$ipResult
						);

		return $response;
	}

	/*
	* Function Name - getCurrency()
	* Input - $fromCurrency, $toCurrency, $amount
	* Purpose - To get currency converter 
	*
	*/
	
	private function getCurrency($fromCurrency, $toCurrency, $amount) {
		$amount = urlencode($amount);
		$from_Currency = urlencode($fromCurrency);
		$to_Currency = urlencode($toCurrency);
		$url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";
		$ch = curl_init();
		$timeout = 0;
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$rawdata = curl_exec($ch);
		curl_close($ch);
		$data = explode('bld>', $rawdata);
		$data = explode($to_Currency, $data[1]);
		return round($data[0], 2);
	}	
	
	/*
	* Function Name - currencyConverter()
	* Input - Array $data
	* Purpose - To check email already exist or not
	*
	*/
	public function currencyConverter($data){
	
		$passArray = array();
		$fromCurrency = $data['fromCurrency'];
		$toCurrency = $data['toCurrency'];
		$amount = $data['amount'];
	
    	$result = $this->getCurrency($fromCurrency, $toCurrency, $amount);
		
		if(isset($result) && $result!=''){
			$status =SUCCESS;
			$message = MESSAGE;
		}
		else
		{
			$status = FAIL;
			$message = ERRORMESSAGE;
		}
		
		$response = array(
							"Status" => $status,
							"Message"=> $message,
							"Result"=>$result
						);
		
		return $response;
	}
	
	/*
	* Function Name - countryList()
	* Input - 
	* Purpose - To get country list from database
	*
	*/
	public function countryList(){
	
		$passArray = array();
		$mod = new userModel();
		$res = $mod->countryList();
		
		if(mysql_num_rows($res) > 0){
			while($row = mysql_fetch_array($res)){
				$passArray['countryList'][] =  array("id"=>$row["id"],"name"=>$row["name"]);
			}
			$status = SUCCESS;
			$message = MESSAGE;
		}
		else
		{
			$status =FAIL;
			$message = ERRORMESSAGE;
		}
		
		$response = array(
							"Status" => $status,
							"Message"=> $message,
							"Result"=>$passArray
						);
		
		return $response;
	}
	
	/*
	* Function Name - stateList()
	* Input - $countryid
	* Purpose - To get country list from database
	*
	*/
	public function stateList($countryid){
	
		$passArray = array();
		$mod = new userModel();
		$res = $mod->stateList($countryid);
		
		if(mysql_num_rows($res) > 0){
			while($row = mysql_fetch_array($res)){
				$passArray['stateList'][] =  array("id"=>$row["id"],"name"=>$row["name"]);
			}
			$status = SUCCESS;
			$message = MESSAGE;
			
		}
		else
		{
			$status =FAIL;
			$message = ERRORMESSAGE;
		}
		
		$response = array(
							"Status" => $status,
							"Message"=> $message,
							"Result"=>$passArray
						);
		
		return $response;
	}
	/*
	* Function Name - cityList()
	* Input - $stateid
	* Purpose - To get city list from database
	*
	*/
	public function cityList($stateid){
	
		$passArray = array();
		$mod = new userModel();
		$res = $mod->cityList($stateid);
		
		if(mysql_num_rows($res) > 0){
			while($row = mysql_fetch_array($res)){
				$passArray['cityList'][] =  array("id"=>$row["id"],"name"=>$row["name"]);
			}
			$status = SUCCESS;
			$message = MESSAGE;
			
		}
		else
		{
			$status =FAIL;
			$message = ERRORMESSAGE;
		}
		
		$response = array(
							"Status" => $status,
							"Message"=> $message,
							"Result"=>$passArray
						);
		
		return $response;
	}
	
	/*
	* Function Name - newTokenEncode()
	* Input - $userName, $id
	* Purpose - To create new token using username and id
	*
	*/
	function newTokenEncode($userName,$id)
	{
		$newTokenNum =base64_encode($userName."/".$id);
		return $newTokenNum;
	}
	
	/*
	* Function Name - newTokenDecode()
	* Input - $token
	* Purpose - To create new token using username and id
	*
	*/
	function newTokenDecode($token)
	{
		$newTokenNum =base64_decode($token);
		$userArray = explode("/",$newTokenNum);
		return $userArray;
	}
	
	/*
	* Function Name - weatherReport()
	* Input - Array $data
	* Purpose - To get weather report
	*
	*/
	
	public function weatherReport($query)
	{
		$passArray = array();
		$key= WEATHERKEY;
		$queryResult = file_get_contents('http://api.worldweatheronline.com/free/v1/search.ashx?q='.$query.'&format=json&key='.$key);
		if(sizeof($queryResult)>0)
		{
			$status =SUCCESS;
			$message = MESSAGE;
		}
		else
		{
			$status =FAIL;
			$message = ERRORMESSAGE;
		}		
		$response = array(
							"Status" => $status,
							"Message"=> $message,
							"Result" =>$queryResult
						);

		return $queryResult;
	}

		/*
	* Function Name - dob()
	* Input - Array $data
	* Purpose - To get current age
	*
	*/

	public function dob($dob)
	{	// $dob = dd.mm.yyyy
		$bday = new DateTime($dob);
		// $today = new DateTime('00:00:00'); - use this for the current date
		$today = new DateTime(date("d.m.y")); // for testing purposes
		$diff = $today->diff($bday);
		$datebirth =$diff->y.' years,'.$diff->m.' month,'.$diff->d.' days';
		$dobResult =array('years'=>$diff->y,'months'=>$diff->m,'days'=>$diff->d,'dob'=>$datebirth);
		
		$response = array(
							"Status" => SUCCESS,
							"Message"=> MESSAGE,
							"Result" =>$dobResult
						);

		return $response;
	}

	
}