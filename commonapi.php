<?php

	include_once ("classes/userApi.php");
	include_once ("classes/stockdataApi.php");
	
	$countryid ='';

        $obj = new userApi();    
		$stockdataObj = new stockdataApi();    
		
		$textVar = $_GET['Code'];
	
		/* Code to get country list */
		if($textVar == 'country')
		{		
			$data = $obj->countryList();
			echo json_encode($data);
	    }
		
		/* Code to get state list according to country */
		if($textVar == 'state')
		{		
			if(isset($_GET['countryid']) && $_GET['countryid']!='')
			{
				$countryid = $_GET['countryid'];
				$data = $obj->stateList($countryid);
			}
			else{
				$data = array(
							"Status" => FAIL,
							"Message"=> ERRORMESSAGE,
							"Result"=>""
						);
			}			
			echo json_encode($data);
	    }
		
		/* Code to get the city list */
		if($textVar == 'city')
		{		
			if(isset($_GET['stateid']) && $_GET['stateid']!='')
			{
				$stateid = $_GET['stateid'];
				$data = $obj->cityList($stateid);
		
			}
			else
			{
				$data = array(
							"Status" => FAIL,
							"Message"=> ERRORMESSAGE,
							"Result"=>""
						);
			}	
			echo json_encode($data);
	    }
		
		/* Code to check the unique email */
		if($textVar == 'email')
		{	
			if(isset($_GET['emailid']) && $_GET['emailid']!='')
			{
				$emailid = $_GET['emailid'];
				$data = $obj->emailCheck($emailid);
			}
			else
			{
				$data = array(
							"Status" => FAIL,
							"Message"=> ERRORMESSAGE,
							"Result"=>""
						);
			}	
			echo json_encode($data);
	    }
		
		/* Code to get stock report */
		if($textVar == 'stock')
		{	
			if(isset($_GET['tickerCode']) && $_GET['tickerCode']!='')
			{
				$tickerCode = $_GET['tickerCode'];
				$data = $stockdataObj->stockData($tickerCode);
			}
			else
			{
				$data = array(
							"Status" => FAIL,
							"Message"=> ERRORMESSAGE,
							"Result"=>""
						);
			}	
			
			echo json_encode($data);
	    }
		
		/* code to get weather api */
		if($textVar=='weather')
		{		
			if(isset($_GET['query']) && $_GET['query']!='')
			{
				$query = $_GET['query'];
				$data = $obj->weatherReport($query);
			}
			else{
				$data = array(
							"Status" => FAIL,
							"Message"=> ERRORMESSAGE,
							"Result"=>""
						);
			}			
			echo $data;
	    }

?>